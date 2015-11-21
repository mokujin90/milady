<?php
/**
 *
 * @var BannerController $this
 * @var FeedBanner $model
 * @var CActiveForm $form
 */
Yii::app()->clientScript->registerScript('init', 'feedBanner.init();', CClientScript::POS_READY);
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
                <?= $model->isNewRecord ? Yii::t('main', 'Создание объявления в ленту') : Yii::t('main', 'Редактирование объявления в ленту') ?>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div id="logo_block" class="profile-image col-lg-3">
                    <span class="rel">
                        <?= Candy::preview(array($model->media, 'scale' => '140x80')) ?>
                        <?php echo CHtml::hiddenField('logo_id', $model->media_id) ?>
                    </span>
                    </div>
                    <div class="col-lg-8">
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
                                'scale' => '140x80',
                                'scaleMode' => 'in',
                                'needfields' => 'false',
                                'crop'=>true));
                        ?>
                        <div class="open-dialog load-action btn btn-success"><?= Yii::t('main', 'Загрузить изображение') ?></div>
                        <?php echo Candy::error($model, 'media_id'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->

                <div class="form-group">
                    <?php echo $form->labelEx($model,'content',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textArea($model,'content',array('rows' => 5, 'class' => ' form-control')); ?>
                        <?php echo Candy::error($model,'content'); ?>
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
                    <div class="col-lg-12">
                        <?$this->widget('crud.dropDownList',
                            array('selected' => CHtml::listData($model->banner2Regions, 'id', 'region_id'), 'elements' => Region::getDrop(),
                                'options' => array('multiple' => true, 'placeholder' => $model->getAttributeLabel('region_id')),
                                'id' => 'region-list',
                                'name' => 'banner2region'
                            ));?>
                        <?php echo Candy::error($model, 'region_id'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->

                <div class="form-group">
                    <div class="col-lg-12">
                        <?$this->widget('crud.dropDownList',
                            array('selected' => $model->usersShow, 'elements' => User::getUserType(),
                                'options' => array('multiple' => true, 'placeholder' => $model->getAttributeLabel('user_show')),
                                'id' => 'user-show',
                                'name' => 'FeedBanner[usersShow]'
                            ));?>
                        <?php echo Candy::error($model, 'user_show'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->


            </div>
        </div>
        <?$hours = array(); for($i=0; $i<24; $i++){$hours[$i] = $i < 10 ? "0$i:00" : "$i:00";}?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?=Yii::t('main', 'Даты публикаций (максимум 5 раз)')?>
                <div class="btn pull-right btn-xs" id="add-publish-date" data-row="1"><i class="fa fa-plus"></i> <?=Yii::t('main', 'Добавить')?></div>
            </div>
            <div class="panel-body" id="publish-date-wrap">
                <?php echo Candy::error($model, 'bannerPublishDates'); ?>
                <?
                $count = 0;
                foreach($model->bannerPublishDates as $item){
                $count++;
                $datetime = new DateTime($item['publish_date']);
                ?>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Дата</label>
                    <div class="col-lg-3">
                        <?= CHtml::textField('publishDate[post'.$count.'][date]', $datetime->format('Y-m-d'), array(
                            'data-provide' => "datepicker",
                            'data-date-format' => "yyyy-mm-dd",
                            'data-date-today-highlight' => "true",
                            'data-date-language' => "en-GB",
                            'class' => 'form-control'
                        )) ?>
                    </div><!-- /.col -->
                    <label class="col-lg-2 control-label">Время</label>
                    <div class="col-lg-3">
                        <?= CHtml::dropDownList('publishDate[post'.$count.'][hour]', (int)$datetime->format('H'), $hours, array('class' => 'form-control')) ?>
                    </div><!-- /.col -->
                    <div class="col-lg-2">
                        <div class="btn pull-right remove-publish-date"><i class="fa fa-remove fa-lg"></i></div>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
                <?}?>
            </div>
        </div>

    <div class="button-panel center" style="margin: 10px 0 0 0;">
            <?=$this->action->buttonPanel()?>
        </div>
        <?=CHtml::hiddenField('id',$model->id,array('id'=>'banner-id-value'))?>
    <?php $this->endWidget(); ?>

    <div class="hidden" id="new-publish-row">
        <div class="form-group">
            <label class="col-lg-2 control-label">Дата</label>
            <div class="col-lg-3">
                <?= CHtml::textField('', '', array(
                    'data-provide' => "datepicker",
                    'data-date-format' => "yyyy-mm-dd",
                    'data-date-today-highlight' => "true",
                    'data-date-language' => "en-GB",
                    'class' => 'form-control date-control'
                )) ?>
            </div><!-- /.col -->
            <label class="col-lg-2 control-label">Время</label>
            <div class="col-lg-3">
                <?= CHtml::dropDownList('', '', $hours, array('class' => 'form-control hour-control')) ?>
            </div><!-- /.col -->
            <div class="col-lg-2">
                <div class="btn pull-right remove-publish-date"><i class="fa fa-remove fa-lg"></i></div>
            </div><!-- /.col -->
        </div><!-- /form-group -->
    </div>
</div>