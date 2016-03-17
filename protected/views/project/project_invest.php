<?
/**
 *
 * @var $this SiteController
 * @var $project Project
 * @var $params array
 */
Yii::app()->clientScript->registerScript('init', 'projectDetailPart.init();', CClientScript::POS_READY);
?>
<div class="card-header">
    <?= $project->bgMedia ? Candy::preview(array($project->bgMedia, 'scale' => '1000x263','class'=>'card-header__bg')) : '<img class="card-header__bg" src="/images/frontend/card/item-1.jpg" alt="Фон"/>'?>
    <div class="card-header-right">
        <p class="card__company"><?=$project->getCompanyAttr('company_name');?></p>
        <div class="card-company-logo">
            <?= Candy::preview(array($project->logo, 'scale' => '187x157','class'=>'pos-center')) ?>
        </div><!--card-company-logo-->

    </div><!--card-header-right-->

    <p class="card__name"><?= CHtml::encode($project->name)?></p>
    <p class="card__type">
        <i class="icon icon-card-type-1"></i>
        <span><?=$project->getProjectType()?></span>
    </p>

    <p class="card__viewed">
        <em><?=number_format($project->view_count);?></em> <?=Candy::getNumEnding($project->view_count,array(Yii::t('main','просмотр'),Yii::t('main','просмотра'),Yii::t('main','просмотров')));?>
    </p>

    <? //=CHtml::link(Yii::t('main', 'Оставить отклик'), '#auth-content', array('class' => 'blue-btn card__review auth-fancy'))?>
    <? //=CHtml::link(Yii::t('main', 'Добавить в избранное'), '#auth-content', array('class' => 'blue-btn card__favorites auth-fancy'))?>
    <? if (!(Yii::app()->user->isGuest || Yii::app()->user->id == $project->user_id)) { ?>
        <? if ($this->user->type == 'investor') { ?>
            <?=CHtml::link(Yii::t('main', 'Оставить отклик'), array('message/create', 'project_id' => $project->id), array('class' => 'blue-btn card__review'))?>
        <?}?>
        <?=CHtml::link($project->isFavorite() ? Yii::t('main', 'В избранном') : Yii::t('main', 'Добавить в избранное'), '#auth-content', array('class' => 'blue-btn card__favorites item favorite ' . ($project->isFavorite() ? '' : 'add'), 'data-project-id' => $project->id))?>
    <?}?>
    <? if (!Yii::app()->user->isGuest && !$project->hideRecommend(Yii::app()->user->id)) {?>
    <? $form=$this->beginWidget('CActiveForm', array(
        'htmlOptions'=>array('class'=>'card-recom'))); ?>
        <span class="card-recom__close" data-project=<?=$project->id?>></span>
        <p class="card-recom__title"><?=Yii::t('main','Порекомендовать проект');?></p>
        <?=CHtml::emailField('invite_email','',array('class'=>'card-recom__field','placeholder'=>Yii::t('main','введите e-mail')));?>
        <?= CHtml::submitButton(Yii::t('main', 'Отправить'),array('data-project' => $project->id, 'class'=>'blue-btn card-recom__btn recommend-project-action'))?>
    <? $this->endWidget(); ?>
    <? }?>

</div><!--card-header-->

<div class="card-data-wrap">
    <ul class="card-data-list">
        <?if(count($project->project2FinanceType)){?>
            <li class="card-data-item">
                    <span class="card-data-item__i-wrap">
                        <i class="icon icon-card-data-4"></i>
                    </span>
                <span class="card-data-item__name"><?=Yii::t('main','Форма инвестиций');?></span>
                <div class="card-data-item__desc ">
                    <? foreach($project->project2FinanceType as $model){
                            echo CHtml::tag('span', array(), $model->financeType->name);
                    }?>
                </div><!--card-data-item__desc-->
            </li>
        <?}?>
        <li class="card-data-item">
                <span class="card-data-item__i-wrap">
                    <i class="icon icon-card-data-5"></i>
                </span>
            <span class="card-data-item__name"><?=Yii::t('main','Сумма инвестиций');?></span>
            <div class="card-data-item__desc">
                <?=Candy::formatNumber($project->investment_sum)?> <i class="icon icon-rub-black"></i>
            </div><!--card-data-item__desc-->
        </li>

        <li class="card-data-item">
                <span class="card-data-item__i-wrap">
                    <i class="icon icon-card-data-6"></i>
                </span>
            <span class="card-data-item__name"><?=Yii::t('main','Выручка');?></span>
            <div class="card-data-item__desc">
                <?//=Candy::formatNumber($project->investment->no_finRevenue)?>??? <i class="icon icon-rub-black"></i>
            </div><!--card-data-item__desc-->
        </li>

        <li class="card-data-item">
                <span class="card-data-item__i-wrap">
                    <i class="icon icon-card-data-7"></i>
                </span>
            <span class="card-data-item__name">NPV</span>
            <div class="card-data-item__desc">
                <?=Candy::formatNumber($project->profit_clear)?> <i class="icon icon-rub-black"></i>
            </div><!--card-data-item__desc-->
        </li>

        <li class="card-data-item">
                <span class="card-data-item__i-wrap">
                    <i class="icon icon-card-data-8"></i>
                </span>
            <span class="card-data-item__name">IRR</span>
            <div class="card-data-item__desc">
                <?=$project->profit_norm?>%
            </div><!--card-data-item__desc-->
        </li>

        <li class="card-data-item">
                <span class="card-data-item__i-wrap">
                    <i class="icon icon-card-data-9"></i>
                </span>
            <span class="card-data-item__name"><?=Yii::t('main','Возврат инвестиций');?></span>
            <div class="card-data-item__desc">
                <?=(float)$project->period?> <?=Candy::getNumEnding((int)$project->period,array(Yii::t('main','год'),Yii::t('main','года'),Yii::t('main','лет')));?>
            </div><!--card-data-item__desc-->
        </li>

    </ul>
    <?if(!empty($project->investment->investment_direction)){?>
    <div class="card-data">
            <span class="card-data__icon-wrap">
                <i class="icon icon-card-data-1"></i>
            </span>
            <span class="card-data__name">
                <?=Yii::t('main','Направление инвестиций');?>
            </span>
        <div class="card-data__desc">
            <?
                $data = unserialize($project->investment->investment_direction);
                foreach($data as $directionId) {
                    $name = InvestmentProject::getInvestmentDirectionDrop($directionId);
                    if (!empty($name)) {
                        echo CHtml::tag('span', array(), $name);
                    }
                }?>
        </div><!--card-data__desc-->

    </div><!--card-data-->
    <?}?>

    <div class="card-data">
            <span class="card-data__icon-wrap">
                <i class="icon icon-card-data-2"></i>
            </span>
            <span class="card-data__name">
                <?=Yii::t('main','Основные условия финансирования');?>
            </span>

        <div class="card-data__desc">
            <span><?=strip_tags($project->investment->term_finance)?></span>
        </div><!--card-data__desc-->

    </div><!--card-data-->
    <?if($project->investment->industry){?>
    <div class="card-data">
            <span class="card-data__icon-wrap">
                <i class="icon icon-card-data-3"></i>
            </span>
            <span class="card-data__name">
                <?=Yii::t('main','Отрасль');?>
            </span>

        <div class="card-data__desc">
            <span><?=$project->investment->industry->name?></span>
        </div><!--card-data__desc-->

    </div><!--card-data-->
    <?}?>
</div><!--card-data-wrap-->

<div class="card-tabs-wrap tabs-wrap">
    <div class="card-tab-links tab-links">
        <span class="card-tab-link tab-link active" data-index="0"><?=Yii::t('main','Финансовый план');?></span>
        <span class="card-tab-link tab-link" data-index="1"><?=Yii::t('main','Производственный план');?></span>
        <span class="card-tab-link tab-link" data-index="2"><?=Yii::t('main','Организационный план');?></span>
    </div><!--card-tab-links-->

    <div class="card-tabs tabs">
        <div class="card-tab tab active">
            <div class="statistic">
                <ul class="statistic-list">
                    <li class="statistic-item">
                            <span class="statistic-item__icon-wrap">
                                <i class="icon icon-statistic-1"></i>
                            </span>
                        <span class="statistic-item__name"><?=Yii::t('main','Выручка');?></span>
                    </li>

                    <li class="statistic-item">
                            <span class="statistic-item__icon-wrap">
                                <i class="icon icon-statistic-2"></i>
                            </span>
                        <span class="statistic-item__name"><?=Yii::t('main','Чистая прибыль');?></span>
                    </li>

                    <li class="statistic-item">
                            <span class="statistic-item__icon-wrap">
                                <i class="icon icon-statistic-3"></i>
                            </span>
                        <span class="statistic-item__name">EBITDA</span>
                    </li>

                </ul>

                <div class="statistic-table">
                    <p class="statistic-row-header">
                        <span class="statistic-col-1">1 <?=Yii::t('main','год');?></span>
                        <span class="statistic-col-2">2 <?=Yii::t('main','год');?></span>
                        <span class="statistic-col-3">3 <?=Yii::t('main','год');?></span>
                    </p>
                    <?$financePlan = CJSON::decode($project->investment->finance_plan);?>
                    <?foreach(InvestmentProject::getFinancePlanData() as $key => $item):?>
                        <p class="statistic-row">
                        <?for($i=0;$i<3;$i++):?>
                            <?$value = isset($financePlan[$i]) ? $financePlan[$i][$key] : '---';?>
                            <span class="statistic-col-<?=$i+1?>"><?= is_numeric($value) ? Candy::formatNumber($value) : '---'?></span>
                        <?endfor;?>
                        </p>
                    <?endforeach;?>


                    <!--p class="statistic-table__info">*<?=Yii::t('main','миллионов Р');?></p-->

                </div><!--statistic-table-->

            </div><!--statistic-->

            <div class="card-tab-right clear-fix">
                <p class="card-tab-right__title"><?=Yii::t('main','Гарантии возврата инвестиций');?></p>
                <p class="card-tab-right__desc">
                    <?=$project->investment->guarantee?>
                </p>

                <?$planFile = $project->investment->finance_plan_file;?>
                <?if ($planFile) {?>
                    <a href="<?=$planFile->makeWebPath()?>" class="blue-btn card-tab__btn" target="_blank">
                        <?$icon = isset(Makeup::$fileIcons[$planFile->ext]) ? ("<i class='icon " . Makeup::$fileIcons[$planFile->ext] . "'></i>") : ''?>
                        <?=$icon?>
                        <span><?=Yii::t('main','Финансовый план');?></span>
                    </a>
                <?}?>


            </div><!--card-tab-right-->

        </div><!--card-tab-->

        <div class="card-tab tab">
            <div class="card-text">
                <p class="card-text__title"><?=Yii::t('main','Предполагаемая к выпуску продукции');?></p>
                <div class="card-text__desc">
                    <?=$project->investment->products?>
                </div>

            </div><!--card-text-->

            <div class="card-tab-right clear-fix card-tab-right_fix">
                <p class="card-tab-right__title">
                    <?=Yii::t('main','Предполагаемый максимальный объем производства <br/> млн. руб. \ Р (по видам продукции)');?>
                </p>
                <p class="card-tab-right__desc">
                    <?=$project->investment->max_products?>
                </p>

                <?$planFile = $project->investment->prod_plan_file;?>
                <?if ($planFile) {?>
                    <a href="<?=$planFile->makeWebPath()?>" class="blue-btn card-tab__btn" target="_blank">
                        <?$icon = isset(Makeup::$fileIcons[$planFile->ext]) ? ("<i class='icon " . Makeup::$fileIcons[$planFile->ext] . "'></i>") : ''?>
                        <?=$icon?>
                        <span><?=Yii::t('main','Производственный <br/> план');?></span>
                    </a>
                <?}?>

            </div><!--card-tab-right-->

        </div><!--card-tab-->

        <div class="card-tab tab">
            <div class="card-text">
                <p class="card-text__title"><?=Yii::t('main','Предполагаемое капитальное строительство');?></p>
                <div class="card-text__desc">
                    <?=$project->investment->capital_dev?>
                </div>

            </div><!--card-text-->


            <div class="card-tab-right clear-fix card-tab-right_mt">
                <?$planFile = $project->investment->org_plan_file;?>
                <?if ($planFile) {?>
                    <a href="<?=$planFile->makeWebPath()?>" class="blue-btn card-tab__btn" target="_blank">
                        <?$icon = isset(Makeup::$fileIcons[$planFile->ext]) ? ("<i class='icon " . Makeup::$fileIcons[$planFile->ext] . "'></i>") : ''?>
                        <?=$icon?>
                        <span><?=Yii::t('main','Организационный <br/> план');?></span>
                    </a>
                <?}?>
            </div><!--card-tab-right-->

        </div><!--card-tab-->

    </div><!--card-tabs-->

</div><!--card-tabs-wrap-->

<? $param = $project->has_user_contact ? $project->user->name : $project->contact_face;
if(!empty($param)){ ?>
<div class="card-block card-block_cont">
    <h2 class="card-block__title">
        <i class="icon icon-prof-3"></i>
        <span><?=Yii::t('main','Контактное лицо');?></span>
    </h2>

    <ul class="card-block-data card-block-data_first">
        <li>
            <span class="card-block-data__name"><?=Yii::t('main','ФИО');?></span>
                <span class="card-block-data__desc">
                    <?=$param?>
                </span>
        </li>
        <? $param = $project->has_user_contact ? $project->user->post : $project->contact_role;
        if(!empty($param)){ ?>
        <li>
            <span class="card-block-data__name"><?=Yii::t('main','Должность');?></span>
                <span class="card-block-data__desc">
                    <?=$param?>
                </span>
        </li>
        <?}?>
    </ul>

    <ul class="card-block-data card-block-data_second">
        <? $param = $project->has_user_contact ? $project->user->phone : $project->contact_phone;
        if(!empty($param)){ ?>
        <li>
            <span class="card-block-data__name"><?=Yii::t('main','Телефон');?></span>
                <span class="card-block-data__desc">
                    <?=$param?>
                </span>
        </li>
        <?}?>
        <? $param = $project->has_user_contact ? $project->user->contact_email : $project->contact_email;
        if(!empty($param)){ ?>
        <li>
            <span class="card-block-data__name">E-mail</span>
                <span class="card-block-data__desc">
                    <?=$param?>
                </span>
        </li>
        <?}?>

    </ul>

</div><!--card-block-->
<?}?>
<? $param = $project->has_user_company ? $project->user->company_name : $project->investment->company_name;
if(!empty($param)){ ?>
<div class="card-block card-block_comp">
    <h2 class="card-block__title">
        <i class="icon icon-prof-1"></i>
        <span><?=Yii::t('main','Компания');?></span>
    </h2>

    <ul class="card-block-data card-block-data_first">
        <li>
            <span class="card-block-data__name"><?=Yii::t('main','Наименование');?></span>
                <span class="card-block-data__desc">
                    <?=$param?>
                </span>
        </li>

        <? $param = $project->has_user_company ? $project->user->company_email : $project->investment->company_email;
        if(!empty($param)){ ?>
            <li>
                <span class="card-block-data__name">E-mail</span>
                <span class="card-block-data__desc">
                    <?=$param?>
                </span>
            </li>
        <?}?>

        <? $param = $project->has_user_company ? $project->user->companyIndustry : null;
        if(!empty($param)){ ?>
        <li>
            <span class="card-block-data__name"><?=Yii::t('main','Отрасль');?></span>
                <span class="card-block-data__desc">
                    <?=$param->name?>
                </span>
        </li>
        <?}?>

    </ul>

    <ul class="card-block-data card-block-data_second">
        <? $param = $project->has_user_company ? $project->user->company_phone : $project->investment->company_phone;
        if(!empty($param)){ ?>
        <li>
            <span class="card-block-data__name"><?=Yii::t('main','Телефон');?></span>
                <span class="card-block-data__desc">
                    <?=$param?>
                </span>
        </li>
        <?}?>

        <? $param = $project->has_user_company ? $project->user->inn : $project->investment->company_inn;
        if(!empty($param)){ ?>

        <li>
            <span class="card-block-data__name"><?=Yii::t('main','ИНН');?></span>
                <span class="card-block-data__desc">
                    <?=$param?>
                </span>
        </li>
        <?}?>
        <? $param = $project->has_user_company ? $project->user->ogrn : $project->investment->company_ogrn;
        if(!empty($param)){ ?>
        <li>
            <span class="card-block-data__name"><?=Yii::t('main','ОГРН');?></span>
                <span class="card-block-data__desc">
                    <?=$param?>
                </span>
        </li>
        <?}?>

    </ul>

</div><!--card-block-->
<?}?>
<?if(count($project->project2Files)):?>

<div class="card-block card-block_doc">
    <h2 class="card-block__title">
        <i class="icon icon-prof-2"></i>
        <span><?=Yii::t('main','Документы');?></span>
    </h2>

    <div class="card-docs">

        <?foreach($project->project2Files as $file):?>
            <a href="<?=$file->media->makeWebPath()?>" class="card-docs__item" target="_blank">
                <?$icon = isset(Makeup::$fileIcons[$file->media->ext]) ? ("<i class='icon " . Makeup::$fileIcons[$file->media->ext] . "'></i>") : ''?>
                <?=$icon?>
                <span><?=!empty($file->desc) ? $file->desc : $file->name?></span>
            </a><!--card-docs__item-->
        <?endforeach?>

    </div><!--card-docs-->

</div><!--card-block-->
<?endif?>

<div class="card-block">
    <a class="card-block__regio-link" href="<?=$this->createUrl('/region/social/', array('id' => $project->region_id))?>"><?=Yii::t('main','Страница региона');?></a>
    <h2 class="card-block__title">
        <i class="icon icon-prof-4"></i>
        <span><?=Yii::t('main','Место реализации проекта');?></span>
    </h2>

    <p class="card-block__address">
        <?=strip_tags($project->has_user_company ? $project->user->company_address : $project->investment->company_legal);?>
    </p>

    <div id="card-map">
        <? $this->widget('Map', array(
            'projects'=>array($project),
            'htmlOptions'=>array(
                'style'=>'height: 364px;width:100%;'
            )
        )); ?>
    </div>

</div><!--card-block-->

<div class="card-block clear-fix card-block_about">
    <h2 class="card-block__title">
        <i class="icon icon-prof-5"></i>
        <span><?=Yii::t('main','Описание проекта');?></span>
    </h2>

    <?if(!empty($project->investment->video_frame)){?>
        <iframe width="440" height="265" src="<?= $project->investment->video_frame?>" frameborder="0" allowfullscreen></iframe>
    <?}?>

    <div class="card-about<?=empty($project->investment->video_frame) ? '_full' : ''?> card-about__desc_block">
        <? $desc = trim($project->investment->full_description);?>
        <?= !empty($desc)? $project->investment->full_description : $project->investment->short_description?>
        <!--a class="card-about__view-all" href="#"><?=Yii::t('main','Показать еще');?></a-->

    </div><!--card-about-->

</div><!--card-block-->