<p class="project__desc"><?=CHtml::encode($model->investmentSite->site_address)?></p>

<div class="project-params">
    <div class="project-param">
        <span class="project-param__icon-wrap">
            <i class="icon icon-param-5"></i>
        </span>
        <span class="project-param__name">
            <?=Yii::t('main', 'Тип площадки')?>
        </span>
        <?$tmp = InvestmentSite::getSiteTypeDrop()?>
        <span class="project-param__desc">
            <?=isset($tmp[$model->investmentSite->site_type]) ? $tmp[$model->investmentSite->site_type] : ''?>
        </span>
    </div><!--project-param-->

    <div class="project-param">
        <span class="project-param__icon-wrap">
            <i class="icon icon-param-6"></i>
        </span>
        <span class="project-param__name">
            <?=Yii::t('main', 'Площадь')?>
        </span>
        <span class="project-param__desc">
            <?=number_format($model->investmentSite->param_space, 2, ',', ' ')?> <?=Yii::t('main', 'км м')?>
        </span>
    </div><!--project-param-->

</div><!--project-params-->