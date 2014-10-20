<?php
/**
 *
 * @var UserController $this
 * @var InvestmentProject $model->innovative
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
        <div class="side-column opacity-box">
            <img class="profile-image" src="/images/assets/avatar.png">
            <div class="profile-text"><?= $model->name?></div>
            <div class="load-action">загрузить логотип</div>
            <div class="profile-name"></div>
        </div>
        <div class="main-column opacity-box">
            <div class="inner-column">

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'region_id','elements'=>CHtml::listData($regions,'id','name'),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model,'region_id'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'project_description'); ?>
                    <?php echo $form->textArea($model->innovative,'project_description',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'project_description'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'project_history'); ?>
                    <?php echo $form->textArea($model->innovative,'project_history',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'project_history'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'project_address'); ?>
                    <?php echo $form->textArea($model->innovative,'project_address',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'project_address'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->innovative, 'attribute'=>'patent_type','elements'=>InnovativeProject::getPatentTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->innovative,'patent_type'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'patent_value'); ?>
                    <?php echo $form->textArea($model->innovative,'patent_value',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'patent_value'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->innovative, 'attribute'=>'project_step','elements'=>InnovativeProject::getProjectStepDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)));?>
                    <?php echo $form->error($model->innovative,'project_step'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'market_size'); ?>
                    <?php echo $form->textArea($model->innovative,'market_size',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'market_size'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'project_price'); ?>
                    <?php echo $form->textField($model->innovative,'project_price'); ?>
                    <?php echo $form->error($model->innovative,'project_price'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'investment_sum'); ?>
                    <?php echo $form->textField($model->innovative,'investment_sum'); ?>
                    <?php echo $form->error($model->innovative,'investment_sum'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'investment_direction'); ?>
                    <?php echo $form->textArea($model->innovative,'investment_direction',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'investment_direction'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'financing_terms'); ?>
                    <?php echo $form->textArea($model->innovative,'financing_terms',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'financing_terms'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'product_description'); ?>
                    <?php echo $form->textArea($model->innovative,'product_description',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'product_description'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',array('model'=>$model->innovative, 'attribute'=>'relevance_type','elements'=>InnovativeProject::getRelevanceTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)));?>
                    <?php echo $form->error($model->innovative,'relevance_type'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'finance'); ?>
                    <?php echo $form->textArea($model->innovative,'finance',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'finance'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'profit'); ?>
                    <?php echo $form->textArea($model->innovative,'profit',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'profit'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'period'); ?>
                    <?php echo $form->textArea($model->innovative,'period',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'period'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'profit_clear'); ?>
                    <?php echo $form->textField($model->innovative,'profit_clear'); ?>
                    <?php echo $form->error($model->innovative,'profit_clear'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'profit_norm'); ?>
                    <?php echo $form->textField($model->innovative,'profit_norm'); ?>
                    <?php echo $form->error($model->innovative,'profit_norm'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'risk'); ?>
                    <?php echo $form->textArea($model->innovative,'risk',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'risk'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'investment_size'); ?>
                    <?php echo $form->textArea($model->innovative,'investment_size',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'investment_size'); ?>
                </div>

            </div>
            <div class="inner-column">


                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'investment_goal'); ?>
                    <?php echo $form->textArea($model->innovative,'investment_goal',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'investment_goal'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'structure_before'); ?>
                    <?php echo $form->textArea($model->innovative,'structure_before',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'structure_before'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'structure_after'); ?>
                    <?php echo $form->textArea($model->innovative,'structure_after',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'structure_after'); ?>
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
                    <?php echo $form->labelEx($model->innovative,'main_terms'); ?>
                    <?php echo $form->textArea($model->innovative,'main_terms',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'main_terms'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'investment_tranches'); ?>
                    <?php echo $form->textArea($model->innovative,'investment_tranches',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'investment_tranches'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'swot'); ?>
                    <?php echo $form->textArea($model->innovative,'swot',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'swot'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'strategy'); ?>
                    <?php echo $form->textArea($model->innovative,'strategy',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'strategy'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'exit_period'); ?>
                    <?php echo $form->textArea($model->innovative,'exit_period',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'exit_period'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'exit_price'); ?>
                    <?php echo $form->textArea($model->innovative,'exit_price',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'exit_price'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'exit_multi'); ?>
                    <?php echo $form->textArea($model->innovative,'exit_multi',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'exit_multi'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'short_description'); ?>
                    <?php echo $form->textArea($model->innovative,'short_description',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'short_description'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->innovative,'programm'); ?>
                    <?php echo $form->textArea($model->innovative,'programm',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->innovative,'programm'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->innovative, 'attribute'=>'industry_type','elements'=>Project::getIndustryTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->innovative,'industry_type'); ?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="button-panel center">
                <?=CHtml::submitButton($model->innovative->isNewRecord ? Yii::t('main','Создать') : Yii::t('main','Сохранить'),array('class'=>'btn'))?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>