<?php

class RegionListWidget extends CWidget
{
    public $data;
    public $dataDistrict;
    public $district;
    public $districtList;

    public $dictionaryLatin = array();
    public function init() {
        define('DEFAULT_COLUMN', 8);
        $this->data = array();
        $this->dataDistrict = array();
        $regions = Region::model()->findAll(array('order' => 'name','condition'=>'is_single=0'));
        $singleRegions = CHtml::listData(Region::model()->findAll(array('order' => 'name','condition'=>'is_single=1')),'id','name');

        $this->dictionaryLatin = CHtml::listData(Region::model()->findAll(),'id','latin_name');
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


        $i = 0;
        $currentColumn = 1;
        $tempData = array();
        foreach ($regions as $model) {
            $tempData[$model->district_id][$model->id] = $model->name;
        }

        if(count($singleRegions)){
            $this->dataDistrict[$currentColumn][0] = $singleRegions;
            $i += count($singleRegions);
        }

        foreach ($tempData as $districtId => $regionList) {
            foreach ($regionList as $key => $name) {
                $i++;
                $this->dataDistrict[$currentColumn][$districtId][$key] = $name;
                if ($i >= $columnCount && $currentColumn < DEFAULT_COLUMN) {
                    $i = 0;
                    $currentColumn++;
                }
            }

        }
        $this->districtList = CHtml::listData(District::model()->findAll(), 'id', 'name');
    }

    public function run()
    {
        $this->render('regionList');
    }
}