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

    <div class="map-project-right">
        <p class="map-project__name map-project__name_small"><?=CHtml::encode($model->name)?></p>
        <?$dateVal = new DateTime($model->create_date)?>
        <p class="map-project__date">
            <em><?=$dateVal->format('d.m.Y')?></em> / <?=$dateVal->format('H:i')?>
        </p>

        <p class="map-project-reviews">
            <span class="map-project-reviews__count"><?=$model->commentCount?></span>
            <a class="map-project-reviews__link" href="#"><?=Candy::getNumEnding($model->commentCount,array(Yii::t('main','Комментарий'),Yii::t('main','Комментария'),Yii::t('main','Комментариев')))?></a>
        </p>

    </div><!--map-project-right-->

    <!--p class="map-project__desc"> </p-->

    <ul class="map-project-params">
        <li class="map-project-param">
                <span class="map-project-param__icon-wrap">
                    <i class="icon icon-map-project-1 pos-center"></i>
                </span>
            <span class="map-project-param__name">Сумма инвестиций</span>
                <span class="map-project-param__desc">
                    <?=$model->investment_sum?> млн.
                    <i class="icon icon-rub"></i>
                </span>
        </li>

        <li class="map-project-param">
                <span class="map-project-param__icon-wrap">
                    <i class="icon icon-map-project-2 pos-center"></i>
                </span>
            <span class="map-project-param__name">Срок окупаемости</span>
            <span class="map-project-param__desc"><?=$model->period?> лет</span>
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
                    <?=$model->profit_clear?> млн.
                    <i class="icon icon-rub"></i>
                </span>
        </li>

    </ul>

</div><!--map-project-->