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
        <? $this->renderPartial('/partial/_leftColumn',array('model'=>$model,'content'=>Project::T_INVEST));?>
        <div class="main-column opacity-box">
            <div class="inner-column">
                <h2><?= Yii::t('main','Резюме проекта')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField($model,'name'); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'short_description'); ?>
                    <?php echo $form->textArea($model->investment,'short_description',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'short_description'); ?>
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
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'address'); ?>
                    <?php echo $form->textArea($model->investment,'address',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'address'); ?>
                </div>
                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->investment, 'attribute'=>'industry_type','elements'=>Project::getIndustryTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->investment,'industry_type'); ?>
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
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->investment, 'attribute'=>'investment_form','elements'=>InvestmentProject::getInvestmentFormDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->investment,'investment_form'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'investment_sum'); ?>
                    <?php echo $form->textField($model->investment,'investment_sum'); ?>
                    <?php echo $form->error($model->investment,'investment_sum'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'investment_direction'); ?>
                    <?php echo $form->textArea($model->investment,'investment_direction',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'investment_direction'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'financing_terms'); ?>
                    <?php echo $form->textArea($model->investment,'financing_terms',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'financing_terms'); ?>
                </div>
                <h2><?= Yii::t('main','Организационный план')?></h2>
                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->investment, 'attribute'=>'project_step','elements'=>Project::getProjectStepDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)));?>
                    <?php echo $form->error($model->investment,'project_step'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'kap_construction'); ?>
                    <?php echo $form->textArea($model->investment,'kap_construction',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'kap_construction'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investment,'equipment'); ?>
                    <?php echo $form->textArea($model->investment,'equipment',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'equipment'); ?>
                </div>
            </div>
            <div class="inner-column">
                <h2><?= Yii::t('main','Производственный план')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->investment,'products'); ?>
                    <?php echo $form->textArea($model->investment,'products',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'products'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investment,'max_products'); ?>
                    <?php echo $form->textArea($model->investment,'max_products',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'max_products'); ?>
                </div>
                <h2><?= Yii::t('main','Финансовый план')?></h2>

                <div class="row">
                    <?php echo $form->labelEx($model->investment,'no_finRevenue'); ?>
                    <?php echo $form->textField($model->investment,'no_finRevenue'); ?>
                    <?php echo $form->error($model->investment,'no_finRevenue'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investment,'no_finCleanRevenue'); ?>
                    <?php echo $form->textField($model->investment,'no_finCleanRevenue'); ?>
                    <?php echo $form->error($model->investment,'no_finCleanRevenue'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investment,'profit'); ?>
                    <?php echo $form->textField($model->investment,'profit'); ?>
                    <?php echo $form->error($model->investment,'profit'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investment,'period'); ?>
                    <?php echo $form->textField($model->investment,'period'); ?>
                    <?php echo $form->error($model->investment,'period'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investment,'profit_clear'); ?>
                    <?php echo $form->textField($model->investment,'profit_clear'); ?>
                    <?php echo $form->error($model->investment,'profit_clear'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investment,'profit_norm'); ?>
                    <?php echo $form->textField($model->investment,'profit_norm'); ?>
                    <?php echo $form->error($model->investment,'profit_norm'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investment,'risk'); ?>
                    <?php echo $form->textArea($model->investment,'risk',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investment,'risk'); ?>
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