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
}