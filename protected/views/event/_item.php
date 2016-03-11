<div class="event clear-fix">
    <?if($model):?>
        <div class="event__img-wrap">
            <?=$model->media?Candy::preview(array($model->media, 'scale' => '316x112', 'class' => 'image')):''?>
        </div><!--event__img-wrap-->

        <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(),array('class'=>'event__title'))?>
        <?=!empty($model->announce)? "<p class='event__desc'>" . CHtml::encode($model->announce) . "</p>": ''?>

    <?else:?>
        Мероприятий нет.
    <?endif?>

</div><!--event-->