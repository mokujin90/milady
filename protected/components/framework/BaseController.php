<?php

class BaseController extends CController
{
    const S_SUCCESS = 'success';
    const S_ERROR = 'error';
    const DEFAULT_CURRENT_REGION = 13;
    public $layout = '//layouts/column2';

    /**
     * Массив для ajax-ответов
     * @var array
     */
    public $json = array();

    /**
     * array is label=>url
     * EXAMPLE:
     *array(
     *'Label1'=>array('route1'),
     *'Label2'=>array('route2'),
     *'Label3');
     *
     */
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

    protected $currentRegion; //текущий город, по умолчанию Москва

    public function init()
    {
        header('Content-Type: text/html; charset=utf-8');
        /*
                $this->mailer =& Yii::app()->mailer;
                $this->mailer->CharSet = 'windows-1251';
                $this->mailer->From = Yii::app()->params['fromEmail'];
                $this->mailer->FromName = iconv("UTF-8", "windows-1251", Yii::app()->params['fromName']);*/

        if (!Yii::app()->user->isGuest) {
            $this->user = User::model()->findByPk(Yii::app()->user->id);
        }
        new JsTrans('main', Yii::app()->language);
        parent::init();
        $this->currentRegion = $this->getCurrentRegion();
        $this->region = Region::model()->findByPk($this->currentRegion);

    }

    public function blockJquery()
    {
        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.ui.min.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.ui.js'] = false;
        }
    }

    protected function beforeAction($action)
    {
        $loginOnlyController = array('message','user');
        $accessAction = array('login','feedback','register','confirm','waitConfirm','subscribe','restore','restoreForm');
        if(Yii::app()->user->isGuest && in_array($action->controller->id,$loginOnlyController) && !in_array($action->id,$accessAction)){
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
            );
        }
        return true;
    }

    /**
     * Геттер для закрытого атрибута текущего города. Лучше все делать через него
     * @return int|string
     */
    public function getCurrentRegion()
    {
        $cookieRegion = $this->getCookie('currentRegion');
        return is_null($cookieRegion) ? self::DEFAULT_CURRENT_REGION : $cookieRegion;
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

}