<?php
/**
 *
 * @var UserController $this
 * @var InvestmentProject $model
 * @var CActiveForm $form
 */
/*$finance = count($model->investment->financeFormat) ? $model->investment->financeFormat : array('one'=>'','two'=>'','three'=>'');
$no_finRevenueFormat = count($model->investment->no_finRevenueFormat) ? $model->investment->no_finRevenueFormat : array('one'=>'','two'=>'','three'=>'');
$no_finCleanRevenueFormat = count($model->investment->no_finCleanRevenueFormat) ? $model->investment->no_finCleanRevenueFormat : array('one'=>'','two'=>'','three'=>'');*/
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
        <?if(count($model->errors) || count($model->investment->errors)){?>
            <div class="alert alert-danger padding-md">
                <?= $form->errorSummary(array($model, $model->investment)); ?>
            </div>
        <? }?>
        <?$this->renderPartial('/partial/_commonProjectAttr',array('model'=>$model,'content'=>Project::T_INVEST,'form'=>$form));?>
        <?$this->renderPartial('/user/_projectNews',array('model'=>$model));?>
        <? //$this->renderPartial('/user/_request',array('model'=>$model));?>
    <?php endif;?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Резюме проекта')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model,'name',array('class' => 'col-lg-2 control-label', 'label'=>Yii::t('main','Название инвестиционного проекта'))); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'name',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'name'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'company_area',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?$this->widget('crud.dropDownList',
                            array('model'=>$model->investment, 'attribute'=>'company_area','elements'=>Project::getIndustryTypeDrop(),
                                'options'=>array('multiple'=>false,'label'=>true,'show_required'=>false)
                            ));?>
                        <?php echo $form->error($model->investment,'company_area'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'short_description',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'short_description',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investment,'short_description'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'full_description',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'full_description',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'full_description'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'address',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'address',array('placeholder'=>Makeup::holder(), 'class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'address'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'region_id',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?$this->widget('crud.dropDownList',
                            array('model'=>$model, 'attribute'=>'region_id','elements'=>CHtml::listData($regions,'id','name'),
                                'options'=>array('multiple'=>false,'label'=>true,'show_required'=>false)
                            ));?>
                        <?php echo $form->error($model->investment,'region_id'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'market_size',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investment,'market_size',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investment,'market_size'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'project_price',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investment,'project_price',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investment,'project_price'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <div class="col-lg-10">
                        <?$this->widget('crud.dropDownList',array('model'=>$model->investment, 'attribute'=>'investment_formFormat','elements'=>Project::getFinanceTypeDrop(),
                            'options'=>array('multiple'=>true,'label'=>true)));?>
                        <?php echo $form->error($model->investment,'investment_formFormat'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'investment_sum',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'investment_sum',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'investment_sum'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Резюме проекта')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-10">
                        <?$this->widget('crud.dropDownList',array('model'=>$model->investment, 'attribute'=>'investment_directionFormat','elements'=>InvestmentProject::getInvestmentDirectionDrop(),
                            'options'=>array('multiple'=>true,'label'=>true)));?>
                        <?php echo $form->error($model->investment,'investment_directionFormat'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'term_finance',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'term_finance',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'term_finance'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'financing_terms',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'financing_terms',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'financing_terms'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>
        <?=$this->renderPartial('application.views.user._contact',array('model'=>$model,'form'=>$form))?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Информация о компании (инициатор инновационного проекта)')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-10">
                        <?$this->widget('crud.dropDownList',array('model'=>$model->investment, 'attribute'=>'investment_directionFormat','elements'=>InvestmentProject::getInvestmentDirectionDrop(),
                            'options'=>array('multiple'=>true,'label'=>true)));?>
                        <?php echo $form->error($model->investment,'investment_directionFormat'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'term_finance',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'term_finance',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'term_finance'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'financing_terms',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'financing_terms',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'financing_terms'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="company-info">
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
                            <?php echo $form->labelEx($model->investment,'company_name',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model->investment,'company_name',array('class' => 'form-control')); ?>
                                <?php echo $form->error($model->investment,'company_name'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <?php echo $form->labelEx($model->investment,'company_legal',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model->investment,'company_legal',array('placeholder'=>Makeup::holder(), 'class' => 'form-control')); ?>
                                <?php echo $form->error($model->investment,'company_legal'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <?php echo $form->labelEx($model->investment,'company_description',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model->investment,'company_description',array('class' => 'ckeditor form-control')); ?>
                                <?php echo $form->error($model->investment,'company_description'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <?php echo $form->labelEx($model->investment,'company_area',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?$this->widget('crud.dropDownList',
                                    array('model'=>$model->investment, 'attribute'=>'company_area','elements'=>Project::getIndustryTypeDrop(),
                                        'options'=>array('multiple'=>false),
                                    ));?>
                                <?php echo $form->error($model->investment,'company_area'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Организационный план')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'stage_project',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?$this->widget('crud.dropDownList',
                            array('model'=>$model->investment, 'attribute'=>'stage_project','elements'=>Project::getProjectStepDrop(),
                                'options'=>array('multiple'=>false,'label'=>true,'show_required'=>false)));?>
                        <?php echo $form->error($model->investment,'stage_project'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'capital_dev',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'capital_dev',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'capital_dev'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'equipment',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'equipment',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'equipment'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Производственный план')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'products',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'products',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'products'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'max_products',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'max_products',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'max_products'); ?>
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
                    <?php echo $form->labelEx($model->investment,'no_finRevenue',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'no_finRevenue',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'no_finRevenue'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'no_finCleanRevenue',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'no_finCleanRevenue',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'no_finCleanRevenue'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo CHtml::label(Yii::t('main','Финансовые показатели (за 3 последних года'),'',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'finance',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'finance'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'profit',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investment,'profit',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investment,'profit'); ?>
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
                    <?php echo $form->labelEx($model->investment,'guarantee',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'guarantee',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->investment,'guarantee'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

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
