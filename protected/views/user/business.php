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
<div class="padding-md" id="general">
    <?php if(!isset($admin)):?>
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array(
                "onkeypress"=>"return event.keyCode != 13;",
                'class' => 'form-horizontal no-margin form-border'
            ),
        )); ?>
        <?if(count($model->errors) || count($model->businesses->errors)){?>
            <div class="alert alert-danger padding-md">
                <?= $form->errorSummary(array($model, $model->businesses)); ?>
            </div>
        <? }?>

        <? $this->renderPartial('/partial/_commonProjectAttr',array('model'=>$model,'content'=>Project::T_BUSINESS,'form'=>$form));?>
        <?$this->renderPartial('/user/_projectNews',array('model'=>$model));?>
        <?//$this->renderPartial('/user/_request',array('model'=>$model));?>
    <?php endif;?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Информация о компании')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model,'name',array('class' => 'col-lg-2 control-label', 'label'=>Yii::t('main','Название компании проекта'))); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'name',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'name'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'legal_address',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->businesses,'legal_address',array('placeholder'=>Makeup::holder(),'class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'legal_address'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'post_address',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->businesses,'post_address',array('placeholder'=>Makeup::holder(),'class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'post_address'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'phone',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->businesses,'phone',array('placeholder'=>Makeup::holder(1),'class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'phone'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'fax',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->businesses,'fax',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'fax'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'email',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->emailField($model->businesses,'email',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'email'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'leadership',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->businesses,'leadership',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'leadership'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'history',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->businesses,'history',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->businesses,'history'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'founders',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->businesses,'founders',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'founders'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'activity_sphere',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->businesses,'activity_sphere',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->businesses,'activity_sphere'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'other',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->businesses,'other',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->businesses,'other'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Информация о продаваемом бизнесе')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'business_name',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->businesses,'business_name',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'business_name'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'short_description',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->businesses,'short_description',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'short_description'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'industry_type',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model,'industry_type',Project::getIndustryTypeDrop(),array('class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model,'industry_type'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'share',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->businesses,'share',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'share'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'price',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->businesses,'price',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'price'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'region_id',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model,'region_id',CHtml::listData($regions,'id','name'),array('class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model,'region_id'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'address',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->businesses,'address',array('placeholder'=>Makeup::holder(),'class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'address'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'age',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->businesses,'age',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'age'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'revenue',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->businesses,'revenue',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'revenue'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'profit',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->businesses,'profit',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'profit'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'operational_cost',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->businesses,'operational_cost',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'operational_cost'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'wage_fund',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->businesses,'wage_fund',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->businesses,'wage_fund'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'debts',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->businesses,'debts',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->businesses,'debts'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'has_bankruptcy',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->radioButtonList($model->businesses,'has_bankruptcy',Project::getAnswer(),array('separator'=>'<br>')); ?>
                        <?php echo $form->error($model->businesses,'has_bankruptcy'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->businesses,'has_bail',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->radioButtonList($model->businesses,'has_bail',Project::getAnswer(),array('separator'=>'<br>')); ?>
                        <?php echo $form->error($model->businesses,'has_bail'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>
        <?=$this->renderPartial('application.views.user._contact',array('model'=>$model,'form'=>$form))?>
        <div class="button-panel center">
            <?=CHtml::submitButton($model->isNewRecord ? Yii::t('main','Создать') : Yii::t('main','Сохранить'),array('class'=>'btn btn-success'))?>
            <?if(isset($admin) && !$model->isNewRecord):?>
                <?=CHtml::submitButton('Применить', array('class'=>'btn', 'name'=>'update')); ?>
            <?endif?>
        </div>
    <?php if(!isset($admin)):?>
        <?php $this->endWidget(); ?>
    <?php endif;?>
</div>