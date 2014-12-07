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
                <?= CHtml::hiddenField('project_id',$project->id,array('id'=>'project-id-value'))?>
                <div class="row">
                    <div class="inner-column">
                        <div class="caption"><?=Yii::t('main','Название компании')?></div>
                        <div class="main-company-info chain-block">
                            <div class="logo">
                                <?=Candy::preview(array($project->logo,'scale'=>'98x98'))?>
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
                <?if(count($project->lastNews)):?>
                <hr>
                <div class="row" style="margin-left: 18px;">
                    <div class="caption"><?= Yii::t('main','Новости проекта')?></div>
                    <div class="caption notice"><?= Yii::t('main','Последние события')?></div>
                    <?foreach($project->lastNews as $newsItem):?>
                    <div class="news-info chain-block">
                        <?if($newsItem->media):?>
                        <div class="logo">
                            <?=Candy::preview(array($newsItem->media, 'scale' => '102x102'))?>
                        </div>
                        <?endif?>
                        <div class="text">
                            <div class="caption notice"><?=Candy::formatDate($newsItem->create_date, 'd.m.Y / H:m')?></div>
                            <div class="value"><?=CHtml::link(CHtml::encode($newsItem->announce), $newsItem->createUrl())?></div>
                        </div>
                    </div>
                    <?endforeach?>
                    <br>
                    <?=CHtml::link(Yii::t('main', 'Все новости'), $this->createUrl('project/news', array('id' => $project->id)), array('class' => 'btn'))?>
                </div>
                <?endif?>
                <div class="clear"></div>
            </div>
            <div class="box dark side-column bossy">
                <div class="box inner">
                    <?foreach($project->systemMessage as $key => $item):?>
                        <?if($item['object']=='project'):?>
                            <?= CHtml::link($item['name'],array('message/create','system'=>$key,'project_id'=>$project->id),array('class'=>'item'))?>
                        <?endif;?>
                    <?endforeach;?>
                    <?if(!Yii::app()->user->isGuest):?>
                    <?=CHtml::link($project->isFavorite() ? Yii::t('main','В избранном') : Yii::t('main','Добавить в избранное'),'#',array('class'=> 'item favorite ' . ($project->isFavorite() ? '' : 'add'), 'data-project-id' => $project->id))?>
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
                <?=$this->renderPartial('_params', array('project' => $project, 'fields' => $fields))?>
            </div>
        </div>
    </div>
</div>