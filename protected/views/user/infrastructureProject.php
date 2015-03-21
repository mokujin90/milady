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
    <?php if(!isset($admin)):?>
    <div class="main bread-block">
        <?$this->renderPartial('/partial/_breadcrumbs')?>
    </div>
    <?php endif;?>
    <div class="content columns">
        <?php if(!isset($admin)):?>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'user-form',
                'enableAjaxValidation'=>false,
                'htmlOptions'=>array(
                    "onkeypress"=>"return event.keyCode != 13;"
                )
            )); ?>

            <? $this->renderPartial('/partial/_leftColumn',array('model'=>$model,'content'=>Project::T_INFRASTRUCT,'form'=>$form));?>
            <?$this->renderPartial('/user/_projectNews',array('model'=>$model));?>
            <?$this->renderPartial('/user/_request',array('model'=>$model));?>
        <?php endif;?>

        <div class="main-column opacity-box">
            <div class="inner-column">
                <h2><?= Yii::t('main','Резюме проекта')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model,'name',array('label'=>Yii::t('main','Название инфраструктурного проекта'))); ?>
                    <?php echo $form->textField($model,'name'); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->infrastructure,'short_description'); ?>
                    <?php echo $form->textArea($model->infrastructure,'short_description',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->infrastructure,'short_description'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->infrastructure,'realization_place'); ?>
                    <?php echo $form->textArea($model->infrastructure,'realization_place',array('placeholder'=>Makeup::holder(),'class'=>'ckeditor middle-textarea')); ?>
                    <?php echo $form->error($model->infrastructure,'realization_place'); ?>
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
                            'options'=>array('multiple'=>false,'placeholder'=>Yii::t('main','Отрасль реализации'))
                        ));?>
                    <?php echo $form->error($model,'industry_type'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->infrastructure,'full_price'); ?>
                    <?php echo $form->textField($model->infrastructure,'full_price'); ?>
                    <?php echo $form->error($model->infrastructure,'full_price'); ?>
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
                    <?php echo $form->labelEx($model->infrastructure,'effect'); ?>
                    <?php echo $form->textArea($model->infrastructure,'effect',array('class'=>'ckeditor middle-textarea')); ?>
                    <?php echo $form->error($model->infrastructure,'effect'); ?>
                </div>
                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->infrastructure, 'attribute'=>'type','elements'=>InfrastructureProject::getTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->infrastructure,'type'); ?>
                </div>


            </div>
            <div class="inner-column">
                <h2><?= Yii::t('main','Информация о компании (инициатор инновационного проекта')?></h2>
                <div class="company-info">
                    <script type="text/javascript">
                        $(function() {
                            $('.company-info #Project_has_user_company').change(function(){
                                var isShow = $(this).attr('checked');
                                if(isShow){
                                    $('.company-info .toggle').hide();
                                }
                                else{
                                    $('.company-info .toggle').show();
                                }
                            });
                        });
                    </script>
                    <div class="row">
                        <?php echo $form->checkBox($model, 'has_user_company'); ?>
                        <?php echo $form->labelEx($model, 'has_user_company',array('style'=>'display:inline-block;')); ?>
                        <?php echo $form->error($model, 'has_user_company'); ?>
                    </div>
                    <div class="toggle" style="<?if($model->has_user_company):?>display: none;<?endif;?>">
                        <div class="row">
                            <?php echo $form->labelEx($model->infrastructure,'company_name'); ?>
                            <?php echo $form->textField($model->infrastructure,'company_name'); ?>
                            <?php echo $form->error($model->infrastructure,'company_name'); ?>
                        </div>
                        <div class="row">
                            <?php echo $form->labelEx($model->infrastructure,'legal_address'); ?>
                            <?php echo $form->textArea($model->infrastructure,'legal_address',array('placeholder'=>Makeup::holder(),'class'=>'middle-textarea')); ?>
                            <?php echo $form->error($model->infrastructure,'legal_address'); ?>
                        </div>
                        <div class="row">
                            <?php echo $form->labelEx($model->infrastructure,'company_about'); ?>
                            <?php echo $form->textArea($model->infrastructure,'company_about',array('class'=>'ckeditor middle-textarea')); ?>
                            <?php echo $form->error($model->infrastructure,'company_about'); ?>
                        </div>
                        <div class="row">
                            <?php echo $form->labelEx($model->infrastructure,'activity_sphere'); ?>
                            <?$this->widget('crud.dropDownList',
                                array('model'=>$model->infrastructure, 'attribute'=>'activity_sphere','elements'=>Project::getIndustryTypeDrop(),
                                    'options'=>array('multiple'=>false),
                                ));?>
                            <?php echo $form->error($model->infrastructure,'activity_sphere'); ?>
                        </div>
                    </div>
                </div>
                <?=$this->renderPartial('application.views.user._contact',array('model'=>$model,'form'=>$form))?>
            </div>
            <div class="clear"></div>
            <div class="row center">
                <?php echo $form->labelEx($model->infrastructure,'dinamics'); ?>
                <?php echo $form->textArea($model->infrastructure,'dinamics',array('class'=>'ckeditor middle-textarea')); ?>
                <?php echo $form->error($model->infrastructure,'dinamics'); ?>
            </div>
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