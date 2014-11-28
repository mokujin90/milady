<?php
/**
 *
 * @var UserController $this
 * @var PsiWhiteSpace $model->businesses
 * @var #M#M#C\Region.model.findAll|? $regions
 * @var $form CActiveForm
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
<div class="profile" id="general">
    <div class="content columns">
        <?php if(!isset($admin)):?>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'user-form',
                'enableAjaxValidation'=>false,
            )); ?>

            <? $this->renderPartial('/partial/_leftColumn',array('model'=>$model,'content'=>Project::T_BUSINESS));?>
        <?php endif;?>

        <div class="main-column opacity-box">
            <div class="inner-column">
                <h2><?= Yii::t('main','Информация о продаваемом бизнесе')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField($model,'name'); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'history'); ?>
                    <?php echo $form->textArea($model->businesses,'history',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'history'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'leadership'); ?>
                    <?php echo $form->textField($model->businesses,'leadership',array()); ?>
                    <?php echo $form->error($model->businesses,'leadership'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'founders'); ?>
                    <?php echo $form->textField($model->businesses,'founders',array()); ?>
                    <?php echo $form->error($model->businesses,'founders'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'region_id','elements'=>CHtml::listData($regions,'id','name'),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model,'region_id'); ?>
                </div>
                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'object_type','elements'=>Project::getObjectTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model,'object_type'); ?>
                </div>
                <!--filter_fields-->
                <div class="row">
                    <?php echo $form->labelEx($model,'investment_sum'); ?>
                    <?php echo $form->textField($model,'investment_sum'); ?>
                    <?php echo $form->error($model,'investment_sum'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'period'); ?>
                    <?php echo $form->textField($model,'period'); ?>
                    <?php echo $form->error($model,'period'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'profit_norm'); ?>
                    <?php echo $form->textField($model,'profit_norm'); ?>
                    <?php echo $form->error($model,'profit_norm'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'profit_clear'); ?>
                    <?php echo $form->textField($model,'profit_clear'); ?>
                    <?php echo $form->error($model,'profit_clear'); ?>
                </div>
                <!--end-filter_fields-->
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'short_description'); ?>
                    <?php echo $form->textArea($model->businesses,'short_description',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'short_description'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'property'); ?>
                    <?php echo $form->textArea($model->businesses,'property',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'property'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'means'); ?>
                    <?php echo $form->textArea($model->businesses,'means',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'means'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'reserves'); ?>
                    <?php echo $form->textArea($model->businesses,'reserves',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'reserves'); ?>
                </div>

            </div>
            <div class="inner-column">



                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'assets'); ?>
                    <?php echo $form->textArea($model->businesses,'assets',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'assets'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'debts'); ?>
                    <?php echo $form->textArea($model->businesses,'debts',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'debts'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'has_bankruptcy'); ?>
                    <?php echo $form->radioButtonList($model->businesses,'has_bankruptcy',Project::getAnswer(),array('separator'=>'')); ?>
                    <?php echo $form->error($model->businesses,'has_bankruptcy'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'has_bail'); ?>
                    <?php echo $form->radioButtonList($model->businesses,'has_bail',Project::getAnswer(),array('separator'=>'')); ?>
                    <?php echo $form->error($model->businesses,'has_bail'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'other'); ?>
                    <?php echo $form->textArea($model->businesses,'other',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'other'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->businesses, 'attribute'=>'industry_type','elements'=>Project::getIndustryTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->businesses,'industry_type'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'share'); ?>
                    <?php echo $form->textField($model->businesses,'share'); ?>
                    <?php echo $form->error($model->businesses,'share'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'price'); ?>
                    <?php echo $form->textField($model->businesses,'price'); ?>
                    <?php echo $form->error($model->businesses,'price'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'address'); ?>
                    <?php echo $form->textField($model->businesses,'address',array()); ?>
                    <?php echo $form->error($model->businesses,'address'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'age'); ?>
                    <?php echo $form->textField($model->businesses,'age',array()); ?>
                    <?php echo $form->error($model->businesses,'age'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'revenue'); ?>
                    <?php echo $form->textField($model->businesses,'revenue',array()); ?>
                    <?php echo $form->error($model->businesses,'revenue'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'profit'); ?>
                    <?php echo $form->textField($model->businesses,'profit',array()); ?>
                    <?php echo $form->error($model->businesses,'profit'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'costs'); ?>
                    <?php echo $form->textField($model->businesses,'costs',array()); ?>
                    <?php echo $form->error($model->businesses,'costs'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'salary'); ?>
                    <?php echo $form->textField($model->businesses,'salary',array()); ?>
                    <?php echo $form->error($model->businesses,'salary'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->businesses, 'attribute'=>'role_type','elements'=>Business::getRoleTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->businesses,'role_type'); ?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="button-panel center">
                <?=CHtml::submitButton($model->isNewRecord ? Yii::t('main','Создать') : Yii::t('main','Сохранить'),array('class'=>'btn'))?>
            </div>
        </div>
        <?php if(!isset($admin)):?>
            <?php $this->endWidget(); ?>
        <?php endif;?>

    </div>
</div>