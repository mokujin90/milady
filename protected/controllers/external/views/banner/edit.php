<?php
/**
 *
 * @var BannerController $this
 * @var Banner $model
 * @var CActiveForm $form
 */
Yii::app()->clientScript->registerScript('init', 'banner.init('.Setting::get(Setting::MIN_BANNER_BALANCE).');', CClientScript::POS_READY);
?>
<div id="general" class="lk banner">
    <div class="content columns">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'banner-form',
        )); ?>
        <div class="cabinet side-column opacity-box">
            <div class="base-block">
                <div id="logo_block" class="profile-image">
                    <span class="rel">
                        <?= Candy::preview(array($model->media, 'scale' => '319x168')) ?>
                        <?php echo CHtml::hiddenField('logo_id', $model->media_id) ?>
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

                <div class="open-dialog load-action"><?= Yii::t('main', 'Загрузить логотип') ?></div>
            </div>
            <?php echo Candy::error($model, 'media_id'); ?>
        </div>
        <div class="main-column opacity-box">
            <div class="inner-column">
                <h2><?= $model->isNewRecord ? Yii::t('main', 'Создание баннера') : Yii::t('main', 'Редактирование баннера') ?></h2>

                <div class="row">
                    <?php echo $form->labelEx($model, 'url'); ?>
                    <?php echo $form->textField($model, 'url'); ?>
                    <?php echo Candy::error($model, 'url'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('selected' => CHtml::listData($model->banner2Regions, 'id', 'region_id'), 'elements' => Region::getDrop(),
                            'options' => array('multiple' => true, 'placeholder' => $model->getAttributeLabel('region_id')),
                            'id' => 'region-list',
                            'name' => 'banner2region'
                        ));?>
                    <?php echo Candy::error($model, 'region_id'); ?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('selected' => $model->usersShow, 'elements' => User::getUserType() + array('guest' => 'Гость'),
                            'options' => array('multiple' => true, 'placeholder' => $model->getAttributeLabel('user_show')),
                            'id' => 'user-show',
                            'name' => 'Banner[usersShow]'
                        ));?>
                    <?php echo Candy::error($model, 'user_show'); ?>
                </div>

                <div id="investor_block">
                    <?if(in_array(User::T_INVESTOR,$model->usersShow)):?>
                        <? $this->renderPartial('external.views.banner._investorParam',array('model'=>$model,'form'=>$form));?>
                    <?endif;?>
                </div>

                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('selected' => $model->daysShow, 'elements' => Candy::$weekDay,
                            'options' => array('multiple' => true, 'placeholder' => $model->getAttributeLabel('day_show')),
                            'id' => 'day-show',
                            'name' => 'Banner[daysShow]'
                        ));?>
                    <?php echo Candy::error($model, 'day_show'); ?>
                </div>

                <div class="row">
                    <? $elements = $model->isNewRecord ? array_merge(array(null => Yii::t('main', 'Выберите')), Banner::typeList()) : Banner::typeList() ?>
                    <?$this->widget('crud.dropDownList',
                        array('model' => $model, 'attribute' => 'type', 'elements' => $elements,
                            'options' => array('multiple' => false, 'label' => true),
                            'id' => 'banner-type'
                        ));?>
                    <?php echo Candy::error($model, 'type'); ?>
                </div>

                <?=CHtml::link(Yii::t('main','Расчет рекомендуемой цены'),'#',array('class'=>'btn','id'=>'get-recommend'))?>
                <div id="recommend">
                    <? $this->renderPartial('external.views.banner._recommend',array('model'=>$model));?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'price'); ?>
                    <?php echo $form->textField($model, 'price'); ?>
                    <?php echo Candy::error($model, 'price'); ?>
                </div>

                <div class="row" id="banner-balance-block">
                    <?php echo $form->labelEx($model, 'balance'); ?>
                    <?php if($model->isNew()):?>
                        <?php echo $form->textField($model, 'balance'); ?>
                    <?php else:?>
                        <span><?=$model->balance?></span> <?=Candy::getNumEnding($model->balance,array(Yii::t('main','рубль'),Yii::t('main','рубля'),Yii::t('main','рублей')))?>
                    <?php endif;?>

                    <?php echo Candy::error($model, 'balance'); ?>
                </div>
            </div>
            <div class="clear"></div>

            <div class="button-panel center" style="margin: 10px 0 0 0;">
                <?=$this->action->buttonPanel()?>
            </div>

        </div>

        <?=CHtml::hiddenField('id',$model->id,array('id'=>'banner-id-value'))?>
        <?php $this->endWidget(); ?>
    </div>
</div>