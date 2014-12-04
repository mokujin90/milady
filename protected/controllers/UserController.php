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
        $this->redirect('/');
    }

    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * @var $model User
     */
    public function actionProfile()
    {
        $model = $this->loadModel('User', null, Yii::app()->user->id);
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->logo_id = Yii::app()->request->getParam('logo_id')=="" ? null : Yii::app()->request->getParam('logo_id');
            if($model->type == 'investor'){
                $model->investor_country_id = Candy::get($_POST['User']['investor_country_id'],null);
                $model->investor_type = Candy::get($_POST['User']['investor_type'],-1);
                $model->investor_industry = Candy::get($_POST['User']['investor_industry'],-1);
            }
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
        $this->render('infrastructureProject', array('model' => $model, 'regions' => $regions));
    }

    public function actionProjectList()
    {

        $criteria = new CDbCriteria();

        $criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));
        if (isset($_GET['hide'])) {
            $criteria->addNotInCondition('type', $_GET['hide']);
        }

        $pages = new CPagination(Project::model()->count($criteria));
        $pages->setPageSize(5);
        $pages->applyLimit($criteria);

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
            if (!$model) {
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
        $model->logo_id = Yii::app()->request->getParam('logo_id')=="" ? null : Yii::app()->request->getParam('logo_id');
        if ($isValidate == '[]') {
            if ($model->save()) {
                $model->{Project::$params[$type]['relation']}->project_id = $model->id;
                if ($model->{Project::$params[$type]['relation']}->save()) {
                    #как только все-все сохранили, так же сохраним файлы
                    if(isset($_POST['file_id'])){
                        $this->checkFiles($model);
                    }
                    $this->redirect(array("user/" . lcfirst(Project::$params[$type]['model']), "id" => $model->id));
                }
            }
        }
    }

    /**
     * Сохраним файлы от переданной модели
     * @param $model Project
     */
    private function checkFiles(&$model){
        #получим все прешедшие id
        $projectFiles = Project2File::model()->findAllByAttributes(array('project_id'=>$model->id),array('index'=>'media_id'));
        $newIds = array_keys($_POST['file_id']);
        $oldIds = array_keys($projectFiles);
        $createItem = array_diff($newIds,$oldIds);
        $deleteItem = array_diff($oldIds,$newIds);

        foreach($createItem as $item){
            $file = new Project2File();
            $file->project_id = $model->id;
            $file->media_id = $_POST['file_id'][$item]['id'];
            $file->name = $_POST['file_id'][$item]['old_name'];
            $file->save();
        }
        Project2File::model()->deleteAllByAttributes(array('media_id'=>$deleteItem,'project_id'=>$model->id));
    }
    /**
     * @param $id
     * @param $type
     * Изменяет состояния объекта в избранном (добавляет/удаляет) в зависимотси от текущего состояния
     */
    public function actionToggleFavorite($id, $type){
        $result = array('success' => false);
        if (!Yii::app()->user->isGuest) {
            if ($favorite = Favorite::model()->findByAttributes(array('user_id' => $this->user->id, "{$type}_id" => $id))) {
                if($favorite->delete()){
                    $result['success'] = true;
                }
            } else {
                $favorite = new Favorite();
                $favorite->user_id = $this->user->id;
                $favorite->{"{$type}_id"} = $id;
                if($favorite->save()){
                    $result['success'] = true;
                }
            }
        }
        $this->renderJSON($result);
    }

    public function actionFavoriteList()
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('t.user_id' => $this->user->id));
        $criteria->with = 'project';
        if (isset($_GET['hide'])) {
            $criteria->addNotInCondition('project.type', $_GET['hide']);
        }
        $criteria->order = 't.id DESC';

        $pages = new CPagination(Favorite::model()->count($criteria));
        $pages->setPageSize(10);
        $pages->applyLimit($criteria);

        $models = Favorite::model()->findAll($criteria);

        $this->render('favoriteList', array('models' => $models, 'pages' => $pages));
    }

    /**
     * Ajax-ответ на поиск пользователей
     * @param $term
     */
    public function actionGetUserJSON($term)
    {
        $json = array();
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('name', $term, true);
        $criteria->addSearchCondition('login', $term, true, 'OR');
        $models = User::model()->findAll($criteria);
        foreach ($models as $model) {
            $json[] = array('label' => $model->name, 'value' => $model->id);
        }
        $this->renderJSON($json);
    }

    public function actionIndex()
    {
        $filter = new FeedFilter();
        if (isset($_GET['hide']) && is_array($_GET['hide'])) {
            $filter->hideProjectByType = implode(',', $_GET['hide']);
        }
        $data = $filter->apply($this->user);
        try {
            $pages = $this->applyLimit($data, null, 10);
        } catch (Exception $e) {
            $data = array();
            $pages = new CPagination();
        }
        $this->addAdvancedData($data);
        $this->render('index', array('filter' => $filter, 'data' => $data, 'pages' => $pages));
    }

    private function addAdvancedData(array &$data)
    {
        foreach ($data as $key => $item) {
            if($item['object_name'] == 'project_comment'){
                $data[$key]['model'] = Project::model()->findByPk($data[$key]['target_id']);
            } elseif($item['object_name'] == 'region_news') {
                $data[$key]['model'] = News::model()->findByPk($data[$key]['id']);
            } elseif($item['object_name'] == 'project_news') {
                $data[$key]['model'] = Project::model()->findByPk($data[$key]['target_id']);
                $data[$key]['alt_model'] = ProjectNews::model()->findByPk($data[$key]['id']);
            }
        }
    }

    public function actionProjectNews($id = null, $project = null){
        $model = null;
        if ($id) {
            $criteria = new CDbCriteria();
            $criteria->with = 'project';
            $criteria->addColumnCondition(array('t.id' => $id, 'project.user_id' => Yii::app()->user->id));
            $model = ProjectNews::model()->find($criteria);
        } elseif ($project) {
            if ($projectModel = Project::model()->findByAttributes(array('id' => $project, 'user_id' => Yii::app()->user->id))) {
                $model = new ProjectNews();
                $model->project_id = $projectModel->id;
            }
        }
        if (!$model) {
            throw new CHttpException(404, Yii::t('main', 'Указанная запись не найдена'));
        }
        if (isset($_POST['ProjectNews'])) {
            $isValidate = CActiveForm::validate($model);
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            if ($isValidate == '[]') {
                if ($model->save()) {
                    $this->redirect($model->project->createUserUrl());
                }
            }
        }

        $this->render('projectNewsDetail', array('model' => $model));


    }
}