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
    <div data-type="photo" class="attach-action foto-action btn btn-default btn-sm"><i class="fa fa-plus fa-fw"></i> <i class="fa fa-photo fa-fw"></i> <?= Yii::t('main','Слайд')?></div>
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
            'scale' => '629x290',
            'scaleMode' => 'in',
            'needfields' => 'false',
            'callback'=>'slider_article',
            'crop'=>true
        ));
    ?>
</div>
<br>
<style>
    #document_block img{
        margin: 1px;
    }
</style>
<div id="document_block" data-min-width="<?=Setting::get(Setting::MIN_WIDTH_NEWS_IMAGE)?>" data-min-height="<?=Setting::get(Setting::MIN_HEIGHT_NEWS_IMAGE)?>">
    <?foreach($model->sliders as $file):?>
        <span id="wrap_photo_fake2" style="display: inline;">
            <?=Candy::preview(array($file->media, 'scale' => '100x46'))?><span class="uploaded-file-name"><a href="#" class="delete-file">Удалить</a>
                <?=CHtml::hiddenField("file_id[$file->media_id][id]",$file->media_id)?>
            </span>
        </span>
    <?endforeach;?>
</div>