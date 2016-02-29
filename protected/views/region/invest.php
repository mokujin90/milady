<?php
/**
 *
 * @var RegionController $this
 * @var Field reference $region
 */
?>
<div class="tab invest-climat">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Инвестиционный климат'),'icon'=>'invest-climat'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="row chain">
                <div class="params-block" style="width: 49%;">
                    <?if(!empty($region->invest_rating)):?>
                    <div class="item">
                        <span class="logo r r-block-invest-climat-level"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','Инвестиционный рейтинг')?></div>
                            <div class="value"><?=$region->drawField('invest_rating',$proofs)?></div>
                        </div>
                    </div>
                    <?endif?>
                    <?if(!empty($region->invest_risk_position)):?>
                    <div class="item">
                        <span class="logo r r-block-invest-climat-risk"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','По инвестиционному риску')?></div>
                            <div class="value"><?=$region->drawField('invest_risk_position',$proofs,array('after'=>' место в России'))?></div>
                        </div>
                    </div>
                    <?endif?>
                    <?if(!empty($region->invest_potential_position)):?>
                    <div class="item">
                        <span class="logo r r-block-invest-climat-potential"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','По инвестиционному потенциалу')?></div>
                            <div class="value"><?=$region->drawField('invest_potential_position',$proofs,array('after'=>' место в России'))?></div>
                        </div>
                    </div>
                    <?endif?>
                    <?if(!empty($region->invest_position_source)):?>
                    <div class="notice-bottom">
                        <?=CHtml::encode($region->invest_position_source)?>
                    </div>
                    <?endif?>
                </div>
                <div class="graphic-block" style="width: 49%;">
                    <div class="item">
                        <div class="caption" style="height: 30px;"><?= Yii::t('main','Инвестиции в основной капитал, в млн руб.')?></div>
                        <?
                        $data = empty($region->invest_capital_chart) ? null : unserialize($region->invest_capital_chart);
                        $this->widget('application.widgets.columnCharts.ColumnChartDual',
                            array(
                                'meta' => empty($data) ? array() : $data['meta'],
                                'data' => empty($data) ? array() : $data['data'],
                                'height' => 300
                            )
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?if(count($region->region->banks)):?>
    <div class="tab bank">
        <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Банковская сфера'),'icon'=>'bank'))?>
        <div class="data toggled-block">
            <div class="main trans-block detail">
                <div class="graphic-block dual chain">
                    <div class="item">
                        <div class="logo-list">
                            <div class="caption"><?= Yii::t('main','Крупнейшие банки')?></div>
                            <? $count = 0;
                            foreach($region->region->banks as $item):?>
                                <?$item = $item->company;?>
                                <?if(!(++$count%2)) continue;?>
                                <?$url = Makeup::makeLinkTextUrl($item->url);?>
                                <div class="row chain">
                                    <div class="logo">
                                        <?if ($item->media):?>
                                            <?= Candy::preview(array($item->media, 'scaleMode' => 'in', 'scale' => '100x100', 'noGif' => true)) ?>
                                        <?endif?>
                                    </div>
                                    <div class="info">
                                        <div class="text"><?=CHtml::encode($item->name)?></div>
                                        <?= empty($item->url) ? '' : CHtml::link($url[0],$url[1], array('class' => 'link'))?>
                                    </div>
                                </div>
                            <?endforeach?>
                        </div>
                    </div>
                    <div class="item two">
                        <div class="logo-list">
                            <? $count = 0;
                            foreach($region->region->banks as $item):?>
                                <?$item = $item->company;?>
                                <?if(++$count%2) continue;?>
                                <?$url = Makeup::makeLinkTextUrl($item->url);?>
                                <div class="row chain">
                                    <div class="logo">
                                        <?if ($item->media):?>
                                            <?= Candy::preview(array($item->media, 'scaleMode' => 'in', 'scale' => '100x100', 'noGif' => true)) ?>
                                        <?endif?>
                                    </div>
                                    <div class="info">
                                        <div class="text"><?=CHtml::encode($item->name)?></div>
                                        <?= empty($item->url) ? '' : CHtml::link($url[0],$url[1], array('class' => 'link'))?>
                                    </div>
                                </div>
                            <?endforeach?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?endif;?>


<?if(count($region->region->businessBanks) || count($region->region->orgs)):?>
<div class="tab bissunes">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Структура поддержки и обслуживания бизнеса'),'icon'=>'bissunes'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <?if(count($region->region->businessBanks)):?>
            <div class="graphic-block dual chain">
                <div class="item">
                    <div class="logo-list">
                        <div class="caption"><?= Yii::t('main','Бизнес-ассоциации и некоммерческие партнерства')?></div>
                        <? $count = 0;
                        foreach($region->region->businessBanks as $item):?>
                            <?$item = $item->company;?>
                            <?if(!(++$count%2)) continue;?>
                            <?$url = Makeup::makeLinkTextUrl($item->url);?>
                            <div class="row chain">
                                <div class="logo">
                                    <?if ($item->media):?>
                                        <?= Candy::preview(array($item->media, 'scaleMode' => 'in', 'scale' => '100x100', 'noGif' => true)) ?>
                                    <?endif?>
                                </div>
                                <div class="info">
                                    <div class="text"><?=CHtml::encode($item->name)?></div>
                                    <?= empty($item->url) ? '' : CHtml::link($url[0],$url[1], array('class' => 'link'))?>
                                </div>
                            </div>
                        <?endforeach?>
                    </div>
                </div>
                <div class="item two">
                    <div class="logo-list">
                        <? $count = 0;
                        foreach($region->region->businessBanks as $item):?>
                            <?$item = $item->company;?>
                            <?if(++$count%2) continue;?>
                            <?$url = Makeup::makeLinkTextUrl($item->url);?>
                            <div class="row chain">
                                <div class="logo">
                                    <?if ($item->media):?>
                                        <?= Candy::preview(array($item->media, 'scaleMode' => 'in', 'scale' => '100x100', 'noGif' => true)) ?>
                                    <?endif?>
                                </div>
                                <div class="info">
                                    <div class="text"><?=CHtml::encode($item->name)?></div>
                                    <?= empty($item->url) ? '' : CHtml::link($url[0],$url[1], array('class' => 'link'))?>
                                </div>
                            </div>
                        <?endforeach?>
                    </div>
                </div>
            </div>
            <?endif?>
            <?if(count($region->region->orgs)):?>
            <div class="logo-list gov-invest">
                <div class="caption no-bottom">Организации, координирующие инвестиционную деятельность</div>
                <div class="chain">
                    <?foreach($region->region->orgs as $item):?>
                        <?$item = $item->company;?>
                        <?$url = Makeup::makeLinkTextUrl($item->url);?>
                        <div class="row chain">
                            <div class="logo">
                                <?if ($item->media):?>
                                    <?= Candy::preview(array($item->media, 'scaleMode' => 'in', 'scale' => '100x100', 'noGif' => true)) ?>
                                <?endif?>
                            </div>
                            <div class="info">
                                <div class="text"><?=CHtml::encode($item->name)?></div>
                                <?= empty($item->url) ? '' : CHtml::link($url[0],$url[1], array('class' => 'link'))?>
                            </div>
                        </div>
                    <?endforeach?>
                </div>
            </div>
            <?endif?>
        </div>
    </div>
</div>
<?endif?>
<?if(count($region->region->region2Files)):?>
<div class="tab investment-politics">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Направление региональной инвестиционной политики'),'icon'=>'investment-politics'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <?=$region->invest_politics_text?>
            <div class="document-list">
                <?foreach($region->region->region2Files as $file):?>
                    <div class="item">
                        <span class="r r-file-pdf"></span>
                        <?= CHtml::link(empty($file->title) ? $file->name : $file->title,$file->media->makeWebPath(),array('class'=>'link'));?>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</div>
<?endif?>
