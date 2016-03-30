<?php

class NewsController extends BaseController
{

    public function actionIndex($tag=null, $region = null,$from = null, $to=null,$type = 'federal')
    {

        $excluded = array(
            'news' => array(0),
            'analytics' => array(0),
            'event'=>array(0)
        );
        if($type == 'region' && empty($region)){
            $region = $this->currentRegion;
        }
        $sql = $this->createSql($tag,$region,$excluded,$from,$to,$type);
        $articleArray = $sql->queryAll();

        foreach ($articleArray as $item) {
            $excluded[$item['object']][] = $item['id'];
        }

        $title = $this->getTitle($tag, $region,$from, $to,$type);
        $this->breadcrumbs = array($title);
        $this->render('index', array('articleArray' => $articleArray, 'excluded' => $excluded,'title'=>$title,'type'=>$type));
    }

    public function actionMore()
    {
        $this->layout = false;
        if (Yii::app()->request->isAjaxRequest) {
            $data = $_REQUEST;
            $excluded = array(
                'news' => array(0),
                'analytics' => array(0),
                'event'=>array(0)
            );
            $tag = isset($_REQUEST['tag']) ? $_REQUEST['tag'] : null;
            $region = isset($_REQUEST['region']) ? $_REQUEST['region'] : null;
            $from = isset($_REQUEST['from']) ? $_REQUEST['from'] : null;
            $to = isset($_REQUEST['to']) ? $_REQUEST['to'] : null;
            $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : null;
            if ($data['excluded']) {
                $json = json_decode($data['excluded']);
                if (isset($json->news) && is_array($json->news)) {
                    $excluded['news'] += $json->news;
                }
                if (isset($json->analytics) && is_array($json->analytics)) {
                    $excluded['analytics'] += $json->analytics;
                }
                if (isset($json->event) && is_array($json->event)) {
                    $excluded['event'] += $json->event;
                }
            }


            $sql = $this->createSql($tag,$region,$excluded,$from,$to,$type);
            if (!empty($data['page'])) {
                $sql->offset = $data['page'] * 9;
            }
            $sql->limit = 9;
            $articles = $sql->queryAll();
            $this->render('_ajaxArticle', array('articles' => $articles));
        }
    }

    protected function createSql($tag, $region, $excluded, $from, $to, $type){
        $sql = Yii::app()->db->createCommand()
            ->select('("news") as object, id, create_date')
            ->from("News")
            //->where('is_active = 1  AND id NOT IN (' . implode(',', $excluded['news']) . ') and (region_id is null or region_id = :current_region)',array(':current_region'=>$this->currentRegion));
            ->where('is_active = 1  AND id NOT IN (' . implode(',', $excluded['news']) . ')');
        $this->modifySql($sql,$tag,$region, $from, $to,$type);
        $sqlAnalytics = Yii::app()->db->createCommand()
            ->select('("analytics") as object, id, create_date')
            ->from("Analytics")
            ->where('is_active = 1 AND id NOT IN (' . implode(',', $excluded['analytics']) . ')');
        $this->modifySql($sqlAnalytics,$tag,$region, $from, $to,null);
        $sqlEvent = Yii::app()->db->createCommand()
            ->select('("event") as object, id, create_date')
            ->from("Event")
            ->where('is_active = 1 AND id NOT IN (' . implode(',', $excluded['event']) . ')');
        $this->modifySql($sqlEvent,$tag,$region, $from, $to,$type);
        if($type=='analytics'){
            $sql = $sqlAnalytics;
        }
        elseif($type=='event'){
            $sql = $sqlEvent;
        }
        elseif(!in_array($type,array('iip','region','federal'))){ //если мы не ищем именно новости, объеденим
            $sql = $sql->union($sqlAnalytics->getText())->union($sqlEvent->getText());
        }
        $sql->limit = 9;

        $sql->order($type =='event' ? 'datetime DESC' : 'create_date DESC');
        return $sql;
    }
    protected function modifySql(CDbCommand &$query, $tag, $region,$from=null,$to=null,$type=null)
    {
        if(!is_null($tag)){
            $query->andWhere(array('like', 'tags', $tag));
        }
        /*if(!is_null($region)){
           $query->andWhere(array('region_id'=>$region));
        }*/

        if($type == 'event'){
            if(!empty($from)){
                $query->andWhere('datetime >= :from',array(':from'=>Candy::formatValidDate($from,Candy::DATE, "d.m.Y")));
            }
            if(!empty($to)){
                $query->andWhere('datetime <= :to',array(':to'=>Candy::formatValidDate($to,Candy::DATE, "d.m.Y")));
            }
        }
        else{
            if(!empty($from)){
                $query->andWhere('create_date >= :from',array(':from'=>Candy::formatValidDate($from,Candy::DATE, "d.m.Y")));
            }
            if(!empty($to)){
                $query->andWhere('create_date <= :to',array(':to'=>Candy::formatValidDate($to,Candy::DATE, "d.m.Y")));
            }

        }

        if(!is_null($type)){

            if($type=='region'){
                //$query->andWhere('region_id = :current_region',array(':current_region'=>$this->currentRegion));
                $query->andWhere('region_id = :current_region',array(':current_region'=>$region));
            }
            elseif($type=='federal'){
                $query->andWhere('region_id is null && is_portal_news = 0');
            }
            elseif($type == 'iip'){
                $query->andWhere('region_id is null && is_portal_news = 1');
            }
        }
    }

    public function actionDetail($id)
    {
        $excluded = array(
            'news' => array($id),
            'analytics' => array(0),
            'event'=>array(0)
        );

        if (!$model = News::model()->findByPk($id, 'is_active = 1')) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $regionParam = array();

        if($model->region && $this->currentRegion != $model->region_id){
            $regionParam['regionLatin'] = $model->region->latin_name;
        }

        if($model->is_portal_news){
            $this->breadcrumbs = array(Yii::t('main','Новости IIP') => $this->createUrl('news/index/type/iip'));
        } elseif($model->region){
            $this->breadcrumbs = array($model->region->name . ' - ' . Yii::t('main','Новости') => $this->createAbsoluteUrl('news/index',array_merge(array('type' => 'region'),$regionParam)));
        } else {
            $this->breadcrumbs = array(Yii::t('main','Федеральные новости') => $this->createUrl('news/index'));
        }
        $this->breadcrumbs[] = $model->name;
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('is_active'=>1));
        $criteria->order = 'create_date DESC';
        $criteria->limit = 1;
        $criteria->addNotInCondition('id',$excluded['analytics']);
        $lastAnalytic = Analytics::model()->find($criteria);
        if($lastAnalytic){
            $excluded['analytics'][] = $lastAnalytic->id;
        }
        $slider = array();
        if($model->media){
            $slider[] = $model->media;
        }
        if(count($model->sliders)>0){
            foreach($model->sliders as $slide){
                $slider[] = $slide->media;
            }
        }
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('is_active'=>1));
        $criteria->order = 'create_date DESC';
        $criteria->limit = 4;
        $criteria->addNotInCondition('id',$excluded['news']);
        if(empty($model->region_id)){
            $criteria->addCondition('region_id is NULL');
        }
        else{
            $criteria->addColumnCondition(array('region_id'=>$model->region_id));
        }
        $similarNews = News::model()->findAll($criteria);


        $this->render('/news/detail', array('model' => $model,'lastAnalytic'=>$lastAnalytic,'similarNews'=>$similarNews,'slider'=>$slider));
    }

    public function getTitle($tag, $region,$from, $to,$type){
        $title = '';
        if($type == 'region'){
            $regionModel = Region::model()->findByPk($region);
            if(!is_null($regionModel)){
                $title = $regionModel->name." - ";
            }
            $title .= Yii::t('main','Новости');
        }
        elseif($type == 'iip'){
            $title = Yii::t('main','Новости iip');
        }
        elseif($type == 'federal'){
            $title = Yii::t('main','Федеральные новости');
        }
        elseif($type == 'analytics'){
            $title = Yii::t('main','Аналитика');
        }
        elseif($type == 'event'){
            $title = Yii::t('main','События');
        }
        return $title;

    }
}