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
                </div>
                <div class="item">
                    <div class="caption"><?= Yii::t('main','По заявленным сумам инвестиций')?></div>
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
                </div>
                <div class="item">
                    <div class="caption"><?= Yii::t('main','По заявленным сумам инвестиций')?></div>
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
                <div class="params-block">
                    <div class="chain double">
                        <div class="item">
                            <span class="logo r r-block-econom-vvp"></span>
                            <div class="detail">
                                <div class="key"><?= Yii::t('main','Валовый региональный продукт')?></div>
                                <div class="value"><span class="r r-rub"></span>1 192,2 млрд</div>
                                <div class="notice"><?= Yii::t('main','{n} на душу населения',array('{n}'=>"261,3 тыс. руб "))?></div>
                            </div>
                        </div>
                        <div class="item">
                            <span class="logo r r-block-econom-invest-ino"></span>
                            <div class="detail">
                                <div class="key"><?= Yii::t('main','Объем пряых иностранных инвестиций')?></div>
                                <div class="value"><span class="r r-dollar"></span>11 156,4</div>
                                <div class="notice"><?= Yii::t('main','{n} на душу населения',array('{n}'=>"$ 3910,7 "))?></div>
                            </div>
                        </div>
                    </div>
                    <div class="chain double">
                        <div class="item">
                            <span class="logo r r-block-econom-invest"></span>
                            <div class="detail">
                                <div class="key"><?= Yii::t('main','Инвестиции в основной капитал')?></div>
                                <div class="value"><span class="r r-rub"></span>369 298 млн</div>
                                <div class="notice"><?= Yii::t('main','{n} на душу населения',array('{n}'=>"129594 руб "))?></div>
                            </div>
                        </div>
                        <div class="item">
                            <span class="logo r r-block-profit"></span>
                            <div class="detail">
                                <div class="key"><?= Yii::t('main','Удельный вес прибыльных предприятий')?></div>
                                <div class="value">71,5%</div>
                            </div>
                        </div>
                    </div>
                    <div class="chain double">
                        <div class="item">
                            <span class="logo r r-block-econom-zp"></span>
                            <div class="detail">
                                <div class="key"><?= Yii::t('main','Среднемесячная заработная плата')?></div>
                                <div class="value"><span class="r r-rub"></span>31 662,6</div>
                                <div class="notice"><?= Yii::t('main','{n} прожиточный минимум',array('{n}'=>"8478 руб "))?></div>
                            </div>
                        </div>
                        <div class="item">
                            <span class="logo r r-block-econom-unwork"></span>
                            <div class="detail">
                                <div class="key"><?= Yii::t('main','Уровень зарегистрированной безработицы')?></div>
                                <div class="value">5,7%</div>
                            </div>
                        </div>
                    </div>
                    <div class="proof-block">Данные представлены за 2014 год </div>
                </div>
                <div class="item">
                    <div class="caption"><?= Yii::t('main','По заявленным сумам инвестиций')?></div>
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
    else{
        $columnsIndustry[]=$industries;
    }
?>

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