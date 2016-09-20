<?php

class ProjectController extends BaseController
{
    /**
     * id проекта к которому обращаемся. Необходим, чтобы не таскать между методами параметр
     * @var int
     */
    private $id;
    public $project = null;

    public function actionIndex($map = 0)
    {
        if(isset($_REQUEST['RegionFilter'])){
            $_SESSION['RegionFilter'] = $_REQUEST['RegionFilter'];
        } elseif(isset($_SESSION['RegionFilter'])){
            $_REQUEST['RegionFilter'] = $_SESSION['RegionFilter'];
        }
        session_write_close(); //закрываем, чтобы по AJAX писать в $_SESSION['RegionFilter']
        $limit = Yii::app()->request->getParam('limit',5);
        $limit = $limit > 50 ? 50 : $limit;

        $filter = new RegionFilter();
        $filter->apply();
        if (Yii::app()->request->isPostRequest) {
            //Makeup::dump($_POST,true);
        }
        //Makeup::dump($_GET,true);
        $criteria = $filter->getCriteria();
        $this->setSort($criteria);
        //$criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));
        $pages = null;
        if(empty($map) && !Yii::app()->request->isAjaxRequest){
            $pages = $this->applyLimit($criteria, 'Project',$limit);
            $this->breadcrumbs = array('Список проектов');
        } else {
            $this->breadcrumbs = array('Проекты на карте');
        }

        $models = Project::model()->with('commentCount')->findAll($criteria);
        $filter->selectedCount = Project::model()->count($criteria);

        if(Yii::app()->request->isAjaxRequest){
            $result = array(
                'success' => true,
                'data' => array(),
                'count_text' => Candy::getNumEnding($filter->selectedCount, array(Yii::t('main', 'Выбран'),  Yii::t('main', 'Выбрано'),  Yii::t('main', 'Выбрано'))) . " " . $filter->selectedCount . " " . Candy::getNumEnding($filter->selectedCount, array(Yii::t('main', 'проект'),  Yii::t('main', 'проекта'),  Yii::t('main', 'проектов')))
            );
            foreach($models as $project){
                $result['data'][] = array(
                    'id' => $project->id,
                    'lon' => $project->lon,
                    'lat' => $project->lat,
                    'icon' => Map::getIconMarker($project->type)
                );
            }
            $this->renderJSON($result);
        }
        $this->render(empty($map) ? 'list' : 'map', array('filter' => $filter, 'models' => $models, 'pages' => $pages));
    }

    private function setSort(&$criteria){
        $sort = Yii::app()->request->getParam('sort',null);
        if($sort == 'name_up'){
            $criteria->order = 'name ASC';
        }
        elseif($sort == 'name_down'){
            $criteria->order = 'name DESC';
        }
        elseif($sort == 'sum_up'){
            $criteria->order = 'investment_sum ASC';
        }
        elseif($sort == 'sum_down'){
            $criteria->order = 'investment_sum DESC';
        }
        elseif($sort == 'period_up'){
            $criteria->order = 'period ASC';
        }
        elseif($sort == 'period_down'){
            $criteria->order = 'period DESC';
        }
        elseif($sort == 'profit_up'){
            $criteria->order = 'profit_clear ASC';
        }
        elseif($sort == 'profit_down'){
            $criteria->order = 'profit_clear DESC';
        }

    }
    /**
     * Детальная страница проекта
     * @param $id
     */
    public function actionDetail($id)
    {
        $this->layout = 'main_old';

        $params = array();
        if (!$project = Project::model()->findByPk($id)) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        if ($project->is_disable || $project->status!='approved') {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $project->view_count += 1;
        $project->update();
        if($this->user){
            UserView::addView('project', $this->user->id, $project->user_id);
        }
        $project->setAdvancedInfo();
        $this->breadcrumbs = array(
            'Проекты' => $this->createUrl('project/index'),
            $project->name);

        $fieldsList = Project::$fieldsList;
        $params['hasRequest'] = Investor2Project::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'project_id' => $id));
        $view = 'detail';
        if ($project->type == Project::T_INVEST) {
            $this->layout = 'mainProject';
            $view = 'project_invest';
        }
        $this->project = $project;
        $this->render($view, array('project' => $project, 'params' => $params, 'fields' => $fieldsList[$project->type]));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel('Project', null, $id);
        if ($model->user_id != Yii::app()->user->id) {
            throw new CHttpException(403, Yii::t('main', 'Нет пути'));
        }
        $model->delete();
        $this->redirect($this->createUrl('user/projectList'));
    }

    public function actionRemove()
    {
        $models = Project::model()->findAllByAttributes(array('id' => $_REQUEST['id']));
        foreach ($models as $model) {
            if ($model->user_id != Yii::app()->user->id)
                continue;
            $model->delete();
        }
    }

    /**
     * Мини-фронт контроллер, для выдачи дополнительных данных по проекту. Отдается через ajax
     * Вызывает другие закрытые методы, которые в свою очередь возваращают куски вью
     * @param $id
     * @param $action
     */
    public function actionGetInfo($id, $action)
    {

        if (!Yii::app()->request->isAjaxRequest) {
            return false;
        }
        $this->id = $id;
        $availableAction = array('comments', 'map', 'photo', 'documents', 'params','financial','discription');
        if (in_array($action, $availableAction)) {
            $this->{"load" . ucfirst($action)}();
        }
        Yii::app()->end();
    }

    private function loadDiscription(){
        $project = Project::model()->findByPk($this->id);
        $this->renderPartial("_description", array('model' => $project), false, true);
    }
    private function loadFinancial()
    {
        $project = Project::model()->findByPk($this->id);
        $this->renderPartial("_financial", array('model' => $project), false, true);
    }

    private function loadComments()
    {
        $this->renderPartial("_comments", array('id' => $this->id), false, true);
    }

    private function loadMap()
    {
        $project = Project::model()->findByPk($this->id);
        $this->renderPartial("_map", array('model' => $project), false, true);
    }

    private function loadPhoto()
    {
        $documents = Project2File::model()->with('media')->findAllByAttributes(array('project_id' => $this->id), array('condition' => 'media.type=1'));
        $this->renderPartial("_photo", array('models' => $documents), false, true);
    }

    private function loadDocuments()
    {
        $documents = Project2File::model()->with('media')->findAllByAttributes(array('project_id' => $this->id), array('condition' => 'media.type=0'));
        $this->renderPartial("_documents", array('models' => $documents), false, true);
    }

    private function loadParams()
    {
        $project = Project::model()->findByPk($this->id);
        $fieldsList = Project::$fieldsList;
        $this->renderPartial("_params", array('project' => $project, 'fields' => $fieldsList[$project->type]), false, true);
    }

    public function actionTest()
    {
        /*$regions = Region::model()->findAll();
        foreach($regions as $model){
            $data = file_get_contents(Map::NOMINATIM_URL . "&q=" . urlencode($model->name));
            $json = json_decode($data, true);
            if(!isset($json[0])){
                continue;
            }
            $coordsCenter =  $json[0];
            $model->lat = $coordsCenter['lat'];
            $model->lon = $coordsCenter['lon'];
            $model->save();
            Makeup::dump($model->name);
        }*/
    }

    public function actionMapInfo($id, $extend = 0)
    {
        Candy::cleanBuffer();
        $model = Project::model()->findByPk($id);
        if (is_null($model)) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        //$content = ActiveRecord::model(Project::$params[$model->type]['model'])->findByAttributes(array('project_id'=>$model->id));
        $this->renderPartial(empty($extend) ? '_ajaxInfo' : '_ajaxMapInfo', array('model' => $model));
    }

    public function actionNews($id)
    {
        if (!$model = Project::model()->findByPk($id)) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->breadcrumbs = array(
            'Проекты' => $this->createUrl('project/index'),
            $model->name => $this->createUrl('project/detail', array('id' => $id)),
            'Новости проекта');
        $this->render('news', array('model' => $model));
    }

    public function actionNewsDetail($id)
    {
        if (!$model = ProjectNews::model()->findByPk($id)) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->breadcrumbs = array(
            'Проекты' => $this->createUrl('project/index'),
            $model->project->name => $this->createUrl('project/detail', array('id' => $model->project_id)),
            'Новости проекта' => $this->createUrl('project/news', array('id' => $model->project_id)),
            $model->name);
        $this->render('newsDetail', array('model' => $model));
    }

    public function actionNewsDelete($id)
    {

        $model = $this->loadModel('ProjectNews', null, $id);
        if ($model->project->user_id != Yii::app()->user->id) {
            throw new CHttpException(403, Yii::t('main', 'Нет пути'));
        }
        $model->delete();
        $this->redirect($this->createUrl($model->project->createUserUrl()));
    }

    /**
     * Добавить запрос на добавление в проект инвестора
     * @param $projectId int
     */
    public function actionNewRequest($projectId)
    {
        if (Yii::app()->user->isGuest || $this->user->type != User::T_INVESTOR) {
            $this->renderJSON(array('status' => 'No'));
        }
        if (!$model = Project::model()->findByPk($projectId)) { #только для существующих проектов
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $count = Investor2Project::model()->countByAttributes(array('user_id' => Yii::app()->user->id, 'project_id' => $projectId));
        if ($count > 0 || $model->user_id == Yii::app()->user->id) { #самого себя не добавляем и не добавляем повторно
            $this->renderJSON(array('status' => 'No'));
        }
        $request = new Investor2Project();
        $request->user_id = Yii::app()->user->id;
        $request->project_id = $projectId;
        $request->save();
        $this->renderJSON(array('status' => 'Ok', 'initiator' => $model->user_id, 'project_id' => $projectId));
    }

    public function actionApproveRequest($requestId)
    {
        if (!$model = Investor2Project::model()->findByPk($requestId)) {
            $this->redirectByRole();
        }
        #создатель проекта - не мы
        $project = Project::model()->findByPk($model->project_id);
        if ($project->user_id != Yii::app()->user->id) {
            $this->redirect($project->createUserUrl());
        }
        $model->is_active = 1;
        if ($model->save()) {
            Message::sendSystemMessage($model->user_id,
                Yii::t('main', 'Добавление в проект'),
                Yii::t('main', 'Вы добавлены в проект "{n}"', array('{n}' => $project->name)));
        }
        $this->redirect($project->createUserUrl());
    }

    public function actionRemoveRequest($requestId)
    {
        if (!$model = Investor2Project::model()->findByPk($requestId)) {
            $this->redirectByRole();
        }
        #создатель проекта - не мы
        $project = Project::model()->findByPk($model->project_id);
        if ($project->user_id != Yii::app()->user->id) {
            $this->redirect($project->createUserUrl());
        }
        $model->delete();
        $this->redirect($project->createUserUrl());
    }

    public function actionFind($urlLatine)
    {
        $project = Project::model()->findByAttributes(array('url' => $urlLatine));
        if ($project) {
            $this->actionDetail($project->id);
        } else {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
    }


}