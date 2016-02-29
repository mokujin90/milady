<?php
/**
 * @var RegionController $this
 * @var RegionFilter $filter
 * @var CActiveForm $form
 * @var User $model
 */
//Yii::app()->clientScript->registerScript('init', 'regionListPart.init();', CClientScript::POS_READY);
?>

<div class="iniciator-page">
    <div id="general">
        <div class="main bread-block">
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>array(Yii::t('main','Проекты')=>$this->createUrl('project/index'),'Страница инициатора'),
                'htmlOptions' => array('class'=>'breadcrumb'),
                'homeLink'=>CHtml::link('Главная','/',array('class'=>'normal')),
                'separator'=>''
            )); ?>
        </div>

        <div class="content list-columns columns">
            <div class="full-column">
                <div class="investor-item opacity-box">
                    <div class="title">Описание компании</div>
                    <div class="data">
                        <div class="main-data">
                            <?=$model->logo?Candy::preview(array($model->logo, 'scale' => '100x100', 'class' => 'image')):'<img class="image" src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">'?>
                            <div class="name"><?=$model->company_name?></div>
                            <div class="type">Инициатор</div>
                        </div>
                        <div class="contact-data">
                            <div class="label">Контакты</div>
                            <div class="text"><?=$model->company_address?></div>
                        </div>
                        <div class="more-data">
                            <div class="label"><?= Yii::t('main','Сведения о пользователе')?></div>
                            <div class="text">
                                <?php if($model->hasJointProject(Yii::app()->user->id)):?>


                                    Имя: <?=$model->name?><br>
                                    Email: <?=$model->email?><br>
                                    Телефон: <?=$model->phone?><br>
                                    Сфера деятельности: <?=Project::getIndustryTypeDrop($model->company_scope)?>

                                <?else:?>
                                    <?= Yii::t('main','Нет доступа')?>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="side-column opacity-box">
                <h1><?= Yii::t('main','Тип площадок')?></h1>
                <div class="side-menu-list">
                    <?
                    $sideMenu = array(
                        Project::T_INFRASTRUCT => Yii::t('main', 'Инфраструктурные'),
                        Project::T_INNOVATE => Yii::t('main', 'Иновационные'),
                        Project::T_INVEST => Yii::t('main', 'Инвестиционные'),
                        Project::T_SITE => Yii::t('main', 'Инвестиционные площадки'),
                        Project::T_BUSINESS => Yii::t('main', 'Бизнес'),
                    );
                    foreach ($sideMenu as $type => $name) {
                        $params = $_GET;
                        unset($params['page']);
                        if (empty($params['hide'][$type])) {
                            $params['hide'][$type] = $type;
                        } else {
                            unset($params['hide'][$type]);
                        }
                        ?>
                        <div class="side-menu-item overflow blue-label">
                            <?=Crud::checkBox("hide[$type]",empty($_GET['hide'][$type]),array('disabled' => true)) . CHtml::link($name, $this->createUrl('', $params))?>
                        </div>
                    <?}?>
                </div>
            </div>
            <div class="main-column">
                <!--div class="right-column">
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
                </div-->
                <? foreach($projects as $model) {
                    $this->renderPartial('projectItem/' . Project::$urlByType[$model->type], array('model' => $model));
                }?>
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
                                <div class="name">Сумма инвестиций (млн руб)</div>
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
                                <div class="name">Чистый дисконтированный доход (млн руб)</div>
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