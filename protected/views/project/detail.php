<?php
/**
 *
 * @var SiteController $this
 * @var Project $project
 * @var array $params
 */
    Yii::app()->clientScript->registerScript('init', 'projectMapPart.init();', CClientScript::POS_READY);
?>
<div class="map project-page">
    <div id="general">
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
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
                                <?=CHtml::link("<div class='name'>" . $project->getCompanyAttr('company_name') . "</div>", $this->createUrl('project/iniciator', array('id' => $project->user->id)))?>
                                <?php
                                $attr = $project->getContactAttr('contact_face');
                                if(!empty($attr)):?>
                                    <div class="caption notice"><?= $project->getAttributeLabel('contact_face')?>:</div>
                                    <div class="value"><?=$attr?></div>
                                <?php endif;?>
                                <?php
                                $attr = $project->getContactAttr('contact_role');
                                if(!empty($attr)):?>
                                    <div class="caption notice"><?= $project->getAttributeLabel('contact_role')?>:</div>
                                    <div class="value"><?=$attr?></div>
                                <?php endif;?>
                                <?php
                                $attr = $project->getContactAttr('contact_address');
                                if(!empty($attr)):?>
                                    <div class="caption notice"><?= $project->getAttributeLabel('contact_address')?>:</div>
                                    <div class="value"><?=$attr?></div>
                                <?php endif;?>
                                <?php
                                $attr = $project->getContactAttr('contact_phone');
                                if(!empty($attr)):?>
                                    <div class="caption notice"><?= $project->getAttributeLabel('contact_phone')?>:</div>
                                    <div class="value"><?=$attr?></div>
                                <?php endif;?>
                                <?php
                                $attr = $project->getContactAttr('contact_email');
                                if(!empty($attr)):?>
                                    <div class="caption notice"><?= $project->getAttributeLabel('contact_email')?>:</div>
                                    <div class="value"><?=$attr?></div>
                                <?php endif;?>

                            </div>
                        </div>
                    </div>
                    <div class="clear display-770"></div>
                    <hr class="display-770">
                    <div class="inner-column two">
                        <div class="caption"><?=$project->getProjectType()?></div>
                        <!--div class="caption notice"><?= Yii::t('main','Отрасль реализации')?></div-->
                        <?$tmp = InvestmentSite::getSiteTypeDrop()?>
                        <div class="name"><?=$project->type != Project::T_SITE?$project->name:$tmp[$project->{Project::$params[$project->type]['relation']}->site_type]?></div>
                        <?$dateVal = new DateTime($project->create_date)?>
                        <div class="caption notice"><?=$dateVal->format('d.m.Y / H:s')?></div>
                        <table class="params even">
                        <?if($project->type == Project::T_SITE):?>
                            <?$tmp = InvestmentSite::getSiteTypeDrop()?>
                            <?if(isset($tmp[$project->investmentSite->site_type])):?>
                            <tr>
                                <td><?=Yii::t('main', 'Тип площадки')?></td>
                                <td class="value"><?=$tmp[$project->investmentSite->site_type]?></td>
                            </tr>
                            <?endif?>
                            <tr>
                                <td><?=Yii::t('main', 'Площадь (кв.м)')?></td>
                                <td class="value"><?=$project->investmentSite->param_space?></td>
                            </tr>
                            <tr>
                                <td><?=Yii::t('main', 'Место реализации')?></td>
                                <td class="value"><?=$project->region->name?></td>
                            </tr>
                        <?elseif($project->type == Project::T_BUSINESS):?>
                            <?$tmp = Project::getIndustryTypeDrop()?>
                            <?if(isset($tmp[$project->industry_type])):?>
                            <tr>
                                <td><?=Yii::t('main', 'Отрасль')?></td>
                                <td class="value"><?=$tmp[$project->industry_type]?></td>
                            </tr>
                            <?endif?>
                            <tr>
                                <td><?=Yii::t('main', 'Стоимость бизнеса (млн. руб)')?></td>
                                <td class="value"><?=$project->businesses->price?></td>
                            </tr>
                            <tr>
                                <td><?=Yii::t('main', 'Доля (%)')?></td>
                                <td class="value"><?=$project->businesses->share?></td>
                            </tr>
                            <tr>
                                <td><?=Yii::t('main', 'Местоположение')?></td>
                                <td class="value"><?=$project->region->name?></td>
                            </tr>
                        <?elseif($project->type == Project::T_INNOVATE):?>
                            <tr>
                                <td><?=Yii::t('main', 'Сумма инвестиций (млн. руб)')?></td>
                                <td class="value"><?=$project->investment_sum?></td>
                            </tr>
                            <tr>
                                <td><?=Yii::t('main', 'Полная стоимость проекта (млн. руб)')?></td>
                                <td class="value"><?=$project->innovative->project_price?></td>
                            </tr>
                            <tr>
                                <td><?=Yii::t('main', 'Внутренняя норма доходности (%)')?></td>
                                <td class="value"><?=$project->profit_norm?></td>
                            </tr>
                            <tr>
                                <td><?=Yii::t('main', 'Чистый дисконтированный доход (млн. руб)')?></td>
                                <td class="value"><?=$project->profit_clear?></td>
                            </tr>
                        <?elseif($project->type == Project::T_INVEST):?>
                            <tr>
                                <td><?=Yii::t('main', 'Сумма инвестиций (млн. руб)')?></td>
                                <td class="value"><?=$project->investment_sum?></td>
                            </tr>
                            <tr>
                                <td><?=Yii::t('main', 'Срок окупаемости (лет)')?></td>
                                <td class="value"><?=$project->period?></td>
                            </tr>
                            <tr>
                                <td><?=Yii::t('main', 'Внутренняя норма доходности (%)')?></td>
                                <td class="value"><?=$project->profit_norm?></td>
                            </tr>
                            <tr>
                                <td><?=Yii::t('main', 'Чистый дисконтированный доход (млн. руб)')?></td>
                                <td class="value"><?=$project->profit_clear?></td>
                            </tr>
                        <?elseif($project->type == Project::T_INFRASTRUCT):?>
                        <?endif?>
                        </table>
                    </div>
                </div>
                <div class="clear"></div>
                <?if(count($project->lastNews)):?>
                <hr class="display-1000">
                <div class="row display-1000" style="margin-left: 18px;">
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
                    <?if(!(Yii::app()->user->isGuest || Yii::app()->user->id == $project->user_id)):?>
                    <?= CHtml::link($params['hasRequest'] ? Yii::t('main','Заявка в обработке') : Yii::t('main','Оставить заявку'),array('project/newRequest','projectId'=>$project->id),array('class'=>'item','id'=>'new-request'))?>
                    <?endif?>
                    <?foreach($project->systemMessage as $key => $item):?>
                        <?if($item['object']=='project' && !(in_array('not_author',$item) && Yii::app()->user->id == $project->user_id)):?>
                            <?php if(Yii::app()->user->isGuest):?>
                                <?= CHtml::link($item['name'],'#auth-content',array('class'=>'item auth-fancy'))?>
                            <?php else:?>
                                <?= CHtml::link($item['name'],array('message/create','system'=>$key,'project_id'=>$project->id),array('class'=>'item'))?>
                            <?php endif;?>
                        <?elseif($this->user && $item['object'] == $this->user->type):?>
                            <?= CHtml::link($item['name'],array('message/create','system'=>$key),array('class'=>'item'))?>
                        <?endif;?>
                    <?endforeach;?>
                    <?if(!(Yii::app()->user->isGuest || Yii::app()->user->id == $project->user_id)):?>
                        <?=CHtml::link($project->isFavorite() ? Yii::t('main','Удалить из избранного') : Yii::t('main','Добавить в избранное'),'#',array('class'=> 'item favorite ' . ($project->isFavorite() ? '' : 'add'), 'data-project-id' => $project->id))?>
                    <?endif?>
                </div>
            </div>
        </div>
        <?if(count($project->lastNews)):?>
        <!--noindex-->
        <div class="opacity-box news-block display-770 main">
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
        <!--/noindex-->
        <?endif?>
        <div class="opacity-box main info" id="scrollable">
            <div class="inner-column blue-menu">
                <?php echo CHtml::link(Yii::t('main','Описание проекта'),'#',array('class'=>'item','data-action'=>'params'))?>
                <?php echo CHtml::link(Yii::t('main','Документы'),'#',array('class'=>'item','data-action'=>'documents'))?>
                <?php echo CHtml::link(Yii::t('main','Фото'),'#',array('class'=>'item','data-action'=>'photo'))?>
                <?php echo CHtml::link(Yii::t('main','Карта'),'#',array('class'=>'item','data-action'=>'map'))?>
                <?php echo CHtml::link(Yii::t('main','Обсуждение'),'#',array('class'=>'item','data-action'=>'comments'))?>
            </div>
            <div class="inner-column" id="ajax-content">
                <?=$this->renderPartial('_params', array('project' => $project, 'fields' => $fields))?>
            </div>
        </div>
    </div>
</div>