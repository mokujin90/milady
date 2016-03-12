<?php
/**
 * @var DropDownList $this
 */
?>
<div class="filter-region filter-block open">
    <p class="filter-region__btn filter-block__btn select__open">
        <i class="filter-region__btn_check filter-block__btn_check"></i>
        <?if(isset($this->options['placeholder']) && $this->options['label']):?>
            <span><?=$this->options['placeholder']?></span>
        <?endif;?>
        <span class="select-list select-list_many">
                <?foreach($this->elements as $key=>$value):?>
                    <label class="select-list__item">
                        <?= CHtml::checkBox($this->getName(),in_array($key,$this->selected ? $this->selected : array()),array('value'=>$key))?>
                        <span class="select-list__item_btn"></span>
                        <?=$value?>
                    </label>
                <?endforeach;?>
            </span>
    </p>
    <div class="filter-region-list filter-block-list">
        <?php if(is_array($this->selected)):?>
            <?foreach($this->selected as $key):?>
                <?if(isset($this->elements[$key])):?>
                    <label class="selected selected_full active selected__option" data-val="<?=$key?>">
                        <span class="selected__btn unselect"></span>
                        <span class="selected__name"><?=$this->elements[$key]?></span>
                    </label>
                <?endif;?>
            <?endforeach;?>
        <?php endif;?>

    </div><!--p-filter-region-list-->
</div><!--p-filter-region-list-->

<!--div class="selected">
        <?php if(is_array($this->selected)):?>
            <?foreach($this->selected as $key):?>
                <?if(isset($this->elements[$key])):?>
                    <div class="option" data-val="<?=$key?>">
                        <div class="unselect"></div><?=CHtml::label($this->elements[$key],'#')?>
                    </div>
                <?endif;?>
            <?endforeach;?>
        <?php endif;?>
    </div-->