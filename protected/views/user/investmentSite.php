<?php
/**
 *
 * @var UserController $this
 * @var InvestmentProject $model
 * @var form CActiveForm
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
            <? $this->renderPartial('/partial/_leftColumn',array('model'=>$model,'content'=>Project::T_SITE,'form'=>$form));?>
            <?$this->renderPartial('/user/_projectNews',array('model'=>$model));?>
            <?$this->renderPartial('/user/_request',array('model'=>$model));?>
        <?php endif;?>

        <div class="main-column opacity-box">
            <div class="inner-column">
                <h2><?= Yii::t('main','Общие сведения')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField($model,'name'); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'owner'); ?>
                    <?php echo $form->textField($model->investmentSite,'owner'); ?>
                    <?php echo $form->error($model->investmentSite,'owner'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'ownership'); ?>
                    <?php echo $form->textField($model->investmentSite,'ownership'); ?>
                    <?php echo $form->error($model->investmentSite,'ownership'); ?>
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
                        array('model'=>$model->investmentSite, 'attribute'=>'location_type','elements'=>InvestmentSite::getLocationTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->investmentSite,'location_type'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'site_address'); ?>
                    <?php echo $form->textArea($model->investmentSite,'site_address',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investmentSite,'site_address'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->investmentSite, 'attribute'=>'site_type','elements'=>InvestmentSite::getSiteTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->investmentSite,'site_type'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'problem'); ?>
                    <?php echo $form->textArea($model->investmentSite,'problem',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investmentSite,'problem'); ?>
                </div>

                <h2><?= Yii::t('main','Удаленность от ближайшего')?></h2>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'distance_to_district'); ?>
                    <?php echo $form->textField($model->investmentSite,'distance_to_district'); ?>
                    <?php echo $form->error($model->investmentSite,'distance_to_district'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'distance_to_road'); ?>
                    <?php echo $form->textField($model->investmentSite,'distance_to_road'); ?>
                    <?php echo $form->error($model->investmentSite,'distance_to_road'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'distance_to_train_station'); ?>
                    <?php echo $form->textField($model->investmentSite,'distance_to_train_station'); ?>
                    <?php echo $form->error($model->investmentSite,'distance_to_train_station'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'distance_to_air'); ?>
                    <?php echo $form->textField($model->investmentSite,'distance_to_air'); ?>
                    <?php echo $form->error($model->investmentSite,'distance_to_air'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'closest_objects'); ?>
                    <?php echo $form->textArea($model->investmentSite,'closest_objects',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investmentSite,'closest_objects'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'has_fence'); ?>
                    <?= $form->radioButtonList($model->investmentSite,'has_fence',Project::getIssetDrop(),array('separator'=>''))?>
                    <?php echo $form->error($model->investmentSite,'has_fence'); ?>
                </div>
            </div>
            <div class="inner-column">
                <h2><?= Yii::t('main','Собственные транспортные коммуникации')?></h2>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'has_road'); ?>
                    <?= $form->radioButtonList($model->investmentSite,'has_road',Project::getIssetDrop(),array('separator'=>''))?>
                    <?php echo $form->error($model->investmentSite,'has_road'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'has_rail'); ?>
                    <?= $form->radioButtonList($model->investmentSite,'has_rail',Project::getIssetDrop(),array('separator'=>''))?>
                    <?php echo $form->error($model->investmentSite,'has_rail'); ?>
                </div>

                <div class="row">

                    <?php echo $form->labelEx($model->investmentSite,'has_port'); ?>
                    <?= $form->radioButtonList($model->investmentSite,'has_port',Project::getIssetDrop(),array('separator'=>''))?>
                    <?php echo $form->error($model->investmentSite,'has_port'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'has_mail'); ?>
                    <?= $form->radioButtonList($model->investmentSite,'has_mail',Project::getIssetDrop(),array('separator'=>''))?>
                    <?php echo $form->error($model->investmentSite,'has_mail'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'area'); ?>
                    <?php echo $form->textArea($model->investmentSite,'area',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investmentSite,'area'); ?>
                </div>

                <h2><?= Yii::t('main','Дополнительная информация')?></h2>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSite,'other'); ?>
                    <?php echo $form->textArea($model->investmentSite,'other',array('class'=>'middle-textarea')); ?>
                    <?php echo $form->error($model->investmentSite,'other'); ?>
                </div>
            </div>
            <div class="clear"></div>
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