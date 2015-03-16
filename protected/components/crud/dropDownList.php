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
        $this->setDefaults();
        $this->setJsOption();
        $this->setHtmlOption();
        $this->assets();
        if(!is_null($this->model)){
            $model = $this->model;
            $attribute = $this->attribute;
            $this->selected = $model->$attribute;
            if($this->options['label'] && $this->options['placeholder']==''){
                $this->options['placeholder'] = $model->getAttributeLabel($attribute);
            }
            if($model->isAttributeRequired($attribute) && $this->options['placeholder'] && $this->options['show_required']){
                $this->options['placeholder'] .=" *";
            }
        }
        else{

        }
        $this->render("crud.views.{$this->getView()}");
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
        $js = "$('#{$this->htmlOptions['id']}').dropDown($options)";
        if($this->htmlOptions['ajax']){
            echo "<script>$js</script>";
        }
        else{
            Yii::app()->clientScript->registerScript($this->getId(), $js, CClientScript::POS_READY);
        }
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
        $this->htmlOptions['id'] = isset($this->htmlOptions['id']) ? $this->htmlOptions['id'] : $this->getId();
        $this->htmlOptions['class'] = (isset($this->htmlOptions['class']) ? $this->htmlOptions['class'] : '') . ' crud drop ' . $addClass ;
        $this->htmlOptions['ajax'] = (isset($this->htmlOptions['ajax']) ? $this->htmlOptions['ajax'] : false);

    }

    private function setDefaults(){
        $this->options['label'] = Candy::get($this->options['label'],true); //true/false
        $this->options['placeholder'] = Candy::get($this->options['placeholder'],'');
        $this->options['check_all'] = Candy::get($this->options['check_all'],false);
        $this->options['show_required'] = Candy::get($this->options['show_required'],true);
        if($this->options['check_all'] && empty($this->selected)){
            $this->selected = array_keys($this->elements);
        }
        else{
            $this->options['check_all'] = false;
        }
    }

    private function getView(){
        if(isset($this->options) && isset($this->options['useButton'])){
            $this->options['skin'] = 'withButton';
            $this->htmlOptions['class'] .=" has-button";
        }
        if(isset($this->options['skin'])){
            $view = "{$this->options['skin']}DownList";
        }
        else{
            $view = $this->options['multiple'] ? 'dropDownList' : 'singleDownList';
        }
        return $view;
    }

    public function getElementId($key){
        return $this->getName()."_".$key;
    }
}