<?php $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
    'data' => $data,
    'options' => array(
        'width' => 700,
        'height' => 400,
        'backgroundColor'=>'none',
        'chartArea'=>array(
            'left' => '0'
        ),
        'legend'=>array(
            'textStyle'=>array('color'=>"#333",'fontSize'=>14),
            'alignment' => 'start',
            'position' => 'top',
            'maxLines' => 3
        ),
        'pieSliceTextStyle'=>array(
            'color'=>'white',
        ),
        'sliceVisibilityThreshold'=>0,
    )));?>

<?
$sum = 0;
foreach($data as $item){
    $sum += (int)$item[1];
}?>
<div class="caption" style="text-align: center; text-transform: uppercase; font-size:14px;"><?="$total $sum"?></div>