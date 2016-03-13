<p class="project__desc"><?=CHtml::encode($model->investment->short_description)?></p>

<div class="spacer">
    <div class="project-params">
        <div class="project-param">
            <span class="project-param__icon-wrap">
                <i class="icon icon-param-1"></i>
            </span>
            <span class="project-param__name">
                <?=Yii::t('main', 'Требуемое <br/> финансирование')?>
            </span>
            <span class="project-param__desc">
                ??? <?=Yii::t('main', 'млн')?> <i class="icon icon-rub-black"></i>
            </span>
        </div><!--project-param-->

        <div class="project-param">
            <span class="project-param__icon-wrap">
                <i class="icon icon-param-2"></i>
            </span>
            <span class="project-param__name">
                <?=Yii::t('main', 'Общий объем <br/> инвестиций')?>
            </span>
            <span class="project-param__desc">
                ?
            </span>
        </div><!--project-param-->

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
                <?=number_format($model->profit_clear, 0, ',', ' ')?> <?=Yii::t('main', 'млн')?> <i class="icon icon-rub-black"></i>
            </span>
        </div><!--project-param-->
    </div><!--project-params-->
</div><!--spacer-->