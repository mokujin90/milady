<div class="pie-chart">
<?php
$colors = array('#5190D5','#7AB9FE','#294187','#F25856','#F78D63','#6CA135','#A4C240','#C8E275','#E2AB35','#E28B36','#E25733','#E2323C','#E23187','#E29BD0','#8B617D','#AF66E2');
$this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
    'data' => $data,
    'options' => array(
        'width' => 700,
        'height' => 400,
        'backgroundColor'=>'none',
        'chartArea'=>array(
            'left' => '0'
        ),
        'legend'=>array(
            'position'=>'none'
        ),
        'pieSliceTextStyle'=>array(
            'color'=>'white',
        ),
        'sliceVisibilityThreshold'=>0,
        'colors' => $colors
    )));?>
</div>
<?
$sum = 0;
for($i = 1; $i < count($data); $i++){
    $sum += (int)$data[$i][1];
}?>
<div class="pie-caption"><?="$total $sum"?></div>
<ul class="pie-legend">
    <?
    for($i = 1; $i < count($data); $i++):?>
        <li><span class="legend-icon" style="background: <?=isset($colors[$i-1]) ? $colors[$i-1] : $colors[0]?>"></span><?=$data[$i][0]?></li>
    <?endfor?>
</ul>