<?php
/**
 *
 * @var BannerController $this
 * @var Banner[] $models
 */
?>
<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b><?= Yii::t('main','Таргетинг')?></b>
            <?=CHtml::link(Yii::t('main','Создать'), $this->createUrl('banner/edit'), array('class'=>'btn btn-xs btn-success pull-right'))?>
        </div>

        <table class="table table-striped" id="responsiveTable">
            <!--thead>
            <tr>
                <th></th>
                <th>Тип</th>
                <th>Название</th>
            </tr>
            </thead-->
            <tbody>
            <?if(empty($models)):?>
                <tr><td colspan="3">Список пуст</td></tr>
            <?endif?>
            <?foreach($models as $model):?>
                <tr class="item">
                    <td class="user-info"><?=CHtml::encode($model->url)?></td>
                    <td><?=$model->getStatus($model->status);?></td>
                    <td><?=$model->balance;?> <i class="fa fa-rub fa-lg"></i></td>
                    <td><?=$model->count_click?> <?=Candy::getNumEnding($model->count_click,array(Yii::t('main','клик'),Yii::t('main','клика'),Yii::t('main','кликов')))?></td>
                    <td><?=$model->count_view?> <?=Candy::getNumEnding($model->count_view,array(Yii::t('main','просмотр'),Yii::t('main','просмотра'),Yii::t('main','просмотров')))?></td>
                    <td><?=CHtml::link(Yii::t('main','Редактировать'),array('edit','id'=>$model->id),array('class'=>'btn btn-xs btn-primary'))?></td>
                    <td><?=CHtml::link(Yii::t('main','Удалить'),array('remove','id'=>$model->id),array('class'=>'btn btn-xs btn-danger'))?></td>
                </tr>
            <?endforeach?>
            </tbody>
        </table>
    </div>

    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b><?= Yii::t('main','Объявления в ленте пользователя')?></b>
            <?=CHtml::link(Yii::t('main','Создать'), $this->createUrl('banner/feedEdit'), array('class'=>'btn btn-xs btn-success pull-right'))?>
        </div>

        <table class="table table-striped" id="responsiveTable">
            <!--thead>
            <tr>
                <th></th>
                <th>Тип</th>
                <th>Название</th>
            </tr>
            </thead-->
            <tbody>
            <?if(empty($feedModels)):?>
                <tr><td colspan="3">Список пуст</td></tr>
            <?endif?>
            <?foreach($feedModels as $model):?>
                <tr class="item">
                    <td class="user-info"><?=CHtml::encode($model->url)?></td>
                    <td><?=$model->getStatus($model->status);?></td>
                    <td><?=CHtml::link('<i class="fa fa-bar-chart fa-lg"></i> ' . Yii::t('main','Статистика'),array('stat','id'=>$model->id),array('class'=>'btn btn-xs btn-primary'))?></td>
                    <td><?=CHtml::link(Yii::t('main','Редактировать'),array('feedEdit','id'=>$model->id),array('class'=>'btn btn-xs btn-primary'))?></td>
                </tr>
            <?endforeach?>
            </tbody>
        </table>
    </div>
</div>

