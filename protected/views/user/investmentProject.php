<?php
/**
 *
 * @var UserController $this
 * @var InvestmentProject $model
 * @var CActiveForm $form
 */
Yii::app()->clientScript->registerPackage('tinymce');
Yii::app()->clientScript->registerScript('edit', 'projectPart.init();', CClientScript::POS_READY);
$finance = count($model->investment->financeFormat) ? $model->investment->financeFormat : array('one'=>'','two'=>'','three'=>'');
$no_finRevenueFormat = count($model->investment->no_finRevenueFormat) ? $model->investment->no_finRevenueFormat : array('one'=>'','two'=>'','three'=>'');
$no_finCleanRevenueFormat = count($model->investment->no_finCleanRevenueFormat) ? $model->investment->no_finCleanRevenueFormat : array('one'=>'','two'=>'','three'=>'');
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
        <?php if(!isset($admin)):?>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'user-form',
                'enableAjaxValidation'=>false,
                'htmlOptions'=>array(
                    "onkeypress"=>"return event.keyCode != 13;"
                )
            )); ?>

            <?$this->renderPartial('/partial/_leftColumn',array('model'=>$model,'content'=>Project::T_INVEST,'form'=>$form));?>
            <?$this->renderPartial('/user/_projectNews',array('model'=>$model));?>
            <?$this->renderPartial('/user/_request',array('model'=>$model));?>
        <?php endif;?>

        <div class="main-column opacity-box">
            <div class="inner-column">
                <h2><?=Yii::t('main','Инфорация о компании (инициатор инвестиционного проекта)')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'company_name'); ?>
                    <?php echo $form->textField($model->investment,'company_name'); ?>
                    <?php echo $form->error($model->investment,'company_name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'company_legal'); ?>
                    <?php echo $form->textArea($model->investment,'company_legal',array('placeholder'=>Makeup::holder(),'class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'company_legal'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'company_description'); ?>
                    <?php echo $form->textArea($model->investment,'company_description',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'company_description'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'company_area'); ?>
                    <?php echo $form->textField($model->investment,'company_area'); ?>
                    <?php echo $form->error($model->investment,'company_area'); ?>
                </div>
                <h2><?= Yii::t('main','Финансовые показатели (за 3 последних года')?></h2>
                <div class="row">
                    <?$this->widget('crud.grid',
                        array('header'=>array('one'=>'2014 г.','two'=>'2013 г.','three'=>'2012 г.',),
                            'data'=>array($finance),
                            'name'=>'Finance',
                            'options'=>array('button'=>false)
                        ));?>
                </div>
                <?=$this->renderPartial('_contact',array('model'=>$model,'form'=>$form))?>
            </div>
            <div class="inner-column">
                <h2><?= Yii::t('main','Резюме проекта')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model,'name',array('label'=>Yii::t('main','Название инвестиционного проекта'))); ?>
                    <?php echo $form->textField($model,'name'); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'short_description'); ?>
                    <?php echo $form->textArea($model->investment,'short_description',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'short_description'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'address'); ?>
                    <?php echo $form->textArea($model->investment,'address',array('placeholder'=>Makeup::holder(),'class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'address'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'region_id'); ?>
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'region_id','elements'=>CHtml::listData($regions,'id','name'),
                            'options'=>array('multiple'=>false,'label'=>true,'show_required'=>false)
                        ));?>
                    <?php echo $form->error($model,'region_id'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'industry_type',array('label'=>Yii::t('main','Отрасль реализации'))); ?>
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'industry_type','elements'=>Project::getIndustryTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true,'show_required'=>false)
                        ));?>
                    <?php echo $form->error($model,'industry_type'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'market_size'); ?>
                    <?php echo $form->textField($model->investment,'market_size'); ?>
                    <?php echo $form->error($model->investment,'market_size'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'project_price'); ?>
                    <?php echo $form->textField($model->investment,'project_price'); ?>
                    <?php echo $form->error($model->investment,'project_price'); ?>
                </div>
                <div class="row">
                    <?$this->widget('crud.dropDownList',array('model'=>$model->investment, 'attribute'=>'investment_formFormat','elements'=>InnovativeProject::getFinanceTypeDrop(),
                        'options'=>array('multiple'=>true,'label'=>true)));?>
                    <?php echo $form->error($model->investment,'investment_formFormat'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'investment_sum'); ?>
                    <?php echo $form->textField($model,'investment_sum'); ?>
                    <?php echo $form->error($model,'investment_sum'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'investment_direction'); ?>
                    <?php echo $form->textArea($model->investment,'investment_direction',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'investment_direction'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'term_finance'); ?>
                    <?php echo $form->textArea($model->investment,'term_finance',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'term_finance'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'financing_terms'); ?>
                    <?php echo $form->textArea($model->investment,'financing_terms',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'financing_terms'); ?>
                </div>

            </div>
            <div class="clear"></div>
            <div class="row center">
                <h2><?= Yii::t('main','Организационный план')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'stage_project'); ?>
                    <?php echo $form->textField($model->investment,'stage_project'); ?>
                    <?php echo $form->error($model->investment,'stage_project'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'capital_dev'); ?>
                    <?php echo $form->textArea($model->investment,'capital_dev',array('class'=>'rte middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'capital_dev'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'equipment'); ?>
                    <?php echo $form->textArea($model->investment,'equipment',array('class'=>'rte middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'equipment'); ?>
                </div>
                <h2><?= Yii::t('main','Производственный план')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'products'); ?>
                    <?php echo $form->textArea($model->investment,'products',array('class'=>'rte middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'products'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'max_products'); ?>
                    <?php echo $form->textArea($model->investment,'max_products',array('class'=>'rte middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'max_products'); ?>
                </div>
            </div>
            <div class="inner-column">
                <h2><?= Yii::t('main','Финансовый план')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'no_finRevenue'); ?>
                    <?$this->widget('crud.grid',
                        array('header'=>array('one'=>'1 год','two'=>'2год','three'=>'3 год',),
                            'data'=>array($no_finRevenueFormat),
                            'name'=>'finRevenue',
                            'options'=>array('button'=>false)
                        ));?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'no_finCleanRevenue'); ?>
                    <?$this->widget('crud.grid',
                        array('header'=>array('one'=>'1 год','two'=>'2год','three'=>'3 год',),
                            'data'=>array($no_finCleanRevenueFormat),
                            'name'=>'finCleanRevenue',
                            'options'=>array('button'=>false)
                        ));?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investment,'profit'); ?>
                    <?php echo $form->textField($model->investment,'profit'); ?>
                    <?php echo $form->error($model->investment,'profit'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'period'); ?>
                    <?php echo $form->textField($model,'period'); ?>
                    <?php echo $form->error($model,'period'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'profit_clear'); ?>
                    <?php echo $form->textField($model,'profit_clear'); ?>
                    <?php echo $form->error($model,'profit_clear'); ?>
                </div>
            </div>
            <div class="inner-column">
                <div class="row">
                    <?php echo $form->labelEx($model,'profit_norm'); ?>
                    <?php echo $form->textField($model,'profit_norm'); ?>
                    <?php echo $form->error($model,'profit_norm'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'guarantee'); ?>
                    <?php echo $form->textArea($model->investment,'guarantee',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'guarantee'); ?>
                </div>
                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'object_type','elements'=>Project::getObjectTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model,'object_type'); ?>
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