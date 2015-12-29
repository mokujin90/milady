<?php
/**
 * @var array $data
 */
?>
<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'region-content-form',
            'enableAjaxValidation'=>false,
        )); ?>
        <div class="panel-heading">
            История оплат
        </div>
        <div id="history" class="content columns">
            <div class="main-column">
                <div class="full-column opacity-box overflow" style="padding: 30px;">
                    <div class="row project list">
                        <?if(empty($data)):?>
                            <p>Список пуст</p>
                        <?else:?>
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