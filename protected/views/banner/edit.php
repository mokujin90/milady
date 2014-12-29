<?php
/**
 *
 * @var BannerController $this
 * @var Banner $model
 */
Yii::app()->clientScript->registerScript('init', 'banner.init();', CClientScript::POS_READY);
?>
<div id="general" class="lk banner">
    <div class="content columns">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
        )); ?>
        <div class="cabinet side-column opacity-box">
            <div class="base-block">
                <div id="logo_block" class="profile-image">
                    <span class="rel">
                        <?=Candy::preview(array($model->media, 'scale' => '319x168'))?>
                        <?php echo CHtml::hiddenField('logo_id',$model->media_id)?>
                    </span>
                </div>

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
                        'needfields' => 'false'));
                ?>

                <div class="open-dialog load-action"><?= Yii::t('main','Загрузить логотип')?></div>
            </div>
            <?php echo $form->error($model,'media_id'); ?>
        </div>
        <div class="main-column opacity-box">
            <div class="inner-column">
                <h2><?= $model->isNewRecord ? Yii::t('main','Создание баннера') : Yii::t('main','Редактирование баннера')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model,'url'); ?>
                    <?php echo $form->textField($model,'url'); ?>
                    <?php echo $form->error($model,'url'); ?>
                </div>
                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'region_id','elements'=>Region::getDrop(),
                            'options'=>array('multiple'=>false,'label'=>true),
                            'id'=>'region-list'
                        ));?>
                    <?php echo $form->error($model,'region_id'); ?>
                </div>
                <div class="row">
                    <?$elements = $model->isNewRecord ? array_merge(array(null=>Yii::t('main','Выберите')),Banner::typeList()) : Banner::typeList()?>
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'type','elements'=>$elements,
                            'options'=>array('multiple'=>false,'label'=>true),
                            'id'=>'banner-type'
                        ));?>
                    <?php echo $form->error($model,'type'); ?>
                </div>
                <?php if($model->isNewRecord):?>
                    <div class="row">
                        <?= Yii::t('main','Рекомендуемая цена:')?>
                        <span style="color: #4788d8;" id="recommend_price"><?= Yii::t('main','для загрузки выберите раздел')?></span>
                    </div>
                <?php endif;?>
                <div class="row">
                    <?php echo $form->labelEx($model,'price'); ?>
                    <?php echo $form->textField($model,'price'); ?>
                    <?php echo $form->error($model,'price'); ?>
                </div>
            </div>
            <div class="clear"></div>

            <div class="button-panel center">
                <?=CHtml::submitButton('Сохранить',array('class'=>'btn'))?>
                <?if($model->status =="activate"):?>
                    <?=CHtml::link(Yii::t('main','Заблокировать'),array('banner/block','id'=>$model->id),array('class'=>'btn'))?>
                <?elseif($model->status=='blocked'):?>
                    <?=CHtml::link(Yii::t('main','Разблокировать'),array('banner/block','id'=>$model->id),array('class'=>'btn'))?>
                <?endif;?>
            </div>

        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>