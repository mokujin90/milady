<?php

class RegionController extends BaseController
{
    public function actionList(){
        $filter = new RegionFilter();
        if(Yii::app()->request->isPostRequest){
            Makeup::dump($_POST,true);
        }

        $this->render('list',array('filter'=>$filter));
    }
    public function actionDetail($id=null)
    {
        $this->render('index');
    }
}