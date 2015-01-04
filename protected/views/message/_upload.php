<div class="attach-wrap">
    <div class="attach-btn icon icon-attach"></div>
    <div class="attach-menu">
        <div data-type="photo" class="attach-action foto-action"><i class="icon icon-photo"></i><?= Yii::t('main','Фото')?></div>
        <div data-type="document" class="attach-action doc-action"><i class="icon icon-file"></i><?= Yii::t('main','Документ')?></div>
    </div>
</div>

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
            'callback'=>'message',
            'crop'=>true
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
            'callback'=>'message',
            'fileTypes'=>'doc,docx,pdf,txt,zip',
            'scale' => '102x102',
            'scaleMode' => 'in',
            'needfields' => 'false'));
    ?>
</div>