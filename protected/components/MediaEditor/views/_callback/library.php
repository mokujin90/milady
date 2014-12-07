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
    function wsf_item_<?php echo str_replace(array('[',']'), '', $field)?>(data, settings){
        var $block = $('#logo_block'),
            inputId=$('<input/>').attr({
                name:"media_id",
                type:"hidden",
                value:data['id']

            }),
            inputName=$('<input/>').attr({
                name:"normal_name",
                type:"text",
                value:data['old_name']
            }).addClass('form-control'),
            $new = $('<span/>').append(inputId);
            $('.file-normal-name').prepend(inputName);
        return $new;
    }

</script>