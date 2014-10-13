<?php
/**
 * @var DropDownList $this
 */
?>
<?=CHtml::openTag('div',$this->htmlOptions)?>
    <div class="elements">
        <?=CHtml::image('/images/markup/crud/show-select.png','',array('class'=>'button-down'))?>
        <div class="drop-down box dark">
            <?foreach($this->elements as $key=>$value):?>
                <div class="option <?if(in_array($key,$this->selected)):?>block<?endif;?>">
                    <?= CHtml::checkBox($this->getName(),false,array('value'=>$key,'id'=>Makeup::id()))?>
                    <?= CHtml::label($value,Makeup::id());?>
                </div>
            <?endforeach;?>
        </div>
    </div>
    <div class="selected">
        <?foreach($this->selected as $key):?>
            <?if(isset($this->elements[$key])):?>
                <div class="option">
                    <?=CHtml::checkBox($this->getName(),true,array('value'=>$key,'id'=>Makeup::id()))?>
                    <?=CHtml::label('',Makeup::id(),array('class'=>'unselect'))?>
                    <?=$this->elements[$key]?>
                </div>
            <?endif;?>
        <?endforeach;?>
    </div>
<?=CHtml::closeTag('div')?>