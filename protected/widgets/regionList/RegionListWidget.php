<?php

class RegionListWidget extends CWidget
{
    public $data;
    public $district;
    public $districtList;

    public function init() {
        define('DEFAULT_COLUMN', 8);
        $this->data = array();
        $regions = Region::model()->findAll(array('order' => 'name','condition'=>'is_single=0'));
        $singleRegions = CHtml::listData(Region::model()->findAll(array('order' => 'name','condition'=>'is_single=1')),'id','name');
        $columnCount = ceil((count($regions) + count($singleRegions))/ DEFAULT_COLUMN);
        $i = 0;
        $currentColumn = 1;
         //просто разбиваем на четыре колонки и если больше заданного переносим в следующую колонку
        $tempData = array_fill_keys(Candy::$alphabet,array());
        foreach ($regions as $model) {
            $firstChar = mb_strtolower($model->sort_char);
            if(array_key_exists($firstChar,$tempData)){
                $tempData[$firstChar][$model->id] = $model->name;
            }
        }

        if(count($singleRegions)){
            $this->data[$currentColumn][0] = $singleRegions;
            $i += count($singleRegions);
        }
        foreach ($tempData as $districtId => $regionList) {
            foreach ($regionList as $key => $name) {
                $i++;
                $this->data[$currentColumn][$districtId][$key] = $name;
                if ($i >= $columnCount && $currentColumn < DEFAULT_COLUMN) {
                    $i = 0;
                    $currentColumn++;
                }
            }

        }
    }

    public function run()
    {
        $this->render('regionList');
    }
}