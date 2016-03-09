/**
 * Created by Алексей on 29.02.2016.
 */

$(document).ready(function(){
    //sliders
    $('.main-slides').bxSlider({
        pagerCustom: '.main-slider-pager',
        speed: 1000,
        nextText: ' ',
        prevText: ' ',
        onSliderLoad: function () {
            $(".main-slider .bx-pager.bx-default-pager").remove();
        }
    });

    $('.promo-slides').bxSlider({
        pagerCustom: '.promo-slider-pager',
        nextSelector: '.promo-slider-listing__next',
        prevSelector: '.promo-slider-listing__prev',
        nextText: ' ',
        prevText: ' ',
        onSliderLoad: function () {
            $(".promo-slider .bx-pager.bx-default-pager").remove();
        }
    });

    var regions = $('.region-tab');

    for(var i = 0; i < regions.length; i++) {
        regions.eq(i).find('.region-slides').bxSlider({
            pagerCustom: regions.eq(i).find('.region-slider-listing'),
            nextSelector: regions.eq(i).find('.region-slider__next'),
            prevSelector: regions.eq(i).find('.region-slider__prev'),
            nextText: ' ',
            prevText: ' ',
            onSliderLoad: function () {
                $(".region .bx-pager.bx-default-pager").remove();
            }
        });
    }
    //end slider

    //scroll
    var top = $(this).scrollTop();
    var scrollBtn = $('.scroll-top');
    if (top < 240) {
        scrollBtn.fadeOut();
    } else {
        scrollBtn.fadeIn();
    }

    $(window).scroll(function() {
        top = $(this).scrollTop();

        if (top < 240) {
            scrollBtn.fadeOut();
        } else {
            scrollBtn.fadeIn();
        }
    });
    $('.scroll-btn').on('click', function(e) {
        var id = $(this).data('href');
        $('html,body').stop().animate({ scrollTop: $(id).offset().top}, 1000);
        e.preventDefault();
        return false;
    });
    //end scroll

    //form elements
    var scroller = $('.filter_with-scroll');

    if(scroller.index() != -1) {
        scroller.scroller();
    }

    function scrollReset() {
        if(scroller.index() != -1) {
            scroller.scroller("reset");
        }
    }
    $('.filter-block__btn').on('click', function() {
        var block = $(this).parents('.filter-block');
        if(block.hasClass('open')) {
            block.find('.filter-block-list').slideUp(200, function(){
                scrollReset();
            });
        } else {
            block.find('.filter-block-list').slideDown(200, function(){
                scrollReset();
            });
        }
        block.toggleClass('open');
    });

    $('.checkbox, .switch, .agree').on('click', function(e) {
        e.preventDefault();
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).find('input').attr('checked', false);
        } else {
            $(this).addClass('active');
            $(this).find('input').attr('checked', true);
        }
        scrollReset();
    });

    $('.switch').on('click', function() {
        $(this).parent().toggleClass('open');
        scrollReset();
    });

    $('.p-filter-block__add').on('click', function() {
        if($(this).hasClass('open')) {
            $(this).removeClass('open');
            $('.p-filter-add').slideUp(function(){
                $(this).removeClass('open');
                scrollReset();
            });
            $('span', this).text('Подробный фильтр');
        } else {
            $(this).addClass('open');
            $('.p-filter-add').slideDown(function(){
                $(this).addClass('open');
                scrollReset();
            });
            $('span', this).text('Свернуть фильтр');
        }
    });
    //end form elements

    //regions
    $('.region__btn').on('click', function() {
        var regionsList = $('.region-list');
        if(regionsList.hasClass('open')) {
            regionsList.removeClass('open').css({'visibility': 'hidden', 'height': '0'});
        } else {
            regionsList.addClass('open').css({'visibility': 'visible', 'height': 'auto'});
        }
    });
    //end regions

    //tabs
    $('.tab-link').on('click', function() {
        var index = $(this).data('index');
        $('.tab-link').removeClass('active');
        $(this)
            .addClass('active')
            .parents('.tabs-wrap')
            .find('.tab')
            .removeClass('active')
            .eq(index)
            .addClass('active');
    });
    //end tabs

    var chart = {
        init: function() {
            this.setEvents();
        },

        selectRow: function() {
            var self = this, rows = $('.chart-table-row');
            rows.hover(function(){
                rows.removeClass('active');
                $(this).addClass('active');
                self.setGraph($(this).data('type'), this);
            });
        },

        selectQuotes: function() {
            var self = this,
                quotes = $('.quotes__quotation'),
                quotesBlocks = $('.quotes-sec-block');

            quotes.click(function(){
                var index = $(this).index();
                quotes.removeClass('active');
                $(this).addClass('active');
                quotesBlocks.removeClass('active');
                quotesBlocks.eq(index).addClass('active');
                self.refreshGraph();
            });
        },

        selectQuotesAdd: function() {
            var self = this;
            $('.quotes-sec').on('click', '.quotes-sec-block.active .quotes-sec__quotation', function(){
                var quotesSec = $('.quotes-sec-block.active .quotes-sec__quotation');
                quotesSec.removeClass('active');
                $(this).addClass('active');
                self.refreshGraph();
            });
        },

        refreshGraph: function(type, elem) {
            var charts = $('.chart-result'),
                index = $('.quotes-sec-block.active .quotes-sec__quotation.active').data('index');
            charts.removeClass('active');
            charts.eq(index).addClass('active');
        },

        setGraph: function(type, elem) {
            var img = $(elem).parents('.chart-result').find('img'),
                src = img.attr('src');

            src = src.slice(0, src.lastIndexOf('/') + 1);
            img.attr('src', src + type + '.jpg');
        },

        setEvents: function() {
            this.selectRow();
            this.selectQuotes();
            this.selectQuotesAdd();
        }

    };

    if($('.chart').index() != -1) {
        chart.init();
    }

});