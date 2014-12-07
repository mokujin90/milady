
var region = {
    init:function(){
        common.initMedia();
        this.tinyMCE();
    },
    tinyMCE:function(){
        tinymce.init({
            selector: "textarea.rte",
            menubar : false,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste moxiemanager"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });

    }

},
project ={
    init:function(){
        region.init();
        this.autocomplete();
    },
    autocomplete:function(){
        var cache = {};
        $( ".autocomplete" ).autocomplete({
            minLength: 2,
            //прогрузка с сервера
            source: function( request, response ) {
                var term = request.term;
                if ( term in cache ) {
                    response( cache[ term ] );
                    return;
                }
                $.getJSON( "/user/getUserJSON", request, function( data, status, xhr ) {
                    cache[ term ] = data;
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
        tinymce.init({
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
        });
    }
}
