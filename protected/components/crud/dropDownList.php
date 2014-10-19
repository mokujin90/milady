<?php

/**
 * Виджет модифицированного селекта. Представляет из себя слева кнопку, открывающую диалоговое окно со списком элементов,
 * а справа выбранные элементы, которые при желании можно вернуть обратно в список (для этого необходимо нажать на крестик)
 * Class DropDownList
 */
class DropDownList extends CWidget
{

    /**
     * Имя которое будет присваиваться выбранным пунктам
     * @var str
     */
    public $name;

    /**
     * Массив вида [[ключ:значение][ключ:значение]] со всеми возможными пунктами
     * @var array
     */
    public $elements = array();

    /**
     * Массив выбранных элементов вида [[ключ][ключ][ключ]] или ключ (если еденичный выбор)
     * @var array | int
     */
    public $selected = array();

    /**
     * Js-параметры для плагина
     * @var array
     */
    public $options = array();
    public $htmlOptions = array();

    /**
     * Модель куда будем записывать (при одиночной)
     * @var CActiveRecord
     */
    public $model = null;
    public $attribute;

    public function run()
    {
        $this->setJsOption();
        $this->setHtmlOption();
        $this->assets();
        if(!is_null($this->model)){
            $model = $this->model;
            $attribute = $this->attribute;
            $this->selected = $model->$attribute;
        }
        $view = $this->options['multiple'] ? 'dropDownList' : 'singleDownList';
        $this->render("crud.views.$view");
    }

    /**
     * Метод, который будет для вывода отдавать имя для выбранных элементов, в зависимости от переданных данных и параметров
     */
    protected function getName()
    {
        $name = is_null($this->name) ? CHtml::activeName($this->model, $this->attribute) : $this->name;

        #при множественном выборе добавим параметр, который сделает массив из наших записей
        if ($this->options['multiple']) {
            $name .= '[]';
        }
        return $name;
    }

    /**
     * Все действия с Jsом происходят здесь
     */
    private function assets()
    {
        Yii::app()->getClientScript()->registerScriptFile('/js/crud/jquery.crud.select.js');
        $options = CJavaScript::encode($this->options);
        Yii::app()->clientScript->registerScript($this->getId(), "$('#{$this->getId()}').dropDown($options)", CClientScript::POS_READY);
    }

    /**
     * Рассчитать стандартные параметры для js параметров
     */
    private function setJsOption(){
        $default = array('multiple'=>true);
        $this->options = array_merge($default,$this->options);
    }

    private function setHtmlOption(){
        $addClass = $this->options['multiple'] ? 'multiple' : 'single';
        $this->htmlOptions['id'] = $this->getId();
        $this->htmlOptions['class'] = (isset($this->htmlOptions['class']) ? $this->htmlOptions['class'] : '') . ' crud drop ' . $addClass ;
    }
}