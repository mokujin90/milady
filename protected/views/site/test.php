<?Yii::import("application.widgets.columnCharts.*");?>
<style>
    .opacity-box{
        margin: 10px;
        padding: 10px;
    }
</style>
<div id="general">
    <div class="content list-columns columns">
        <div class="full-column">
            <div class="news-item opacity-box">
                <? $this->widget('application.widgets.columnCharts.ColumnChartDual',
                    array(
                        'meta' => array('column1', 'column2'),
                        'data' => array(
                            '2011' => array(780, 232),
                            '2012' => array(323, 312),
                            '2013' => array(3123, 221),
                            '2014' => array(1000, 212),
                        )
                    )
                ); ?>
            </div>
            <div class="news-item opacity-box">
                <? $this->widget('application.widgets.columnCharts.ColumnChartGroup',
                    array(
                        'meta' => array('column1', 'column2', 'column3', 'column4'),
                        'data' => array(
                            '2011' => array(780, 232, 313,123),
                            '2012' => array(323, 3123, 5254,123),
                            '2013' => array(3123, 221, 1212,123),
                            '2014' => array(1000, 212, 200,123),
                        )
                    )
                ); ?>
            </div>
            <div class="news-item opacity-box">
                <? $this->widget('application.widgets.columnCharts.ColumnChartGroup',
                    array(
                        'meta' => array('column1', 'column2', 'column3'),
                        'data' => array(
                            '2011' => array(780, 232, 313),
                            '2012' => array(323, 3123, 52540),
                            '20122' => array(323, 3123, 5254),
                            '20121' => array(323, 3123, 5254),
                            '20123' => array(323, 3123, 5254),
                            '2013' => array(3123, 221, 1212),
                            '2014' => array(1000, 212, 200),
                        )
                    )
                ); ?>
            </div>
            <div class="news-item opacity-box">
                <? $this->widget('application.widgets.columnCharts.ColumnChartSingle',
                    array(
                        'labelType' => ColumnChartSingle::LABEL_RECT_CENTER,
                        'meta' => array('column1'),
                        'data' => array(
                            '2011' => array(780),
                            '2012' => array(323.56),
                            '2014' => array(1000),
                            array(1000.5),
                            array(3000),
                            array(1000),
                            array(1000),
                        )
                    )
                ); ?>
            </div>
            <div class="news-item opacity-box">
                <? $this->widget('application.widgets.columnCharts.ColumnChartSingle',
                    array(
                        'labelType' => ColumnChartSingle::LABEL_CIRCLE,
                        'maxColumnCount' => 5,
                        'width' => 500,
                        'meta' => array('column1'),
                        'data' => array(
                            '2011' => array(780),
                            '2012' => array(323.56),
                            '2014' => array(1000),
                            array(1000.02),
                            array(1000.66),
                            array(212.5),
                            array(2000),
                            array(1000),
                            array(422),
                            array(1000),
                        )
                    )
                ); ?>
            </div>
            <div class="news-item opacity-box">
                <? $this->widget('application.widgets.columnCharts.ColumnChartSingle',
                    array(
                        'color' => ColumnChartSingle::CSS_GREEN,
                        'meta' => array('column1'),
                        'data' => array(
                            '2011' => array(780),
                            '2012' => array(323),
                            '2014' => array(100),
                            array(10.02),
                            array(200),
                            array(100),
                        )
                    )
                ); ?>
            </div>
        </div>
    </div>
</div>
