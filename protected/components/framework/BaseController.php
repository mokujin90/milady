<?php

class BaseController extends CController
{
    const S_SUCCESS = 'success';
    const S_ERROR = 'error';
    const DEFAULT_CURRENT_REGION = 13;
    public $layout = '//layouts/column2';

    const L_RUSSIA = 0;
    const L_ENGLISH = 1;

    static private $languageList = array(
        self::L_RUSSIA => 'ru',
        self::L_ENGLISH => 'en_US'
    );
    public $currentLanguage = self::L_RUSSIA;
    /**
     * Массив для ajax-ответов
     * @var array
     */
    public $json = array();

    public $breadcrumbs = array();
    public $globalSearch = '';
    public $interface = array(
        'slim_menu' => true
    );
    public $mailer;
    /**
     * @var User
     */
    public $user;
    /**
     * @var Region
     */
    public $region;
    private $_balance = 0;
    public $footerContent = false;
    protected $currentRegion = null; //текущий город, по умолчанию Москва

    public function init()
    {
        header('Content-Type: text/html; charset=utf-8');
        parent::init();
        $this->currentRegion = $this->getCurrentRegion();
        $this->region = Region::model()->findByPk($this->currentRegion);
        if (!Yii::app()->user->isGuest) {
            $this->user = User::model()->findByPk(Yii::app()->user->id);
            $this->currentLanguage = $this->user->language_id;
            $this->_balance = Balance::get(Yii::app()->user->id);
        } else {
            Direct::add($this->currentRegion);
            $langInCookie = $this->getCookie('languageId');
            $this->currentLanguage = empty($langInCookie) ? self::L_RUSSIA : $langInCookie;
        }
        Yii::app()->language = $this->getLanguage();
        new JsTrans('main', Yii::app()->language);

    }

    public function blockJquery()
    {
        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.ui.min.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.ui.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.crud.select.js'] = false;
        }
    }

    protected function beforeAction($action)
    {
        if (!Yii::app()->user->isGuest && !$this->user->validate()) {
            if ($action->controller->id == 'user' && $action->id == 'logout') {
                return true;
            }
            Yii::app()->user->setFlash('error', "Функционал ограничен до момента заполнения профиля и активации аккаунта");
            if (!($action->controller->id == 'user' && $action->id == 'profile')) {
                $this->redirect($this->createUrl('user/profile'));
            }
            return true;
        }

        $loginOnlyController = array('message', 'user', 'banner');
        $accessAction = array('login', 'feedback', 'register', 'confirm', 'waitConfirm', 'subscribe', 'restore', 'restoreForm', 'admin', 'getUserJSON', 'view', 'click');
        if (Yii::app()->user->isGuest && in_array($action->controller->id, $loginOnlyController) && !in_array($action->id, $accessAction)) {
            $this->redirect($this->createUrl('site/index'));
        }
        return true;
    }


    /**
     * Решаем проблемы повторной загрузки никому не нужных скриптов при ajax-загрузки.
     * Yii этим грешит, когда мы выполняем renderPartial с параметров $htmlOutput = true
     * @param string $view
     * @return bool
     */
    protected function beforeRender($view)
    {
        parent::beforeRender($view);
        if (Yii::app()->request->isAjaxRequest) {
            $cs = Yii::app()->clientScript;
            $cs->scriptMap = array(
                'jquery.js' => false,
                'jquery-ui.min.js' => false,
                'jquery-ui.css' => false,
                'jquery.crud.select.js' => false,
            );
        }
        Candy::cleanBuffer();
        return true;
    }

    /**
     * Геттер для закрытого атрибута текущего города. Лучше все делать через него
     * @return int|string
     */
    public function getCurrentRegion()
    {
        if (!is_null($this->currentRegion)){
            return $this->currentRegion;
        }
        $regionId = null;
        $subDomain = $this->getCurrentDomain();

        if ($subDomain) { #попробуем найти регион в домене
            $regionDomain = Region::model()->findByAttributes(array('latin_name' => $subDomain));
            if ($regionDomain) {
                $regionId = $regionDomain->id;
            }
        }
        if (is_null($regionId)) {
            $regionId = Setting::get(Setting::REGION_DEFAULT);
        }
        return $regionId;
    }

    public function detectCity()
    {
        $res = null;

        $geo = new Geo(array('charset' => 'utf-8'));
        $city = $geo->get_value('city', false);

        if (strlen($city)) {
            $criteria = new CDbCriteria();
            $criteria->addColumnCondition(array('type' => 'city', 'name' => $city, 'is_blocked' => 0));
            $res = Region::model()->find($criteria);
        }
        return $res;
    }

    public function getBalance()
    {
        return $this->_balance;
    }

    public function redirectByRole()
    {
        $this->redirect('/');
    }

    public function getPageTitle()
    {
        $path = array();
        $breadcrumbs = $this->breadcrumbs;
        $count = count($breadcrumbs);
        foreach ($breadcrumbs as $key => $item) {
            $count--;
            $path = array_merge(array($count ? $key : $item), $path);
        }

        $title = implode(' | ', array_merge($path, array(Yii::app()->name)));

        return $title;
    }

    public function getMainMenu()
    {
        $data = array();

        // data[] = array('id' => 'members', 'name' => 'Сотрудники', 'url' => $this->createUrl('member/index'));

        return $data;
    }


    public function loadModel($modelName, $paramName = null, $id = null)
    {
        if (!$id) {
            if (isset($paramName) && isset($_GET[$paramName])) {
                $id = $_GET[$paramName];
            } else if (isset($_GET['modelId'])) {
                $id = $_GET['modelId'];
            }
        }
        if ($id) {
            $criteria = new CDbCriteria();
            $criteria->addColumnCondition(array('id' => $id));

            /*if ($modelName == 'User') {
                $criteria->addColumnCondition(array('is_blocked' => 0, 'is_confirmed' => 1));
            }*/

            $model = CActiveRecord::model($modelName)->find($criteria);
        }
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Сахар для ajax-валидации и закрытия приложения
     * @param array $data
     */
    public function renderJSON($data)
    {
        Candy::cleanBuffer();
        header('Content-type: application/json');
        echo CJSON::encode($data);
        /*foreach ( Yii::app()->log->routes as $route ) {
            if ( $route instanceof CWebLogRoute ) {
                $route->enabled = false; // закрыть ведени всех логов
            }
        }*/
        Yii::app()->end();
    }

    /**
     * Геттер для куки
     * @param $name
     * @return string
     */
    public function getCookie($name)
    {
        $cookie = Yii::app()->request->cookies[$name];
        return $cookie ? $cookie->value : null;
    }

    /**
     * Сеттер для cookie
     * @param $name
     * @param $value
     */
    public function setCookie($name, $value)
    {
        $cookie = new CHttpCookie($name, $value);
        Yii::app()->request->cookies[$name] = $cookie;
    }

    /**
     * Сахар, который поможет в создании пейджера на страницах с обычной критерией
     *
     * @param CDbCriteria|CDbCommand $criteria ссылка на критерию, к которой применится applyLimit
     * @param str $modelName название модели
     * @param int $pageCount необходимое количество элементов на странице
     * @return $pager CPagination
     *
     * @see http://rmcreative.ru/blog/post/postranichnaja-razbivka-v-yii
     */
    public function applyLimit(CComponent &$query, $modelName = null, $pageCount = 10)
    {
        $pages = new CPagination();
        if (is_a($query, 'CDbCriteria')) {
            #все из-за проблемы, и того что запрос не исполняется если там если там GROUP BY + CActiveRecord::count()
            $count = $query->group == '' ? CActiveRecord::model($modelName)->count($query) : count(CActiveRecord::model($modelName)->findAll($query));
            $pages->setItemCount($count);
            $pages->pageSize = $pageCount; // элементов на страницу
            $pages->applyLimit($query);
        } elseif (is_a($query, 'CDbCommand')) {
            $dataProvider = new CArrayDataProvider($query->queryAll(), array(
                'pagination' => array(
                    'pageSize' => $pageCount,
                ),
            ));
            $query = $dataProvider->getData();
            return $dataProvider->pagination;
        }
        return $pages;
    }

    public function getActionName()
    {
        return Yii::app()->controller->action->id;
    }

    /**
     * Вернуть обозначения языка в нормальном виде для yii
     * @param $languageId
     * @return string
     */
    public function getLanguage($languageId = null)
    {
        if (is_null($languageId)) {
            $languageId = $this->currentLanguage;
        }
        return !array_key_exists($languageId, self::$languageList) ? self::$languageList[self::L_RUSSIA] : self::$languageList[$languageId];
    }

    public function getCurrentDomain()
    {
        $subdomainName = explode('.', $_SERVER['HTTP_HOST']);
        $result = $subdomainName[0];
        return $result;
    }

    /**
     * Получить текущий округ
     */
    public function getCurrentArea($areaId=null){
        $array = array(
            1=>Yii::t('main','Центральный округ'),2=>Yii::t('main','Северо-Западный округ'),
            3=>Yii::t('main','Южный округ'), 4=>Yii::t('main','Северо-Кавказский округ'),
            5=>Yii::t('main','Приволжский округ'),6=>Yii::t('main','Уральский округ'),
            7=>Yii::t('main','Сибирский округ'), 8=>Yii::t('main','Дальневосточный округ')
        );
        return $array[$areaId];
    }

    public function getMenu()
    {
        return array(
            'news' => array(
                'name' => Yii::t('main', 'Новости'),
                'items' => array(
                    array(
                        'name' => Yii::t('main', 'Региональные новости'),
                        'url' => '/news/index/type/region'
                    ),
                    array(
                        'name' => Yii::t('main', 'Федеральные новости'),
                        'url' => '/news/index/type/federal'
                    ),
                    array(
                        'name' => Yii::t('main', 'Новости IIP'),
                        'url' => '/news/index/type/iip'
                    ),
                    array(
                        'name' => Yii::t('main', 'Аналитика'),
                        'url' => '/news/index/type/analytics'
                    ),
                    array(
                        'name' => Yii::t('main', 'События'),
                        'url' => '/news/index/type/event'
                    ),
                )
            ),
            'info' => array(
                'name' => Yii::t('main', 'Информация'),
                'items' => array(
                    /*array(
                        'name' => Yii::t('main', 'Состав проектов'),
                        'url' => '#'
                    ),*/
                    array(
                        'name' => Yii::t('main', 'Контакты'),
                        'url' => '/site/contacts'
                    ),
                    array(
                        'name' => Yii::t('main', 'О проекте'),
                        'url' => '/site/aboutus'
                    ),
                    array(
                        'name' => Yii::t('main', 'Команда'),
                        'url' => '/site/team'
                    ),
                    /*array(
                        'name' => Yii::t('main', 'Обратная связь'),
                        'url' => '#'
                    ),
                    array(
                        'name' => Yii::t('main', 'Услуги портала'),
                        'url' => '#'
                    ),*/
                )
            ),
            /*'service' => array(
                'name' => Yii::t('main', 'Сервис'),
                'items' => array(
                    array(
                        'name' => Yii::t('main', 'Конкурсы'),
                        'url' => '#'
                    ),
                    array(
                        'name' => Yii::t('main', 'Библиотека'),
                        'url' => '#'
                    ),
                    array(
                        'name' => Yii::t('main', 'Группы'),
                        'url' => '#'
                    ),
                    array(
                        'name' => Yii::t('main', 'Справочник'),
                        'url' => '#'
                    ),
                )
            ),*/
            'invest' => array(
                'name' => Yii::t('main', 'Инвестиции'),
                'items' => array(
                    array(
                        'name' => Yii::t('main', 'Инвесторы'),
                        'url' => '/investor/index'
                    ),
                    array(
                        'name' => Yii::t('main', 'Инвестиционные проекты'),
                        'url' => '/project/index?RegionFilter%5BisInvestment%5D=1&RegionFilter%5BisInnovative%5D=0&RegionFilter%5BisInfrastructure%5D=0&RegionFilter%5BisBusinessSale%5D=0&RegionFilter%5BisInvestPlatform%5D=0'
                    ),
                   /* array(
                        'name' => Yii::t('main', 'Инновационные проекты'),
                        'url' => '/project/index?RegionFilter%5BisInvestment%5D=0&RegionFilter%5BisInnovative%5D=1&RegionFilter%5BisInfrastructure%5D=0&RegionFilter%5BisBusinessSale%5D=0&RegionFilter%5BisInvestPlatform%5D=0'
                    ),
                    array(
                        'name' => Yii::t('main', 'Инфраструктурные проекты'),
                        'url' => '/project/index?RegionFilter%5BisInvestment%5D=0&RegionFilter%5BisInnovative%5D=0&RegionFilter%5BisInfrastructure%5D=1&RegionFilter%5BisBusinessSale%5D=0&RegionFilter%5BisInvestPlatform%5D=0'
                    ),
                    array(
                        'name' => Yii::t('main', 'Инвестиционная площадка'),
                        'url' => '/project/index?RegionFilter%5BisInvestment%5D=0&RegionFilter%5BisInnovative%5D=0&RegionFilter%5BisInfrastructure%5D=0&RegionFilter%5BisBusinessSale%5D=0&RegionFilter%5BisInvestPlatform%5D=1'
                    ),
                    array(
                        'name' => Yii::t('main', 'Продажа бизнеса'),
                        'url' => '/project/index?RegionFilter%5BisInvestment%5D=0&RegionFilter%5BisInnovative%5D=0&RegionFilter%5BisInfrastructure%5D=0&RegionFilter%5BisBusinessSale%5D=1&RegionFilter%5BisInvestPlatform%5D=0'
                    ),*/
                )
            ),
            'region' => array(
                'name' => Yii::t('main', 'О регионе'),
                'items' => array(
                    array(
                        'name' => Yii::t('main', 'Социально-экономическая информация'),
                        'url' => '/region/social'
                    ),
                    array(
                        'name' => Yii::t('main', 'Инновационный паспорт'),
                        'url' => '/region/innovative'
                    ),
                    array(
                        'name' => Yii::t('main', 'Инвестиционный паспорт'),
                        'url' => '/region/invest'
                    ),
                    array(
                        'name' => Yii::t('main', 'Инфраструктурный паспорт'),
                        'url' => '/region/infrastructure'
                    ),
                    array(
                        'name' => Yii::t('main', 'Региональное законодательство'),
                        'url' => '/region/law'
                    ),
                )
            ),
        );
    }
}