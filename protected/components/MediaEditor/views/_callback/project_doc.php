<script type="text/javascript">

    function set_info(id) {
        $("#text_"+id).html($("#form_"+id+" input:eq(0)").val());
    }

    function wsf_container_<?php echo str_replace(array('[',']'), '', $field)?>(name){

        var html = $('<span class="photos ws_swfUpload single_image"  id="ws_'+name+'">')
            .append('<span id="ws_addButton_'+name+'"></span>')
            .append($('<div class="progress ws_progress"></span>'));
        return html;

    }
    /**
     *Метод который будет выполняться после загрузки на сервер файла
     */
    function wsf_item_<?php echo str_replace(array('[',']'), '', $field)?>(data, settings){

        var type = data['type']==1 ? 'media' : 'file',
            $block = $('#document_block'),
            $alreadyUpload = $block.children('span'),
            inputId=$('<input/>').attr({
                name:"file_id["+data['id']+"][id]",
                type:"hidden",
                value:data['id']

            }),
            inputName=$('<input/>').attr({
                name:"file_id["+data['id']+"][old_name]",
                type:"hidden",
                value:data['old_name']
            }),
            deleteLink = $('<a/>').attr({
                href:"#"
            }).addClass('delete-file btn btn-default btn-sm').text(Yii.t('main', 'Удалить')),

            inputDesc=$('<input/>').attr({
                placeholder:Yii.t('main', 'Описание'),
                name:"file_id["+data['id']+"][desc]",
                type:"text"}).addClass('input-sm form-control').prop('style', 'display: block;');

            var $new = $('<span/>').append(
                $('<div/>').addClass('form-group wrap-uploaded-file-name')
                .append(
                    $('<div/>').addClass('uploaded-file-name')
                        .append(
                            $('<label/>').addClass('col-lg-2 control-label').text(data['old_name'])
                        ).append(
                            $('<div class="col-lg-10"/>')
                                .append(inputId)
                                .append(inputName)
                                .append(
                                    $('<div class="input-group"/>')
                                        .append(inputDesc)
                                        .append(
                                            $('<div class="input-group-btn">').append(deleteLink)
                                        )
                                )
                    )
                )
            );

        if($alreadyUpload.length==0){
            return $new;
        }
        else {
            $block.append($new);
            return $block.children('span');
        }

    }

</script>