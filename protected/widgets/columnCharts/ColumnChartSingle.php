<?php
Yii::import("application.widgets.columnCharts.ColumnChartBase");

class ColumnChartSingle extends ColumnChartBase
{
    const CSS_VALUE_MARGIN = 15;
    const CSS_VALUE_PER_SIGN = 10;
    const CSS_CIRCLE_LABEL_MARGIN = 3;

    const CSS_BLUE = '#7AB9FE';
    const CSS_GREEN = '#C8E275';

    const LABEL_RECT_TOP = 1;
    const LABEL_RECT_CENTER = 2;
    const LABEL_CIRCLE = 3;

    public $cssGroupMargin = 8;

    public $labelType = self::LABEL_RECT_TOP;
    public $color = self::CSS_BLUE;
    public $maxColumnCount = 8;
    /**
     * @var string - стока дописывается к значениям. например '%' - 10%, 20%.
     */
    public $afterSign = '';
    public $showLegend = false;

    private $valueWidth;

    public function init()
    {

        $this->meta = array(array_shift($this->meta));

        foreach ($this->data as $key => $group) {
            $this->data[$key] = array(array_shift($group));
        }

        parent::init();
        $this->valueWidth = self::CSS_VALUE_MARGIN * 2 + self::CSS_VALUE_PER_SIGN * strlen((string)(int)$this->endValue);
    }

    public function getColumns()
    {
        $html = '';
        foreach ($this->data as $group) {
            $html .= '<div class="bar-group" style="width:' . $this->groupWidth . 'px; margin: 0 ' . $this->cssGroupMargin . 'px;">';
            $column = $group[0];

            $html .= CHtml::tag('div',
                array('class' => "bar fig_bg", 'style' => 'width:' . $this->columnWidth . 'px;left:' . (self::CSS_COLUMN_MARGIN) . 'px; height: 100%;'), ''
            );

            $html .= CHtml::tag('div',
                array('class' => "bar fig1", 'style' => 'background:' . $this->color . ';width:' . $this->columnWidth . 'px;left:' . (self::CSS_COLUMN_MARGIN) . 'px; height: ' . $this->getColumnHeight($column) . '%;'), ''
            );

            switch ($this->labelType) {
                case self::LABEL_RECT_TOP:
                    $html .= CHtml::tag('div',
                        array('class' => "value-stick", 'style' => 'height:' . $this->valueWidth . 'px; left:' . (self::CSS_COLUMN_MARGIN) . 'px;'),
                        '<span style="width: ' . $this->valueWidth . 'px; line-height: ' . $this->valueWidth . 'px; left: -' . ($this->valueWidth / 2 - 13) . 'px;">' . $this->numberFormat($column) . $this->afterSign . '</span>'
                    );
                    break;
                case self::LABEL_RECT_CENTER:
                    $html .= CHtml::tag('div',
                        array('class' => "value-stick", 'style' => '  top: 50%; margin-top: -' . ($this->valueWidth / 2) . 'px; height:' . $this->valueWidth . 'px; left:' . (self::CSS_COLUMN_MARGIN) . 'px;'),
                        '<span style="width: ' . $this->valueWidth . 'px; line-height: ' . $this->valueWidth . 'px; left: -' . ($this->valueWidth / 2 - 13) . 'px;">' . $this->numberFormat($column) . $this->afterSign . '</span>'
                    );
                    break;
                case self::LABEL_CIRCLE:
                    $circleSize = $this->columnWidth - self::CSS_CIRCLE_LABEL_MARGIN * 2;
                    $html .= CHtml::tag('div',
                        array('class' => "value-stick-circle", 'style' => "height: {$circleSize}px;width: {$circleSize}px;line-height: {$circleSize}px;"),
                        '<span style="">' . $this->numberFormat($column) . $this->afterSign . '</span>'
                    );
                    break;
            }

            $html .= '</div>';
        }
        return $html;
    }


}