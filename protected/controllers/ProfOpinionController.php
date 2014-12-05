<?php

class ProfOpinionController extends BaseController
{

    public function actionIndex($tag = null)
    {
        $this->breadcrumbs = array('Проф. мнение');
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('is_active' => 1));
        $criteria->order='create_date DESC, id DESC';
        if (!empty($tag)) {
            $criteria->addSearchCondition('tags', $tag);
            $this->breadcrumbs = array('Проф. мнение' => $this->createUrl('profOpinion/index'), "Проф. мнение с тегом: $tag");
        }
        $pages = $this->applyLimit($criteria,'ProfOpinion');
        $models = ProfOpinion::model()->findAll($criteria);
        $this->render('index',array('models' => $models,'pages'=>$pages));
    }

    public function actionDetail($id)
    {

        if(!$model = ProfOpinion::model()->findByPk($id)){
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->breadcrumbs = array('Проф. мнение' => $this->createUrl('profOpinion/index'), $model->name);

        $this->render('detail', array('model' => $model));
    }
}