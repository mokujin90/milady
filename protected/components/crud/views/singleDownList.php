<?php
/**
 * @var DropDownList $this
 */
?>
<?=CHtml::openTag('div',$this->htmlOptions)?>
    <div class="selected">
        <?if(isset($this->elements[$this->selected])):?>
            <div class="option">
                <?=CHtml::checkBox($this->getName(),true,array('value'=>$this->selected,'id'=>Makeup::id()))?>
                <?=$this->elements[$this->selected]?>
            </div>
        <?endif;?>
    </div>
    <div class="elements">
        <?=CHtml::image('/images/markup/crud/show-select.png','',array('class'=>'button-down'))?>
        <div class="drop-down box dark">
            <?foreach($this->elements as $key=>$value):?>
                <div class="option <?if($key == $this->selected):?>block<?endif;?>">
                    <?= CHtml::checkBox($this->getName(),false,array('value'=>$key,'id'=>Makeup::id()))?>
                    <?= CHtml::label($value,Makeup::id());?>
                </div>
            <?endforeach;?>
        </div>
    </div>

<?=CHtml::closeTag('div')?>