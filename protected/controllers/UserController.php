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
        $model = $this->loadProject($id, Project::T_INVEST);
        if (isset($_POST['Project']) || isset($_POST[Project::$params[Project::T_INVEST]['model']])) {
            $this->save($model, Project::T_INVEST);
        }
        $regions = Region::model()->findAll();
        $this->render('investmentProject', array('model' => $model, 'regions' => $regions));
    }

    public function actionBusiness($id = null)
    {
        $model = $this->loadProject($id, Project::T_BUSINESS);
        if (isset($_POST['Project']) || isset($_POST[Project::$params[Project::T_BUSINESS]['model']])) {
            $this->save($model, Project::T_BUSINESS);
        }
        $regions = Region::model()->findAll();
        $this->render('business', array('model' => $model, 'regions' => $regions));
    }

    public function actionInfrastructureProject($id = null)
    {
        $model = $this->loadProject($id, Project::T_INFRASTRUCT);
        if (isset($_POST['Project']) || isset($_POST[Project::$params[Project::T_INFRASTRUCT]['model']])) {
            $this->save($model, Project::T_INFRASTRUCT);
        }
        $regions = Region::model()->findAll();
        $this->render('infrastructureSite', array('model' => $model, 'regions' => $regions));
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

    public function actionInvestmentSite($id = null)
    {
        $model = $this->loadProject($id, Project::T_SITE);
        if (isset($_POST['Project']) || isset($_POST[Project::$params[Project::T_SITE]['model']])) {
            $this->save($model, Project::T_SITE);
        }
        $regions = Region::model()->findAll();
        $this->render('investmentSite', array('model' => $model, 'regions' => $regions));
    }

    public function actionInnovativeProject($id = null)
    {
        $model = $this->loadProject($id, Project::T_INNOVATE);
        if (isset($_POST['Project']) || isset($_POST[Project::$params[Project::T_INNOVATE]['model']])) {
            $this->save($model, Project::T_INNOVATE);
        }
        $regions = Region::model()->findAll();
        $this->render('innovativeProject', array('model' => $model, 'regions' => $regions));
    }

    private function loadProject($id, $type)
    {
        if (empty($id)) {
            $model = new Project();
            $modelName = Project::$params[$type]['model'];
            $model->{Project::$params[$type]['relation']} = new $modelName;
        } else {
            $model = Project::model()->findByAttributes(array('id' => $id, 'type' => $type, 'user_id' => Yii::app()->user->id));
            if (is_null($model)) {
                throw new CHttpException(404, Yii::t('main', 'Указанная запись не найдена'));
            }
        }
        return $model;
    }

    private function save(&$model, $type)
    {
        $model->user_id = Yii::app()->user->id;
        $model->type = $type;
        $isValidate = CActiveForm::validate(array($model, $model->{Project::$params[$type]['relation']}));
        if ($isValidate == '[]') {
            if ($model->save()) {
                $model->{Project::$params[$type]['relation']}->project_id = $model->id;
                if ($model->{Project::$params[$type]['relation']}->save()) {
                    $this->redirect(array("user/" . lcfirst(Project::$params[$type]['model']), "id" => $model->id));
                }
            }
        }
    }
}