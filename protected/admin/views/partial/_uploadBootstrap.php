<script>
    $(window).load(function () {
        //эмуляция нажатия на картинку
        $('.attach-action').click(function(){
            var $this = $(this),
                type = $this.data('type');
            $('#'+type).find('.photos').find('span:eq(0)').click();
            $('.attach-wrap').removeClass('active'); //закроем popup окошко
        });
        $(document).on('click.media','a.delete-file',function(){
            $(this).closest('.uploaded-file-name').parent().remove();
            return false;
        });
        //открытие/скрытие окна
        $('.attach-btn').click(function () {
            $(this).closest('.attach-wrap').toggleClass('active');
        });
    });

</script>
<div class="attach-wrap">
    <div class="btn-group">
        <button class="btn btn-default dropdown-toggle dropup" data-toggle="dropdown"><i class="fa fa-paperclip fa-lg"></i> <span class="caret"></span></button>
        <ul class="dropdown-menu" style="bottom: 100%; top: auto;">
            <li><a href="#" data-type="photo" class="attach-action foto-action"><i class="fa fa-photo fa-fw"></i> <?= Yii::t('main','Фото')?></a></li>
        </ul>
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
        ));
    ?>
</div>
<div id="document_block">
    <?foreach($model->sliders as $file):?>
        <span id="wrap_photo_fake2" style="display: inline;">
            <span class="uploaded-file-name"><?=$file->normal_name?>
                <?=CHtml::hiddenField("file_id[$file->media_id][id]",$file->media_id)?>
                <a href="#" class="delete-file">Удалить</a>
            </span>
        </span>
    <?endforeach;?>
</div>