<?php
/**
 *
 * @var BannerController $this
 * @var Banner $model
 * @var CActiveForm $form
 */
Yii::app()->clientScript->registerScript('init', 'banner.init('.Setting::get(Setting::MIN_BANNER_BALANCE).');', CClientScript::POS_READY);
?>
<style>
    .img-circle{
        border-radius: 0px;
    }
</style>
<div id="general" class="lk banner padding-md">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'banner-form',
        'htmlOptions'=>array(
            'class' => 'form-horizontal no-margin form-border'
        ),
    )); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= $model->isNewRecord ? Yii::t('main', 'Создание баннера') : Yii::t('main', 'Редактирование баннера') ?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div id="logo_block" class="profile-image col-lg-6">
                    <span class="rel">
                        <?= Candy::preview(array($model->media, 'scale' => '319x168')) ?>
                        <?php echo CHtml::hiddenField('logo_id', $model->media_id) ?>
                    </span>
                    </div>
                    <div class="col-lg-6">
                        <?php
                        $this->widget('application.components.MediaEditor.MediaEditor',
                            array('data' => array(
                                'items' => null,
                                'field' => 'logo_id',
                                'item_container_id' => 'logo_block',
                                'button_image_url' => '/images/markup/logo.png',
                                'button_width' => 28,
                                'button_height' => 28,
                            ),
                                'scale' => '319x168',
                                'scaleMode' => 'in',
                                'needfields' => 'false',
                                'crop'=>true));
                        ?>
                        <div class="open-dialog load-action btn btn-success margin-xs" style="margin-left: 0 !important;"><?= Yii::t('main', 'Загрузить логотип') ?></div>
                        <?php echo Candy::error($model, 'media_id'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->

                <div class="form-group">
                    <?php echo $form->labelEx($model,'title',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'title',array('class' => 'form-control')); ?>
                        <?php echo Candy::error($model,'title'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->

                <div class="form-group">
                    <?php echo $form->labelEx($model,'url',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'url',array('class' => 'form-control')); ?>
                        <?php echo Candy::error($model,'url'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->

                <div class="form-group">
                    <?php echo $form->labelEx($model,'region_id',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10" style="padding-top: 5px">
                        <?=CHtml::dropDownList('banner2region',CHtml::listData($model->banner2Regions, 'id', 'region_id'),Region::getDrop(),array('class'=>'chosen','multiple' => true,'placeholder'=>' '))?>
                        <?php echo Candy::error($model, 'region_id'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->

                <div class="form-group">
                    <?php echo $form->labelEx($model,'user_show',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10" style="padding-top: 5px">
                        <?=CHtml::dropDownList('Banner[usersShow]',$model->usersShow,User::getUserType() + array('guest' => 'Гость'),array('class'=>'chosen','multiple' => true,'placeholder'=>' ','id'=>'user-show'))?>
                        <?php echo Candy::error($model, 'user_show'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->

                <div class="form-group">
                    <?php echo $form->labelEx($model,'day_show',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10" style="padding-top: 5px">
                        <?=CHtml::dropDownList('Banner[daysShow]',$model->daysShow,Candy::$weekDay,array('class'=>'chosen','multiple' => true,'placeholder'=>' '))?>
                        <?php echo Candy::error($model, 'day_show'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>
        <div id="investor_block">
            <?if(in_array(User::T_INVESTOR,$model->usersShow)):?>
                <? $this->renderPartial('external.views.banner._investorParam',array('model'=>$model,'form'=>$form));?>
            <?endif;?>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?=Yii::t('main', 'Цена') ?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model,'type',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <? $elements = $model->isNewRecord ? array_merge(array(null => Yii::t('main', 'Выберите')), Banner::typeList()) : Banner::typeList() ?>
                        <?=$form->dropDownList($model,'type',$elements,array('class'=>'chosen','id'=>'banner-type'))?>
                        <?php echo Candy::error($model, 'type'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group">
                    <div class="col-lg-4">
                        <?=CHtml::link('<i class="fa fa-cog fa-spin fa-lg light-hidden" id="loading-state"></i> ' . Yii::t('main','Расчет рекомендуемой цены'),'#',array('class'=>'btn btn-success','id'=>'get-recommend'))?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <? $this->renderPartial('external.views.banner._recommend',array('model'=>$model));?>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'price',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'price',array('class' => 'form-control')); ?>
                        <?php echo Candy::error($model,'price'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <div class="form-group" id="banner-balance-block">
                    <?php echo $form->labelEx($model,'balance',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php if($model->isNew()):?>
                            <?php echo $form->textField($model, 'balance',array('class' => 'form-control')); ?>
                        <?php else:?>
                            <span><?=$model->balance?></span> <?=Candy::getNumEnding($model->balance,array(Yii::t('main','рубль'),Yii::t('main','рубля'),Yii::t('main','рублей')))?>
                        <?php endif;?>
                        <?php echo Candy::error($model, 'balance'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            </div>
        </div>
        <div class="button-panel center" style="margin: 10px 0 0 0;">
            <?=$this->action->buttonPanel()?>
        </div>
        <?=CHtml::hiddenField('id',$model->id,array('id'=>'banner-id-value'))?>
    <?php $this->endWidget(); ?>
</div>