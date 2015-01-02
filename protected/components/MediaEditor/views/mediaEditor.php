<?php
/**
 * @var $this MediaEditor
 */
?>

<?php Yii::app()->clientScript->registerScript('haspicturescount','picturesCount=0;');  ?>
<?php $filecontainerid = str_replace('.','_',"filecontainer" . microtime(true)) ?>


<?php

    $view = is_null($this->callback) ? 'standard' : $this->callback;
    $this->render("/_callback/$view",array('field'=>$field));
?>




<input type="file" name="<?php echo $field ?>" id="<?php echo $filecontainerid;?>"/>



<?php

if($this->crop){
    $scale=Media::CROP_SCALE;
    $scaleMode='in';
} else{
    $scale=$this->scale;
    $scaleMode=$this->scaleMode;
}

Yii::app()->clientScript->registerscript('pluploader_'.$field,'

		uploaded_files = '.$items.';
        true_scale = "'.$this->scale.'";

		$("#'.$filecontainerid.'").pluploadUploader({
			mode: \''.$mode.'\',
			scale: \''.$this->scale.'\',
		    scaleMode: \''.$this->scaleMode.'\',
			status_load: \'<span style="font-size: 10px">загрузка...</span>\'

		},{
			url: \'http://'.$_SERVER['HTTP_HOST'].'/media/uploadFile'.($scale?'?scale='.$scale:'').($scaleMode?($scale?'&':'?').'scaleMode='.$scaleMode:'').'\',
			flash_swf_url: swf_file,
			silverlight_xap_url : xap_file,
			button_image_url:  "'.$button_image_url.'",
			button_width: '.$button_width.',
//			debug : true,
			button_height: '.$button_height.',
			max_file_size: \''.$this->fileUploadLimit.'\',
			max_file_size_text: \''.$this->fileUploadLimitText.'\',
			filters: [
                    {title: "Типы файлов", extensions: \''.$this->fileTypes.'\'}
                ]
		}, {
			container: wsf_container_'.str_replace(array('[',']'), '', $field).',
			item_container_id: \''.$item_container_id.'\',
			item_crop_container_id: \'crop_container_'.str_replace(array('[',']'), '', $field).'\',
			item: wsf_item_'.str_replace(array('[',']'), '', $field).''.(!empty($flash_avail)? ',
			item_flash: wsf_item_'.str_replace('[]', '', $field).'_flash' : '').'
		}, uploaded_files);

		

');


if($this->crop) {
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'crop_container_'.str_replace(array('[',']'), '', $field),
            'options' => array(
                'title' => '',
                'autoOpen' => false,
                'width' => 630,
                'height' => 600,
                'modal' => true,
                'resizable' => false,
                'buttons' => array(
                    array(
                        'text' => 'Сохранить',
                        'click' => 'js:function(){$(this).dialog("close"); $(this).data("pluploadUploader").cropSave(); }'
                    ),
                ),

            ),
        )
    );
    $this->endWidget('zii.widgets.jui.CJuiDialog');
}
?>