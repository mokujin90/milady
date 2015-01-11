<?php
if(count($filter->placeList)>0){
    $region = Region::model()->findByPk($filter->placeList[0]);
}
else{
    $region = $this->region;
}
$this->widget('Map', array(
    'id'=>'map',
    'region' => $region,
    'htmlOptions'=>array(
        'style'=>'height:300px;',
        'ajax'=>true,
    ),
    'showProjectBalloon'=>true,
    'projects' => $models,
    'panel'=>'application.views.site._filterMap',
    'panelParams'=>array('ajax'=>true,'filter'=>$filter,'type'=>$type)
)); ?>