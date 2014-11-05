<?php
/**
 *
 * @var SiteController $this
 */
    Yii::app()->clientScript->registerScript('init', 'projectMapPart.init();', CClientScript::POS_READY);
?>
<div class="map project-page">
    <div id="general">
        <div class="main bread-block">
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>array(Yii::t('main','Проекты')=>$this->createUrl('project/index'),'Страница проекта'),
                'htmlOptions' => array('class'=>'breadcrumb'),
                'homeLink'=>CHtml::link('Главная','/',array('class'=>'normal')),
                'separator'=>''
            )); ?>
        </div>
        <div class="content columns">
            <div class="main-column opacity-box">
                <?= CHtml::hiddenField('project_id','1',array('id'=>'project-id-value'))?>
                <div class="row">
                    <div class="inner-column">
                        <div class="caption"><?=Yii::t('main','Название компании')?></div>
                        <div class="main-company-info chain-block">
                            <div class="logo">
                                <?=CHtml::image(Makeup::img(),'')?>
                            </div>
                            <div class="text">
                                <?=CHtml::link("<div class='name'>{$project->user->company_name}</div>", $this->createUrl('project/iniciator', array('id' => $project->user->id)))?>
                                <div class="caption notice"><?= Yii::t('main','Описание компании')?>:</div>
                                <div class="value"><?=$project->user->company_address?></div>
                            </div>
                        </div>
                    </div>
                    <div class="inner-column two">
                        <div class="caption"><?=$project->getProjectType()?></div>
                        <div class="caption notice"><?= Yii::t('main','Отрасль реализации')?></div>
                        <?$tmp = InvestmentSite::getSiteTypeDrop()?>
                        <div class="name"><?=$project->type != Project::T_SITE?$project->name:$tmp[$project->{Project::$params[$project->type]['relation']}->site_type]?></div>
                        <?$dateVal = new DateTime($project->create_date)?>
                        <div class="caption notice"><?=$dateVal->format('d.m.Y / H:s')?></div>
                        <?if($project->type != Project::T_SITE):?>
                        <table class="params even">
                            <tr>
                                <td>Сумма инвестиций (млн. руб)</td>
                                <td class="value"><?=$project->investment_sum?></td>
                            </tr>
                            <tr>
                                <td>Срок окупаемости (лет)</td>
                                <td class="value"><?=$project->period?></td>
                            </tr>
                            <tr>
                                <td>Внутренняя норма доходности (%)</td>
                                <td class="value"><?=$project->profit_norm?></td>
                            </tr>
                            <tr>
                                <td>Чистый дисконтир. доход (млн. руб)</td>
                                <td class="value"><?=$project->profit_clear?></td>
                            </tr>
                        </table>
                        <?endif?>
                    </div>
                </div>
                <div class="clear"></div>
                <hr/>
                <div class="row" style="margin-left: 18px;">
                    <div class="caption"><?= Yii::t('main','Новости проекта')?></div>
                    <div class="caption notice"><?= Yii::t('main','Последние события')?></div>
                    <div class="news-info chain-block">
                        <div class="logo">
                            <?=CHtml::image(Makeup::img(),'')?>
                        </div>
                        <div class="text">
                            <div class="caption notice">29.07.2014 / 13:00</div>
                            <div class="value">Открывать трамвайное движение по проспектам Набережночелнинский, Мира, Сююмбике и снизить на 65% пассажирский автотраспортный поток на данных участках</div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="box dark side-column bossy">
                <div class="box inner">
                    <?= CHtml::link(Yii::t('main','Оставить заявку'),'#',array('class'=>'item active'))?>
                    <?= CHtml::link(Yii::t('main','Связаться с инициатором'),'#',array('class'=>'item'))?>
                    <?= CHtml::link(Yii::t('main','Заказать маршрутную карту'),'#',array('class'=>'item'))?>
                    <?= CHtml::link(Yii::t('main','Предложение по кредитам'),'#',array('class'=>'item'))?>
                    <?= CHtml::link(Yii::t('main','Юридическая консультация'),'#',array('class'=>'item'))?>
                    <?= CHtml::link(Yii::t('main','Проверить компанию'),'#',array('class'=>'item'))?>
                    <?= CHtml::link(Yii::t('main','Анализ проекта'),'#',array('class'=>'item'))?>
                    <?= CHtml::link(Yii::t('main','Сопровождение сделки'),'#',array('class'=>'item'))?>
                    <?= CHtml::link(Yii::t('main','Расчет рентабельности'),'#',array('class'=>'item'))?>
                    <?if(!Yii::app()->user->isGuest):?>
                    <?= CHtml::link($project->isFavorite() ? Yii::t('main','В избранном') : Yii::t('main','Добавить в избранное'),'#',array('class'=> 'item favorite ' . ($project->isFavorite() ? '' : 'add'), 'data-project-id' => $project->id))?>
                    <?endif?>
                </div>
            </div>
        </div>
        <div class="opacity-box main info">
            <div class="inner-column blue-menu">
                <?php echo CHtml::link(Yii::t('main','Параметры проекты'),'#',array('class'=>'item','data-action'=>'params'))?>
                <?php echo CHtml::link(Yii::t('main','Обсуждение'),'#',array('class'=>'item','data-action'=>'comments'))?>
                <?php echo CHtml::link(Yii::t('main','Финансовые показатели'),'#',array('class'=>'item','data-action'=>'financial'))?>
                <?php echo CHtml::link(Yii::t('main','Описание проекта'),'#',array('class'=>'item','data-action'=>'discription'))?>
                <?php echo CHtml::link(Yii::t('main','Документы'),'#',array('class'=>'item','data-action'=>'documents'))?>
                <?php echo CHtml::link(Yii::t('main','Фото'),'#',array('class'=>'item','data-action'=>'photo'))?>
                <?php echo CHtml::link(Yii::t('main','Карта'),'#',array('class'=>'item','data-action'=>'map'))?>
            </div>
            <div class="inner-column" id="ajax-content">
                <table class="all-params even">
                    <tbody>
                    <?foreach($fields as $field):?>
                    <tr>
                        <td><?=$project->{Project::$params[$project->type]['relation']}->getAttributeLabel($field)?></td>
                        <td class="value"><?=$project->{Project::$params[$project->type]['relation']}->{$field}?></td>
                    </tr>
                    <?endforeach?>
                    </tbody></table>
                <!--div class="text">
                    Сегодня вечером я на кухне пил чай с симпатичной тян. Она сидела на стуле, обняв ножки в полосатых носках руками и смотрела на меня тепло-тепло и слушала. Я ей рассказывал о каких-то пустяках, она склоняла голову на бочок, свешивая один из рыжих хвостиков. Потом я начал объяснять ей про какую-то книгу, употребив по привычке «суть такова…», она улыбнулась и спросила: «а в ней можно грабить корованы?», я как-то рефлекторно что-то хотел сказать про Номада и осекся, не веря своим ушам. А она так же смотрела на меня и улыбалась. У меня перехватило дыхание. Как, откуда?! А потом я все понял. Никакой тян не было, стоял еще один пустой стул и остывший чай на столе. И стало вдруг так одиноко, что я заплакал.
                </div-->
            </div>
        </div>
    </div>
</div>