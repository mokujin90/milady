<?php

class StockWidget extends CWidget{
//http://jsfiddle.net/gh/get/jquery/1.9.1/highslide-software/highcharts.com/tree/master/samples/stock/demo/basic-line/
    public function run()
    {
        $this->assets();
        $this->render('stock');
    }
    public function assets()
    {
        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets/highstock.js', false, -1, false),
            CClientScript::POS_END
        );
        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets/stock.js', false, -1, YII_DEBUG),
            CClientScript::POS_END
        );
    }

}