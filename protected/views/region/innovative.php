<?php
/**
 *
 * @var RegionController $this
 * @var Field reference $region
 */
?>
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
                            <div class="value">23 место в России</div>
                        </div>
                    </div>
                    <div class="item">
                        <span class="logo r r-block-inovative-action-level2"></span>
                        <div class="detail">
                            <div class="key"><?= Yii::t('main','По инновационному развитию')?></div>
                            <div class="value">14 место в России</div>
                        </div>
                    </div>
                </div>
                <div class="graphic-block">
                    <div class="item">
                        <div class="caption"><?= Yii::t('main','Удельный вес инновационных товаров, работ, услуг в общем объеме отгруженных товаров, выполненных работ, услуг малых предприятий в {n}, в %',array('{n}'=>'Красноярском крае'))?></div>
                    </div>
                </div>
            </div>
            <div class="row chain">
                <div class="graphic-block">
                    <div class="item">
                        <div class="caption"><?= Yii::t('main','Инновационная активность организации (удельный вес организации, осуществляющих технологические, организационные, маркетинговые инновации) в {n}, в %',array('{n}'=>'Красноярском крае'))?></div>
                    </div>
                </div>
                <div class="graphic-block">
                    <div class="item">
                        <div class="caption"><?= Yii::t('main','Затраты организации на технологические инновации в {n}, в млн.руб',array('{n}'=>'Красноярском крае'))?></div>
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
                        <span class="ball">4</span>
                        <span class="text"><?= Yii::t('main','Действующих института развития')?></span>
                    </div>

                    <div class="logo-list">
                        <div class="caption"><?= Yii::t('main','Существующая инфрастуктура')?></div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-1.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">КГАУ "Красноярский региональный инновационно-технологический бизнес-инкубатор"</div>
                                <a href="#" class="link">http://www.kribi.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-2.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">ОАО "Красноярское региональное агенство поддержки малого и среднего бизнеса"</div>
                                <a href="#" class="link">http://www.agpb24.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-1.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">КГАУ "Красноярский краевой фонд поддержки начной и научно-технической деятельности"</div>
                                <a href="#" class="link">http://www.sk-kras.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="info">
                                <div class="text">ОАО "Агенство развития инновационной деятельности Красноярского края"</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ball-item">
                        <span class="ball">4</span>
                        <span class="text"><?= Yii::t('main','Планируемых института развития')?></span>
                    </div>
                    <div class="logo-list">
                        <div class="caption"><?= Yii::t('main','Строящаяся и планируемая инфраструктура')?></div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-2.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">Промышленный парк ЗАТО г. Железногорск (годы реализации 2012 - 2017)</div>
                                <a href="#" class="link">http://www.csr-nw.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="info">
                                <div class="text">Красноярский Технопарк (годы реализации 2013 - 2018)</div>
                                <a href="#" class="link">http://www.agpb24.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="info">
                                <div class="text">Проект "Красноярский инжинириновый центр горно-металлургических технологий" (годы реализации 2013-2015)</div>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="info">
                                <div class="text">Проект "Региональный центр инжиниринга "Космические системы и технологии" (годы реализации 2013-2015)</div>
                            </div>
                        </div>
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
                    <div class="ball-item">
                        <span class="ball">10</span>
                        <span class="text"><?= Yii::t('main','Государственных вузов')?></span>
                    </div>
                    <div class="ball-item">
                        <span class="ball">22</span>
                        <span class="text"><?= Yii::t('main','Филиала Российских вузов')?></span>
                    </div>
                    <div class="ball-item">
                        <span class="ball">1</span>
                        <span class="text"><?= Yii::t('main','Негосударственный вуз')?></span>
                    </div>
                    <div class="ball-item">
                        <span class="ball">55</span>
                        <span class="text"><?= Yii::t('main','Учреждений среднего профессионального образования')?></span>
                    </div>
                    <div class="ball-item">
                        <span class="ball">1</span>
                        <span class="text"><?= Yii::t('main','Красноярский центр сибирского отделения ран')?></span>
                    </div>
                </div>
                <div class="item">
                    <div class="logo-list">
                        <div class="caption"><?= Yii::t('main','Крупнейшие ВУЗы края')?></div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-1.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">Сибирский федеральный университет</div>
                                <a href="#" class="link">http://www.kribi.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="info">
                                <div class="text">Сибирский государственный технологический университет</div>
                                <a href="#" class="link">http://www.agpb24.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-1.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">Красноярский государственный аграрный университет</div>
                                <a href="#" class="link">http://www.sk-kras.ru</a>
                            </div>
                        </div>
                        <div class="row chain">
                            <div class="logo">
                                <?=CHtml::image('/images/assets/slider-2.png','')?>
                            </div>
                            <div class="info">
                                <div class="text">Сибирский государственный аэрокосический университет им. Академика М.Ф. Решетнева</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>