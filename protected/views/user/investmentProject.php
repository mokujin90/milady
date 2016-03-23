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
                    <?php echo $form->labelEx($model,'industry_type',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model,'industry_type',Project::getIndustryTypeDrop(),array('class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model,'industry_type'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'short_description',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'short_description',array('class' => 'description-counter form-control','rows'=>4)); ?>
                        <?php echo $form->error($model->investment,'short_description'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'full_description',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'full_description',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->investment,'full_description'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'video_frame',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'video_frame',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investment,'video_frame'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'address',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'address',array('placeholder'=>Makeup::holder(), 'class' => 'form-control')); ?>
                        <?php echo $form->error($model->investment,'address'); ?>
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
                    <?php echo $form->labelEx($model->investment,'market_size',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <div class="input-group">
                            <?php echo $form->textField($model->investment,'market_size',array('class' => 'form-control')); ?>
                            <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                        </div>
                        <?php echo $form->error($model->investment,'market_size'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'project_price',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <div class="input-group">
                            <?php echo $form->textField($model->investment,'project_price',array('class' => 'form-control')); ?>
                            <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                        </div>
                        <?php echo $form->error($model->investment,'project_price'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'investment_formFormat',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model->investment,'investment_formFormat',ReferenceFinanceType::getList(),array('multiple'=>true,'class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model->investment,'investment_formFormat'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'investment_sum',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <div class="input-group">
                            <?php echo $form->textField($model,'investment_sum',array('class' => 'form-control')); ?>
                            <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                        </div>
                        <?php echo $form->error($model,'investment_sum'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'investment_directionFormat',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model->investment,'investment_directionFormat',InvestmentProject::getInvestmentDirectionDrop(),array('multiple'=>true,'class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model->investment,'investment_directionFormat'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'term_finance',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'term_finance',array('class' => 'form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->investment,'term_finance'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->

            </div>
        </div>
        <?=$this->renderPartial('application.views.user._contact',array('model'=>$model,'form'=>$form))?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Информация о компании (Инициатор)')?>
            </div>
            <div class="panel-body">
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

                    <div class="toggle form-group padding-sm" style="<?if($model->has_user_company):?>display: none;<?endif;?>">
                        <div class="form-group">
                            <?php echo $form->labelEx($model->investment,'company_name',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model->investment,'company_name',array('class' => 'form-control')); ?>
                                <?php echo $form->error($model->investment,'company_name'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <?php echo $form->labelEx($model->investment,'company_email',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model->investment,'company_email',array('class' => 'form-control')); ?>
                                <?php echo $form->error($model->investment,'company_email'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <?php echo $form->labelEx($model->investment,'company_phone',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model->investment,'company_phone',array('class' => 'form-control phone-mask')); ?>
                                <?php echo $form->error($model->investment,'company_phone'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <?php echo $form->labelEx($model->investment,'company_inn',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model->investment,'company_inn',array('class' => 'form-control')); ?>
                                <?php echo $form->error($model->investment,'company_inn'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <?php echo $form->labelEx($model->investment,'company_ogrn',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model->investment,'company_ogrn',array('class' => 'form-control')); ?>
                                <?php echo $form->error($model->investment,'company_ogrn'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <?php echo $form->labelEx($model->investment,'company_area',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?=$form->dropDownList($model->investment,'company_area',Project::getIndustryTypeDrop(),array('class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                                <?php echo $form->error($model->investment,'company_area'); ?>
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
                                <?php echo $form->textArea($model->investment,'company_description',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                                <?php echo $form->error($model->investment,'company_description'); ?>
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
                    <?php echo $form->labelEx($model->investment,'org_plan_file_id', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                    <div class="col-xs-12 col-sm-10 file-block">
                        <?if($model->investment->org_plan_file):?>
                            <?= CHtml::link('Скачать',$model->investment->org_plan_file->makeWebPath(),array('style'=>'float: left;', 'class' => 'label label-success', 'target' => '_blank'))?>
                            <br>
                        <?endif?>
                        <?php
                        $this->widget('application.components.MediaEditor.MediaEditor',
                            array('data' => array(
                                'items' => null,
                                'field' => 'org_plan_file_id',
                                'item_container_id' => 'file_block_org',
                                'button_image_url' => '/images/markup/logo.png',
                                'button_width' => 28,
                                'button_height' => 28,
                            ),
                                'callback'=>'admin',
                                'fileTypes'=>'doc,docx,pdf,txt,xls,ppt,pptx',
                                'scale' => '300x160',
                                'scaleMode' => 'in',
                                'fileUploadLimit' => '20mb',
                                'fileUploadLimitText' => '20 mb',
                                'needfields' => 'false'));
                        ?>
                        <?php echo CHtml::button(Yii::t('main','Загрузить документ'),array('style'=>'float: left;','class'=>'open-dialog btn btn-primary m-right-xs'))?>
                        <?php if($model->investment->org_plan_file):?>
                            <?php echo CHtml::button(Yii::t('main','Удалить'),array('class'=>'delete-media-button btn'))?>
                        <?php endif;?>
                        <div class="hidden" >
                            <span id="file_block_org" class="rel file_block_rel">
                                <?php echo CHtml::hiddenField('org_plan_file_id',$model->investment->org_plan_file_id)?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'stage_project',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model->investment,'stage_project',Project::getProjectStepDrop(),array('class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model->investment,'stage_project'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'capital_dev',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'capital_dev',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->investment,'capital_dev'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'equipment',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'equipment',array('class' => 'ckeditor form-control','rows'=>8)); ?>
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
                    <?php echo $form->labelEx($model->investment,'prod_plan_file_id', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                    <div class="col-xs-12 col-sm-10 file-block">
                        <?if($model->investment->prod_plan_file):?>
                            <?= CHtml::link('Скачать',$model->investment->prod_plan_file->makeWebPath(),array('style'=>'float: left;', 'class' => 'label label-success', 'target' => '_blank'))?>
                            <br>
                        <?endif?>
                        <?php
                        $this->widget('application.components.MediaEditor.MediaEditor',
                            array('data' => array(
                                'items' => null,
                                'field' => 'prod_plan_file_id',
                                'item_container_id' => 'file_block_prod',
                                'button_image_url' => '/images/markup/logo.png',
                                'button_width' => 28,
                                'button_height' => 28,
                            ),
                                'callback'=>'admin',
                                'fileTypes'=>'doc,docx,pdf,txt,xls,ppt,pptx',
                                'scale' => '300x160',
                                'scaleMode' => 'in',
                                'fileUploadLimit' => '20mb',
                                'fileUploadLimitText' => '20 mb',
                                'needfields' => 'false'));
                        ?>
                        <?php echo CHtml::button(Yii::t('main','Загрузить документ'),array('style'=>'float: left;','class'=>'open-dialog btn btn-primary m-right-xs'))?>
                        <?php if($model->investment->prod_plan_file):?>
                            <?php echo CHtml::button(Yii::t('main','Удалить'),array('class'=>'delete-media-button btn'))?>
                        <?php endif;?>
                        <div class="hidden">
                            <span id="file_block_prod" class="rel file_block_rel">
                                <?php echo CHtml::hiddenField('prod_plan_file_id',$model->investment->prod_plan_file_id)?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'products',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'products',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->investment,'products'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'max_products',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'max_products',array('class' => 'ckeditor form-control','rows'=>8)); ?>
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
                    <?php echo $form->labelEx($model->investment,'finance_plan_file_id', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                    <div class="col-xs-12 col-sm-10 file-block">
                        <?if($model->investment->finance_plan_file):?>
                            <?= CHtml::link('Скачать',$model->investment->finance_plan_file->makeWebPath(),array('style'=>'float: left;', 'class' => 'label label-success', 'target' => '_blank'))?>
                            <br>
                        <?endif?>
                        <?php
                        $this->widget('application.components.MediaEditor.MediaEditor',
                            array('data' => array(
                                'items' => null,
                                'field' => 'finance_plan_file_id',
                                'item_container_id' => 'file_block_finance',
                                'button_image_url' => '/images/markup/logo.png',
                                'button_width' => 28,
                                'button_height' => 28,
                            ),
                                'callback'=>'admin',
                                'fileTypes'=>'doc,docx,pdf,txt,xls,ppt,pptx',
                                'scale' => '300x160',
                                'scaleMode' => 'in',
                                'fileUploadLimit' => '20mb',
                                'fileUploadLimitText' => '20 mb',
                                'needfields' => 'false'));
                        ?>
                        <?php echo CHtml::button(Yii::t('main','Загрузить документ'),array('style'=>'float: left;','class'=>'open-dialog btn btn-primary m-right-xs'))?>
                        <?php if($model->investment->finance_plan_file):?>
                            <?php echo CHtml::button(Yii::t('main','Удалить'),array('class'=>'delete-media-button btn'))?>
                        <?php endif;?>
                        <div class="hidden" >
                            <span id="file_block_finance" class="rel file_block_rel">
                                <?php echo CHtml::hiddenField('finance_plan_file_id',$model->investment->finance_plan_file_id)?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'finance_plan',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <div class="grid-widget">
                        <table class=" crud-grid-table table" ajax="" style="font-size: 12px;text-align: center;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><?=Yii::t('main','1 год');?></th>
                                    <th><?=Yii::t('main','2 год');?></th>
                                    <th><?=Yii::t('main','3 год');?></th>
                                </tr>
                            </thead>

                            <tbody>
                            <?$financePlan = CJSON::decode($model->investment->finance_plan);?>
                            <?foreach(InvestmentProject::getFinancePlanData() as $key => $item):?>
                                <tr>
                                    <td><?=$item['title'];?></td>
                                    <?for($i=0;$i<3;$i++):?>
                                        <td>

                                            <?
                                                $value = isset($financePlan[$i]) ? $financePlan[$i][$key] : '';
                                                echo CHtml::textField("finance_plan[{$i}][{$key}]",$value,array('class'=>"form-control numeric"));
                                            ?>
                                        </td>
                                    <?endfor;?>
                                </tr>
                            <?endforeach;?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'fin_revenue',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <div class="input-group">
                            <?php echo $form->textField($model->investment,'fin_revenue',array('class' => 'form-control')); ?>
                            <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                        </div>
                        <?php echo $form->error($model->investment,'fin_revenue'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'no_finCleanRevenue',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'no_finCleanRevenue',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->investment,'no_finCleanRevenue'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo CHtml::label(Yii::t('main','Финансовые показатели (за 3 последних года'),'',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'finance',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->investment,'finance'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'profit',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <div class="input-group">
                            <?php echo $form->textField($model->investment,'profit',array('class' => 'form-control')); ?>
                            <span class="input-group-addon">%</span>
                        </div>
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
                        <div class="input-group">
                            <?php echo $form->textField($model,'profit_clear',array('class' => 'form-control')); ?>
                            <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                        </div>
                        <?php echo $form->error($model,'profit_clear'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'profit_norm',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <div class="input-group">
                            <?php echo $form->textField($model,'profit_norm',array('class' => 'form-control')); ?>
                            <span class="input-group-addon">%</span>
                        </div>
                        <?php echo $form->error($model,'profit_norm'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investment,'guarantee',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investment,'guarantee',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->investment,'guarantee'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="button-panel center">
            <?=CHtml::submitButton($model->isNewRecord ? Yii::t('main','Создать') : Yii::t('main','Сохранить'),array('class'=>'btn btn-success'))?>
            <?if(isset($admin) && !$model->isNewRecord):?>
                <?=CHtml::submitButton('Применить', array('class'=>'btn', 'name'=>'update')); ?>
                <?if($model->status != 'approved'):?>
                    <?=CHtml::submitButton('Одобрить проект', array('class'=>'btn')); ?>
                <?endif?>
            <?endif?>
        </div>
    <?php if(!isset($admin)):?>
        <?php $this->endWidget(); ?>
    <?php endif;?>
</div>
