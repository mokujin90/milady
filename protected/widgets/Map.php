<?php

class Map extends CWidget
{
    public $htmlOptions = array();

    private $js = '';
    public function run()
    {
        $this->setOptions();
        $this->setAssets();
        echo CHtml::openTag('div', $this->htmlOptions);
        echo CHtml::closeTag('div');
        $this->renderMap();
    }

    /**
     * Метод, который подготовит все параметры для дальнейшего использования
     */
    private function setOptions()
    {
        $this->htmlOptions['id'] = $this->getId();
    }

    private function setAssets()
    {
        Yii::app()->clientScript->registerCssFile('/css/vendor/leaflet.css');
        Yii::app()->clientScript->registerScriptFile('/js/vendor/leaflet.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile('/js/map.js', CClientScript::POS_END);
    }

    private function renderMap(){
        $id = $this->htmlOptions['id'];
        $js = <<<JS
            var params = {
                id:'$id'
            }
            map.init(params);
JS;
        Yii::app()->clientScript->registerScript($this->id,$js,CClientScript::POS_END);
    }

}