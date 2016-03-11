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
    <? if(isset($model->logo)):?>
    <div class="map-project__img-wrap">
        <?=Candy::preview(array($model->logo,'scale'=>'84x84'))?>
    </div><!--map-project__img-wrap-->
    <? endif;?>

    <p class="map-project__name"><?=$model->name?></p>

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

    <a href="<?=$model->createUrl()?>">
    <button class="red-btn map-project__btn">
        <span class="red-btn__text">Посмотреть проект</span>
        <i class="icon icon-arrow-right"></i>
    </button>
    </a>
</div>