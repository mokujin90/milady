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
    public function actionIndex()
    {
        $this->layout = 'bootstrapCabinet';

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));

        $models = Banner::model()->findAll($criteria);
        $feedModels = FeedBanner::model()->findAll($criteria);

        $this->render('index', array('models' => $models, 'feedModels' => $feedModels));
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

            $js = BannerWidget::renderImage($banner_id, $banner->media->makeWebPath(), 159, 84, $clickUrl);

            echo $js;
        }
    }

    public function actionStat($id)
    {
        $this->layout = 'bootstrapCabinet';

        $model = FeedBanner::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, Yii::t('main', 'Указанная запись не найдена'));
        }

        $now = new DateTime(date('Y-m-d 00:00:00'));
        $criteria = new CDbCriteria();
        $criteria->select = 'SUM(click) as click, SUM(view) as view';
        $criteria->addColumnCondition(array('banner_id' => $id));
        $stat = FeedBannerStat::model()->find($criteria);

        $this->render('stat', array(
            'chart' => $this->getChart($id),
            'stat' => array(
                'click' => $stat->click,
                'view' => $stat->view,
            )
        ));
    }

    /**
     * Увеличить баланс баннера
     */
    public function actionAddBalance(){

    }

    private function getChart($id)
    {
        $result = array();
        $now = new DateTime(date('Y-m-d 00:00:00'));
        foreach (FeedBannerStat::model()->findAllByAttributes(array('banner_id' => $id)) as $item) {
            $date = new DateTime($item->date);
            $result[$date->format('U')] = array('view' => $item->view, 'click' => $item->click);
        }
        for($i=0; $i<28; $i++){
            if(!isset($result[$now->format('U')])){
                $result[$now->format('U')] = array('view' => 0, 'click' => 0);
            }
            $now->modify('-1 day');
        }
        return json_encode($result);
    }
}