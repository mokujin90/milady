<?php

class RegionController extends BaseController
{
    public function actionList(){
        $filter = new RegionFilter();
        $this->render('list',array('filter'=>$filter));
    }
    public function actionDetail($id=null)
    {
        $this->render('index');
    }
}