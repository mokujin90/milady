<div class="analitycs-page">
    <div id="general">
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        <style>
            .link-item{
                text-align: center;
                width: 200px;
                display: inline-block;
                margin: 16px;
                font-size: 18px;
            }
            .link-item img{
                max-width: 100px;
                max-height: 100px;
            }
        </style>
        <div class="content list-columns columns" style="margin-bottom: 20px;">
            <div class="full-column opacity-box" style="padding: 10px 20px; margin-top: 10px; color: #364F8C;">
                <div style="margin: 0 auto; width: 750px;">
                <div class="link-item">
                    <img src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png"><br>
                    <?=CHtml::link('Новости', $this->createUrl('news/index'), array('style'=>'color: #364F8C;'))?>
                </div>
                <div class="link-item">
                    <img src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png"><br>
                    <?=CHtml::link('Аналитика', $this->createUrl('analytics/index'), array('style'=>'color: #364F8C;'))?>
                </div>
                <div class="link-item">
                    <img src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png"><br>
                    <?=CHtml::link('Мероприятия', $this->createUrl('event/index'), array('style'=>'color: #364F8C;'))?>
                </div>
                </div>
            </div>
        </div>
        <div class="content main chart">
            <div class="chart-wrapper">
                <h2>Состав проектов на портале</h2>
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
                <h2>Топ 10 регионов, с наибольшим количеством размещенных в базе портала проектов</h2>
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
                <h2>Суммарный объем необходимых инвестиций по размещенным проектам</h2>

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
    </div>
</div>