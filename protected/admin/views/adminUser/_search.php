
<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>Yii::app()->createUrl($this->route),
            'method'=>'get',
            'htmlOptions' => array(
                'class' => 'form'
            )
        )); ?>
        <div class="form-group col-xs-6">
            <?php echo $form->label($model,'name'); ?>
            <?php echo $form->textField($model,'name',array('class' => 'form-control', 'size'=>60,'maxlength'=>255)); ?>
        </div>
        <div class="form-group col-xs-6">
            <label for="User_company_name">Наименование компании</label>
            <?php echo $form->textField($model,'company_name',array('class' => 'form-control', 'size'=>60,'maxlength'=>255)); ?>
        </div>
        <div class="form-group col-xs-6">
            <?php echo $form->label($model,'login'); ?>
            <?php echo $form->textField($model,'login',array('class' => 'form-control', 'size'=>60,'maxlength'=>255)); ?>
        </div>

        <div class="form-group col-xs-6">
            <?php echo $form->label($model,'region_id'); ?>
            <?php echo $form->dropDownList($model,'region_id',array('' => '---') + CHtml::listData(Region::model()->findAll(),'id','name'),array('class' => 'form-control')); ?>
        </div>

        <div class="form-group col-xs-6">
            <?php echo $form->label($model,'company_scope'); ?>
            <?php echo $form->dropDownList($model,'company_scope', array('' => '---') + Project::getIndustryTypeDrop(), array('class' => 'form-control')); ?>
        </div>

        <div class="form-group col-xs-6">
            <?php echo $form->label($model,'is_subscribe'); ?>
            <?php echo $form->dropDownList($model,'is_subscribe',array('' => '---', '0' => 'Без подписки', '1' => 'С подпиской'),array('class' => 'form-control')); ?>
        </div>

        <div class="form-group col-xs-6">
            <?php echo $form->label($model,'type'); ?>
            <?php echo $form->dropDownList($model,'type',array('' => '---', 'investor' => 'Инвестор', 'initiator' => 'Инициатор'),array('class' => 'form-control')); ?>
        </div>

        <div class="form-group col-xs-6">
            <label for="User_type">&nbsp;</label>
            <button type="submit" class="btn btn-success form-control btn-sm col-xs-6">Применить</button>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>





