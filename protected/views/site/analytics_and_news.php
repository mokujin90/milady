<div class="analitycs-page">
    <div id="general">
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        <div class="content main chart">
            <div class="chart-wrapper">
                <?php $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
                    'data' => Analytics::getStatisticByType(),
                    'options' => array(
                        'width' => '50%',
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
                <?php $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'ColumnChart',
                    'data' => Analytics::getStatisticByRegion(),
                    'options' => array(
                        'width' => '90%',
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
                <?php $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'ColumnChart',
                    'data' => Analytics::getStatisticByInvestmentSum(),
                    'options' => array(
                        'width' => '50%',
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
        <div class="content list-columns columns">
            <div class="full-column opacity-box" style="padding: 10px 20px; margin-top: 10px; color: #364F8C;">
                <h1><?=CHtml::link('Новости', $this->createUrl('news/index'), array('style'=>'color: #364F8C;'))?></h1>
                <h1><?=CHtml::link('Аналитика', $this->createUrl('analytics/index'), array('style'=>'color: #364F8C;'))?></h1>
                <h1><?=CHtml::link('Проф. мнение', $this->createUrl('profOpinion/index'), array('style'=>'color: #364F8C;'))?></h1>
                <h1><?=CHtml::link('Мероприятия', $this->createUrl('event/index'), array('style'=>'color: #364F8C;'))?></h1>
            </div>
        </div>
    </div>
</div>