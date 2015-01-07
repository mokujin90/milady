<?php
/**
 *
 * @var UserController $this
 * @var InvestmentProject $model->innovative
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

                <div class="row">
                    <?php echo CHtml::label(Yii::t('main','Название инновационного проекта'),'Project_name'); ?>
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
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'industry_type','elements'=>Project::getIndustryTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model,'industry_type'); ?>
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
                    <?php echo $form->labelEx($model->innovative,'project_address'); ?>
                    <?php echo $form->textArea($model->innovative,'project_address',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->innovative,'project_address'); ?>
                </div>


                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->innovative, 'attribute'=>'project_step','elements'=>Project::getProjectStepDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)));?>
                    <?php echo $form->error($model->innovative,'project_step'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'market_size'); ?>
                    <?php echo $form->textField($model->innovative,'market_size',array()); ?>
                    <?php echo $form->error($model->innovative,'market_size'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'financing_terms'); ?>
                    <?php echo $form->textArea($model->innovative,'financing_terms',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->innovative,'financing_terms'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'product_description'); ?>
                    <?php echo $form->textArea($model->innovative,'product_description',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->innovative,'product_description'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',array('model'=>$model->innovative, 'attribute'=>'relevance_type','elements'=>InnovativeProject::getRelevanceTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)));?>
                    <?php echo $form->error($model->innovative,'relevance_type'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'profit'); ?>
                    <?php echo $form->textField($model->innovative,'profit',array()); ?>
                    <?php echo $form->error($model->innovative,'profit'); ?>
                </div>

            </div>

            <div class="inner-column">

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'investment_goal'); ?>
                    <?php echo $form->textField($model->innovative,'investment_goal',array()); ?>
                    <?php echo $form->error($model->innovative,'investment_goal'); ?>
                </div>


                <div class="row">
                    <?$this->widget('crud.dropDownList',array('model'=>$model->innovative, 'attribute'=>'investment_type','elements'=>InnovativeProject::getInvestmentTypeDrop(),
                        'options'=>array('multiple'=>false,'label'=>true)));?>
                    <?php echo $form->error($model->innovative,'investment_type'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',array('model'=>$model->innovative, 'attribute'=>'finance_type','elements'=>InnovativeProject::getFinanceTypeDrop(),
                        'options'=>array('multiple'=>false,'label'=>true)));?>
                    <?php echo $form->error($model->innovative,'finance_type'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'swot'); ?>
                    <?php echo $form->textArea($model->innovative,'swot',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->innovative,'swot'); ?>
                </div>

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