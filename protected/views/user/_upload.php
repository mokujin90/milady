<div data-type="photo" class="attach-action foto-action btn btn-default btn-sm"><i class="fa fa-photo fa-fw"></i> <?= Yii::t('main','Фото')?></div>
<div data-type="document" class="attach-action doc-action btn btn-default btn-sm"><i class="fa fa-file fa-fw"></i> <?= Yii::t('main','Документ')?></div>

<div id="photo" style="display: none;">
    <?php
    $this->widget('application.components.MediaEditor.MediaEditor',
        array('data' => array(
                'items' => null,
                'field' => 'photo_fake',
                'item_container_id' => 'document_block',
                'button_image_url' => '/images/markup/logo.png',
                'button_width' => 1,
                'button_height' => 1,
            ),
            'scale' => '102x102',
            'scaleMode' => 'in',
            'needfields' => 'false',
            'callback'=>'message_doc',
        ));
    ?>
</div>
<div id="document" style="display: none;">
    <?php
    $this->widget('application.components.MediaEditor.MediaEditor',
        array(
            'data' => array(
                'items' => null,
                'field' => 'document_fake',
                'item_container_id' => 'document_block',
                'button_image_url' => '/images/markup/logo.png',
                'button_width' => 1,
                'button_height' => 1,
            ),
            'callback'=>'message_doc',
            'fileTypes'=>'doc,docx,pdf,txt,zip',
            'scale' => '102x102',
            'scaleMode' => 'in',
            'needfields' => 'false'));
    ?>
</div>

<div id="document_block">
    <?foreach($model->project2Files as $file):?>
        <span id="wrap_photo_fake2" style="display: inline;">
            <span class="uploaded-file-name"><?=$file->name?>
                <?=CHtml::hiddenField("file_id[$file->media_id][id]",$file->media_id)?>
                <?=CHtml::hiddenField("file_id[$file->media_id][old_name]",$file->name)?>
                <?= $file->media->type == 0 ? CHtml::textField("file_id[$file->media_id][desc]",$file->desc, array('placeholder' => 'Описание')) : ''?>
                <a href="#" class="delete-file">Удалить</a>
            </span>
        </span>
    <?endforeach;?>
</div>