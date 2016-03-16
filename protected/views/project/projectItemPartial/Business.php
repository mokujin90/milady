<p class="project__desc"><?=CHtml::encode($model->businesses->short_description)?></p>

<div class="spacer">
    <div class="project-params">
        <div class="project-param">
            <span class="project-param__icon-wrap">
                <i class="icon icon-param-7"></i>
            </span>
            <span class="project-param__name">
                <?=Yii::t('main', 'Отрасль')?>
            </span>
            <?$tmp = Project::getIndustryTypeDrop()?>
            <span class="project-param__desc">
                <?=$tmp[$model->industry_type]?>
            </span>
        </div><!--project-param-->

        <div class="project-param">
            <span class="project-param__icon-wrap">
                <i class="icon icon-param-8"></i>
            </span>
            <span class="project-param__name">
                <?=Yii::t('main', 'Стоимость бизнеса')?>
            </span>
            <span class="project-param__desc">
                <?=Candy::formatNumber($model->businesses->price)?> <i class="icon icon-rub-black"></i>
            </span>
        </div><!--project-param-->

    </div><!--project-params-->

    <div class="project-params">
        <div class="project-param project-param_fix">
            <span class="project-param__icon-wrap">
                <i class="icon icon-param-9"></i>
            </span>
            <span class="project-param__name project-param__name_fix">
                <?=Yii::t('main', 'Доля')?>
            </span>
            <span class="project-param__desc">
                <?=$model->businesses->share?>%
            </span>

        </div><!--project-param-->

    </div><!--project-params-->

</div><!--spacer-->
