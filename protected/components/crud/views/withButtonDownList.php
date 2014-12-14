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
            <div class="option button-panel top">
                <?= CHtml::checkBox('checkAll',$this->options['check_all'],array('value'=>1,'id'=>Makeup::id()))?>
                <?= CHtml::label(Yii::t('main','Выбрать все'),Makeup::id(),array('class'=>$this->options['check_all'] ? 'check-all checked': 'check-all'));?>
            </div>
            <div class="rel">

                <?foreach($this->elements as $key=>$value):?>
                    <div class="option">
                        <?= CHtml::checkBox($this->getName(),in_array($key,$this->selected),array('value'=>$key,'id'=>Makeup::id()))?>
                        <?= CHtml::label($value,Makeup::id());?>
                    </div>
                <?endforeach;?>

            </div>
            <div class="option button-panel bottom">
                <a class="drop-ok" href="<?=Yii::app()->request->url?>"><?= CHtml::button(Yii::t('main','Ок'),array('class'=>'btn'))?></a>
                <?= CHtml::button(Yii::t('main','Отмена'),array('class'=>'drop-cancel btn'))?>
            </div>
        </div>
    </div>
    <div class="selected">
        <?foreach($this->selected as $key):?>
            <?if(isset($this->elements[$key])):?>
                <div class="option" data-val="<?=$key?>">
                    <div class="unselect"></div><?=CHtml::label($this->elements[$key],'#')?>
                </div>
            <?endif;?>
        <?endforeach;?>
    </div>
<?=CHtml::closeTag('div')?>