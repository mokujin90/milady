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
            }).addClass('delete-file').text('Удалить'),
            $new = $('<span/>').append($('<img/>').attr({src:data['preview_url'],width:100})).addClass('uploaded-file-name')
                .append(inputId)
                .append(inputName).append(deleteLink);

        if($alreadyUpload.length==0){

            return $new;
        }
        else{
            $block.append($new);

            return $block.children('span');
        }

    }

</script>