/**
 * Created by multeg on 18.09.14.
 */
var base = {
    init:function(){
        view.init();
        crud.init();
    }
},
/**
 * Класс отвечающий за все эффекты, меню и прочее, которые есть в хедере, футере или будет использоваться на каждой странице.
 */
view = {
    init:function(){
        this.header();
        this.scrollUp()
        this.auth('','auth no-header',365,193);
    },
    header:function(){
        $('.menu-slide').click(function(){
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
    auth:function(title,classes,width,height){
        $('.auth-fancy').fancybox($.extend({}, fancybox.init(classes), {
            title:title,
            width:width,
            height:'auto'
        }));
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
},

//для разнообразных элементов
crud = {
    init:function(){
        this.swipe();
        this.range('.crud.slider');
        this.media();
    },
    //radio-кнопка наподобии свайпа (потяни меня)
    swipe:function(){
        $(document).on('click.crud','.swipe input[type="checkbox"]',function(){
            var $this = $(this);
            $this.siblings('label').text($this.attr('checked')? Yii.t('main',"Вкл") : Yii.t('main',"Выкл"));
        });
        $('.switcher-parent .swipe input[type="checkbox"]').click(function(){checkSwipe($(this));});

        $.each( $('.switcher-parent input[type="checkbox"]'), function( i, element ){
            checkSwipe($(element)); //пройдемся по всем зависимым элемента и скроем ненужные
        });
        function checkSwipe($this){
            var  $child = $this.closest('.switcher-parent').next('.switcher-child');
            $this.prop('checked') ? $child.show() : $child.hide();
        }
    },
    //подключить ion слайдер ко всем элементам
    range:function(select){
        $.each( $(select), function( i, element ){
            var $this = $(element),
                data = $this.data();
            $this.ionRangeSlider({
                min: data.min,
                max: data.max,
                from: data.from,
                to: data.to,
                type: 'double',
                hideMinMax: true
            });

        });
    },
    //достаточно разместить кнопку с этим классом и виджет с медиаэдитором на одном уровен DOM
    media:function(){
        $('.open-dialog').click(function(){
            console.log($(this).siblings('.photos span'));
            $(this).siblings('.photos').find('span').click();
        });
    }
},
/**
 * Синглтон, для эмуляции фабрики виджетов
 */
    fancybox = {
    /**
     * Совместно с $.extend поможет сократить код для стандартных fancybox'ов, которые будут изменяться.
     * @param addClass
     * @returns {{closeClick: boolean, closeBtn: boolean, wrapCSS: *, helpers: {title: {type: string, position: string}}}}
     */
    init:function(addClass){

        addClass = typeof addClass !== 'undefined' ? " "+addClass : '';
        return {
            fitToView: false,//отключаем автоопределение ширины
            autoSize:false,
            scrolling:'no',
            closeBtn:true,
            wrapCSS:'action' + addClass,
            helpers : {
                title: {
                    type: 'inside',
                    position: 'top'
                }
            },
            beforeLoad:function(){
                $(document).on('click.fancybox','.close-fancy',function(){
                    $.fancybox.close()
                });
            }
        }
    },
    /**
     * Обновим высоту фэнсибокса в зависимости от какого либо объекта
     * @param $element
     */
    changeSize:function($element){
        var $fancybox = $('div.fancybox-inner');
        $fancybox.attr('style', function(i,s) { return s + 'height: '+$element.innerHeight()+'px !important;' });
        console.log();
        $.fancybox.reposition();
    }
},
form = {
    ajaxError:function(data,formSelector){
        var $form = $(formSelector);
        $form.find(".errorMessage").hide();
        if(data.error!='[]'){
            var error = $.parseJSON(data.error);
            $.each(error, function(key, val) {
                $form.find("#"+key+"_em_").text(val).show();
            });
        }
        else if(data.status==true){
            location.href=data.url;
        }
    }
}

