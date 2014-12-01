
var region = {
    init:function(){
        common.initMedia();
        //this.tinyMCE();
    },
    tinyMCE:function(){
        tinyMCE.baseURL = '/js/vendor/tinymce';
        var $mce = $('textarea.rte');
        if($mce.length==0){
            return false;
        }
        $.each($mce, function(key, val) {
            var $this = $(this);
            console.log($this.attr('id'));
            tinymce.init({
                selector: "#"+$this.attr('id'),
                plugins: ["image"]
            });
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
}
