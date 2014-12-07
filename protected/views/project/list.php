<?php
/**
 * @var RegionController $this
 * @var RegionFilter $filter
 * @var CActiveForm $form
 */
//Yii::app()->clientScript->registerScript('init', 'regionPart.init();', CClientScript::POS_READY);
?>

<div class="project-filter-page">
    <div id="general">
        <?$this->renderPartial('/partial/_filter',array('filter'=>$filter))?>
        <div class="main bread-block">
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>array('Проекты'),
                'htmlOptions' => array('class'=>'breadcrumb'),
                'homeLink'=>CHtml::link('Главная','/',array('class'=>'normal')),
                'separator'=>''
            )); ?>
        </div>
        <div class="content list-columns">
            <div class="side-column">
                <div class="side-adv-block responsive-770">
                    <img src="/images/assets/banner-index-2.png">
                </div>
                <div class="side-adv-block responsive-770">
                    <img src="/images/assets/banner-3.png">
                </div>
                <div class="side-adv-block">
                    <img src="/images/assets/banner-4.png">
                </div>
                <div class="side-adv-block">
                    <img src="/images/assets/banner-5.png">
                </div>
            </div>
            <div class="main-column">
                <div class="filter opacity-box">
                    <div class="pull-left condition">
                        <label>Сортировать по</label>
                        <select><option>Цене</option></select>
                    </div>
                    <div class="pull-right condition">
                        <label>Сортировать по</label>
                        <select><option>10</option></select>
                    </div>
                </div>
                <?if($filter->viewType):?>
                    <div class="opacity-box">
                        <?php $this->widget('Map', array(
                            'id'=>'map',
                            'target'=>$this->region->name,
                            'showProjectBalloon'=>true,
                            'htmlOptions'=>array(
                                'style'=>'height:600px;'
                            ),
                            'projects' => $models
                        )); ?>
                    </div>
                <?else:?>
                    <? foreach($models as $model) {
                        $this->renderPartial('projectItem/' . Project::$urlByType[$model->type], array('model' => $model));
                    }?>
                <?endif?>

                <!--div class="invest-item opacity-box top-item">
                    <div class="top-stick">топ</div>
                    <div class="info-block">
                        <div class="date">29.07.2014 13:00</div>
                        <img class="image" src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">
                        <a class="comment-link" href="#"><i class="icon icon-balloon"><span>15</span></i> коммент.</a>
                    </div>
                    <div class="data-block">
                        <div class="title">
                            <div class="type">Инвестиционная площадка:</div>
                            <h2>Земельный участок</h2>
                        </div>
                        <div class="location">Воронежска область. Петропавловский муниципальный район, территория бывшего савхоза "Труд"</div>
                        <div class="stats">
                            <div class="stat-row">
                                <div class="name">Сумма инвестиций (млн. руб)</div>
                                <div class="value">12</div>
                            </div>
                            <div class="stat-row">
                                <div class="name">Срок окупаемости (лет)</div>
                                <div class="value">12</div>
                            </div>
                            <div class="stat-row">
                                <div class="name">Внутренн норма доходности (%)</div>
                                <div class="value">12</div>
                            </div>
                            <div class="stat-row">
                                <div class="name">Чистый дисконтированный доход (млн. руб)</div>
                                <div class="value">12</div>
                            </div>
                        </div>
                    </div>
                    <div class="map-block">
                        <h2>Москва</h2>
                        <div class="map">
                            <img src="https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=218x210&maptype=roadmap&markers=color:blue%7C40.709187,-74.010894">
                        </div>
                        <a class="map-link" href="#">Большая карта</a>
                    </div>
                </div>

                <div class="invest-item opacity-box">
                    <div class="info-block">
                        <div class="date">29.07.2014 13:00</div>
                        <img class="image" src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">
                        <a class="comment-link" href="#"><i class="icon icon-balloon"><span>15</span></i> коммент.</a>
                    </div>
                    <div class="data-block">
                        <div class="title">
                            <div class="type">Инвестиционная площадка:</div>
                            <h2>Земельный участок</h2>
                        </div>
                        <div class="location">Воронежска область. Петропавловский муниципальный район, территория бывшего савхоза "Труд"</div>
                        <div class="stats">
                            <div class="stat-row">
                                <div class="name">Сумма инвестиций (млн. руб)</div>
                                <div class="value">12</div>
                            </div>
                            <div class="stat-row">
                                <div class="name">Срок окупаемости (лет)</div>
                                <div class="value">12</div>
                            </div>
                            <div class="stat-row">
                                <div class="name">Внутренн норма доходности (%)</div>
                                <div class="value">12</div>
                            </div>
                            <div class="stat-row">
                                <div class="name">Чистый дисконтированный доход (млн. руб)</div>
                                <div class="value">12</div>
                            </div>
                        </div>
                    </div>
                    <div class="map-block">
                        <h2>Москва</h2>
                        <div class="map">
                            <img src="https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=218x210&maptype=roadmap&markers=color:blue%7C40.709187,-74.010894">
                        </div>
                        <a class="map-link" href="#">Большая карта</a>
                    </div>
                </div>

                <div class="invest-item opacity-box">
                    <div class="info-block">
                        <div class="date">29.07.2014 13:00</div>
                        <img class="image" src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">
                        <a class="comment-link" href="#"><i class="icon icon-balloon"><span>15</span></i> коммент.</a>
                    </div>
                    <div class="data-block">
                        <div class="title">
                            <div class="type">Инвестиционная площадка:</div>
                            <h2>Земельный участок</h2>
                        </div>
                        <div class="location">Воронежска область. Петропавловский муниципальный район, территория бывшего савхоза "Труд"</div>
                        <div class="stats">
                            <div class="stat-row">
                                <div class="name">Сумма инвестиций (млн. руб)</div>
                                <div class="value">12</div>
                            </div>
                            <div class="stat-row">
                                <div class="name">Срок окупаемости (лет)</div>
                                <div class="value">12</div>
                            </div>
                            <div class="stat-row">
                                <div class="name">Внутренн норма доходности (%)</div>
                                <div class="value">12</div>
                            </div>
                            <div class="stat-row">
                                <div class="name">Чистый дисконтированный доход (млн. руб)</div>
                                <div class="value">12</div>
                            </div>
                        </div>
                    </div>
                    <div class="map-block">
                        <h2>Москва</h2>
                        <div class="map">
                            <img src="https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=218x210&maptype=roadmap&markers=color:blue%7C40.709187,-74.010894">
                        </div>
                        <a class="map-link" href="#">Большая карта</a>
                    </div>
                </div-->
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>