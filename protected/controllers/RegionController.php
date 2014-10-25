<?php

class RegionController extends BaseController
{
    public function actionList(){
        $filter = new RegionFilter();
        if(Yii::app()->request->isPostRequest){
            Makeup::dump($_POST,true);
        }
        $criteria = new CDbCriteria();

        //$criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));
        $models = Project::model()->findAll($criteria);
        $this->render('list',array('filter'=>$filter, 'models' => $models));
    }
    public function actionDetail($id=null)
    {
        $this->render('index');
    }
}