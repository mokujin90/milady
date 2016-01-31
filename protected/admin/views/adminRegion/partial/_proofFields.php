<div class="form-group">
    <?php echo CHtml::label('Описание', null, array('class' => "col-xs-12 col-sm-4 control-label")); ?>
    <div class="col-xs-12 col-sm-8">
        <?= CHtml::textField('RegionProof['.$field.']', $model->{$relation} ? $model->{$relation}->title : '', array('class' => 'form-control')); ?>
    </div>
</div>
<div class="form-group ">
    <?php echo CHtml::label('Документ', null, array('class' => "col-xs-12 col-sm-4 control-label")); ?>
    <div class="col-xs-12 col-sm-8 file-normal-name region-document">
        <?if($model->{$relation} && $model->{$relation}->media):?>
            <? //= CHtml::link('Скачать',$model->{$relation}->media->makeWebPath(),array('style'=> 'margin-left: 10px', 'class'=>'btn', 'target' => '_blank'))?>
            <?php echo CHtml::button(Yii::t('main','Удалить'),array('class'=>'delete-media-button btn'))?>
        <?endif?>

        <?php
        $this->widget('application.components.MediaEditor.MediaEditor',
            array('data' => array(
                'items' => null,
                'field' =>  $field . '_media_id',
                'item_container_id' => $field . '_media_id',
                'button_image_url' => '/images/markup/logo.png',
                'button_width' => 28,
                'button_height' => 28,
            ),
                'callback'=>'admin',
                'fileTypes'=>'doc,docx,pdf,txt,zip',
                'scale' => '300x160',
                'scaleMode' => 'in',
                'needfields' => 'false'));
        ?>

        <?php echo CHtml::button(Yii::t('main','Загрузить документ'),array('style'=>'float: left;','class'=>'open-dialog btn btn-primary m-right-xs'))?>
        <div class="col-xs-12 col-sm-8">
            <span id="<?=$field?>_media_id" class="rel">
                <?php echo CHtml::hiddenField($field . '_media_id', $model->{$relation} ? $model->{$relation}->media_id : '', array('class' => 'fid'))?>
            </span>
        </div>
    </div>
</div>
<hr class="col-xs-12">