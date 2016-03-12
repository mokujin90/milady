<?php
/**
 * @var DropDownList $this
 */
if(is_array($this->selected)){
    $this->selected = array_shift(array_values($this->selected));
}
?>
<?=CHtml::openTag('div',$this->htmlOptions)?>
    <div class="selected">
        <div class="option" data-val="<?=$this->selected?>">
            <? $text = empty($this->elements[$this->selected]) ? $this->options['placeholder'] : $this->elements[$this->selected]?>
            <?=CHtml::label($text,'#',array('class'=>'drop-label'))?>
        </div>
    </div>
    <div class="elements">
        <?=CHtml::image('/images/markup/crud/show-select.png','',array('class'=>'button-down'))?>
        <div class="drop-down box dark">
            <?foreach($this->elements as $key=>$value):?>
                <div class="option single-option">
                    <?= CHtml::checkBox($this->getName(),($key==$this->selected && !is_null($this->selected)),array('value'=>$key,'id'=>Makeup::id()))?>
                    <?= CHtml::label($value,Makeup::id());?>
                </div>
            <?endforeach;?>
        </div>
    </div>

<?=CHtml::closeTag('div')?>