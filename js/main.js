$(window).load(function () {
    base.init();
});

var indexPart = {
    init: function () {
        this.slider();
        this.map();

    },
    slider:function(){
        $('.bxslider').bxSlider({
            minSlides: 1,
            maxSlides: 1,
            slideWidth: 674,
            slideMargin: 10,
            useCSS:true
        });
    },
    map:function(){
        //скрыть-показать карты
        $('#map-up').click(function(){
            $(this).closest('.line').prev().slideUp();
        });
    }
},
regionsPart={
    init:function(){

    }
},
root = {
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