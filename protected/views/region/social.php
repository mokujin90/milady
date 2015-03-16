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
                'region' => $region->region
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
                    <div class="header red"><?= Yii::t('main','Контактная информация')?></div>
                    <div class="fieldlist">
                        <div class="item">
                            <div class="label"><?= Yii::t('main','Адрес')?></div>
                            <div class="value">г. Красноярск ул. Название, д Х</div>
                        </div>
                        <div class="item">
                            <div class="label"><?= Yii::t('main','Телефон')?></div>
                            <div class="value"><span>хх (0хх) ххх-хх-хх</span><br/> <span>хх (0хх) ххх-хх-хх</span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?= Yii::t('main','Сайт')?></div>
                            <div class="value"><a href="#">www.сайт.рф</a></div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <div class="value"><span class="r r-rub"></span><?=number_format($region->gross_regional_product, 1, ',', ' ')?> млрд</div>
                            <div class="notice"><?= Yii::t('main','{n} на душу населения',array('{n}'=> number_format($region->gross_regional_product_personal, 0, ',', ' ') ." тыс. руб "))?></div>
                        </div>
                    </div>
                    <div class="item">
                        <span class="logo r r-block-econom-invest-ino"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','Объем пряых иностранных инвестиций')?></div>
                            <div class="value"><span class="r r-dollar"></span><?=number_format($region->foreign_investment, 1, ',', ' ')?></div>
                            <div class="notice"><?= Yii::t('main','{n} на душу населения',array('{n}'=>"$ " . number_format($region->foreign_investment_person, 1, ',', ' ')))?></div>
                        </div>
                    </div>
                </div>
               <div class="chain double">
                   <div class="item">
                       <span class="logo r r-block-econom-invest"></span>
                       <div class="detail">
                           <div class="key"><?= Yii::t('main','Инвестиции в основной капитал')?></div>
                           <div class="value"><span class="r r-rub"></span><?=number_format($region->investment_capital, 0, ',', ' ')?> млн</div>
                           <div class="notice"><?= Yii::t('main','{n} на душу населения',array('{n}'=>number_format($region->investment_capital_personal, 0, ',', ' ') . " руб "))?></div>
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
                            <div class="value"><span class="r r-rub"></span><?=number_format($region->salary, 1, ',', ' ')?></div>
                            <div class="notice"><?= Yii::t('main','{n} прожиточный минимум',array('{n}'=>"8478 руб "))?></div>
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
                <div class="proof-block">Данные представлены за 2015 год </div>
            </div>
        </div>
    </div>
</div>


<div class="tab city">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Крупнейшие города'),'icon'=>'city'))?>
    <div class="data toggled-block">
        <div class="main chain trans-block detail">

        </div>
    </div>
</div>

<div class="tab big-industry">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Крупнейшие предприятия'),'icon'=>'big-industry'))?>
    <div class="data toggled-block">
        <div class="main chain trans-block detail">
            <div class="image-list chain">
                <?foreach($region->region->companies as $item):?>
                    <?$url = Makeup::makeLinkTextUrl($item->url);?>
                    <div class="item">
                        <?if($item->media):?>
                            <?=Candy::preview(array($item->media, 'scaleMode' => 'in', 'scale' => '100x100', 'class'=>'logo'))?>
                        <?endif?>
                            <div class="name"><?=CHtml::encode($item->name)?></div>
                            <?= empty($item->url) ? '' : CHtml::link($url[0],$url[1],array('target'=>'_blank'))?>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </div>
</div>

<div class="tab climat">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Климат'),'icon'=>'climat'))?>
    <div class="data toggled-block">
        <div class="main chain trans-block detail">
           <div class="double chain">
               <div class="item">
                   <div class="text"><?= Yii::t('main','Солнечных дней в году')?></div>
                   <div>
                       <span class="r r-block-climat-sunday"></span>
                       <span class="value">28</span>
                   </div>
               </div>
               <div class="item">
                   <div class="text"><?= Yii::t('main','Среднегодовой уровень осадков')?></div>
                   <div>
                       <span class="r r-block-climat-rain"></span>
                       <span class="value">465 мм</span>
                   </div>
               </div>
           </div>
            <div class="double chain">
               <div class="item">
                   <div class="text"><?= Yii::t('main','Дневная температура января')?></div>
                   <div>
                       <span class="r r-block-climat-winnter-t"></span>
                       <span class="value">-18°С</span>
                   </div>
               </div>
               <div class="item">
                   <div class="text"><?= Yii::t('main','Дневная температура июля')?></div>
                   <div>
                       <span class="r r-block-climat-summer-t"></span>
                       <span class="value">20°С</span>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>

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

<div class="tab news">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Новости'),'icon'=>'news'))?>
    <div class="data toggled-block">
        <div class="main chain trans-block detail news-list">
            <?for($i=0;$i<=2;$i++):?>
                <div class="item">
                    <div class="date gray">11/07</div>
                    <a class="caption" href="#">Лол</a>
                    <div class="notice">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus asperiores, aspernatur at, corporis culpa et eum illo laudantium maiores, molestiae mollitia nostrum numquam obcaecati similique soluta temporibus totam voluptatem voluptates!</div>
                </div>
            <?endfor;?>
            <div class="button-panel">
                <?php echo CHtml::link(Yii::t('main','Все новости'),$this->createUrl('news/index', array('region' => $region->region_id)), array('class'=>'btn','style'=>'background: #508bcc;'))?>
            </div>
        </div>
    </div>
</div>

    <?if(false):?>
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
                        <?=CHtml::link(CHtml::encode($newsModel->name),$newsModel->createUrl(), array('class' => 'name'))?>
                        <div class="announce">
                            <?=CHtml::encode($newsModel->announce)?>
                        </div>
                    </div>
                </div>
            <?endforeach?>
            <?=CHtml::link('Все новости региона', $this->createUrl('news/index', array('region' => $region->region_id)), array('class'=>'btn'))?>
        </div>
    <?endif?>

