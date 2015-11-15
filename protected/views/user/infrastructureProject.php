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
        <?if(count($model->errors) || count($model->infrastructure->errors)){?>
            <div class="alert alert-danger padding-md">
                <?= $form->errorSummary(array($model, $model->infrastructure)); ?>
            </div>
        <? }?>
        <? $this->renderPartial('/partial/_commonProjectAttr',array('model'=>$model,'content'=>Project::T_INFRASTRUCT,'form'=>$form));?>
        <?$this->renderPartial('/user/_projectNews',array('model'=>$model));?>
        <?//$this->renderPartial('/user/_request',array('model'=>$model));?>
    <?php endif;?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Резюме проекта')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model,'name',array('class' => 'col-lg-2 control-label', 'label'=>Yii::t('main','Название инфраструктурного проекта'))); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'name',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'name'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->infrastructure,'short_description',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->infrastructure,'short_description',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->infrastructure,'short_description'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->infrastructure,'realization_place',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->infrastructure,'realization_place',array('placeholder'=>Makeup::holder(),'class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->infrastructure,'realization_place'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'region_id',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?$this->widget('crud.dropDownList',
                            array('model'=>$model, 'attribute'=>'region_id','elements'=>CHtml::listData($regions,'id','name'),
                                'options'=>array('multiple'=>false,'label'=>true)
                            ));?>
                        <?php echo $form->error($model,'region_id'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'industry_type',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?$this->widget('crud.dropDownList',
                            array('model'=>$model, 'attribute'=>'industry_type','elements'=>Project::getIndustryTypeDrop(),
                                'options'=>array('multiple'=>false,'placeholder'=>Yii::t('main','Отрасль реализации'))
                            ));?>
                        <?php echo $form->error($model,'industry_type'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->infrastructure,'full_price',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->infrastructure,'full_price',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->infrastructure,'full_price'); ?>
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
                    <?php echo $form->labelEx($model,'period',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'period',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'period'); ?>
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
                    <?php echo $form->labelEx($model,'profit_clear',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'profit_clear',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'profit_clear'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->infrastructure,'effect',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->infrastructure,'effect',array('class' => 'ckeditor form-control')); ?>
                        <?php echo $form->error($model->infrastructure,'effect'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->infrastructure,'type',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?$this->widget('crud.dropDownList',
                            array('model'=>$model->infrastructure, 'attribute'=>'type','elements'=>InfrastructureProject::getTypeDrop(),
                                'options'=>array('multiple'=>false,'label'=>true)
                            ));?>
                        <?php echo $form->error($model->infrastructure,'type'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Информация о компании (инициатор проекта)')?>
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

                    <div class="toggle form-group" style="<?if($model->has_user_company):?>display: none;<?endif;?>">
                        <div class="form-group">
                            <?php echo $form->labelEx($model->infrastructure,'company_name',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model->infrastructure,'company_name',array('class' => 'form-control')); ?>
                                <?php echo $form->error($model->infrastructure,'company_name'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <?php echo $form->labelEx($model->infrastructure,'legal_address',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model->infrastructure,'legal_address',array('placeholder'=>Makeup::holder(), 'class' => 'form-control')); ?>
                                <?php echo $form->error($model->infrastructure,'legal_address'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <?php echo $form->labelEx($model->infrastructure,'company_about',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model->infrastructure,'company_about',array('class' => 'ckeditor form-control')); ?>
                                <?php echo $form->error($model->infrastructure,'company_about'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <?php echo $form->labelEx($model->infrastructure,'activity_sphere',array('class' => 'col-lg-2 control-label')); ?>
                            <div class="col-lg-10">
                                <?$this->widget('crud.dropDownList',
                                    array('model'=>$model->infrastructure, 'attribute'=>'activity_sphere','elements'=>Project::getIndustryTypeDrop(),
                                        'options'=>array('multiple'=>false),
                                    ));?>
                                <?php echo $form->error($model->infrastructure,'activity_sphere'); ?>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->
                    </div>
                </div>
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
