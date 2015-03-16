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


<div class="tab industry">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Крупнейшие отрасли промышленности'),'icon'=>'industry'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="ball-list chain">
                <div class="column">
                    <div class="item">
                        <span class="r r-industry-gas"></span>
                        <span class="text">Газовая промышленность</span>
                    </div>
                    <div class="item">
                        <span class="r r-industry-geo"></span>
                        <span class="text">Геология и разведка недр</span>
                    </div>
                    <div class="item">
                        <span class="r r-industry-rock"></span>
                        <span class="text">Горнодобывающая и горноперерабатывающая промышленность</span>
                    </div>
                    <div class="item">
                        <span class="r r-industry-flat"></span>
                        <span class="text">Жилищно-коммунальное хозяйство</span>
                    </div>
                    <div class="item">
                        <span class="r r-industry-health"></span>
                        <span class="text">Здравоохранение, социальное обеспечение</span>
                    </div>
                    <div class="item">
                        <span class="r r-industry-gold"></span>
                        <span class="text">Золотодобывающая промышленность</span>
                    </div>
                    <div class="item">
                        <span class="r r-industry-other"></span>
                        <span class="text">Прочее</span>
                    </div>
                </div>
                <div class="column">
                    <div class="item">
                        <span class="r r-industry-medical"></span>
                        <span class="text">Медицинская промышленность</span>
                    </div>
                    <div class="item">
                        <span class="r r-industry-oil"></span>
                        <span class="text">Нефтедобывающая и нефтеперерабывающая промышленность</span>
                    </div>
                    <div class="item">
                        <span class="r r-industry-sell"></span>
                        <span class="text">Оптовая и розничная торговля, общественное питание</span>
                    </div>
                    <div class="item">
                        <span class="r r-industry-food"></span>
                        <span class="text">Пищевая промышленность</span>
                    </div>
                    <div class="item">
                        <span class="r r-industry-paper"></span>
                        <span class="text">Полиграфическая промышленность</span>
                    </div>
                    <div class="item">
                        <span class="r r-industry-building"></span>
                        <span class="text">Строительство</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>