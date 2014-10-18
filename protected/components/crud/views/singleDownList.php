<?php
/**
 * @var DropDownList $this
 */
?>
<?=CHtml::openTag('div',$this->htmlOptions)?>
    <div class="selected" data-val="<?=$key?>">
        <?if(isset($this->elements[$this->selected])):?>
            <?=CHtml::label($this->elements[$key],'#')?>
        <?endif;?>
    </div>
    <div class="elements">
        <?=CHtml::image('/images/markup/crud/show-select.png','',array('class'=>'button-down'))?>
        <div class="drop-down box dark">
            <?foreach($this->elements as $key=>$value):?>
                <div class="option">
                    <?= CHtml::checkBox($this->getName(),$key==$this->selected,array('value'=>$key,'id'=>Makeup::id()))?>
                    <?= CHtml::label($value,Makeup::id());?>
                </div>
            <?endforeach;?>
        </div>
    </div>

<?=CHtml::closeTag('div')?>