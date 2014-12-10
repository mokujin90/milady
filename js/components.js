/**
 * Created by multeg on 18.09.14.
 */
function get(variable,defaultValue){
    return typeof variable == 'undefined' ? defaultValue : variable;
}
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
        this.feedback('','auth no-header',365,193);
        this.cityDrop();
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
    feedback:function(title,classes,width,height){
        $('.feedback-fancy').fancybox($.extend({}, fancybox.init(classes), {
            title:title,
            width:width,
            height:'auto',
            afterClose:function(){
                $(".feedback-form").find("input[type='text'],textarea").val("");
            }
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
    },
    cityDrop:function(){
        $('#city-drop').on('select',function(e,id){
            location.href = '/site/setRegion/id/'+id;
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
            if($this.prop('checked')){
                $child.show().find('input').prop('disabled',false);
            }
            else{
                $child.hide().find('input').prop('disabled',true);
            }
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
    ajaxError:function(data,formSelector,noExit,isFancy){
        noExit = get(noExit,true);
        isFancy = get(isFancy,false);
        var $form = $(formSelector);
        $form.find(".errorMessage").hide();
        if(data.error!='[]'){
            var error = $.parseJSON(data.error);
            $.each(error, function(key, val) {
                $form.find("#"+key+"_em_").text(val).show();
            });
        }
        else if(data.status==true && noExit){
            location.href=data.url;
        }
        else if(isFancy){
            $.fancybox.close();
        }
    }
},
filter = {
    init:function(){
        filter.slide();
    },
    showShort:function(){
        var shortArray = this.getShortText(),
            short = shortArray.join('<span>/</span>'),
            html = '<div class="result-caption">'+Yii.t("main","Результат сортировки")+':</div>' +
                '<div class="difference">'+short+'</div>' +
                '<div id="slide-filter" class="icrud icrud-block-slide-down"></div>';
        $('.filter-form').closest('.content').next('.line').find('.main').html(html);
        $('.full-form').hide();
    },
    hideShort:function(){
        var  html = '<div id="slide-filter" class="icrud icrud-block-slide-up"></div>';
        $('.filter-form').closest('.content').next('.line').find('.main').html(html);
        $('.full-form').show();
    },
    /**
     * Составить массив из измененных данных в фильтре
     * @returns {Array}
     */
    getShortText:function(){
        var $filter = $('.filter-form'),
            list = [];

        $.each( $filter.find('.selected'), function(){
            var $this = $(this),
                item = [];
            $.each( $this.find('.option'), function(i, element){
                var label = $(this).find('label').text();
                item.push(label);
            });
            if(item.length>0){
                var implode = item.join(', ');
                list.push(implode);
            }
        });
        //отфильтруем только видимые поля (а то range-слайдер подхватывает)
        var $inputs = $filter.find('input.crud[type="text"]').filter(function(){
            if($(this).css('display') != 'none')
                return $(this);
        });
        $.each( $inputs, function(){
            var $this = $(this),
                value = $this.val();
            if(value.length>0){
                list.push(value);
            }
        });
        return list;
    },
    slide:function(){
        $(document).on('click.filter','#slide-filter',function(){
            var $this = $(this);
            $this.toggleClass('icrud-block-slide-up icrud-block-slide-down');
            $this.hasClass('icrud-block-slide-down') ? filter.showShort() : filter.hideShort();
        });
    }
},
eventWidgetLoading = false,
eventWidget = {
    init:function(){
        this.update();
    },
    update:function(){
        $('.calendar-widget .date span').click(function(){
            if (eventWidgetLoading) {
                return;
            }
            eventWidgetLoading = true;
            var $this = $(this).closest('.date');
            $('.calendar-widget .loader').addClass('active');
            $.ajax({
                url: "/event/getItem",
                data:{
                    date:$this.data('date')
                },
                success: function(data) {
                    $('.calendar-widget .selected').removeClass('selected');
                    $this.addClass('selected');
                    $('#calendar-event').html(data);
                    $('.calendar-widget .loader').removeClass('active');
                    eventWidgetLoading = false;
                }
            });
        });
    }
}
