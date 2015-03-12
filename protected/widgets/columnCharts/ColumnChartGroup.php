<?php
Yii::import("application.widgets.columnCharts.ColumnChartBase");

class ColumnChartGroup extends ColumnChartBase
{
    public $showYAxisLines = false;

    protected function getColumnHeight($value)
    {
        return 75 * $value / $this->endValue;
    }

}