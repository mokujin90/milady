<?php
/**
 *
 * @var RegionController $this
 * @var RegionContent $region
 */
Yii::app()->clientScript->registerCssFile('/css/vendor/jquery.bxslider.css');

Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.bxslider.min.js', CClientScript::POS_HEAD);
?>

<div class="tab geo">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Географическое положение'),'icon'=>'geo','toggleText'=>'карту'))?>
    <div class="data toggled-block">
        <div class="map-widget rel">
            <?php $this->widget('Map', array(
                'id'=>'map',
                'projects'=>$projects,
                'target'=>$region->region->name,
                'htmlOptions'=>array(
                    'style'=>'height:355px;'
                ),
                'showProjectBalloon'=>true,
                'region' => $region->region,
                'panel'=>'application.views.region._filterMap',
                'panelParams'=>array('region'=>$region,'this'=>$this)
            )); ?>
        </div>
    </div>
</div>


<div class="tab econom">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Экономические показатели'),'icon'=>'econom'))?>
    <div class="data toggled-block">
        <div class="main chain trans-block detail">
            <div class="params-block">
                <div class="chain double">
                    <div class="item">
                        <span class="logo r r-block-econom-vvp"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','Валовый региональный продукт')?></div>
                            <div class="value"><span class="r r-rub"></span><?=Candy::formatNumber($region->gross_regional_product)?></div>
                            <div class="notice"><?= Yii::t('main','{n} руб на душу населения',array('{n}'=> Candy::formatNumber($region->gross_regional_product_personal)))?></div>
                        </div>
                    </div>
                    <div class="item">
                        <span class="logo r r-block-econom-invest-ino"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','Объем прямых иностранных инвестиций')?></div>
                            <div class="value"><span class="r r-dollar"></span><?=Candy::formatNumber($region->foreign_investment)?></div>
                            <div class="notice"><?= Yii::t('main','{n} руб на душу населения',array('{n}'=>"$ " . Candy::formatNumber($region->foreign_investment_person)))?></div>
                        </div>
                    </div>
                </div>
               <div class="chain double">
                   <div class="item">
                       <span class="logo r r-block-econom-invest"></span>
                       <div class="detail">
                           <div class="key"><?= Yii::t('main','Инвестиции в основной капитал')?></div>
                           <div class="value"><span class="r r-rub"></span><?=Candy::formatNumber($region->investment_capital)?></div>
                           <div class="notice"><?= Yii::t('main','{n} руб на душу населения',array('{n}'=>Candy::formatNumber($region->investment_capital_personal)))?></div>
                       </div>
                   </div>
                   <div class="item">
                       <span class="logo r r-block-profit"></span>
                       <div class="detail">
                           <div class="key"><?= Yii::t('main','Удельный вес прибыльных предприятий')?></div>
                           <div class="value"><?=number_format($region->weight_profit, 1, ',', ' ')?>%</div>
                       </div>
                   </div>
               </div>
                <div class="chain double">
                    <div class="item">
                        <span class="logo r r-block-econom-zp"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','Среднемесячная заработная плата')?></div>
                            <div class="value"><span class="r r-rub"></span><?=Candy::formatNumber($region->salary)?></div>
                            <div class="notice"><?= Yii::t('main','{n} руб прожиточный минимум',array('{n}'=>Candy::formatNumber($region->salary_min)))?></div>
                        </div>
                    </div>
                    <div class="item">
                        <span class="logo r r-block-econom-unwork"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','Уровень зарегистрированной безработицы')?></div>
                            <div class="value"><?=number_format($region->unemployment, 1, ',', ' ')?>%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="proof-block">Данные представлены за 2015 год </div>
        </div>
    </div>
</div>
<?if(count($region->region->regionActiveCities)):?>
    <div class="tab city">
        <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Крупнейшие города'),'icon'=>'city'))?>
        <div class="data toggled-block">
            <div class="main chain trans-block detail">

                <?foreach ($region->region->regionCities as $regionCity):?>
                    <?
                    if($regionCity->is_hidden) continue;
                    if($regionCity->count_people > 10000){
                        $countClass = 'huge';
                    } elseif ($regionCity->count_people > 1000){
                        $countClass = 'big';
                    } elseif ($regionCity->count_people > 100){
                        $countClass = 'middle';
                    } else {
                        $countClass = 'small';
                    }?>
                    <div class="region-city-block">
                        <div class="image-block <?=$countClass?>">
                            <?if($regionCity->media):?>
                                <div class="custom-image-wrapper">
                                    <?=Candy::preview(array($regionCity->media, 'scaleMode' => 'in', 'scale' => '85x85', 'noGif' => true))?>
                                </div>
                            <?endif?>
                        </div>
                        <div class="region-city-name"><?=CHtml::encode($regionCity->name)?></div>
                        <div class="region-city-count"><?=CHtml::encode($regionCity->count_people)?> тыс. чел.</div>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </div>

<?endif;?>

<?if(count($region->region->companies)):?>
    <div class="tab big-industry">
        <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Крупнейшие предприятия'),'icon'=>'big-industry'))?>
        <div class="data toggled-block">
            <div class="main chain trans-block detail">
                <div class="image-list chain">
                    <?foreach($region->region->companies as $item):?>
                        <?$item = $item->company;?>
                        <?$url = Makeup::makeLinkTextUrl($item->url);?>
                        <div class="item">
                            <? if ($item->media): ?>
                                <div class="logo">
                                    <?= Candy::preview(array($item->media, 'scaleMode' => 'in', 'scale' => '100x100')) ?>
                                </div>
                            <? endif ?>
                            <div class="name"><?=CHtml::encode($item->name)?></div>
                            <?= empty($item->url) ? '' : CHtml::link($url[0],$url[1],array('target'=>'_blank'))?>
                        </div>
                    <?endforeach?>
                </div>
            </div>
        </div>
    </div>
<?endif;?>

<?if(!empty($this->model->day_sunny) ||
!empty($this->model->year_rain) ||
!empty($this->model->winter_temperatures) ||
!empty($this->model->summer_temperatures)
):?>
<div class="tab climat">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Климат'),'icon'=>'climat'))?>
    <div class="data toggled-block">
        <div class="main chain trans-block detail">
           <div class="double chain">
               <?if(!empty($this->model->day_sunny)):?>
               <div class="item">
                   <div class="text"><?= Yii::t('main','Солнечных дней в году')?></div>
                   <div>
                       <span class="r r-block-climat-sunday"></span>
                       <span class="value"><?=$this->model->day_sunny?></span>
                   </div>
               </div>
               <?endif?>
               <?if(!empty($this->model->year_rain)):?>
               <div class="item">
                   <div class="text"><?= Yii::t('main','Среднегодовой уровень осадков')?></div>
                   <div>
                       <span class="r r-block-climat-rain"></span>
                       <span class="value"><?=$this->model->year_rain?> мм</span>
                   </div>
               </div>
               <?endif?>
           </div>
            <div class="double chain">
                <?if(!empty($this->model->winter_temperatures)):?>
                <div class="item">
                   <div class="text"><?= Yii::t('main','Дневная температура января')?></div>
                   <div>
                       <span class="r r-block-climat-winnter-t"></span>
                       <span class="value"><?=$this->model->winter_temperatures?>°С</span>
                   </div>
                </div>
                <?endif?>
                <?if(!empty($this->model->summer_temperatures)):?>
                <div class="item">
                   <div class="text"><?= Yii::t('main','Дневная температура июля')?></div>
                   <div>
                       <span class="r r-block-climat-summer-t"></span>
                       <span class="value"><?=$this->model->summer_temperatures?>°С</span>
                   </div>
                </div>
                <?endif?>
            </div>
        </div>
    </div>
</div>
<?endif?>

<?if(count($region->zoneFormat)):?>
    <div class="tab zone">
        <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Природная зона'),'icon'=>'zone'))?>
        <div class="data toggled-block">
            <div class="main chain trans-block detail">
                <?$i=0;?>
                <?foreach($region->zoneFormat as $zone):?>
                    <?php if($i%2 ==0):?>
                        <div class="double chain">
                    <?php endif;?>
                    <div class="item">
                        <span class="r r-block-zone-<?=RegionContent::getZone($zone,false)?>"></span>
                        <span class="blue"><?=RegionContent::getZone($zone)?></span>
                    </div>
                    <?php if($i%2 ==0):?>
                        </div>
                    <?php endif;?>
                    <?$i++;?>
                <?endforeach;?>
            </div>
        </div>
    </div>
<?endif;?>


<?if(count($news)):?>
    <div class="tab news">
        <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Новости'),'icon'=>'news'))?>
        <div class="data toggled-block">
            <div class="main chain trans-block detail news-list">
                <?foreach($news as $newsModel):?>
                    <div class="item">
                        <div class="date gray"><?=Candy::formatDate($newsModel->create_date,'d/m')?></div>
                        <?=CHtml::link(CHtml::encode($newsModel->name),$newsModel->createUrl(), array('class' => 'caption'))?>
                        <div class="notice"><?=CHtml::encode($newsModel->announce)?></div>
                    </div>
                <?endforeach?>
                <div class="button-panel">
                    <?php echo CHtml::link(Yii::t('main','Все новости'),$this->createUrl('news/index', array('region' => $region->region_id)), array('class'=>'btn','style'=>'background: #508bcc;'))?>
                </div>
            </div>
        </div>
    </div>
<?endif;?>


