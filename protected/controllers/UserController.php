<?php

class UserController extends BaseController
{
    public $defaultAction = 'login';

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('deny',
                'actions' => array('login', 'register'),
                'users' => array('@'),
            ),
        );
    }

    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirectByRole();
        }
        $model = new LoginForm;
        $json = array('error' => '[]', 'status' => false, 'url' => $this->createUrl('/'));
        if (Yii::app()->request->isAjaxRequest) {
            $json['error'] = CActiveForm::validate($model);

            if ($json['error'] == '[]') {
                if ($model->validate() && $model->login()) {
                    $json['status'] = true;
                }
            }
            $this->renderJSON($json);
        }
        $this->render('/');
    }

    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionProfile()
    {
        $model = $this->loadModel('User', null, Yii::app()->user->id);
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->save();
        }
        $this->render('update', array('model' => $model));
    }

    public function actionInvestmentProject($id = null)
    {
        if(empty($id)){
            $model = new Project();
            $model->investment = new InvestmentProject();
        }
        else{
            $model = $this->loadModel('Project', null, $id);
        }
        if (isset($_POST['Project'])) {
            CActiveForm::validate(array($model,$model->investment));
            $model->user_id = Yii::app()->user->id;
            if($model->save()){
                $model->investment->project_id = $model->id;
                if( $model->investment->save()){
                    Yii::app()->request->redirect('/');
                }
            }
        }
        $regions = Region::model()->findAll();
        $this->render('investmentProject', array('model' => $model,'regions'=>$regions));
    }
    public function actionProjectList()
    {
        $item_count = 32;
        $page_size = 5;

        $pages = new CPagination($item_count);
        $pages->setPageSize($page_size);

        // simulate the effect of LIMIT in a sql query
        $end = ($pages->offset + $pages->limit <= $item_count ? $pages->offset + $pages->limit : $item_count);

        $sample = range($pages->offset + 1, $end);

        $criteria = new CDbCriteria();

        $criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));
        $models = Project::model()->findAll($criteria);

        $this->render('projectList', array('models' => $models, 'pages' => $pages));
    }
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function getBreadcrumbs()
    {
        static $count = 0;
        if ($count++ > 0) {
            return parent::getBreadcrumbs();
        }

        switch ($this->action->id) {
            case 'login':
                $this->addBreadcrumb(array('name' => 'Вход'));
                break;
        }

        return parent::getBreadcrumbs();
    }
}