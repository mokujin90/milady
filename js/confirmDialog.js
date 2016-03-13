(function ( $ ) {
    $.confirmDialog = function(options) {
        var settings = $.extend({}, $.confirmDialog.defaults, options);
        var confirmed = false;

        var contentHtml = $('<div class="fancy-alert popup popup-success" style="width: auto;">')
            .append($('<div class="popup-success__desc">').html(settings.content));
        if (settings.confirmText != false) {
            contentHtml.append($('<button style="margin-right: 11px;" class="blue-btn popup-form__btn confirm-alert-action">').html(settings.confirmText));
        }
        if (settings.cancelText != false) {
            contentHtml.append($('<button class="blue-btn popup-form__btn cancel-alert-action">').html(settings.cancelText));
        }
        var params = {
            content: contentHtml,
            width:410,
            height:'auto',
            fitToView: false,
            autoSize:false,
            scrolling:'no',
            closeBtn:true,
            wrapCSS:'alert '+settings.addClass,
            helpers : {
                title: {
                    type: 'inside',
                    position: 'top'
                },
                overlay: {
                    locked: false
                }
            },
            afterShow : function() {
                if(options.title!='title'){
                    $('.fancybox-title-inside-wrap').html('<div class="icons notice">');
                }
                $(".fancy-alert .confirm-alert-action").click(function() {
                    confirmed = true;
                    $.fancybox.close();
                })
                $(".fancy-alert .cancel-alert-action").click(function() {
                    confirmed = false;
                    $.fancybox.close();
                    settings.noCallback();
                    return false;
                })
            },
            afterClose : function() {
                if(confirmed){
                    settings.confirmCallback();
                } else {
                    settings.cancelCallback();
                }
            }
        };

        $.fancybox(params);
    }

    $.confirmDialog.defaults = {
        content:'Подтвердите действие',
        confirmText: 'Подтверждаю',//false - скрывает кнопку
        cancelText: 'Отмена', //false - скрывает кнопку
        title:'title',
        confirmCallback: function(){},
        cancelCallback: function(){},
        noCallback:function(){},
        addClass:'' //дополнительный класс
    };
}( jQuery ));