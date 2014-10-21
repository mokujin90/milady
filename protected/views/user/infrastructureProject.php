<?php
/**
 *
 * @var UserController $this
 * @var InvestmentProject $model
 */
?>
<style>
    .red-box {
        background: #F00;
        font-size: 12px;
        line-height: 20px;
        width: 120px;
    }
</style>
<div id="general">
    <div class="content columns">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>false,
        )); ?>
        <? $this->renderPartial('/partial/_leftColumn',array('model'=>$model,'content'=>Project::T_INFRASTRUCT));?>
        <div class="main-column opacity-box">
            <div class="inner-column">
                <h2><?= Yii::t('main','Общие сведения')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField($model,'name'); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'region_id','elements'=>CHtml::listData($regions,'id','name'),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model,'region_id'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->infrastructure,'short_description'); ?>
                    <?php echo $form->textArea($model->infrastructure,'short_description',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->infrastructure,'short_description'); ?>
                </div>

            </div>
            <div class="inner-column">
                <div class="row">
                    <?php echo $form->labelEx($model->infrastructure,'investment_sum'); ?>
                    <?php echo $form->textField($model->infrastructure,'investment_sum'); ?>
                    <?php echo $form->error($model->infrastructure,'investment_sum'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->infrastructure,'effect'); ?>
                    <?php echo $form->textArea($model->infrastructure,'effect',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->infrastructure,'effect'); ?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="button-panel center">
                <?=CHtml::submitButton($model->isNewRecord ? Yii::t('main','Создать') : Yii::t('main','Сохранить'),array('class'=>'btn'))?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>