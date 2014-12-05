<?php

class EventCalendarWidget extends CWidget
{
    /**
     * Дата с которой начинать календарь
     * @var string
     */
    public $date = null;

    public $news;

    /**
     * Понедельник первой недели календаря
     * @var DateTime
     */
    private $calendarStartDate;

    private $month;
    private $day;

    public function init() {
        $this->date = new DateTime($this->date);
        $this->month = $this->date->format('m');
        $this->day = $this->date->format('d');
        $this->calendarStartDate = clone $this->date;
        $day = $this->calendarStartDate->format('N') - 1;
        $this->calendarStartDate->modify("-$day days");

        $criteria = new CDbCriteria();
        $criteria->addCondition("create_date >= '" . $this->calendarStartDate->format('Y-m-d') . "'");
        $criteria->addColumnCondition(array('is_active'=>1));
        $this->news = Event::model()->findAll($criteria);
    }

    public function run()
    {

        $this->assets();
        $this->render('calendar');
    }

    /**
     * Вернем AR родителя в нашей структуре
     * @param $tree Comment корневой комментарий
     * @param $comment Comment текущий
     */
    public function getAnswer($comment, $tree)
    {
        if ($tree->id == $comment->parent_id) {
            return $tree;
        } else {
            return $this->tree[$tree->id]['child'][$comment->parent_id];
        }
    }

    public function assets()
    {
        /*Yii::app()->clientScript->registerScriptFile(
            Yii::app()->assetManager->publish(
                dirname(__FILE__) . '/assets/event.js', false, -1, YII_DEBUG
            ),
            CClientScript::POS_END
        );*/
    }

    public function getTableHead()
    {
        $tmp = clone $this->calendarStartDate;
        $html = CHtml::tag('th', array('class' => 'day-week'), '');
        for ($i = 0; $i < 7; $i++) {
            $html .= CHtml::tag('th', array('class' => 'week'), $tmp->format('W'));
            $tmp->modify('+ 1 week');
        }
        $html .= CHtml::tag('th', array('class' => 'day-week'), '');
        $html = CHtml::tag('tr', array('class' => 'week-row'), $html);
        return $html;
    }

    public function getTableBody()
    {
        $html = '';
        $weekNames = array(Yii::t('main', 'пн'), Yii::t('main', 'вт'), Yii::t('main', 'ср'), Yii::t('main', 'чт'), Yii::t('main', 'пт'), Yii::t('main', 'сб'), Yii::t('main', 'вс'));
        for ($i = 0; $i < 7; $i++) {
            $tmp = clone $this->calendarStartDate;
            $tmp->modify("+ $i days");
            $htmlRow = CHtml::tag('td', array('class' => 'day-week'), $weekNames[$tmp->format('N') - 1]);
            for ($j = 0; $j < 7; $j++) {
                $htmlRow .= CHtml::tag('td', array('class' => $this->getDateClass($tmp), 'data-date' => $tmp->format('Y-m-d')), '<span>' . $tmp->format('j') . '</span>');
                $tmp->modify('+ 1 week');
            }
            $htmlRow .= CHtml::tag('td', array('class' => 'day-week'), $weekNames[$tmp->format('N') - 1]);
            $html .= CHtml::tag('tr', array(), $htmlRow);
        }
        return $html;
    }

    private function getDateClass($date)
    {
        $classes = array('date');
        if ($this->month != $date->format('m')) {
            $classes[] = 'grey';
        } elseif ($this->day == $date->format('d')) {
            $classes[] = 'selected';
        }
        $tmp = $date->format('Y-m-d');
        foreach($this->news as $item) {
            if ($item->create_date == $tmp) {
                $classes[] = 'active';
                break;
            }
        }

        return implode(' ', $classes);
    }

    public function getCalendarEvent() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("create_date = '" . $this->date->format('Y-m-d') . "'");
        $criteria->addColumnCondition(array('is_active'=>1));
        $this->controller->renderPartial('/event/_item', array('model' => Event::model()->find($criteria)));
    }
}