<?php
/**
 *
 * @var ProjectController $this
 * @var Project2File[] $models
 */
?>
<script type="text/javascript">
    $(".fancybox").fancybox({
        openEffect	: 'none',
        closeEffect	: 'none',
        helpers: {
            overlay: {
                locked: false
            }
        }
    });
</script>
<div class="attached gallery image">
    <?php if(count($models)):?>
    <?foreach($models as $model):?>
        <a class="fancybox" rel="project" href="<?=$model->media->makeWebPath()?>">
            <?=Candy::preview(array($model->media,'scale'=>'300x300'))?>
        </a>
    <?endforeach;?>
    <?php else:?>
        <?= Yii::t('main','Для данного проекта фотографий не найдено')?>
    <?php endif;?>
</div>