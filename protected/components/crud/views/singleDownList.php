<?php
/**
 * @var DropDownList $this
 */
?>
<?=CHtml::openTag('div',$this->htmlOptions)?>
    <div class="selected" data-val="<?=$this->selected?>">
        <div class="option" data-val="initiator">
            <? $text = empty($this->elements[$this->selected]) ? $this->options['placeholder'] : $this->elements[$this->selected]?>
            <?=CHtml::label($text,'#')?>
        </div>
    </div>
    <div class="elements">
        <?=CHtml::image('/images/markup/crud/show-select.png','',array('class'=>'button-down'))?>
        <div class="drop-down box dark">
            <?foreach($this->elements as $key=>$value):?>
                <div class="option">
                    <?= CHtml::checkBox($this->getName(),($key==$this->selected && !is_null($this->selected)),array('value'=>$key,'id'=>Makeup::id()))?>
                    <?= CHtml::label($value,Makeup::id());?>
                </div>
            <?endforeach;?>
        </div>
    </div>

<?=CHtml::closeTag('div')?>