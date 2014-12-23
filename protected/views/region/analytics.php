<?php
/**
 *
 * @var RegionController $this
 */
?>
<div class="region-page">
    <div id="general">

        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        <div class="light-gray-gradient line bottom back">
            <div class="main">
                <h2>Состав проектов в регионе по отраслям</h2>
            </div>
        </div>

        <div class="content main fullmargin">
            <?php $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
                'data' => $region->region->getStatisticByIndustry(),
                'options' => array(
                    'width' => '100%',
                    'height' => 400,
                    'backgroundColor'=>'none',
                    'chartArea'=>array(
                        'left' => '0'
                    ),
                    'legend'=>array(
                        'textStyle'=>array('color'=>"#333",'fontSize'=>14),
                        'alignment' => 'center'
                    ),
                    'pieSliceTextStyle'=>array(
                        'color'=>'white',
                    ),
                    'sliceVisibilityThreshold'=>0,
                )));?>
        </div>

        <div class="light-gray-gradient line bottom back">
            <div class="main">
                <h2>Соотношение количества проектов в данном регионе</h2>
            </div>
        </div>

        <div class="content main fullmargin">
            <?php $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
                'data' => $region->region->getStatisticByAll(),
                'options' => array(
                    'width' => '100%',
                    'height' => 400,
                    'backgroundColor'=>'none',
                    'chartArea'=>array(
                        'left' => '0'
                    ),
                    'legend'=>array(
                        'textStyle'=>array('color'=>"#333",'fontSize'=>14),
                        'alignment' => 'center'
                    ),
                    'pieSliceTextStyle'=>array(
                        'color'=>'white',
                    ),
                    'sliceVisibilityThreshold'=>0,
                )));?>
        </div>

        <div class="light-gray-gradient line bottom back">
            <div class="main">
                <h2>Объем необходимых инвестиций в регионе по отраслям</h2>
            </div>
        </div>

        <div class="content main fullmargin">
            <?php $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'ColumnChart',
                'data' => $region->region->getStatisticByInvestment(),
                'options' => array(
                    'width' => '100%',
                    'height' => 400,
                    'backgroundColor'=>'none',
                    'chartArea'=>array(
                        'width' => '100%',
                        'left' => '0'
                    ),
                    'legend'=>array(
                        'position'=>'none',
                    ),
                    'pieSliceTextStyle'=>array(
                        'color'=>'white',
                    ),
                    'sliceVisibilityThreshold'=>0,
                )));?>
        </div>
    </div>
</div>
