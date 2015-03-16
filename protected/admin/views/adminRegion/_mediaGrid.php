<script>
    var $gridMediaLoadItem;
    $(document).on('click.media','.grid-media-load',function(){
        var $this = $(this);
        $gridMediaLoadItem = $this;
        $('#media-uploader').find('input[type=file]').click();
        return false;
    });
</script>
<div id="media-uploader">
    <?php echo CHtml::hiddenField('','',array('class'=>'downloadMedia'))?>
    <span style="clear: both;" id="temp_media_id"></span>
    <?php
    $this->widget('application.components.MediaEditor.MediaEditor',
        array('data' => array(
            'items' => null,
            'field' => 'temp_media_id',
            'item_container_id' => 'downloadMedia',
            'button_image_url' => '',
            'button_width' => 28,
            'button_height' => 28,
        ),
            'callback'=>'list',
            'fileUploadLimit'=>"1mb",
            'fileUploadLimitText'=>"1 мб",
            'scale' => '100x100',
            'scaleMode' => 'in',
            'needfields' => 'false'));
    ?>
</div>