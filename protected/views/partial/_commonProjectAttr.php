<?
/**
 * @var $model User|Project
 * @var $types array
 * @var $content str "user" | 1 | 2 | 3 | 4| 5
 * @var $form CActiveForm
 */
$params = array();
//определим какие связи нужны
$content = Candy::get($content,'user');
$params['attributes']['name'] = $content == 'user' ? 'company_name' : 'name';
Yii::app()->clientScript->registerScript('init', 'projectDetail.init();', CClientScript::POS_READY);
?>
<div class="panel panel-default">
    <div class="panel-body">Поля обязательные к заполнению отмечены звездочкой (*)</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= $model->$params['attributes']['name']?>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div id="logo_block" class="profile-image col-lg-2">
                <span class="rel">
                    <?=Candy::preview(array($model->logo, 'scale' => '102x102'))?>
                    <?php echo CHtml::hiddenField('logo_id',$model->logo_id)?>
                </span>
            </div>
            <div class="col-lg-10">
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
                        'scale' => '102x102',
                        'scaleMode' => 'in',
                        'needfields' => 'false',
                        'crop'=>true
                    ));
                ?>
                <div class="open-dialog load-action btn btn-success margin-xs" style="margin-left: 0 !important;"><?= Yii::t('main','Загрузить логотип')?></div>
                <span class="help-block"> Рекомендуемые параметры: Размер не менее 100х100. Пропорции сторон 1 к 1</span>
            </div><!-- /.col -->
        </div><!-- /form-group -->

        <?php if($content!='user'):?>
            <div class="map-block">
                <?php $this->widget('Map', array(
                    'id'=>'map',
                    'projects'=>array($model),
                    'draggableBalloon'=>true
                )); ?>
                <?=$form->hiddenField($model,'lat',array('id'=>'coords-lat'))?>
                <?=$form->hiddenField($model,'lon',array('id'=>'coords-lon'))?>
            </div>
            <div id="upload-block">
                <?=$this->renderPartial('/user/_upload',array('model'=>$model))?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'complete', array('class' => 'col-lg-2 control-label')); ?>
                <div class="col-lg-10">
                    <?php echo $form->textField($model,'complete',array('size'=>60,'maxlength'=>255, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model,'complete'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->
            <div class="hidden">
            <?$price = Price::get(Price::P_CURRENT_URL)?>
            <?//if(!$model->isNewRecord && Balance::get(Yii::app()->user->id)->value >=$price && empty($model->url)):?>
                <?php echo CHtml::link('Уникальный url',array('user/uniqueUrl','projectId'=>$model->id),array('class'=>'btn fancybox.ajax fancy-open unique-url','style'=>'margin: 0 0 7px 7px;'))?>
            <?//endif;?>
            <div class="form-group">
                <?php echo $form->labelEx($model,'url', array('class' => 'col-lg-2 control-label')); ?>
                <div class="col-lg-10">
                    <?php echo $form->textField($model,'url',array('id'=>'unique-url-value', 'class' => 'form-control')); ?>
                    <?php echo $form->error($model,'url'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'is_disable', array('class' => 'col-lg-2 control-label')); ?>
                <div class="col-lg-10 is-disable">
                    <label class="label-checkbox inline">
                        <?php echo $form->checkBox($model,'is_disable'); ?>
                        <span class="custom-checkbox"></span>
                    </label>
                    <?php echo $form->error($model,'is_disable'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->
        <?php endif;?>
    </div>
</div>