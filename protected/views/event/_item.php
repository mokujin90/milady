<div class="record news event">
    <?if($model):?>
    <a href="<?=$model->createUrl()?>">
        <?=$model->media?Candy::preview(array($model->media, 'scale' => '316x112', 'class' => 'image')):''?>
    </a>
    <div class="text-block">
        <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(),array('class'=>'caption'))?>
        <?=!empty($model->announce)? "<div class='notice'>" . CHtml::encode($model->announce) . "</div>": ''?>
    </div>
    <hr/>
    <?else:?>
        Мероприятий нет.
    <?endif?>
</div>