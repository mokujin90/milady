<?php

class NewsController extends BaseController
{

    public function actionIndex($tag = null, $region = null,$from = null, $to=null)
    {
        $this->breadcrumbs = array(Yii::t('main', 'Новости. Событие. Аналитка'));
        $excluded = array(
            'news' => array(0),
            'analytics' => array(0),
            'event'=>array(0)
        );
        $sql = $this->createSql($tag,$region,$excluded,$from,$to);
        $articleArray = $sql->queryAll();

        foreach ($articleArray as $item) {
            $excluded[$item['object']][] = $item['id'];
        }

        $this->render('index', array('articleArray' => $articleArray, 'excluded' => $excluded));
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


            $sql = $this->createSql($tag,$region,$excluded,$from,$to);
            if (!empty($data['page'])) {
                $sql->offset = $data['page'] * 3;
            }
            $sql->limit = 9;
            $articles = $sql->queryAll();
            $this->render('_ajaxArticle', array('articles' => $articles));
        }
    }

    protected function createSql($tag, $region, $excluded, $from, $to){
        $sql = Yii::app()->db->createCommand()
            ->select('("news") as object, id, create_date')
            ->from("News")
            ->where('is_active = 1  AND id NOT IN (' . implode(',', $excluded['news']) . ')');
        $this->modifySql($sql,$tag,$region, $from, $to);
        $sqlAnalytics = Yii::app()->db->createCommand()
            ->select('("analytics") as object, id, create_date')
            ->from("Analytics")
            ->where('is_active = 1 AND id NOT IN (' . implode(',', $excluded['analytics']) . ')');
        $this->modifySql($sqlAnalytics,$tag,$region, $from, $to);
        $sqlEvent = Yii::app()->db->createCommand()
            ->select('("event") as object, id, create_date')
            ->from("Event")
            ->where('is_active = 1 AND id NOT IN (' . implode(',', $excluded['event']) . ')');
        $this->modifySql($sqlEvent,$tag,$region, $from, $to);
        $sql = $sql->union($sqlAnalytics->getText())->union($sqlEvent->getText());
        $sql->limit = 9;
        $sql->order('create_date DESC');
        return $sql;
    }
    protected function modifySql(CDbCommand &$query, $tag, $region,$from=null,$to=null)
    {
        if(!is_null($tag)){
            $query->andWhere(array('like', 'tags', $tag));
        }
        if(!is_null($region)){
            $query->andWhere(array('region_id'=>$region));
        }
        if(!is_null($from)){
            $query->andWhere('create_date > :from',array(':from'=>Candy::formatDate($from,Candy::DATE)));
        }
        if(!is_null($to)){
            $query->andWhere('create_date < :to',array(':to'=>Candy::formatDate($to,Candy::DATE)));
        }
    }

    public function actionDetail($id)
    {
        $excluded = array(
            'news' => array($id),
            'analytics' => array(0),
            'event'=>array(0)
        );

        if (!$model = News::model()->findByPk($id)) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->breadcrumbs = array(Yii::t('main','Новости. Событи. Аналитка') => $this->createUrl('news/index'), $model->name);

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('is_active'=>1));
        $criteria->order = 'create_date DESC';
        $criteria->limit = 1;
        $criteria->addNotInCondition('id',$excluded['analytics']);
        $lastAnalytic = Analytics::model()->find($criteria);
        if($lastAnalytic){
            $excluded['analytics'][] = $lastAnalytic->id;
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


        $this->render('/news/detail', array('model' => $model,'lastAnalytic'=>$lastAnalytic,'similarNews'=>$similarNews));
    }
}