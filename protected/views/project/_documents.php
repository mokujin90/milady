<?php
/**
 *
 * @var ProjectController $this
 * @var Project2File[] $models
 */
?>
<?php if(count($models)):?>
<table class="all-params even">
    <tbody>
    <? foreach ($models as $model): ?>
        <tr>
            <td><?=CHtml::encode($model->desc)?></td>
            <td class="value"><?=CHtml::link($model->name,$model->media->makeWebPath())?></td>
        </tr>
    <? endforeach ?>
    </tbody>
</table>
<?php else:?>
    <?= Yii::t('main','Для данного проекта документов не найдено')?>
<?php endif;?>