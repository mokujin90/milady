<?php

class BannerController extends BaseController
{

    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));
        $pages = $this->applyLimit($criteria, 'Banner', 10);
        $models = Banner::model()->findAll($criteria);
        $this->render('index', array('models' => $models, 'pages' => $pages));
    }

    public function actionEdit($id = null)
    {
        if ($id) {
            $model = Banner::model()->findByPk($id);
            if (!$model) {
                throw new CHttpException(404, Yii::t('main', 'Указанная запись не найдена'));
            }
            if ($model->user_id != Yii::app()->user->id) {
                throw new CHttpException(403, Yii::t('main', 'Блокировка доступа'));
            }
        } else {
            $model = new Banner();
            $model->user_id = Yii::app()->user->id;
            $model->status = 'moderation';
        }
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_REQUEST[CHtml::modelName($model)];
            $model->media_id = Yii::app()->request->getParam('logo_id', null);
            $model->count_view = 0;
            if ($model->save()) {
                $this->redirect($this->createUrl('banner/index'));
            }
        }
        $this->render('edit', array('model' => $model));
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
        if($model->status=='activate'){
            $model->status = 'blocked';
            $model->save();
        }
        else if($model->status=='blocked'){
            $model->status = 'activate';
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

    public function actionGetRecommendPrice($type, $regionId)
    {
        echo Banner::getRecommendPrice($type, $regionId);
        Yii::app()->end();
    }

    public function actionClick()
    {
        $banner = Banner::model()->findByPk(Yii::app()->request->getParam('bannerId'));
        if ($banner) {
            $banner->addClick();
            $this->redirect($banner->url);
        }
    }

    public function actionView()
    {
        $banner = Banner::model()->findByPk(Yii::app()->request->getParam('bannerId'));
        if ($banner) {
            $banner->addView();
            $banner_id = 'banner' . $banner->id;
            $clickUrl = Yii::app()->createAbsoluteUrl('banner/click', array('bannerId' => $banner->id));

            $js = BannerWidget::renderImage($banner_id, $banner->media->makeWebPath(), 319, 168, $clickUrl);

            echo $js;
        }

    }
}