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
        );
    }
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));
        $pages = $this->applyLimit($criteria, 'Banner', 10);
        $models = Banner::model()->findAll($criteria);
        $this->render('index', array('models' => $models, 'pages' => $pages));
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

    /**
     * Увеличить баланс баннера
     */
    public function actionAddBalance(){

    }
}