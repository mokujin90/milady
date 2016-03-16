<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-group" style="border: none;">
            <div class="col-lg-12">
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
                            'callback'=>'project_doc',
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
                            'callback'=>'project_doc',
                            'fileTypes'=>'doc,docx,pdf,txt,xls,ppt,pptx',
                            'scale' => '102x102',
                            'scaleMode' => 'in',
                            'needfields' => 'false'));
                    ?>
                </div>
            </div>
        </div>
        <div id="document_block" class="form-group-special">
        <?foreach($model->project2Files as $file):?>
            <span id="wrap_photo_fake2" style="display: inline;">
                <div class="form-group wrap-uploaded-file-name" >
                    <div class="uploaded-file-name">
                        <label class="col-lg-2 control-label"><?=$file->name?></label>
                        <div class="col-lg-10">
                            <?=CHtml::hiddenField("file_id[$file->media_id][id]",$file->media_id)?>
                            <?=CHtml::hiddenField("file_id[$file->media_id][old_name]",$file->name)?>
                            <div class="input-group">
                                <?= CHtml::textField("file_id[$file->media_id][desc]",$file->desc, array('style' => 'display: block;', 'class' => 'input-sm form-control', 'placeholder' => Yii::t('main', 'Описание')))?>
                                <div class="input-group-btn">
                                    <a href="#" class="delete-file btn btn-default btn-sm"><?=Yii::t('main', 'Удалить')?></a>
                                </div> <!-- /input-group-btn -->
                            </div>
                        </div><!-- /.col -->
                    </div>
                </div>
            </span>
        <?endforeach;?>
        </div>
    </div>
</div>