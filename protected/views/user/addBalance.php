<div class="panel-tab clearfix" style="border-bottom: 1px solid #eee;">
    <ul class="tab-bar">
        <li><a href="/user/payHistory/"><i class="fa fa-dollar fa-fw"></i> История оплат</a></li>
        <li><a href="/user/service"><i class="fa fa-list fa-fw"></i> Подключенные услуги</a></li>
        <li class="active"><a href="/user/addBalance"><i class="fa fa-plus fa-fw"></i> Пополнение баланса</a></li>
    </ul>
</div>
<div class="padding-md">
    <div class="panel panel-default padding-md overflow-hidden">
        <?php $form=$this->beginWidget('CActiveForm',array('action'=>$this->createUrl('money/add'),'htmlOptions'=>array('class'=>'form-horizontal'))); ?>
                <div class="form-group">
                    <?=CHtml::label('Сумма','summary_money',array('class'=>'col-lg-2 control-label'))?>
                    <div class="col-lg-10">
                        <?=CHtml::textField('add_value','100',array('id'=>'summary_money','class'=>'form-control'))?>
                    </div>
                </div>
            <?=CHtml::submitButton('Пополнить',array('class'=>'btn btn-primary pull-right'))?>
    </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
