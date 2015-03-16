<?php
/**
 * @var DropDownList $this
 */
?>
<?=CHtml::openTag('div',$this->htmlOptions)?>
    <?if(isset($this->options['placeholder']) && $this->options['label']):?>
        <?php echo CHtml::label($this->options['placeholder'],'#',array('class'=>'up drop-label'))?>
    <?endif;?>

    <div class="elements">
        <?=CHtml::image('/images/markup/crud/show-select.png','',array('class'=>'button-down'))?>
        <div class="drop-down box dark">
            <?foreach($this->elements as $key=>$value):?>
                <div class="option">
                    <?= CHtml::checkBox($this->getName(),in_array($key,$this->selected ? $this->selected : array()),array('value'=>$key,'id'=>$this->getElementId($key)))?>
                    <?= CHtml::label($value,$this->getElementId($key));?>
                </div>
            <?endforeach;?>
        </div>
    </div>
    <div class="selected">
        <?php if(is_array($this->selected)):?>
            <?foreach($this->selected as $key):?>
                <?if(isset($this->elements[$key])):?>
                    <div class="option" data-val="<?=$key?>">
                        <div class="unselect"></div><?=CHtml::label($this->elements[$key],'#')?>
                    </div>
                <?endif;?>
            <?endforeach;?>
        <?php endif;?>
    </div>
<?=CHtml::closeTag('div')?>