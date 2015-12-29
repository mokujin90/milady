<?php
class AdminStatisticController extends AdminBaseController
{
    public $model = null;
    public $enableModels = array(
        'User',
        'Banner',
        'FeedBanner',
        'News',
        'Analytics',
        'Event',
        'Project',
    );

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->pageCaption = 'Statistic';
        $this->activeMenu = array('statistic');
        return true;
    }

    public function actionIndex($ref)
    {
        $this->checkRef($ref);
        $filter = $this->getFilter();
        $criteria = new CDbCriteria();
        $this->checkFilter($criteria,$filter);
        $this->render('index', array(
            'filterCount'=>ActiveRecord::model($this->model)->count($criteria),
            'count' => $this->getAllCount(),
            'chart' => $this->getChart($filter),
            'filter'=>$filter
        ));
    }


    protected function getAllCount(){
        return ActiveRecord::model($this->model)->count();
    }

    public function actionEdit($ref, $id = null)
    {
        $this->checkRef($ref);
        $model = is_null($id) ? new $ref() : $ref::model()->findByPk($id);
        if (Yii::app()->request->isPostRequest && isset($_POST[$ref])) {
            if(in_array($_GET['ref'], $this->mediaModels)) {
                $model->media_id = empty($_POST['media_id']) ? null : $_POST['media_id'];
            }
            CActiveForm::validate($model);
            if ($model->save() && !isset($_POST['update'])) {
                $this->redirect(array('adminReference/index', 'ref' => $ref));
            }
        }
        $this->render('_edit', array('model' => $model));
    }

    public function actionDelete($ref, $id){
        $this->checkRef($ref);
        $ref::model()->deleteByPk($id);
        $this->redirect(array('adminReference/index', 'ref' => $ref));
    }

    private function checkRef($ref)
    {
        $this->activeMenu[] = $ref;
        if(!in_array($ref, $this->enableModels)){
            throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        }
        $this->model = $ref;
    }

    /**
     * Получить массив с параметрами фильтра (отвалидированными)
     * @return array
     */
    protected function getFilter(){
        $filter = array('from'=>'','to'=>'');
        if(Yii::app()->request->getParam('filter',false)){
            if(isset($_REQUEST['filter']['from']) && Candy::verifyDate($_REQUEST['filter']['from'])){
                $dateFrom = new DateTime($_REQUEST['filter']['from']);
                $filter['from'] = $dateFrom->format(Candy::DATE);
            }
            if(!empty($_REQUEST['filter']['to']) && Candy::verifyDate($_REQUEST['filter']['to'])){
                $dateTo = new DateTime($_REQUEST['filter']['to']);
                $filter['to'] = $dateTo->format(Candy::DATE);
            }
            if($filter['to'] < $filter['from']){ //не проходит валидаацию - скрываем
                $filter = array('from'=>'','to'=>'');
            }

        }
        $filter['to'] = empty($filter['to']) ? Candy::formatDate(Candy::currentDate(),Candy::DATE) : $filter['to'];
        $filter['from'] = empty($filter['from']) ? Candy::formatDate(Candy::editDate($filter['to'],'- 28 days'),Candy::DATE) : $filter['from'];
        $dayCount = !empty($filter['from']) ? Candy::differenceDay($filter['from'],$filter['to']) : 28;
        if($dayCount>90){ //если выбран период более 90 дней сократим
            $filter['from'] = Candy::formatDate(Candy::editDate($filter['to'],'- 90 days'),Candy::DATE);
        }
        return $filter;
    }

    /**
     * При необходимост добавить в критерию данных
     * @param $criteria CDbCriteria
     */
    protected function checkFilter(&$criteria,$filter){
        if(!empty($filter['from'])){
            $criteria->addCondition('DATE(create_date) >= :date_from');
            $criteria->params +=array(':date_from'=>$filter['from']);
        }
        if(!empty($filter['to'])){
            $criteria->addCondition('DATE(create_date) <= :date_to');
            $criteria->params +=array(':date_to'=>$filter['to']);
        }
       /* if(in_array($this->model,'User')){
            $criteria->addColumnCondition(array('is_active'=>1));
        }*/
    }

    private function getChart($params=array())
    {
        $result = array();

        $now = new DateTime(date(!empty($params['to']) ? $params['to'] : 'Y-m-d 00:00:00'));
        $criteria = new CDbCriteria();
        $this->checkFilter($criteria,$params);
        $criteria->select = 'DATE(create_date) as create_date, COUNT(*) as count';
        $criteria->group = 'DATE(create_date)';
        foreach (ActiveRecord::model($this->model)->findAll($criteria) as $item) {
            $date = new DateTime($item->create_date);
            $result[$date->format('U')] = array('count' => $item->count);
        }

        $dayCount = !empty($params['from']) ? Candy::differenceDay($params['from'],$params['to']) : 28;
//        Makeup::dump(array($params,$dayCount),true);
        for($i=0; $i<$dayCount; $i++){
            if(!isset($result[$now->format('U')])){
                $result[$now->format('U')] = array('count' => 0);
            }
            $now->modify('-1 day');
        }
        return json_encode($result);
    }
}
?>
