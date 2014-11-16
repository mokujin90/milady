<?php

class StockController extends BaseController{

    public function actionInit(){
        Finance::reDownloadStock('10.11.2014');
        $finance = Finance::init()->downloadStock('15.11.2014');
        /*$stock = Stock::model()->findByPk(1);
        $stock->params = serialize(array('VAL_NM_RQ' => 'R01235'));
        $stock->save();*/
    }
}