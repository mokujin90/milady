<div class="panel-tab clearfix" style="border-bottom: 1px solid #eee;">
    <ul class="tab-bar">
        <li><a href="/user/payHistory/"><i class="fa fa-dollar fa-fw"></i> История оплат</a></li>
        <li class="active"><a href="/user/service"><i class="fa fa-list fa-fw"></i> Подключенные услуги</a></li>
        <li><a href="/user/addBalance"><i class="fa fa-plus fa-fw"></i> Пополнение баланса</a></li>
    </ul>
</div>
<div class="padding-md">
    <div class="panel panel-default timeline-panel">
        <div class="panel-heading">
            <span class="label label-danger m-right-xs">Услуга действует</span>
            Подписка
        </div>
        <div class="panel-body">
            <p>Текущий срок действия до 25.01.2017</p>
            <label class="label-checkbox inline">
                <input type="hidden" value="0" name="conditions">
                <input name="conditions" value="1" checked="checked" type="checkbox">
                <span class="custom-checkbox"></span>
            </label>
            Принимаю условия &nbsp;&nbsp;&nbsp;&nbsp;
            <a class="btn btn-xs btn-default" href="#">Продлить</a>
        </div>
    </div>

    <?foreach($banner as $model):?>
        <div class="panel panel-default timeline-panel">
            <div class="panel-heading">
                <span class="label label-danger m-right-xs"><?=$model->getStatus($model->status);?></span>
                Таргетинг <?=CHtml::encode($model->url)?>
            </div>
            <div class="panel-body">
                Баланс: <?=$model->balance;?> <i class="fa fa-rub fa-lg"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                <?=CHtml::link(Yii::t('main','Пополнить'),array('banner/edit','id'=>$model->id),array('class'=>'btn btn-xs btn-default'))?>
            </div>
        </div>
    <?endforeach?>

    <?foreach($feedBanner as $model):?>
        <div class="panel panel-default timeline-panel">
            <div class="panel-heading">
                <span class="label label-danger m-right-xs"><?=$model->getStatus($model->status);?></span>
                Рекламная компания <?=CHtml::encode($model->url)?>
            </div>
            <div class="panel-body">
                Даты публикаций: <?=implode(', ', CHtml::listData($model->banner2Date,'id','publish_date'))?><br>
                <?=CHtml::link(Yii::t('main','Изменить'),array('banner/feedEdit','id'=>$model->id),array('class'=>'btn btn-xs btn-default'))?>
            </div>
        </div>
    <?endforeach?>
</div>