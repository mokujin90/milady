<?php
/**
 *
 * @var SiteController $this
 * @var PsiWhiteSpace $data
 * @var array $districtList
 * @var #A#M#C\BaseController.actionRegionList.0|? $district
 */
?>
<div id="region-drop-inner">
    <div class="rel">


        <div class="header tab">
            <span data-sort="0" class="ajax <?if(!$district):?>active<?endif;?>"><?= Yii::t('main','По алфавиту')?></span>
            <span class="separator">|</span>
            <span data-sort="1" class="ajax <?if($district):?>active<?endif;?>"><?= Yii::t('main','По федеральным округам')?></span>
            <?=CHtml::textField('find-city-text','',array('id'=>'find-city-text','placeholder'=>Yii::t('main','Введите название региона')))?>
        </div>
        <div class="list chain-block">
            <?$showDistrict = array();?>
            <?foreach($data as $column):?>
                <div class="column">
                    <?foreach($column as $districtId=>$items):?>

                        <?if(!array_key_exists($districtId,$showDistrict)):?>
                            <?if($districtId!==0):?>
                                <div class="district"><?=$district ? $districtList[$districtId] : $districtId?></div>
                            <?endif;?>

                        <?endif;?>
                        <?$showDistrict[$districtId] = 1;?>
                        <?foreach($items as $regionId=>$regionName):?>
                            <div class="region"><?=CHtml::link($regionName,'#',array('data-region'=>$regionId))?></div>
                        <?endforeach;?>

                    <?endforeach;?>
                </div>
            <?endforeach;?>
        </div>
    </div>
</div>