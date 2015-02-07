<?php

/**
 * Class Grid
 * Своеобразный гридвью Yii с возможностью редактирования и js-создания строк
 */
class Grid extends CWidget
{
    const A_EDIT = 0;
    const A_VIEW = 1;
    /**
     * @var CActiveRecord
     */
    public $model = null;
    public $attribute;
    /**
     * Массив вида [[[значение][значение]][[значение][значение]]] таблица 2x2
     * @var array
     */
    public $data = array();
    public $options = array();
    public $htmlOptions = array();
    public $name;

    public $header = array();
    public $action = self::A_EDIT;

    public function run()
    {
        $this->setDefaults();
        $this->setHtmlOption();
        $this->assets();
        $this->setData();
        $this->render("crud.gridView.{$this->getView()}");
    }

    private function assets()
    {
        if ($this->action == self::A_EDIT) {
            Yii::app()->getClientScript()->registerScriptFile('/js/crud/jquery.crud.grid.js');
            $options = CJavaScript::encode($this->options);
            $js = "crudGrid.init('{$this->getId()}',$options);";
            if ($this->htmlOptions['ajax']) {
                echo "<script>$js</script>";
            } else {
                Yii::app()->clientScript->registerScript($this->getId(), $js, CClientScript::POS_READY);
            }
        }

    }

    private function setHtmlOption()
    {
        $this->htmlOptions['id'] = isset($this->htmlOptions['id']) ? $this->htmlOptions['id'] : $this->getId();
        $this->htmlOptions['class'] = (isset($this->htmlOptions['class']) ? $this->htmlOptions['class'] : '') . ' crud-grid ';
        $this->htmlOptions['ajax'] = (isset($this->htmlOptions['ajax']) ? $this->htmlOptions['ajax'] : false);
        $this->htmlOptions['style'] = "font-size: 12px;text-align: center;";
    }

    private function setDefaults()
    {
        $default = array('button' => true);
        $this->options = array_merge($default, $this->options);

    }

    private function getView()
    {
        if ($this->action == self::A_EDIT) {
            $view = 'edit';
        } else {
            $view = 'view';
        }
        return $view;
    }

    protected function getName()
    {
        $name = is_null($this->name) ? CHtml::activeName($this->model, $this->attribute) : $this->name;
        #при множественном выборе добавим параметр, который сделает массив из наших записей

        return $name;
    }

    protected function setData()
    {
        if (!is_null($this->model)) {
            if(is_array($this->model)){
                foreach($this->model as $model){
                    $current = Candy::model2Array($model);
                    foreach($current as $attr => $value){
                        if(!in_array($attr,array_keys($this->header))){
                            unset($current[$attr]);
                        }
                    }
                    if ($this->action == self::A_EDIT) {
                        $current += array(0 => '');
                    }
                    $this->data[] = $current;
                }
            }
            else{
            }
        }
        if (count($this->header)) {
            if ($this->action == self::A_EDIT && is_array($this->model)) {
                $this->header += array(0 => '');
            }
            $this->header = array($this->header);
        }
    }

    public function drawLine($line = array(), $edit, $new = false)
    {
        $html = '';
        $addClass = '';
        foreach ($line as $key => $td) {
            $content = $td;
            if($new){
                $td='';
            }
            if ($key === 0 && $edit) {
                $addClass = 'min';
                $content = CHtml::checkBox('',false,array('class'=>'remove-line'));
            }  elseif ($edit) {
                $content = CHtml::textField("{$this->name}[{$key}][]", $td);
            }
            $html .= CHtml::tag('td', array('class' => 'cell ' . $addClass), $content);
        }
        return $html;
    }


}