<?php
/**
 *
 * @var ProjectController $this
 * @var Project $model
 * @var ActiveRecord $content
 * @var array $fields
 */
?>
<div class="map-project box ajax-balloon">
    <span class="map-project__close"></span>
    <p class="map-project__type">
        <i class="icon icon-map-type-<?=$model->type?>"></i>
        <span><?=$model->getStaticProjectType($model->type)?></span>
    </p>
    <div class="map-project__img-wrap">
        <?=isset($model->logo) ? Candy::preview(array($model->logo,'scale'=>'84x84')) : '<img src="/images/frontend/investors/investor-default.png">'?>
    </div><!--map-project__img-wrap-->

    <a href="<?=$model->createUrl()?>" class="map-project__name"><?=CHtml::encode($model->name)?></a>

    <ul class="map-project-params">
        <li class="map-project-param">
                <span class="map-project-param__icon-wrap">
                    <i class="icon icon-map-project-1 pos-center"></i>
                </span>
            <span class="map-project-param__name">Сумма инвестиций</span>
                <span class="map-project-param__desc">
                    <?=Candy::formatNumber($model->investment_sum)?>
                    <i class="icon icon-rub"></i>
                </span>
        </li>

        <li class="map-project-param">
                <span class="map-project-param__icon-wrap">
                    <i class="icon icon-map-project-2 pos-center"></i>
                </span>
            <span class="map-project-param__name">Срок окупаемости</span>
            <span class="map-project-param__desc"><?=(float)$model->period?> лет</span>
        </li>

        <li class="map-project-param">
                <span class="map-project-param__icon-wrap">
                    <i class="icon icon-map-project-3 pos-center"></i>
                </span>
            <span class="map-project-param__name">Внутренняя норма доходности</span>
            <span class="map-project-param__desc"><?=$model->profit_norm?> %</span>
        </li>

        <li class="map-project-param">
                <span class="map-project-param__icon-wrap">
                    <i class="icon icon-map-project-4 pos-center"></i>
                </span>
            <span class="map-project-param__name">Чистый дисконтированный доход</span>
                <span class="map-project-param__desc">
                    <?=Candy::formatNumber($model->profit_clear)?>
                    <i class="icon icon-rub"></i>
                </span>
        </li>

    </ul>

    <a href="<?=$model->createUrl()?>">
    <button class="red-btn map-project__btn">
        <span class="red-btn__text">Посмотреть проект</span>
        <i class="icon icon-arrow-right"></i>
    </button>
    </a>
</div>