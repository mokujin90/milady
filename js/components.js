/**
 * Created by multeg on 18.09.14.
 */
var base = {
    init:function(){
        view.init();
    }
},
/**
 * Класс отвечающий за все эффекты, меню и прочее, которые есть в хедере, футере или будет использоваться на каждой странице.
 */
view = {
    init:function(){
        this.header();
        this.scrollUp()
    },
    header:function(){
        $('#my-project').click(function(){
            var $this = $(this);
            $this.hasClass('active') ? $this.removeClass('active') : $this.addClass('active');
        });
        /**
         * В проектах по ховеру будет выставлять завершенность проекта
         */
        $('#my-project .project-list a').hover(function(){
            var data = $(this).data();
            data.status = $.isNumeric(data.status) ? data.status : 0;
            $('#my-project .status-widget .rank:lt('+data.status+')').addClass('active');
        },
        function(){$('#my-project .status-widget .rank').removeClass('active');})
    },
    /**
     * Кнопка "Подняться вверх"
     */
    scrollUp:function(){
        var $scroll = $('#scroll-up');
        $scroll.css({'bottom':10})
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $scroll.fadeIn();
            } else if ($scroll.is(':visible')) {
                $scroll.fadeOut();
            }
        });
        $scroll.click(function(){
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });
    }
}