<script type="text/javascript">

    function wsf_item_init(){
    }
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
        var $wrap = $gridMediaLoadItem.parent(),
            $preview = $wrap.find('.media-preview');
        $wrap.find('.media-val').val(data.id);
        $preview.html($('<img>').attr("src",data['preview_url']));

        return $('<img/>');
    }

    function wsf_item_onUpload(){
        var $wrap = $gridMediaLoadItem.parent(),
            $preview = $wrap.find('.media-preview');
        $preview.html("Загрузка...");
    }

</script>