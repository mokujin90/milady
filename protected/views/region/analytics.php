<?php
/**
 *
 * @var RegionController $this
 * @var Field reference $region
 */
?>
<div class="tab invest-industry">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Инвестиционные проекты по отраслям'),'icon'=>'graph'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="graphic-block dual chain">
                <div class="item">
                    <div class="caption"><?= Yii::t('main','По количеству проектов')?></div>
                    <?$this->renderPartial('_pieChart', array('data' => $region->region->getStatisticByIndustryCount(), 'total' => 'Общее число проектов'))?>
                </div>
                <div class="item">
                    <div class="caption"><?= Yii::t('main','По заявленным суммам инвестиций')?></div>
                    <?$this->renderPartial('_pieChart', array('data' => $region->region->getStatisticByIndustrySum(), 'total' => 'Общая сумма инвестиций', 'rub' => true))?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab invest-industry">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Инновационные проекты по критическим технологиям'),'icon'=>'graph1'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="graphic-block dual chain">
                <div class="item">
                    <div class="caption"><?= Yii::t('main','По количеству проектов')?></div>
                    <?$this->renderPartial('_pieChart', array('data' => $region->region->getStatisticByTechCount(), 'total' => 'Общее число проектов'))?>
                </div>
                <div class="item">
                    <div class="caption"><?= Yii::t('main','По заявленным суммам инвестиций')?></div>
                    <?$this->renderPartial('_pieChart', array('data' => $region->region->getStatisticByTechSum(), 'total' => 'Общая сумма инвестиций', 'rub' => true))?>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab invest-industry">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Инфраструктурные проекты по типам'),'icon'=>'graph1'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="graphic-block dual chain">
                <div class="item">
                    <div class="caption"><?= Yii::t('main','По количеству проектов')?></div>
                    <?$this->renderPartial('_pieChart', array('data' => $region->region->getStatisticByTypeCount(), 'total' => 'Общее число проектов'))?>
                </div>
                <div class="item">
                    <div class="caption"><?= Yii::t('main','По заявленным суммам инвестиций')?></div>
                    <?$this->renderPartial('_pieChart', array('data' => $region->region->getStatisticByTypeSum(), 'total' => 'Общая сумма инвестиций', 'rub' => true))?>
                </div>
            </div>
        </div>
    </div>
</div>
<?
    $columnsIndustry = array();
    //поделим отрасли на две колонки в два массива
    $industries = $region->industryFormat;
    if(count($industries)>1){
        $middleIndex = ceil(count($industries)/2);
        $i = 1;
        foreach($industries as $item){
            $columnsIndustry[$middleIndex<$i ? 0 : 1][] = $item;
            $i++;
        }
    }
    elseif(count($industries)){
        $columnsIndustry[]=$industries;
    }
?>
<?if(count($columnsIndustry)):?>
<div class="tab industry">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Крупнейшие отрасли промышленности'),'icon'=>'industry'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="ball-list chain">
                <?foreach($columnsIndustry as $items):?>
                    <div class="column">
                        <?foreach($items as $industryId):?>
                            <div class="item">
                                <span class="r r-industry-<?=RegionContent::model()->getIndustry($industryId,false)?>"></span>
                                <span class="text"><?=RegionContent::model()->getIndustry($industryId)?></span>
                            </div>
                        <?endforeach;?>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</div>
<?endif?>