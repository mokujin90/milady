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

            <? $this->renderPartial('/partial/_leftColumn',array('model'=>$model,'content'=>Project::T_INNOVATE,'form'=>$form));?>
            <?$this->renderPartial('/user/_projectNews',array('model'=>$model));?>
            <?$this->renderPartial('/user/_request',array('model'=>$model));?>
        <?php endif;?>

        <div class="main-column opacity-box">
            <div class="inner-column">
                <h2><?= Yii::t('main','Резюме проекта')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model,'name',array('label'=>Yii::t('main','Название инновационного проекта')));?>
                    <?php echo $form->textField($model,'name'); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'project_description'); ?>
                    <?php echo $form->textArea($model->innovative,'project_description',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->innovative,'project_description'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'project_history'); ?>
                    <?php echo $form->textArea($model->innovative,'project_history',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->innovative,'project_history'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'region_id',array('label'=>Yii::t('main','Место реализации проекта (регион)'))); ?>
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'region_id','elements'=>CHtml::listData($regions,'id','name'),
                            'options'=>array('multiple'=>false,'label'=>true,'show_required'=>false)
                        ));?>
                    <?php echo $form->error($model,'region_id'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'industry_type'); ?>
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'industry_type','elements'=>Project::getIndustryTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true,'show_required'=>false)
                        ));?>
                    <?php echo $form->error($model,'industry_type'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'object_type'); ?>
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'object_type','elements'=>Project::getObjectTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true,'show_required'=>false)
                        ));?>
                    <?php echo $form->error($model,'object_type'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'project_step'); ?>
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->innovative, 'attribute'=>'project_step','elements'=>Project::getProjectStepDrop(),
                            'options'=>array('multiple'=>false,'label'=>true,'show_required'=>false)));?>
                    <?php echo $form->error($model->innovative,'project_step'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'market_size'); ?>
                    <?php echo $form->textField($model->innovative,'market_size',array()); ?>
                    <?php echo $form->error($model->innovative,'market_size'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'project_price'); ?>
                    <?php echo $form->textField($model->innovative,'project_price'); ?>
                    <?php echo $form->error($model->innovative,'project_price'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'investment_sum'); ?>
                    <?php echo $form->textField($model,'investment_sum'); ?>
                    <?php echo $form->error($model,'investment_sum'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'invest_way'); ?>
                    <?php echo $form->textField($model->innovative,'invest_way'); ?>
                    <?php echo $form->error($model->innovative,'invest_way'); ?>
                </div>
                <h2><?= Yii::t('main','Описание проекта')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'product_description'); ?>
                    <?php echo $form->textArea($model->innovative,'product_description',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->innovative,'product_description'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'relevance_type'); ?>
                    <?$this->widget('crud.dropDownList',array('model'=>$model->innovative, 'attribute'=>'relevance_type','elements'=>InnovativeProject::getRelevanceTypeDrop(),
                        'options'=>array('multiple'=>false,'label'=>true,'show_required'=>false)));?>
                    <?php echo $form->error($model->innovative,'relevance_type'); ?>
                </div>
                <h2><?= Yii::t('main','Финансовый план')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'profit'); ?>
                    <?php echo $form->textField($model->innovative,'profit',array()); ?>
                    <?php echo $form->error($model->innovative,'profit'); ?>
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
                <div class="row">
                    <?php echo $form->labelEx($model,'profit_norm'); ?>
                    <?php echo $form->textField($model,'profit_norm'); ?>
                    <?php echo $form->error($model,'profit_norm'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'guarantee'); ?>
                    <?php echo $form->textField($model->innovative,'guarantee',array()); ?>
                    <?php echo $form->error($model->innovative,'guarantee'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'structure'); ?>
                    <?php echo $form->textField($model->innovative,'structure',array()); ?>
                    <?php echo $form->error($model->innovative,'structure'); ?>
                </div>
                <h2><?= Yii::t('main','Предложение инвестору')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'investment_goal'); ?>
                    <?php echo $form->textField($model->innovative,'investment_goal',array()); ?>
                    <?php echo $form->error($model->innovative,'investment_goal'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'investment_typeFormat'); ?>
                    <?$this->widget('crud.dropDownList',array('model'=>$model->innovative, 'attribute'=>'investment_typeFormat','elements'=>InnovativeProject::getInvestmentTypeDrop(),
                        'options'=>array('multiple'=>true,'label'=>false,'show_required'=>false)));?>
                    <?php echo $form->error($model->innovative,'investment_typeFormat'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'finance_type'); ?>
                    <?$this->widget('crud.dropDownList',array('model'=>$model->innovative, 'attribute'=>'finance_type','elements'=>InnovativeProject::getFinanceTypeDrop(),
                        'options'=>array('multiple'=>false,'label'=>true,'show_required'=>false)));?>
                    <?php echo $form->error($model->innovative,'finance_type'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'financing_terms'); ?>
                    <?php echo $form->textArea($model->innovative,'financing_terms',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->innovative,'financing_terms'); ?>
                </div>
            </div>

            <div class="inner-column">

                <h2><?= Yii::t('main','Риски проекта')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'swot'); ?>
                    <?php echo $form->textArea($model->innovative,'swot',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->innovative,'swot'); ?>
                </div>
                <h2><?= Yii::t('main','Выход из проекта')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'strategy'); ?>
                    <?php echo $form->textArea($model->innovative,'strategy',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->innovative,'strategy'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'exit_period'); ?>
                    <?php echo $form->textField($model->innovative,'exit_period',array()); ?>
                    <?php echo $form->error($model->innovative,'exit_period'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'exit_price'); ?>
                    <?php echo $form->textField($model->innovative,'exit_price',array()); ?>
                    <?php echo $form->error($model->innovative,'exit_price'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'exit_multi'); ?>
                    <?php echo $form->textField($model->innovative,'exit_multi',array()); ?>
                    <?php echo $form->error($model->innovative,'exit_multi'); ?>
                </div>
                <?=$this->renderPartial('_contact',array('model'=>$model,'form'=>$form))?>
                <h2><?= Yii::t('main','Информация о компании (инициатор инновационного проекта)')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'company_name'); ?>
                    <?php echo $form->textField($model->innovative,'company_name',array()); ?>
                    <?php echo $form->error($model->innovative,'company_name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'company_legal'); ?>
                    <?php echo $form->textArea($model->innovative,'company_legal',array('placeholder'=>Makeup::holder(),'class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->innovative,'company_legal'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'company_info'); ?>
                    <?php echo $form->textArea($model->innovative,'company_info',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->innovative,'company_info'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'company_area'); ?>
                    <?php echo $form->textField($model->innovative,'company_area',array()); ?>
                    <?php echo $form->error($model->innovative,'company_area'); ?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="button-panel center">
                <?=CHtml::submitButton($model->innovative->isNewRecord ? Yii::t('main','Создать') : Yii::t('main','Сохранить'),array('class'=>'btn'))?>
            </div>
        </div>
        <?php if(!isset($admin)):?>
            <?php $this->endWidget(); ?>
        <?php endif;?>

    </div>
</div>