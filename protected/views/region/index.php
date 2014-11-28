<?php
/**
 *
 * @var RegionController $this
 */
?>
<div class="region-page">
    <div id="general">

    <div class="main">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>array('Регионы'=>$this->createUrl('region/index'),'Москва'),
            'htmlOptions' => array('class'=>'breadcrumb'),
            'homeLink'=>CHtml::link('Главная','/',array('class'=>'normal')),
            'separator'=>''
        )); ?>
    </div>
    <div class="content main info chain-block">

        <div>
            <div class="header">
                <?=Candy::preview(array($region->logo, 'scale' => '100x100'))?>
                <div class="caption"><?=$region->region->name?></div>
            </div>
            <div class="text">
                <?=$region->info?>
            </div>
        </div>
        <div>
            <div class="header">
                <?=Candy::preview(array($region->mayorLogo, 'scale' => '100x100'))?>
                <div class="notice">Руководство региона<br/>Мер</div>
                <div class="caption width-190"><?=$region->mayor?></div>
            </div>
            <div class="text">
                <?=$region->mayor_text?>
            </div>
        </div>
        <div class="investment">
            <div class="header">
                <div class="notice">Поддержка инвестора</div>
                <div class="caption"><?=$region->investor_support?></div>
                <?php echo CHtml::link($region->investor_support_url,$region->investor_support_url)?>
            </div>
            <div class="text">
                <?=$region->investor_support_text?>
            </div>
        </div>
    </div>

    <div class="dark-gray-gradient line top bottom">
        <div class="main">
            <div class="linked">
                <?php echo CHtml::link(Yii::t('main','Социально-экономическая информация'),$this->createUrl('region/social'),array())?><span class="sep">/</span>
                <?php //echo CHtml::link(Yii::t('main','Региональная аналитика'),'#',array())?><!--span class="sep">/</span-->
                <?php echo CHtml::link(Yii::t('main','Инфраструктурный паспорт'),$this->createUrl('region/infra'),array())?><span class="sep">/</span>
                <?php echo CHtml::link(Yii::t('main','Инновационный паспорт'),$this->createUrl('region/innovation'),array())?><span class="sep">/</span>
                <?php //echo CHtml::link(Yii::t('main','Региональное законодательство'),'#',array())?><!--span class="sep">/</span-->
                <?php echo CHtml::link(Yii::t('main','Инвестиционный паспорт'),$this->createUrl('region/investment'),array())?>
            </div>
        </div>
    </div>
    <div class="map-widget rel">
        <?php $this->widget('Map', array(
            'id'=>'map',
            'projects'=>$projects,
            'htmlOptions'=>array(
                'style'=>'height:300px;'
            ),
            'projects' => Project::model()->findAll()
        )); ?>
        <div class="abs main">
            <div class="transparent">
                <div class="header red"><?= Yii::t('main','Общие сведения о регионе')?></div>
                <div class="fieldlist">
                    <div class="item">
                        <div class="label"><?= Yii::t('main','Административный центр')?></div>
                        <div class="value"><?=$region->administrative_center?></div>
                    </div>
                    <div class="item">
                        <div class="label"><?= Yii::t('main','Площадь региона')?></div>
                        <div class="value"><?= Yii::t('main','{n} тыс. км',array('{n}'=>$region->area))?><sup>2</sup></div>
                    </div>
                    <div class="item">
                        <div class="label"><?= Yii::t('main','Население региона')?></div>
                        <div class="value"><?= Yii::t('main','{n} млн чел',array('{n}'=>$region->populate))?></div>
                    </div>
                    <div class="item">
                        <div class="label"><?= Yii::t('main','Федеральный округ')?></div>
                        <div class="value"><?=$region->federal_district?></div>
                    </div>
                    <div class="item">
                        <div class="label"><?= Yii::t('main','Часовой пояс')?></div>
                        <div class="value"><?=$region->times?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="light-gray-gradient line bottom back">
        <div class="main">
            <h2><?= Yii::t('main','Экономические показатели')?></h2>
        </div>
    </div>

    <div class="content main economic">
        <div>
            <div class="item">
                <div class="header"><?= Yii::t('main','Валовый региональный продукт')?></div>
                <div class="text"><?= Yii::t('main','{n} млрд р',array('{n}'=>$region->gross_regional_product))?></div>
                <div class="notice"><?= Yii::t('main','{n} тыс. руб. на душу населения',array('{n}'=>$region->gross_regional_product_personal))?></div>
            </div>
            <div class="item">
                <div class="header"><?= Yii::t('main','Инвестиции в основной капитал')?></div>
                <div class="text"><?= Yii::t('main','{n} млн р',array('{n}'=>$region->investment_capital))?></div>
                <div class="notice"><?= Yii::t('main','{n} руб. на душу населения',array('{n}'=>$region->investment_capital_personal))?> </div>
            </div>
            <div class="item">
                <div class="header"><?= Yii::t('main','Среднемесячная заработная плата')?></div>
                <div class="text"><?= Yii::t('main','{n} р',array('{n}'=>$region->salary))?></div>
                <div class="notice"><?= Yii::t('main','{n} руб. прожиточный минимум',array('{n}'=>$region->cost_of_living))?> </div>
            </div>
        </div>
        <div>
            <div class="item">
                <div class="header"><?= Yii::t('main','Объем прямых иностранных инвестиций')?></div>
                <div class="text"><?= Yii::t('main','${n} млн',array('{n}'=>$region->foreign_investment))?></div>
                <div class="notice"><?= Yii::t('main','${n} на душу населения',array('{n}'=>$region->foreign_investment_person))?> </div>
            </div>
            <div class="item">
                <div class="header"><?= Yii::t('main','Удельный вес прибыльных предприятий')?></div>
                <div class="text"><?=$region->weight_profit?>%</div>
            </div>
            <div class="item">
                <div class="header"><?= Yii::t('main','Уровень зарегистрированной безработицы')?></div>
                <div class="text"><?=$region->unemployment?>%</div>
            </div>
        </div>
    </div>

    <div class="light-gray-gradient line bottom back">
        <div class="main">
            <h2><?= Yii::t('main','Географическое положение и климат')?></h2>
        </div>
    </div>

    <div class="content main geo">
        <div class="category"><?= Yii::t('main','Крупнейшие города')?></div>
        <div class="cities">
            <div class="city-info">
                <div class="map">
                    <?php echo CHtml::image(Makeup::img())?>
                </div>
                <div class="name"><?=$region->city?></div>
                <div class="count"><?= Yii::t('main','{n} тыс. чел.',array('{n}'=>123))?></div>
            </div>
            <div class="params">
                <div class="item">
                    <div class="header"><?= Yii::t('main','Солнечных дней в году')?></div>
                    <i class="icon icon-region-sunday"></i><span class="citizen"><?=$region->day_sunny?></span>
                </div>
                <div class="item">
                    <div class="header"><?= Yii::t('main','Дневная температура января')?></div>
                    <i class="icon icon-region-coldday"></i><span class="citizen"><?=$region->winter_temperatures?></span>
                </div>
                <div class="item">
                    <div class="header"><?= Yii::t('main','Природная зона')?></div>
                    <i class="icon icon-region-nature"></i><span class="citizen"><?=$region->nature_zone?></span>
                </div>
            </div>
            <div class="params">
                <div class="item">
                    <div class="header"><?= Yii::t('main','Среднегодовой уровень осадков')?></div>
                    <i class="icon icon-region-rain"></i><span class="citizen"><?=$region->year_rain?></span>
                </div>
                <div class="item">
                    <div class="header"><?= Yii::t('main','Дневная температура июля')?></div>
                    <i class="icon icon-region-temperature-day"></i><span class="citizen"><?=$region->summer_temperatures?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="light-gray-gradient line bottom back">
        <div class="main">
            <h2><?= Yii::t('main','Крупнейшие виды деятельности')?></h2>
        </div>
    </div>

    <div class="content main chart">
        <?php $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
            'data' => array(
                array('Task', 'Hours per Day'),
                array(Yii::t('main','Оптовая и розничная торговля, ремонт автотранспортных сред...'), 10),
                array(Yii::t('main','Операции с недвижимым имуществом, аренда и предоставление услуг'), 50),
                array(Yii::t('main','Обрабатывающие устройства'), 10),
                array(Yii::t('main','Транспорт и связь'), 8),
                array(Yii::t('main','Производство и распределение электроэнергии, газа и ...'), 2),
                array(Yii::t('main','Другое'), 20)
            ),
            'options' => array(
                'width' => 990,
                'height' => 400,
                'backgroundColor'=>'none',
                'chartArea'=>array(
                    'width'=>'50%',
                    'left'=>40,
                ),
                'legend'=>array(
                    'textStyle'=>array('color'=>"#333333",'fontSize'=>14),
                ),
                'pieSliceTextStyle'=>array(
                    'color'=>'white',
                    'fontSize'=>20
                ),
                'sliceVisibilityThreshold'=>0
            )));?>
    </div>

    <?if(count($news)):?>
        <div class="light-gray-gradient line bottom back">
            <div class="main">
                <h2><?= Yii::t('main','Новости региона')?></h2>
            </div>
        </div>

        <div class="main news-page news-container">
            <?foreach($news as $newsModel):?>
                <div class="news-item opacity-box">
                    <div class="data">
                        <div class="date"><?=Candy::formatDate($newsModel->create_date)?></div>
                        <?=$newsModel->media?Candy::preview(array($newsModel->media, 'scale' => '200x100', 'class' => 'image')):''?>
                        <?=CHtml::link(CHtml::encode($newsModel->name),$this->createUrl('news/detail', array('id' => $newsModel->id)), array('class' => 'name'))?>
                        <div class="announce">
                            <?=CHtml::encode($newsModel->announce)?>
                        </div>
                    </div>
                </div>
            <?endforeach?>
            <?=CHtml::link('Все новости региона', $this->createUrl('news/index', array('region' => $region->region_id)), array('class'=>'btn'))?>
        </div>
    <?endif?>
    </div>
</div>
