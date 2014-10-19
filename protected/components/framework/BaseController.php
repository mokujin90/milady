<?php

class BaseController extends CController
{
    public $layout = '//layouts/column2';

    public $breadcrumbs = array();
    public $interface = array(
        'slim_menu'=>true
    );
    public $mailer;
    public $user;

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
        new JsTrans('main',Yii::app()->language);
        parent::init();
    }


    /*public function filters()
    {
        return array(
            'accessControl',
            'roleAccessControl'
        );
    }*/

    /*public function accessRules()
    {
        return array(
            array('deny',
                'users' => array('?'),
            ),
        );
    }*/


    /*public function filterRoleAccessControl($filterChain)
    {
        if (!$this->user) {
            Yii::app()->user->logout(false);
            Yii::app()->user->loginRequired();
        }

        $allowed = false;

        if (Yii::app()->user->checkAccess($this->id . 'Controller')) {
            $allowed = true;
        } else {
            $action = $this->action ? $this->action->id : null;
            if ($action && Yii::app()->user->checkAccess($this->id . '.' . $action)) {
                $allowed = true;
            }
        }
        if (!$allowed) {
            throw new CHttpException(403, Yii::t('yii', 'You are not authorized to perform this action.'));
        } else {
            $filterChain->run();
        }
    }*/

    public function redirectByRole()
    {
        $this->redirect('/');
    }

    public function getPageTitle()
    {
        $path = array();
        $breadcrumbs = $this->breadcrumbs;
        foreach ($breadcrumbs as $item) {
            $path = array_merge(array($item['name']), $path);
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
     * Иногда при загрузки формы через fancybox и нахождения в ней CActiveForm назло второй раз прогружается jquery
     */
    public function blockJquery(){
        if( Yii::app()->request->isAjaxRequest ) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        }
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

}