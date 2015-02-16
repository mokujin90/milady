<?php
/**
 *
 * @var UserController $this
 * @var Businesses $model->businesses
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
                'htmlOptions'=>array(
                    "onkeypress"=>"return event.keyCode != 13;"
                )
            )); ?>

            <? $this->renderPartial('/partial/_leftColumn',array('model'=>$model,'content'=>Project::T_BUSINESS,'form'=>$form));?>
            <?$this->renderPartial('/user/_projectNews',array('model'=>$model));?>
            <?$this->renderPartial('/user/_request',array('model'=>$model));?>
        <?php endif;?>

        <div class="main-column opacity-box">
            <div class="inner-column">
                <h2><?= Yii::t('main','Информация о компании')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model,'name',array('label'=>Yii::t('main','Название компании'))); ?>
                    <?php echo $form->textField($model,'name'); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'legal_address'); ?>
                    <?php echo $form->textArea($model->businesses,'legal_address',array('placeholder'=>Makeup::holder(),'class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'legal_address'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'post_address'); ?>
                    <?php echo $form->textArea($model->businesses,'post_address',array('placeholder'=>Makeup::holder(),'class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'post_address'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'phone'); ?>
                    <?php echo $form->textField($model->businesses,'phone',array('placeholder'=>Makeup::holder(1))); ?>
                    <?php echo $form->error($model->businesses,'phone'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'fax'); ?>
                    <?php echo $form->textField($model->businesses,'fax',array()); ?>
                    <?php echo $form->error($model->businesses,'fax'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'email'); ?>
                    <?php echo $form->emailField($model->businesses,'email',array()); ?>
                    <?php echo $form->error($model->businesses,'email'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'leadership'); ?>
                    <?php echo $form->textField($model->businesses,'leadership',array()); ?>
                    <?php echo $form->error($model->businesses,'leadership'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'history'); ?>
                    <?php echo $form->textArea($model->businesses,'history',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'history'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'founders'); ?>
                    <?php echo $form->textField($model->businesses,'founders',array()); ?>
                    <?php echo $form->error($model->businesses,'founders'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'activity_sphere'); ?>
                    <?php echo $form->textArea($model->businesses,'activity_sphere',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'activity_sphere'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'other'); ?>
                    <?php echo $form->textArea($model->businesses,'other',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'other'); ?>
                </div>
                <h2><?= Yii::t('main','Информация о продаваемом бизнесе')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'business_name'); ?>
                    <?php echo $form->textField($model->businesses,'business_name',array()); ?>
                    <?php echo $form->error($model->businesses,'business_name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'short_description'); ?>
                    <?php echo $form->textArea($model->businesses,'short_description',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->businesses,'short_description'); ?>
                </div>
                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'industry_type','elements'=>Project::getIndustryTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model,'industry_type'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'share'); ?>
                    <?php echo $form->textField($model->businesses,'share'); ?>
                    <?php echo $form->error($model->businesses,'share'); ?>
                </div>


            </div>
            <div class="inner-column">
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'price'); ?>
                    <?php echo $form->textField($model->businesses,'price'); ?>
                    <?php echo $form->error($model->businesses,'price'); ?>
                </div>
                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'region_id','elements'=>CHtml::listData($regions,'id','name'),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model,'region_id'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'address'); ?>
                    <?php echo $form->textArea($model->businesses,'address',array('placeholder'=>Makeup::holder(),'class'=>'middle-textarea')); ?>
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
                    <?php echo $form->labelEx($model->businesses,'operational_cost'); ?>
                    <?php echo $form->textField($model->businesses,'operational_cost',array()); ?>
                    <?php echo $form->error($model->businesses,'operational_cost'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->businesses,'wage_fund'); ?>
                    <?php echo $form->textField($model->businesses,'wage_fund',array()); ?>
                    <?php echo $form->error($model->businesses,'wage_fund'); ?>
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
                <?=$this->renderPartial('application.views.user._contact',array('model'=>$model,'form'=>$form))?>
                <!--filter_fields-->
                <?=$this->renderPartial('_field_filter',array('model'=>$model,'form'=>$form))?>
                <!--end-filter_fields-->
            </div>
            <div class="clear"></div>
            <div class="button-panel center">
                <?=CHtml::submitButton($model->isNewRecord ? Yii::t('main','Создать') : Yii::t('main','Сохранить'),array('class'=>'btn'))?>
                <?if(isset($admin) && !$model->isNewRecord):?>
                    <?=CHtml::submitButton('Применить', array('class'=>'btn', 'name'=>'update')); ?>
                <?endif?>
            </div>
        </div>
        <?php if(!isset($admin)):?>
            <?php $this->endWidget(); ?>
        <?php endif;?>

    </div>
</div>