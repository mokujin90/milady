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
                    <div class="item">
                        <span class="logo r r-block-invest-climat-level"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','Инвестиционный рейтинг')?>*</div>
                            <div class="value">группа 2B</div>
                        </div>
                    </div>
                    <div class="item">
                        <span class="logo r r-block-invest-climat-risk"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','По инвестиционному риску')?>**</div>
                            <div class="value">46 место в России</div>
                        </div>
                    </div>
                    <div class="item">
                        <span class="logo r r-block-invest-climat-potential"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','По инвестиционному потенциалу')?>***</div>
                            <div class="value">7 место в России</div>
                        </div>
                    </div>
                    <div class="notice-bottom">
                        *Источник "Эксперт РА" www.raexpert.ru
                    </div>
                </div>
                <div class="graphic-block" style="width: 49%;">
                    <div class="item">
                        <div class="caption"><?= Yii::t('main','Инвестиции в основной капитал, в млн. руб.')?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab bank">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Банковская сфера'),'icon'=>'bank'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="graphic-block dual chain">
                <div class="item">
                    <div class="logo-list">
                        <div class="caption"><?= Yii::t('main','Крупнейшие банки красноярского края')?></div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-1.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">Сбербак России</div>
                                <a href="#" class="link">http://www.kribi.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-2.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">ВТБ 24</div>
                                <a href="#" class="link">http://www.agpb24.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-1.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">Альфа-Банк</div>
                                <a href="#" class="link">http://www.sk-kras.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-2.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">ОАО Газпромбанк</div>
                                <a href="#" class="link">http://www.sk-kras.ru</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item two">
                    <div class="logo-list">
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-1.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">Альфа-Банк</div>
                                <a href="#" class="link">http://www.sk-kras.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-2.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">ОАО Газпромбанк</div>
                                <a href="#" class="link">http://www.sk-kras.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-2.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">ОАО Газпромбанк</div>
                                <a href="#" class="link">http://www.sk-kras.ru</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="tab bissunes">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Структура поддержки и обслуживания бизнеса'),'icon'=>'bissunes'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <div class="graphic-block dual chain">
                <div class="item">
                    <div class="logo-list">
                        <div class="caption"><?= Yii::t('main','Крупнейшие банки красноярского края')?></div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-1.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">Сбербак России</div>
                                <a href="#" class="link">http://www.kribi.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-2.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">ВТБ 24</div>
                                <a href="#" class="link">http://www.agpb24.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-1.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">Альфа-Банк</div>
                                <a href="#" class="link">http://www.sk-kras.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-2.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">ОАО Газпромбанк</div>
                                <a href="#" class="link">http://www.sk-kras.ru</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item two">
                    <div class="logo-list">
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-1.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">Альфа-Банк</div>
                                <a href="#" class="link">http://www.sk-kras.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-2.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">ОАО Газпромбанк</div>
                                <a href="#" class="link">http://www.sk-kras.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-2.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">ОАО Газпромбанк</div>
                                <a href="#" class="link">http://www.sk-kras.ru</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo-list gov-invest">
                <div class="caption no-bottom">Организации, координирующие инвестиционную деятельность</div>
                <div class="chain">
                    <div class="row chain">
                        <div class="logo" >
                            <?=CHtml::image('/images/assets/slider-2.png','',array('class'=>'region-logo'))?>
                        </div>
                        <div class="info">
                            <div class="text">Министерство инвестиций и инноваций Красноярского края</div>
                            <a href="#" class="link">http://www.sk-kraкываыв3242аыаываываs.ru</a>
                        </div>
                    </div>
                    <div class="row chain">
                        <div class="logo">
                            <?=CHtml::image('/images/assets/slider-1.png','',array('class'=>'region-logo'))?>
                        </div>
                        <div class="info">
                            <div class="text">Министерство инвестиций и инноваций Красноярского края</div>
                            <a href="#" class="link">http://www.sk-kraкываыв3242аыаываываs.ru</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab investment-politics">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Направления региональная инвестиционной политики'),'icon'=>'investment-politics'))?>
    <div class="data toggled-block">
        <div class="main trans-block detail">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores commodi consequuntur facere illum
                incidunt laborum nihil nisi optio perferendis porro quasi ratione reprehenderit tempora tempore tenetur,
                totam vel veniam vero.
            </p>
            <p>A asperiores consectetur consequuntur eaque enim molestias nostrum officiis placeat quae reiciendis!
                Aliquam eligendi nobis, officiis pariatur quia veniam! Aliquid cupiditate delectus ea earum, laborum
                maiores quas. Dicta, eveniet, labore.
            </p>
            <div class="document-list">
                <?for($i=0;$i<=12;$i++):?>
                    <div class="item">
                        <span class="r r-file-pdf"></span>
                        <?= CHtml::link('Федеральный закон РФ от 04.01.1999 г. № 4-ФЗ "О координации международных и внешнеэкономических связей субъектов Российской Федерации"','#',array('class'=>'link'));?>
                    </div>
                <?endfor;?>
            </div>
        </div>
    </div>
</div>
