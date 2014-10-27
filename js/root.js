
var region = {
    init:function(){
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