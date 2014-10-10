<?php
/**
 *
 * @var SiteController $this
 */
?>
<div class="region-page">
    <div id="general">

        <div class="main">
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>array('Ссылка 1'=>'#','Ссылка 2'),
                'htmlOptions' => array('class'=>'breadcrumb'),
                'homeLink'=>CHtml::link('Главная','/',array('class'=>'normal')),
                'separator'=>''
            )); ?>
        </div>
        <div class="content main info chain-block">

            <div>
                <div class="header">
                    <?php echo CHtml::image('/images/assets/news-middle-1.png')?>
                    <div class="caption">Москва</div>
                </div>
                <div class="text">
                    Инвестиционная инфраструктура региона соответствует требованиям Регионального инвестиционного стандарта
                </div>
            </div>
            <div>
                <div class="header">
                    <?php echo CHtml::image('/images/assets/news-middle-2.png')?>
                    <div class="notice">Руководство региона<br/>Мер</div>
                    <div class="caption">СОБЯНИН<br/> Сергей Семенович</div>
                </div>
                <div class="text">
                    Сегодня город реализует одну из самых крупных в мире программ развития транспортной системы — строительство 160 км метрополитена, 240 км железнодорожных путей и 400 км новых автомобильных дорог. Расширяем сферы привлечения частного капитала в экономику города, реализуем проекты на принципах
                </div>
            </div>
            <div class="investment">
                <div class="header">
                    <div class="notice">Поддержка инвестора</div>
                    <div class="caption">Городское агенство управления инвестициями</div>
                    <?php echo CHtml::link('http://www.mosinvest.mos.ru','http://www.mosinvest.mos.ru')?>
                </div>
                <div class="text">
                    В последние годы Правительство Москвы выстраивает принципиально новые отношения с инвесторами. Мы серьезно реформировали и упростили систему доступа бизнеса к работе в городе. Определили приоритеты развития Москвы и градостроительные потенциал ее территории.
                </div>
            </div>
        </div>

        <div class="dark-gray-gradient line top bottom">
            <div class="main">
                <div class="linked">
                    <?php echo CHtml::link(Yii::t('main','Социально-экономическая информация'),'#',array())?><span class="sep">/</span>
                    <?php echo CHtml::link(Yii::t('main','Региональная аналитика'),'#',array())?><span class="sep">/</span>
                    <?php echo CHtml::link(Yii::t('main','Инфраструктурный паспорт'),'#',array())?><span class="sep">/</span>
                    <?php echo CHtml::link(Yii::t('main','Иновационный паспорт'),'#',array())?><span class="sep">/</span>
                    <?php echo CHtml::link(Yii::t('main','Региональное законодательство'),'#',array())?><span class="sep">/</span>
                    <?php echo CHtml::link(Yii::t('main','Инвестиционный паспорт'),'#',array())?>
                </div>
            </div>
        </div>
        <div class="map-widget rel">
            <?php $this->widget('YaMapWidget', array(
                'width'=>'100%',
                'height'=>355,
                'options'=>array(
                    'mapId'=>'map-block',
                    'mapState'=>array(
                        'center'=>"Белград",
                        'zoom'=>7,
                        'behaviors'=>array('default', 'drag'),
                    ),
                ),

            )); ?>
            <div class="abs main">
                <div class="transparent">
                    <div class="header red"><?= Yii::t('main','Общие сведения о регионе')?></div>
                    <div class="fieldlist">
                        <div class="item">
                            <div class="label"><?= Yii::t('main','Административный центр')?></div>
                            <div class="value">Москва</div>
                        </div>
                        <div class="item">
                            <div class="label"><?= Yii::t('main','Площадь региона')?></div>
                            <div class="value"><?= Yii::t('main','{n} тыс. км',array('{n}'=>2,6))?><sup>2</sup></div>
                        </div>
                        <div class="item">
                            <div class="label"><?= Yii::t('main','Население региона')?></div>
                            <div class="value"><?= Yii::t('main','{n} млн чел',array('{n}'=>12,11))?></div>
                        </div>
                        <div class="item">
                            <div class="label"><?= Yii::t('main','Федеральный округ')?></div>
                            <div class="value">Центральный</div>
                        </div>
                        <div class="item">
                            <div class="label"><?= Yii::t('main','Часовой пояс')?></div>
                            <div class="value">UTC+4/MSK</div>
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
                    <div class="text"><?= Yii::t('main','{n} млрд р',array('{n}'=>10577,8))?></div>
                    <div class="notice"><?= Yii::t('main','{n} тыс. руб. на душу населения',array('{n}'=>887,55))?></div>
                </div>
                <div class="item">
                    <div class="header"><?= Yii::t('main','Инвестиции в основной капитал')?></div>
                    <div class="text"><?= Yii::t('main','{n} млн р',array('{n}'=>1412086))?></div>
                    <div class="notice"><?= Yii::t('main','{n} руб. на душу населения',array('{n}'=>117245))?> </div>
                </div>
                <div class="item">
                    <div class="header"><?= Yii::t('main','Среднемесячная заработная плата')?></div>
                    <div class="text"><?= Yii::t('main','{n} р',array('{n}'=>56262))?></div>
                    <div class="notice"><?= Yii::t('main','{n} руб. прожиточный минимум',array('{n}'=>10965))?> </div>
                </div>
            </div>
            <div>
                <div class="item">
                    <div class="header"><?= Yii::t('main','Объем прямых иностранных инвестиций')?></div>
                    <div class="text"><?= Yii::t('main','${n} млн',array('{n}'=>108422))?></div>
                    <div class="notice"><?= Yii::t('main','${n} на душу населения',array('{n}'=>8954,41))?> </div>
                </div>
                <div class="item">
                    <div class="header"><?= Yii::t('main','Удельный вес прибыльных предприятий')?></div>
                    <div class="text">70,2%</div>
                </div>
                <div class="item">
                    <div class="header"><?= Yii::t('main','Уровень зарегистрированной безработицы')?></div>
                    <div class="text">1,7%</div>
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
                    <div class="name">Москва</div>
                    <div class="count"><?= Yii::t('main','{n} тыс. чел.',array('{n}'=>12111))?></div>
                </div>
                <div class="params">
                    <div class="item">
                        <div class="header"><?= Yii::t('main','Солнечных дней в году')?></div>
                        <i class="icon icon-region-sunday"></i><span class="citizen">82</span>
                    </div>
                    <div class="item">
                        <div class="header"><?= Yii::t('main','Дневная температура января')?></div>
                        <i class="icon icon-region-coldday"></i><span class="citizen">82</span>
                    </div>
                    <div class="item">
                        <div class="header"><?= Yii::t('main','Природная зона')?></div>
                        <i class="icon icon-region-nature"></i><span class="citizen">82</span>
                    </div>
                </div>
                <div class="params">
                    <div class="item">
                        <div class="header"><?= Yii::t('main','Среднегодовой уровень осадков')?></div>
                        <i class="icon icon-region-rain"></i><span class="citizen">82</span>
                    </div>
                    <div class="item">
                        <div class="header"><?= Yii::t('main','Дневная температура июля')?></div>
                        <i class="icon icon-region-temperature-day"></i><span class="citizen">82</span>
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
    </div>
</div>
