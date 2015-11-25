<?php
/**
 *
 * @var BannerController $this
 * @var Banner[] $models
 */
?>
<div class="panel-tab clearfix" style="border-bottom: 1px solid #eee;">
    <ul class="tab-bar">
        <li <?=$type == 'feed' ? 'class="active"' : ''?>><a href="/banner/index/"><i class="fa fa-desktop fa-fw"></i> Объявления в ленте пользователя</a></li>
        <li <?=$type == 'target' ? 'class="active"' : ''?>><a href="/banner/index/type/target"><i class="fa fa-bullhorn fa-fw"></i> Таргетинг</a></li>
    </ul>
</div>
<div class="padding-md">
    <?if($type == 'target'){?>
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
                    <td><?=CHtml::link('<i class="fa fa-bar-chart fa-lg"></i> ' . Yii::t('main','Статистика'),array('stat','id'=>$model->id),array('class'=>'btn btn-xs btn-primary'))?></td>
                    <td><?=CHtml::link(Yii::t('main','Редактировать'),array('edit','id'=>$model->id),array('class'=>'btn btn-xs btn-primary'))?></td>
                    <td><?=CHtml::link(Yii::t('main','Удалить'),array('remove','id'=>$model->id),array('class'=>'btn btn-xs btn-danger'))?></td>
                </tr>
            <?endforeach?>
            </tbody>
        </table>
    </div>
    <?}?>
    <?if($type == 'feed'){?>
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
                    <td><?=CHtml::link('<i class="fa fa-bar-chart fa-lg"></i> ' . Yii::t('main','Статистика'),array('feedStat','id'=>$model->id),array('class'=>'btn btn-xs btn-primary'))?></td>
                    <td><?=CHtml::link(Yii::t('main','Редактировать'),array('feedEdit','id'=>$model->id),array('class'=>'btn btn-xs btn-primary'))?></td>
                </tr>
            <?endforeach?>
            </tbody>
        </table>
    </div>
    <?}?>
</div>

