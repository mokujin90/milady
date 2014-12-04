<?php

class ProjectController extends BaseController
{
    /**
     * id проекта к которому обращаемся. Необходим, чтобы не таскать между методами параметр
     * @var int
     */
    private $id;

    public function actionIndex()
    {
        $filter = new RegionFilter();
        $filter->apply();
        if(Yii::app()->request->isPostRequest){
            //Makeup::dump($_POST,true);
        }
        //Makeup::dump($_GET,true);
        $criteria = $filter->getCriteria();

        //$criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));
        $models = Project::model()->findAll($criteria);
        $this->render('list',array('filter'=>$filter, 'models' => $models));
    }
    /**
     * Детальная страница проекта
     * @param $id
     */
    public function actionDetail($id)
    {
        if(!$project = Project::model()->findByPk($id)){
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $fieldsList = array(
            Project::T_INNOVATE => array('project_description', 'project_history', 'project_address', 'patent_type', 'patent_value', 'project_step', 'market_size', 'project_price', 'investment_direction', 'financing_terms', 'product_description', 'relevance_type', 'finance', 'profit', 'risk', 'investment_size', 'investment_goal', 'structure_before', 'structure_after', 'investment_type', 'finance_type', 'main_terms', 'investment_tranches', 'swot', 'strategy', 'exit_period', 'exit_price', 'exit_multi', 'short_description', 'programm', 'industry_type'),
            Project::T_INVEST => array('short_description', 'address', 'industry_type', 'market_size', 'project_price', 'investment_form', 'investment_direction', 'financing_terms', 'project_step', 'kap_construction', 'equipment', 'products', 'max_products', 'no_finRevenue', 'no_finCleanRevenue', 'profit', 'risk'),
            Project::T_INFRASTRUCT => array('short_description', 'effect'),
            Project::T_BUSINESS => array('history', 'leadership', 'founders', 'short_description', 'property', 'means', 'reserves', 'assets', 'debts', 'has_bankruptcy', 'has_bail', 'other', 'industry_type', 'share', 'price', 'address', 'age', 'revenue', 'profit', 'costs', 'salary', 'role_type'),
            Project::T_SITE => array('owner', 'ownership', 'location_type', 'site_address', 'site_type', 'problem', 'distance_to_district', 'distance_to_road', 'distance_to_train_station', 'distance_to_air', 'closest_objects', 'has_fence', 'search_area', 'has_road', 'has_rail', 'has_port', 'has_mail', 'area', 'other'),
        );

        $this->render('detail', array('project' => $project, 'fields' => $fieldsList[$project->type]));
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
        $availableAction = array('comments','map');
        if (in_array($action, $availableAction)) {
            $this->{"load" . ucfirst($action)}();
        }
        Yii::app()->end();
    }

    private function loadComments()
    {
        $this->renderPartial("_comments", array('id'=>$this->id),false,true);
    }

    private function loadMap(){
        $project = Project::model()->findByPk($this->id);
        $this->renderPartial("_map", array('model'=>$project),false,true);
    }

    public function actionIniciator($id)
    {
        if (!$model = User::model()->findByPk($id)) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }

        $criteria = new CDbCriteria();

        $criteria->addColumnCondition(array('user_id' => $model->id));
        if (isset($_GET['hide'])) {
            $criteria->addNotInCondition('type', $_GET['hide']);
        }
        $projects = Project::model()->findAll($criteria);

        $this->render('iniciator',array('model' => $model, 'projects' => $projects));
    }

    public function actionNews($id) {
        if (!$model = Project::model()->findByPk($id)) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->breadcrumbs = array(
            'Проекты' => $this->createUrl('project/index'),
            'Страница проекта' => $this->createUrl('project/detail', array('id' => $id)),
            'Новости проекта');
        $this->render('news',array('model' => $model));
    }
    public function actionNewsDetail($id) {
        if (!$model = ProjectNews::model()->findByPk($id)) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->breadcrumbs = array(
            'Проекты' => $this->createUrl('project/index'),
            'Страница проекта' => $this->createUrl('project/detail', array('id' => $model->project_id)),
            'Новости проекта' => $this->createUrl('project/news', array('id' => $model->project_id)),
            $model->name);
        $this->render('newsDetail',array('model' => $model));
    }
}