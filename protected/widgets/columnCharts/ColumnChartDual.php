<?php
Yii::import("application.widgets.columnCharts.ColumnChartBase");

class ColumnChartDual extends ColumnChartBase
{
    const CSS_VALUE_MARGIN = 15;
    const CSS_VALUE_PER_SIGN = 10;

    public $showYAxisLines = false;
    public $maxColumnCount = 16;
    public $maxColumnWidth = 24;

    private $valueWidth;

    public function init()
    {
        $meta = array();
        $meta[] = array_shift($this->meta);
        $meta[] = array_shift($this->meta);
        $this->meta = $meta;

        foreach ($this->data as $key => $group) {
            $data = array();
            $data[] = array_shift($group);
            $data[] = array_shift($group);
            $this->data[$key] = $data;
        }

        parent::init();
        $this->valueWidth = self::CSS_VALUE_MARGIN * 2 + self::CSS_VALUE_PER_SIGN * strlen((string)(int)$this->endValue);

    }

    public function getColumns()
    {
        $html = '';
        foreach ($this->data as $group) {
            if (!isset($group[0]) || !isset($group[1])) {
                continue;
            }
            $html .= '<div class="bar-group" style="width:' . $this->groupWidth . 'px; margin: 0 ' . self::CSS_GROUP_MARGIN . 'px;">';
            $column1 = $group[0];
            $column2 = $group[1];
            $html .= CHtml::tag('div',
                array('class' => "bar fig_bg", 'style' => 'width:' . $this->columnWidth . 'px;left:' . (self::CSS_COLUMN_MARGIN) . 'px; height: 100%;'), ''
            );
            $html .= CHtml::tag('div',
                array('class' => "bar fig_bg", 'style' => 'width:' . $this->columnWidth . 'px;left:' . ($this->columnWidth + self::CSS_COLUMN_MARGIN * 2 + self::CSS_COLUMN_MARGIN) . 'px; height: 100%;'), ''
            );

            $html .= CHtml::tag('div',
                array('class' => "bar fig0", 'style' => 'z-index: 0; width:' . $this->columnWidth . 'px;left:' . (self::CSS_COLUMN_MARGIN) . 'px; height: ' . $this->getColumnHeight($column1) . '%;'), ''
            );
            $html .= CHtml::tag('div',
                array('class' => "bar fig1", 'style' => 'z-index: -1; width:' . $this->columnWidth . 'px;left:' . ($this->columnWidth + self::CSS_COLUMN_MARGIN * 2 + self::CSS_COLUMN_MARGIN) . 'px; height: ' . $this->getColumnHeight($column2) . '%;'), ''
            );

            $html .= CHtml::tag('div',
                array('class' => "dual-value-stick-left", 'style' => 'height:' . $this->valueWidth . 'px;'),
                '<span style="width: ' . $this->valueWidth . 'px; line-height: ' . $this->valueWidth . 'px; left: -' . ($this->valueWidth / 2 - 13) . 'px;">' . $this->numberFormat($column1) . '</span>'
            );
            $html .= CHtml::tag('div',
                array('class' => "dual-value-stick-right", 'style' => 'height:' . $this->valueWidth . 'px;'),
                '<span style="width: ' . $this->valueWidth . 'px; line-height: ' . $this->valueWidth . 'px; left: -' . ($this->valueWidth / 2 - 13) . 'px;">' . $this->numberFormat($column2) . '</span>'
            );
            $html .= '</div>';
        }
        return $html;
    }


}