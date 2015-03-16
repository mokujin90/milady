<?php
Yii::import("application.widgets.columnCharts.ColumnChartBase");

class ColumnChartGroup extends ColumnChartBase
{
    public $showYAxisLines = false;

    protected function getColumnHeight($value)
    {
        if(!$this->endValue){
            $this->endValue = self::STEP;
        }
        return 75 * $value / $this->endValue;
    }

}