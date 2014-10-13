(function($) {
    var defaults = ({
        'multiple':true
    });
    var methods  = {
        init:function(option){
            var option = $.extend({}, defaults, option);
            var $element = $(this), $button = $element.find('.button-down'),
                $dropDown = $element.find('.drop-down');

            //показ/скрытие списка элементов
            $button.bind('click.crud',function(){
                $dropDown.toggleClass('active');
                if($dropDown.hasClass('active')){
                    $(document).mouseup(function (e)
                    {   //клик вне
                        if ((!$dropDown.is(e.target) && $dropDown.has(e.target).length === 0 ) || $(e.target).hasClass('button-down')){
                            $dropDown.removeClass('active');
                            $(document).off('mouseup');
                        }

                    });
                }

            });

            //клик по элементу. Соответственно перенос элемента вправо. При переносе всегда изымаем текст из label'a
            $dropDown.find('.option').bind('click.crud',function(){
                methods.select($(this),$element,option);
                return false;
            });

            $element.on('click.crud','.unselect',function(){
                methods.unselect($(this).closest('.option'),$element,option);
                return false;
            });
        },
        select:function($this,$element,option){
            var $new = $this.clone(false),
                text = $new.find('label').text(),
                $selected = $element.find('.selected'); //блок с выбранными элементами
            //добавляем в одиночный селект
            if(!option.multiple){
                if($this.hasClass('block')){ //необходимо сделать unselect
                    methods.unselect($this,$element,option);
                    return false;
                }
                methods.unselectDrop($element);
                $selected.find('.option').remove();
                $new.append(text).find('label').remove();
                $new.appendTo($selected);
            }
            else{
                if($this.hasClass('block')){
                    return false;
                }
                $new.find('label').text('').addClass('unselect').after(text);
                $new.find(':checkbox').attr('checked',true);
                $selected.append($new);
            }
            $this.addClass('block');
        },
        unselect:function($this,$element,option){
            if(option.multiple){
                var  id = $this.find(':checkbox').val(),
                    $dropDown = $element.find('.drop-down'),
                    $dropOption = $dropDown.find('input[value="'+id+'"]').closest('.option');
                $this.remove();
                $dropOption.removeClass('block');
            }
            else{
                $element.find('.selected .option').contents().remove();
                methods.unselectDrop($element);
            }

        },
        unselectDrop:function($element){
            $element.find('.drop-down .option').removeClass('block');
        }
    }

    $.fn.dropDown = function(method) {
        if ( methods[method] ) {
            return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Метод с именем ' +  method + ' не существует для jQuery.tooltip' );
        }
    };
})(jQuery);