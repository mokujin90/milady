<p class="project__desc"><?=nl2br(CHtml::encode($model->investment->short_description))?></p>

<div class="spacer">
    <div class="project-params">
        <div class="project-param">
            <span class="project-param__icon-wrap">
                <i class="icon icon-param-1"></i>
            </span>
            <span class="project-param__name">
                <?=Yii::t('main', 'Сумма инвестиций')?>
            </span>
            <span class="project-param__desc">
                <?=Candy::formatNumber($model->investment_sum)?> <i class="icon icon-rub-black"></i>
            </span>
        </div><!--project-param-->

        <!--div class="project-param">
            <span class="project-param__icon-wrap">
                <i class="icon icon-param-2"></i>
            </span>
            <span class="project-param__name">
                <?=Yii::t('main', 'Общий объем <br/> инвестиций')?>
            </span>
            <span class="project-param__desc">
                ?
            </span>
        </div--><!--project-param-->

    </div><!--project-params-->

    <div class="project-params">
        <div class="project-param">
            <span class="project-param__icon-wrap">
                <i class="icon icon-param-3"></i>
            </span>
            <span class="project-param__name">
                <?=Yii::t('main', 'Внутрення норма доходности')?>
            </span>
            <span class="project-param__desc">
                <?=$model->profit_norm?>%
            </span>
        </div><!--project-param-->

        <div class="project-param">
            <span class="project-param__icon-wrap">
                <i class="icon icon-param-4"></i>
            </span>
            <span class="project-param__name">
                <?=Yii::t('main', 'Чистый дисконтированный <br/> доход')?>
            </span>
            <span class="project-param__desc">
                <?=Candy::formatNumber($model->profit_clear)?> <i class="icon icon-rub-black"></i>
            </span>
        </div><!--project-param-->
    </div><!--project-params-->
</div><!--spacer-->