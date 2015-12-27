<?php

class BannerController extends BaseController
{
    /**
     * Для дейтствия update будем использовать отдельный файл CAction, так как он встречается во фронтовой реализации
     * и админской части
     */
    public function actions()
    {
        return array(
            'edit'=>'external.BannerAction',
            'feedEdit'=>'external.FeedBannerAction',
        );
    }
    public function actionIndex($type = 'feed')
    {
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Реклама');
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));

        $models = Banner::model()->findAll($criteria);
        $feedModels = FeedBanner::model()->findAll($criteria);

        $this->render('index', array('models' => $models, 'feedModels' => $feedModels, 'type' => $type));
    }


    public function actionBlock($id)
    {
        $model = Banner::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, Yii::t('main', 'Указанная запись не найдена'));
        }
        if ($model->user_id != Yii::app()->user->id) {
            throw new CHttpException(403, Yii::t('main', 'Блокировка доступа'));
        }
        if($model->is_blocked==1){
            $model->is_blocked = 0;
            $model->save();
        }
        else if($model->is_blocked==0){
            $model->is_blocked = 1;
            $model->save();
        }
        $this->redirect($this->createUrl('banner/index'));
    }

    public function actionRemove($id)
    {
        $model = Banner::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, Yii::t('main', 'Указанная запись не найдена'));
        }
        if ($model->user_id != Yii::app()->user->id) {
            throw new CHttpException(403, Yii::t('main', 'Блокировка доступа'));
        }
        $model->delete();
        $this->redirect($this->createUrl('banner/index'));
    }

    public function actionClick()
    {
        $banner = Banner::model()->findByPk(Yii::app()->request->getParam('bannerId'));
        $banner->scenario="click_and_view";
        if ($banner) {
            $banner->addClick();
            $this->redirect($banner->url);
        }
    }

    public function actionAway()
    {
        $banner = FeedBanner::model()->findByPk(Yii::app()->request->getParam('bannerId'));
        if ($banner) {
            $banner->addClick();
            $this->redirect($banner->url);
        }
    }

    public function actionView()
    {
        $banner = Banner::model()->findByPk(Yii::app()->request->getParam('bannerId'));
        $banner->scenario="click_and_view";
        if ($banner) {
            $banner->addView();
            $banner_id = 'banner' . $banner->id;
            $clickUrl = Yii::app()->createAbsoluteUrl('banner/click', array('bannerId' => $banner->id));

            $js = BannerWidget::renderImage($banner_id, $banner->media->makeWebPath(), 319, 168, $clickUrl);

            echo $js;
        }
    }

    public function actionSideView()
    {
        $banner = Banner::model()->findByPk(Yii::app()->request->getParam('bannerId'));
        $banner->scenario="click_and_view";
        if ($banner) {
            $banner->addView();
            $banner_id = 'banner' . $banner->id;
            $clickUrl = Yii::app()->createAbsoluteUrl('banner/click', array('bannerId' => $banner->id));

            $js = BannerWidget::renderImage($banner_id, $banner->media->makeWebPath(), 159, 84, $clickUrl, $banner->title);

            echo $js;
        }
    }

    public function actionStat($id)
    {
        $this->layout = 'bootstrapCabinet';

        $model = Banner::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, Yii::t('main', 'Указанная запись не найдена'));
        }
        $filter = $this->getFilter();
        $criteria = new CDbCriteria();
        $criteria->select = 'SUM(click) as click, SUM(view) as view';
        $criteria->addColumnCondition(array('banner_id' => $id));
        $this->checkFilter($criteria,$filter);
        $stat = BannerStat::model()->find($criteria);

        $this->render('stat', array(
            'model' => $model,
            'chart' => $this->getChart($id,$filter),
            'stat' => array(
                'click' => $stat->click,
                'view' => $stat->view,
            ),
            'filter'=>$filter
        ));
    }

    public function actionFeedStat($id)
    {
        $this->layout = 'bootstrapCabinet';

        $model = FeedBanner::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, Yii::t('main', 'Указанная запись не найдена'));
        }
        $filter = $this->getFilter();

        $criteria = new CDbCriteria();
        $criteria->select = 'SUM(click) as click, SUM(view) as view';
        $criteria->addColumnCondition(array('banner_id' => $id));
        $this->checkFilter($criteria,$filter);
        $stat = FeedBannerStat::model()->find($criteria);
        $this->render('stat', array(
            'model' => $model,
            'chart' => $this->getFeedChart($id,$filter),
            'stat' => array(
                'click' => $stat->click,
                'view' => $stat->view,
            ),
            'filter'=>$filter
        ));
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
        return $filter;
    }

    /**
     * При необходимост добавить в критерию данных
     * @param $criteria CDbCriteria
     */
    protected function checkFilter(&$criteria,$filter){
        if(!empty($filter['from'])){
            $criteria->addCondition('t.date > :date_from');
            $criteria->params +=array(':date_from'=>$filter['from']);
        }
        if(!empty($filter['to'])){
            $criteria->addCondition('t.date < :date_to');
            $criteria->params +=array(':date_to'=>$filter['to']);
        }
    }

    /**
     * Увеличить баланс баннера
     */
    public function actionAddBalance(){

    }

    private function getChart($id,$params=array())
    {
        $result = array();
        $now = new DateTime(date(!empty($params['to']) ? $params['to'] : 'Y-m-d 00:00:00'));
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('banner_id'=>$id));
        $this->checkFilter($criteria,$params);
        foreach (BannerStat::model()->findAll($criteria) as $item) {
            $date = new DateTime($item->date);
            $result[$date->format('U')] = array('view' => $item->view, 'click' => $item->click);
        }
        $dayCount = !empty($params['from']) ? Candy::differenceDay($params['from'],$params['to'])+1 : 28;
        $dayCount = $dayCount >90 ? 90 : $dayCount;
        for($i=0; $i<$dayCount; $i++){
            if(!isset($result[$now->format('U')])){
                $result[$now->format('U')] = array('view' => 0, 'click' => 0);
            }
            $now->modify('-1 day');
        }
        return json_encode($result);
    }

    private function getFeedChart($id,$params=array())
    {
        $result = array();
        $now = new DateTime(date(!empty($params['to']) ? $params['to'] : 'Y-m-d 00:00:00'));
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('banner_id'=>$id));
        $this->checkFilter($criteria,$params);
        foreach (FeedBannerStat::model()->findAll($criteria) as $item) {
            $date = new DateTime($item->date);
            $result[$date->format('U')] = array('view' => $item->view, 'click' => $item->click);
        }
        $dayCount = !empty($params['from']) ? Candy::differenceDay($params['from'],$params['to']) : 28;
        $dayCount = $dayCount >90 ? 90 : $dayCount;
        for($i=0; $i<$dayCount; $i++){
            if(!isset($result[$now->format('U')])){
                $result[$now->format('U')] = array('view' => 0, 'click' => 0);
            }
            $now->modify('-1 day');
        }
        return json_encode($result);
    }
}