$(window).load(function () {
   $(document).on('click','.delete-media-button',function(){
        var $this = $(this);
       $('#logo_block>*').remove();
       $this.remove();
   });
    form.localization();
    form.datepicker();
});
var region = {
    init:function(){
        common.initMedia();
        this.tinyMCE();
        this.city();
        messagePart.upload();
    },
    tinyMCE:function(){
        var $tiny = $('textarea.rte');
        if($tiny.length>0){
            console.log($tiny);
            $tiny.tinymce({
                script_url : '/js/vendor/tiny_mce/tiny_mce.js',
                language : 'ru',
                // General options
                theme : "advanced",
                plugins: 'imgmanager,pagebreak,style,table,advhr,advlink,iespell,inlinepopups,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template',
                // Theme options
                theme_advanced_buttons1 : 'imgmanager,formatselect,bold,italic,sub,sup,|,bullist,numlist,blockquote,|,link,unlink,|,copy,paste,pastetext,pasteword,|,removeformat,cleanup,code',
                theme_advanced_buttons2 : "",
                theme_advanced_buttons3 : "",
                theme_advanced_buttons4 : "",
                theme_advanced_resizing : true,

                content_css : "/css/tinymce.css",
                theme_advanced_blockformats:  "h2,h4",
                height: 300,
                convert_urls : false,
                relative_urls : false,
                remove_script_host : false
            });
        }
        /*tinymce.init({
            selector: "textarea.rte",
            menubar : false,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste moxiemanager"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });*/

    },
    city:function(){
        $(document).keypress(function(event)
        {
            if(event.keyCode === 13)
            {
                return false;
            }
        });
    }

},
project = {
    init:function(){
        region.init();
        this.autocomplete();
    },
    autocomplete:function(){
        $( ".autocomplete" ).autocomplete({
            minLength: 2,
            //прогрузка с сервера
            source: function( request, response ) {
                $.getJSON( "/user/getUserJSON", request, function( data, status, xhr ) {
                    response( data );
                });
            },
            select: function( event, ui ) {
                $('#field_autocomplete').val(ui.item.value);
                $(this).val(ui.item.label);
                return false;
            },
            focus: function( event, ui ) {
                $(this).val(ui.item.label);
                return false;
            }
        });
    }
},
common={
    initMedia:function(){
        /*$('.open-dialog').click(function(){
            $(this).closest('.form-group').find('span[id^="ws_"]').click();
        });*/
    }
},
content = {
    init:function(){
        /*tinymce.init({
            selector: "textarea",
            width:$('#content-wrapper form').width()-100,
            height:500,
            menubar : false,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste moxiemanager"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });*/
        $('textarea.rte').tinymce({
            script_url : '/js/vendor/tiny_mce/tiny_mce.js',
            language : 'ru',
            // General options
            theme : "advanced",
            plugins: 'imgmanager,pagebreak,style,table,advhr,advlink,iespell,inlinepopups,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template',

            // Theme options
            theme_advanced_buttons1 : 'imgmanager,formatselect,bold,italic,sub,sup,|,bullist,numlist,blockquote,|,link,unlink,|,copy,paste,pastetext,pasteword,|,removeformat,cleanup,code',
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            theme_advanced_buttons4 : "",
            theme_advanced_resizing : true,

            content_css : "/css/tinymce.css",
            theme_advanced_blockformats:  "h2,h4",
            height: 300,
            width:$('#content-wrapper form').width()-100,
            convert_urls : false,
            relative_urls : false,
            remove_script_host : false
        });
    }
},
historyPart = {
    init:function(){
        $('.balance').fancybox($.extend({}, fancybox.init('auth no-header'), {
            width:365,
            height:'auto'
        }));
    }
}
