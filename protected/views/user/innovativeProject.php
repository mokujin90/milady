<?php
/**
 *
 * @var UserController $this
 * @var InnovativeProject $model->innovative
 * @var CActiveForm $form
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
<div id="general" class="padding-md">

        <?php if(!isset($admin)):?>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'user-form',
                'enableAjaxValidation'=>false,
                'htmlOptions'=>array(
                    "onkeypress"=>"return event.keyCode != 13;",
                    'class' => 'form-horizontal no-margin form-border'
                ),
            )); ?>
            <?if(count($model->errors) || count($model->innovative->errors)){?>
                <div class="alert alert-danger padding-md">
                    <?= $form->errorSummary(array($model, $model->innovative)); ?>
                </div>
            <? }?>
            <? $this->renderPartial('/partial/_commonProjectAttr',array('model'=>$model,'content'=>Project::T_INNOVATE,'form'=>$form));?>
            <?$this->renderPartial('/user/_projectNews',array('model'=>$model));?>
            <?//$this->renderPartial('/user/_request',array('model'=>$model));?>
        <?php endif;?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Резюме проекта')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model,'name',array('class' => 'col-lg-2 control-label', 'label'=>Yii::t('main','Название инновационного проекта'))); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'name',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'name'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'project_description',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->innovative,'project_description',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->innovative,'project_description'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'project_history',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->innovative,'project_history',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->innovative,'project_history'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'region_id',array('label'=>Yii::t('main','Место реализации проекта (регион)'), 'class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model,'region_id',CHtml::listData($regions,'id','name'),array('class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model,'region_id'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'project_step', array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model->innovative,'project_step',Project::getProjectStepDrop(),array('class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model->innovative,'project_step'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'market_size',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->innovative,'market_size',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->innovative,'market_size'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'project_price',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->innovative,'project_price',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->innovative,'project_price'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'investment_sum',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'investment_sum',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'investment_sum'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'invest_way',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->innovative,'invest_way',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->innovative,'invest_way'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Описание проекта')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'product_description',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->innovative,'product_description',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->innovative,'product_description'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'relevance_type' ,array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model->innovative,'relevance_type',InnovativeProject::getRelevanceTypeDrop(),array('class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model->innovative,'relevance_type'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Финансовый план')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'profit',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->innovative,'profit',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->innovative,'profit'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'period',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'period',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'period'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'profit_clear',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'profit_clear',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'profit_clear'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'profit_norm',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'profit_norm',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'profit_norm'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'guarantee',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->innovative,'guarantee',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->innovative,'guarantee'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'structure',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->innovative,'structure',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->innovative,'structure'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Предложение инвестору')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'investment_goal',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->innovative,'investment_goal',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->innovative,'investment_goal'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'investment_typeFormat',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model->innovative,'investment_typeFormat',InnovativeProject::getInvestmentTypeDrop(),array('multiple'=>true,'class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model->innovative,'investment_typeFormat'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'finance_type',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model->innovative,'finance_type',Project::getFinanceTypeDrop(),array('class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model->innovative,'finance_type'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->

                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'financing_terms',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->innovative,'financing_terms',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->innovative,'financing_terms'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Риски проекта')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'swot',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->innovative,'swot',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->innovative,'swot'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Выход из проекта')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'strategy',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->innovative,'strategy',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->innovative,'strategy'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'exit_period',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->innovative,'exit_period',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->innovative,'exit_period'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'exit_price',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->innovative,'exit_price',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->innovative,'exit_price'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->innovative,'exit_multi',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->innovative,'exit_multi',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->innovative,'exit_multi'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>
        <?=$this->renderPartial('application.views.user._contact',array('model'=>$model,'form'=>$form))?>
        <script type="text/javascript">
            $(function() {
                $('.company-info #Project_has_user_company').change(function(){
                    var isShow = $(this).prop('checked');
                    if(isShow){
                        $('.company-info .toggle').hide();
                    }
                    else{
                        $('.company-info .toggle').show();
                    }
                });
            });
        </script>
        <div class="panel panel-default company-info">
            <div class="panel-heading">
                <?= Yii::t('main','Информация о компании (инициатор инновационного проекта)')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model,'has_user_company',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <label class="label-checkbox inline">
                            <?php echo $form->checkBox($model,'has_user_company'); ?>
                            <span class="custom-checkbox"></span>
                        </label>
                        <?php echo $form->error($model,'has_user_company'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="toggle form-group" style="<?if($model->has_user_company):?>display: none;<?endif;?>">
                    <div class="form-group">
                        <?php echo $form->labelEx($model->innovative,'company_name',array('class' => 'col-lg-2 control-label')); ?>
                        <div class="col-lg-10">
                            <?php echo $form->textField($model->innovative,'company_name',array('class' => 'form-control')); ?>
                            <?php echo $form->error($model->innovative,'company_name'); ?>
                        </div><!-- /.col -->
                    </div><!-- /form-group -->
                    <div class="form-group">
                        <?php echo $form->labelEx($model->innovative,'company_legal',array('class' => 'col-lg-2 control-label')); ?>
                        <div class="col-lg-10">
                            <?php echo $form->textArea($model->innovative,'company_legal',array('placeholder'=>Makeup::holder(), 'class' => 'ckeditor form-control','rows'=>8)); ?>
                            <?php echo $form->error($model->innovative,'company_legal'); ?>
                        </div><!-- /.col -->
                    </div><!-- /form-group -->
                    <div class="form-group">
                        <?php echo $form->labelEx($model->innovative,'company_info',array('class' => 'col-lg-2 control-label')); ?>
                        <div class="col-lg-10">
                            <?php echo $form->textArea($model->innovative,'company_info',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                            <?php echo $form->error($model->innovative,'company_info'); ?>
                        </div><!-- /.col -->
                    </div><!-- /form-group -->
                </div>
            </div>
        </div>
        <div class="button-panel center">
            <?=CHtml::submitButton($model->innovative->isNewRecord ? Yii::t('main','Создать') : Yii::t('main','Сохранить'),array('class'=>'btn btn-success'))?>
            <?if(isset($admin) && !$model->isNewRecord):?>
                <?=CHtml::submitButton('Применить', array('class'=>'btn', 'name'=>'update')); ?>
            <?endif?>
        </div>
    <?php if(!isset($admin)):?>
        <?php $this->endWidget(); ?>
    <?php endif;?>
</div>