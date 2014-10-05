$(window).load(function () {
    base.init();
});

var indexPart = {
    init: function () {
        this.slider();
    },
    slider:function(){
        $('.bxslider').bxSlider({
            minSlides: 1,
            maxSlides: 1,
            slideWidth: 676,
            slideMargin: 10,
            useCSS:true
        });
    }
}