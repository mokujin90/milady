
var region = {
    init:function(){
        $('.open-dialog').click(function(){
           $(this).closest('.form-group').find('span[id^="ws_"]').click();
        });
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

}