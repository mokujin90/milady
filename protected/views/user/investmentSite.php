<?php
/**
 *
 * @var UserController $this
 * @var InvestmentSite $model
 * @var $form CActiveForm
 * @var Project $model
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
        <?if(count($model->errors) || count($model->investmentSite->errors)){?>
            <div class="alert alert-danger padding-md">
                <?= $form->errorSummary(array($model, $model->investmentSite)); ?>
            </div>
        <? }?>
        <? $this->renderPartial('/partial/_commonProjectAttr',array('model'=>$model,'content'=>Project::T_SITE,'form'=>$form));?>
        <?$this->renderPartial('/user/_projectNews',array('model'=>$model));?>
        <?//$this->renderPartial('/user/_request',array('model'=>$model));?>
    <?php endif;?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Общие сведения')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model,'name',array('class' => 'col-lg-2 control-label', 'label'=>Yii::t('main','Название площадки'))); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'name',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'name'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'owner',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investmentSite,'owner',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investmentSite,'owner'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'ownership',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->radioButtonList($model->investmentSite,'ownership',InvestmentSite::getOwnershipDrop(),array('separator'=>'<br>','class'=>'radio-button-drop'))?>
                        <?php echo $form->error($model->investmentSite,'ownership'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'region_id',array('label'=>Yii::t('main','Местонахождение площадки (регион)'), 'class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model,'region_id',CHtml::listData($regions,'id','name'),array('class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model,'region_id'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'site_address',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investmentSite,'site_address',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investmentSite,'site_address'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'site_type',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model->investmentSite,'site_type',InvestmentSite::getSiteTypeDrop(),array('class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model->investmentSite,'site_type'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'problem',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investmentSite,'problem',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->investmentSite,'problem'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Удаленность от ближайшего')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'distance_to_district',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investmentSite,'distance_to_district',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investmentSite,'distance_to_district'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'distance_to_road',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investmentSite,'distance_to_road',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investmentSite,'distance_to_road'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'distance_to_train_station',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investmentSite,'distance_to_train_station',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investmentSite,'distance_to_train_station'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'distance_to_air',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investmentSite,'distance_to_air',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investmentSite,'distance_to_air'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'closest_objects',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investmentSite,'closest_objects',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->investmentSite,'closest_objects'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'has_fence',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->radioButtonList($model->investmentSite,'has_fence',Project::getIssetDrop(),array('separator'=>'<br>'))?>
                        <?php echo $form->error($model->investmentSite,'has_fence'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <?=$this->renderPartial('application.views.user._contact',array('model'=>$model,'form'=>$form))?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Характеристика территории участка')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'param_space',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investmentSite,'param_space',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investmentSite,'param_space'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'param_expansion',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->radioButtonList($model->investmentSite,'param_expansion',Project::getIssetDrop(),array('separator'=>'<br>'))?>
                        <?php echo $form->error($model->investmentSite,'param_expansion'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'param_expansion_size',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investmentSite,'param_expansion_size',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investmentSite,'param_expansion_size'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'param_earth_category',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investmentSite,'param_earth_category',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investmentSite,'param_earth_category'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'param_relief',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investmentSite,'param_relief',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investmentSite,'param_relief'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'param_ground',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model->investmentSite,'param_ground',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model->investmentSite,'param_ground'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Собственные транспортные коммуникации')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model,'has_road',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->radioButtonList($model->investmentSite,'has_road',Project::getIssetDrop(),array('separator'=>'<br>'))?>
                        <?php echo $form->error($model->investmentSite,'has_road'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'has_rail',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->radioButtonList($model->investmentSite,'has_rail',Project::getIssetDrop(),array('separator'=>'<br>'))?>
                        <?php echo $form->error($model->investmentSite,'has_rail'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'has_port',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->radioButtonList($model->investmentSite,'has_port',Project::getIssetDrop(),array('separator'=>'<br>'))?>
                        <?php echo $form->error($model->investmentSite,'has_port'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model,'has_mail',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?= $form->radioButtonList($model->investmentSite,'has_mail',Project::getIssetDrop(),array('separator'=>'<br>'))?>
                        <?php echo $form->error($model->investmentSite,'has_mail'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'area',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investmentSite,'area',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->investmentSite,'area'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Дополнительная информация')?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model->investmentSite,'other',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model->investmentSite,'other',array('class' => 'ckeditor form-control','rows'=>8)); ?>
                        <?php echo $form->error($model->investmentSite,'other'); ?>
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
                    <?php echo $form->labelEx($model->investmentSite,'location_type',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?=$form->dropDownList($model->investmentSite,'location_type',InvestmentSite::getLocationTypeDrop(),array('class'=>'chosen','prompt'=>'','placeholder'=>' '))?>
                        <?php echo $form->error($model->investmentSite,'location_type'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Характеристика зданий и сооружений на территории участка')?>
            </div>
            <div class="panel-body">
                <div class="padding-md">
                    <div class="row center">
                        <div class="row">
                            <?$this->widget('crud.grid',
                                array('model'=>$model->investmentSite->buildings, 'header'=>InvestmentSite2Building::getHeader(),
                                    'options'=>array(),'name'=>'InvestmentSite2Building', 'inputClass' => 'form-control'
                                ));?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('main','Характеристика инфраструктуры')?>
            </div>
            <div class="panel-body">
                <div class="padding-md">
                    <div class="row center">
                        <div class="row">
                            <?$this->widget('crud.grid',
                                array('model'=>$model->investmentSite->generateInfrastructure(), 'header'=>InvestmentSite2Infrastructure::getHeader(),
                                    'options'=>array(),'name'=>'InvestmentSite2Infrastructure', 'inputClass' => 'form-control'
                                ));?>
                        </div>
                    </div>
                </div>
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