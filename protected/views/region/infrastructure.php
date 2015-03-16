<?php
/**
 *
 * @var RegionController $this
 * @var #M#M#C\RegionContent.model.findByAttributes|? $region
 * @var array $attr
 * @var String $bread
 */
?>
<div class="tab transport">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Транспорт'),'icon'=>'transport'))?>
    <div class="data toggled-block">
        <div class="main chain trans-block detail">
            <div class="column">
                <div class="magistral-list list">
                    <div class="caption"><?= Yii::t('main','Основные транспортные магистрали')?></div>
                    <div class="item chain">
                        <span class="r r-block-transport-auto"></span>
                        <span class="value">43 217</span>
                        <span class="text"><?= Yii::t('main','Километров общая сеть автомобильных дорог')?></span>
                    </div>
                    <div class="item chain">
                        <span class="r r-block-transport-train"></span>
                        <span class="value">3 158</span>
                        <span class="text"><?= Yii::t('main','Эксплуатационная длина железной дороги')?></span>
                    </div>
                    <div class="item chain">
                        <span class="r r-block-transport-boat"></span>
                        <span class="value">7 665</span>
                        <span class="text"><?= Yii::t('main','Километров протяженность внутренних водных путей')?></span>
                    </div>
                </div>
                <div class="list">
                    <div class="caption"><?= Yii::t('main','Порты')?></div>
                    <div class="item">Красноярский речной порт</div>
                    <div class="item">Ачинский речной порт</div>
                    <div class="item">Дудинский морской порт</div>
                </div>
            </div>
            <div class="column">
                <div class="list">
                    <div class="caption"><?= Yii::t('main','Железнодорожные вокзалы')?></div>
                    <div class="item">Железнодорожный вокзал Красноярск</div>
                    <div class="item">Железнодородный вокзал Бугач</div>
                    <div class="item">Железнодорожный вокзал АЧИНСК-1</div>
                </div>
                <div class="list">
                    <div class="caption"><?= Yii::t('main','Аэропорты')?></div>
                    <div class="item">
                        Аэропорт Емельяново (г. Красноярск)
                        <?= CHtml::link("http://www.yemelyanovo.ru","http://www.yemelyanovo.ru")?>
                    </div>
                    <div class="item">
                        Аэропорт Норильск
                        <?= CHtml::link("http://www.airport-norilsk.ru","http://www.yemelyanovo.ru")?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="tab health">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Здравоохранение'),'icon'=>'health'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="graphic-block dual chain">
                <div class="item">
                    <div class="caption chart-caption"><?= Yii::t('main','Количество больничных учреждений')?></div>
                    <?
                    $data = empty($this->region->content->hospital_count_chart) ? null : unserialize($this->region->content->hospital_count_chart);
                    $this->widget('application.widgets.columnCharts.ColumnChartSingle',
                        array(
                            'meta' => array('column1'),
                            'data' => empty($data) ? array() : $data['data']
                        )
                    ); ?>
                </div>
                <div class="item">
                    <div class="caption chart-caption"><?= Yii::t('main','Количество амбулаторно-поликлинических учреждений')?></div>
                    <?
                    $data = empty($this->region->content->hospital2_count_chart) ? null : unserialize($this->region->content->hospital2_count_chart);
                    $this->widget('application.widgets.columnCharts.ColumnChartSingle',
                        array(
                            'color' => ColumnChartSingle::CSS_GREEN,
                            'meta' => array('column1'),
                            'data' => empty($data) ? array() : $data['data']
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab education">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Образование'),'icon'=>'education'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="graphic-block dual chain">
                <div class="item">
                    <div class="caption chart-caption"><?= Yii::t('main','Количество общеобразовательных учреждений')?></div>
                    <?
                    $data = empty($this->region->content->school_count_chart) ? null : unserialize($this->region->content->school_count_chart);
                    $this->widget('application.widgets.columnCharts.ColumnChartSingle',
                        array(
                            'labelType' => ColumnChartSingle::LABEL_CIRCLE,
                            'maxColumnCount' => 5,
                            'cssGroupMargin' => 15,
                            'meta' => array('column1'),
                            'data' => empty($data) ? array() : $data['data']
                        )
                    ); ?>
                </div>
                <div class="item">
                    <div class="caption chart-caption"><?= Yii::t('main','Количество учреждений высшего и среднеспециального образования')?></div>
                    <?
                    $data = empty($this->region->content->university_count_chart) ? null : unserialize($this->region->content->university_count_chart);
                    $this->widget('application.widgets.columnCharts.ColumnChartGroup',
                        array(
                            'meta' => empty($data) ? array() : $data['meta'],
                            'data' => empty($data) ? array() : $data['data'],
                            'cssGroupMargin' => 8,
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab education">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Культурно-спортивный комплекс'),'icon'=>'sport'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="graphic-block dual chain">
                <div class="item">
                    <div class="caption chart-caption"><?= Yii::t('main','Количество спортивных сооружений')?></div>
                    <?
                    $data = empty($this->region->content->sport_count_chart) ? null : unserialize($this->region->content->sport_count_chart);
                    $this->widget('application.widgets.columnCharts.ColumnChartGroup',
                        array(
                            'meta' => empty($data) ? array() : $data['meta'],
                            'data' => empty($data) ? array() : $data['data'],
                            'cssGroupMargin' => 8,
                        )
                    ); ?>
                </div>
                <div class="item">
                    <div class="caption chart-caption"><?= Yii::t('main','Количество инфраструктурных объектов в сфере культуры')?></div>
                    <?
                    $data = empty($this->region->content->cult_count_chart) ? null : unserialize($this->region->content->cult_count_chart);
                    $this->widget('application.widgets.columnCharts.ColumnChartGroup',
                        array(
                            'meta' => empty($data) ? array() : $data['meta'],
                            'data' => empty($data) ? array() : $data['data'],
                            'cssGroupMargin' => 8,
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</div>