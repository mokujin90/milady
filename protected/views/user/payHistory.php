<?php
/**
 * @var array $data
 */
?>
<div class="panel-tab clearfix" style="border-bottom: 1px solid #eee;">
    <ul class="tab-bar">
        <li class="active"><a href="/user/payHistory/"><i class="fa fa-dollar fa-fw"></i> История оплат</a></li>
        <li><a href="/user/service"><i class="fa fa-list fa-fw"></i> Подключенные услуги</a></li>
        <li><a href="/user/addBalance"><i class="fa fa-plus fa-fw"></i> Пополнение баланса</a></li>
    </ul>
</div>
<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'region-content-form',
            'enableAjaxValidation'=>false,
        )); ?>
        <div id="history" class="content columns">
            <div class="main-column">
                <div class="full-column opacity-box overflow" style="padding: 30px;">
                    <div class="row project list">
                        <?if(empty($data)):?>
                            <p>Список пуст</p>
                        <?else:?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <th><?= Yii::t('main','Тип транзакции')?></th>
                                <th><?= Yii::t('main','Разница')?></th>
                                <th><?= Yii::t('main','Дата')?></th>
                                <th><?= Yii::t('main','Описание')?></th>
                                </thead>
                                <?foreach($data as $item):?>
                                    <tr class="item">
                                        <td><?=BalanceHistory::getType($item['object_type'])?></td>
                                        <td><?=$item['delta']?></td>
                                        <td><?=$item['date']?></td>
                                        <td><?=$item['description']?></td>
                                    </tr>
                                <?endforeach?>
                            </table>
                        </div>
                        <?endif?>
                    </div>
                    <div class="row">
                        <b>Текущий баланс: <?=Balance::get($this->user->id)->value?></b>
                    </div>
                </div>
            </div>
        </div>
        <? $this->endWidget(); ?>
    </div>
</div>