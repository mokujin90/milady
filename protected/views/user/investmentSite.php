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
        <div class="side-column opacity-box">
            <img class="profile-image" src="/images/assets/avatar.png">
            <div class="profile-text"><?= $model->name?></div>
            <div class="load-action"><?= Yii::t('main','загрузить обложку')?></div>
            <div class="profile-name"></div>
        </div>
        <div class="main-column opacity-box">
            <div class="inner-column">
                <h2><?= Yii::t('main','Общие сведения')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model->investmentSites,'owner'); ?>
                    <?php echo $form->textArea($model->investmentSites,'owner',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->investmentSites,'owner'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model->investmentSites,'ownership'); ?>
                    <?php echo $form->textArea($model->investmentSites,'ownership',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->investmentSites,'ownership'); ?>
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
                        array('model'=>$model->investmentSites, 'attribute'=>'location_type','elements'=>InvestmentSite::getLocationTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->investmentSites,'location_type'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSites,'site_address'); ?>
                    <?php echo $form->textArea($model->investmentSites,'site_address',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->investmentSites,'site_address'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->investmentSites, 'attribute'=>'site_type','elements'=>InvestmentSite::getSiteTypeDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->investmentSites,'site_type'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSites,'problem'); ?>
                    <?php echo $form->textArea($model->investmentSites,'problem',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->investmentSites,'problem'); ?>
                </div>


            </div>
            <div class="inner-column">
                <h2><?= Yii::t('main','Удаленность от ближайшего')?></h2>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSites,'distance_to_district'); ?>
                    <?php echo $form->textArea($model->investmentSites,'distance_to_district',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->investmentSites,'distance_to_district'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSites,'distance_to_road'); ?>
                    <?php echo $form->textArea($model->investmentSites,'distance_to_road',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->investmentSites,'distance_to_road'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSites,'distance_to_train_station'); ?>
                    <?php echo $form->textArea($model->investmentSites,'distance_to_train_station',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->investmentSites,'distance_to_train_station'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSites,'distance_to_air'); ?>
                    <?php echo $form->textArea($model->investmentSites,'distance_to_air',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->investmentSites,'distance_to_air'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSites,'closest_objects'); ?>
                    <?php echo $form->textArea($model->investmentSites,'closest_objects',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->investmentSites,'closest_objects'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->investmentSites, 'attribute'=>'has_fence','elements'=>Project::getIssetDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->investmentSites,'has_fence'); ?>
                </div>

                <h2><?= Yii::t('main','Собственные транспортные коммуникации')?></h2>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->investmentSites, 'attribute'=>'has_road','elements'=>Project::getIssetDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->investmentSites,'has_road'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->investmentSites, 'attribute'=>'has_rail','elements'=>Project::getIssetDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->investmentSites,'has_rail'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->investmentSites, 'attribute'=>'has_port','elements'=>Project::getIssetDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->investmentSites,'has_port'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model->investmentSites, 'attribute'=>'has_mail','elements'=>Project::getIssetDrop(),
                            'options'=>array('multiple'=>false,'label'=>true)
                        ));?>
                    <?php echo $form->error($model->investmentSites,'has_mail'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSites,'area'); ?>
                    <?php echo $form->textArea($model->investmentSites,'area',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->investmentSites,'area'); ?>
                </div>

                <h2><?= Yii::t('main','Дополнительная информация')?></h2>

                <div class="row">
                    <?php echo $form->labelEx($model->investmentSites,'other'); ?>
                    <?php echo $form->textArea($model->investmentSites,'other',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model->investmentSites,'other'); ?>
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