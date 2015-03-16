<?php

class ColumnChartBase extends CWidget
{
    const CSS_COLUMN_MARGIN = 0;

    /**
     * Число > максимального, но кратное STEP - будет максимумом графика.
     */
    const STEP = 500;
    /**
     * @var int - отступ между группами графиков
     */
    public $cssGroupMargin = 15;
    /**
     * @var array - данные гистораммы (подпись -> array(знач1, знач2,), ...)
     */
    public $data = array();
    /**
     * @var array - названия колонок array(назв1, назв2,..), эти названия будут в легенде
     */
    public $meta = array();

    /**
     * @var int - ширина в px
     */
    public $width = 440;
    /**
     * @var int - высота области диграммы (без легенды) в px
     */
    public $height = 200;
    /**
     * @var int - максимальное кол-во колонок (данные с начала отрезаются)
     */
    public $maxColumnCount = 18;
    /**
     * @var int - максимальная ширина колонки
     */
    public $maxColumnWidth = 56;
    /**
     * @var bool - покаызвать легенду
     */
    public $showLegend = true;
    /**
     * @var bool - показывать разделительные линии по Y
     */
    public $showYAxisLines = true;

    protected $columnCount = 0;
    protected $groupCount = 0;
    protected $groupWidth;
    protected $columnWidth;
    protected $endValue;

    public function init()
    {
        $this->columnCount = count($this->meta);
        $this->groupCount = count($this->data);
        if (!$this->groupCount || !$this->columnCount) {
            return;
        }
        while ($this->maxColumnCount < $this->groupCount * $this->columnCount) {
            list($first) = array_keys($this->data);
            unset($this->data[$first]);
            $this->groupCount--;
        }

        $maxVal = 0;
        foreach ($this->data as $group) {
            $tmpMax = max($group);
            if ($maxVal < $tmpMax) {
                $maxVal = $tmpMax;
            }
        }
        $this->endValue = $maxVal + (self::STEP - ($maxVal % self::STEP));
        $this->initMarking();
    }

    protected function initMarking()
    {
        $this->groupWidth = ($this->width - ($this->groupCount * $this->cssGroupMargin * 2)) / $this->groupCount;
        //TODO IF > MAX
        $this->columnWidth = ($this->groupWidth - ($this->columnCount * self::CSS_COLUMN_MARGIN * 2)) / $this->columnCount;
        if ($this->columnWidth > $this->maxColumnWidth) {
            $this->columnWidth = $this->maxColumnWidth;
            $this->groupWidth = $this->maxColumnWidth * $this->columnCount;
        }
    }

    public function run()
    {

        $this->assets();
        $this->render('_groupChart');
    }

    public function assets()
    {
        $cs = Yii::app()->clientScript;
        $cssDir = Yii::app()->assetManager->publish(dirname(__FILE__) . '/css');
        $cs->registerCssFile($cssDir . '/columnCharts.css');
    }

    public function getXAxisHtml()
    {
        $html = '';
        foreach ($this->data as $key => $vals) {
            $html .= CHtml::tag('li',
                array('style' => 'width:' . $this->groupWidth . 'px; margin: 0 ' . $this->cssGroupMargin . 'px;'),
                '<span>' . CHtml::encode($key) . '</span>'
            );
        }
        return $html;
    }

    public function getLegendHtml()
    {
        $html = '';
        foreach ($this->meta as $id => $value) {
            $html .= "<li><span class='legend-icon fig$id'></span>" . CHtml::encode($value) . "</li>";
        }
        return $html;
    }

    public function getColumns()
    {
        $html = '';
        foreach ($this->data as $group) {
            $html .= '<div class="bar-group" style="width:' . $this->groupWidth . 'px; margin: 0 ' . $this->cssGroupMargin . 'px;">';
            foreach ($group as $id => $column) {
                $html .= CHtml::tag('div',
                    array('class' => "bar fig$id", 'style' => 'z-index:' . (-$id) . ';width:' . $this->columnWidth . 'px;left:' . ($id * $this->columnWidth + $id * self::CSS_COLUMN_MARGIN * 2 + self::CSS_COLUMN_MARGIN) . 'px; height: ' . $this->getColumnHeight($column) . '%;'),
                    '<span style="left:' . (($this->columnWidth - 30) / 2) . 'px;">' . $this->numberFormat($column) . '</span>'
                );
            }
            $html .= '</div>';
        }
        return $html;
    }

    protected function getColumnHeight($value)
    {
        return 100 * $value / $this->endValue;
    }

    protected function numberFormat($val)
    {
        return number_format($val, fmod($val, 1) == 0 ? 0 : 1, ',', ' ');
    }
}