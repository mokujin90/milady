<?php
/**
 *
 * @var RegionController $this
 * @var Field reference $region
 */
?>
<?Yii::import("application.widgets.columnCharts.*");?>
<div class="tab inovative-action">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Инновационная активность региона'),'icon'=>'inovative-action'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="row chain">
                <div class="params-block" style="  width: 49%;">
                    <div class="item">
                        <span class="logo r r-block-inovative-action-level"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','По инновационной активности')?></div>
                            <div class="value"><?=$region->inno_active_position?> место в России</div>
                        </div>
                    </div>
                    <div class="item">
                        <span class="logo r r-block-inovative-action-level2"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','По инновационному развитию')?></div>
                            <div class="value"><?=$region->inno_progress_position?> место в России</div>
                        </div>
                    </div>
                </div>
                <div class="graphic-block">
                    <div class="item">
                        <div class="caption chart-caption"><?= Yii::t('main','Удельный вес инновационных товаров, работ, услуг в общем объеме отгруженных товаров, выполненных работ, услуг малых предприятий, в %')?></div>
                        <?
                        $data = empty($region->inno1_chart) ? null : unserialize($region->inno1_chart);
                        $this->widget('application.widgets.columnCharts.ColumnChartSingle',
                            array(
                                'labelType' => ColumnChartSingle::LABEL_CIRCLE,
                                'maxColumnCount' => 5,
                                'cssGroupMargin' => 15,
                                'afterSign' => '%',
                                'meta' => array('column1'),
                                'data' => empty($data) ? array() : $data['data']
                            )
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="row chain">
                <div class="graphic-block">
                    <div class="item">
                        <div class="caption chart-caption"><?= Yii::t('main','Инновационная активность организации (удельный вес организации, осуществляющих технологические, организационные, маркетинговые инновации), в %')?></div>
                        <?
                        $data = empty($region->inno2_chart) ? null : unserialize($region->inno2_chart);
                        $this->widget('application.widgets.columnCharts.ColumnChartSingle',
                            array(
                                'labelType' => ColumnChartSingle::LABEL_CIRCLE,
                                'maxColumnCount' => 5,
                                'cssGroupMargin' => 15,
                                'afterSign' => '%',
                                'meta' => array('column1'),
                                'data' => empty($data) ? array() : $data['data']
                            )
                        ); ?>
                    </div>
                </div>
                <div class="graphic-block">
                    <div class="item">
                        <div class="caption chart-caption"><?= Yii::t('main','Затраты организации на технологические инновации, в млн.руб')?></div>
                        <?
                        $data = empty($region->inno3_chart) ? null : unserialize($region->inno3_chart);
                        $this->widget('application.widgets.columnCharts.ColumnChartSingle',
                            array(
                                'labelType' => ColumnChartSingle::LABEL_RECT_CENTER,
                                'color' => ColumnChartSingle::CSS_GREEN,
                                'maxColumnCount' => 5,
                                'cssGroupMargin' => 15,
                                'meta' => array('column1'),
                                'data' => empty($data) ? array() : $data['data']
                            )
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab inovative-infrastruct">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Инновационная инфраструктура региона'),'icon'=>'inovative-infrastruct'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="graphic-block dual chain">
                <div class="item">

                    <div class="ball-item">
                        <span class="ball"><?=$region->active_development_institute_count?></span>
                        <span class="text"><?= Yii::t('main','Действующих института развития')?></span>
                    </div>

                    <div class="logo-list">
                        <div class="caption"><?= Yii::t('main','Существующая инфрастуктура')?></div>
                        <?foreach($region->region->developmentInstitutes as $item):?>
                            <?$url = Makeup::makeLinkTextUrl($item->url);?>
                            <div class="row chain">
                                <div class="logo">
                                    <?if ($item->media):?>
                                        <?= Candy::preview(array($item->media, 'scaleMode' => 'in', 'scale' => '100x100')) ?>
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
                <div class="item">
                    <div class="ball-item">
                        <span class="ball"><?=$region->planned_development_institute_count?></span>
                        <span class="text"><?= Yii::t('main','Планируемых института развития')?></span>
                    </div>
                    <div class="logo-list">
                        <div class="caption"><?= Yii::t('main','Строящаяся и планируемая инфраструктура')?></div>
                        <?foreach($region->region->planingInfrastructs as $item):?>
                            <?$url = Makeup::makeLinkTextUrl($item->url);?>
                            <div class="row chain">
                                <div class="logo">
                                    <?if ($item->media):?>
                                        <?= Candy::preview(array($item->media, 'scaleMode' => 'in', 'scale' => '100x100')) ?>
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

<div class="tab scien">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Научно-образовательный потенцил региона'),'icon'=>'scien'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="graphic-block dual chain">
                <div class="item">
                    <?foreach($region->region->universities as $item):?>
                        <div class="ball-item">
                            <span class="ball"><?=CHtml::encode($item->count)?></span>
                            <span class="text"><?=CHtml::encode($item->name)?></span>
                        </div>
                    <?endforeach?>
                </div>
                <div class="item">
                    <div class="logo-list">
                        <div class="caption"><?= Yii::t('main','Крупнейшие ВУЗы края')?></div>
                        <?foreach($region->region->greatSchools as $item):?>
                            <?$url = Makeup::makeLinkTextUrl($item->url);?>
                            <div class="row chain">
                                <div class="logo">
                                    <?if ($item->media):?>
                                        <?= Candy::preview(array($item->media, 'scaleMode' => 'in', 'scale' => '100x100')) ?>
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