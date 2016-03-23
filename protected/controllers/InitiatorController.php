<?php

class InitiatorController extends BaseController
{

    public function actionView($id){
        $model = User::model()->findByAttributes(array('id' => $id, 'type' => 'initiator', 'is_active' => 1));
        if (!$model) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->breadcrumbs = array($model->getInvestorName());
        $this->render('view',array('model' => $model));
    }

}