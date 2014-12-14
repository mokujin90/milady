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
                $('.drop-down').not($dropDown).removeClass('active'); //скроем остальные
                $dropDown.toggleClass('active');
                /*if($dropDown.hasClass('active')){
                    $(document).mouseup(function (e)
                    {   //клик вне
                        if ((!$dropDown.is(e.target) && $dropDown.has(e.target).length === 0 ) || $(e.target).hasClass('button-down')){
                            $dropDown.removeClass('active');
                            $(document).off('mouseup');
                        }

                    });
                }*/

            });
            $element.siblings('label').bind('click.crud',function(){
                $button.click();
            });
            //клик по элементу. Соответственно перенос элемента вправо. При переносе всегда изымаем текст из label'a
            $dropDown.find('.option label').bind('click.crud',function(){
                var id = methods.select($(this),$element,option);
                if(!id){
                    return false;
                }
                $element.trigger('select',[id]);
            });

            $element.on('click.crud','.unselect',function(){
                var id = methods.unselect($(this).closest('.option'),$element,option);
                $element.trigger('unselect',[id]);
                return false;
            });

            $dropDown.find('.button-panel .btn').bind('click.crud',function(){
               var $this = $(this);
                if($this.hasClass('drop-ok')){

                }
                else if($this.hasClass('drop-cancel')){
                    $button.click();
                }
            });
            $dropDown.find('.button-panel .check-all').bind('click.crud',function(){
               var $this = $(this);
                $this.toggleClass('checked');
                if($this.hasClass('checked')){
                    $dropDown.find('.rel :checkbox:not(:checked)').click();
                }
                else{
                    $dropDown.find('.rel :checkbox:checked').click();
                }
            });

        },
        select:function($this,$element,option){
            var $option = $this.closest('.option'),
                $checkbox = $option.find('input[type="checkbox"]'),
                isCheck = $checkbox.prop('checked'),
                $selected = $element.find('.selected'), //блок с выбранными элементами
                id = $checkbox.val();//значение по которому будем искать дургой элемент (при удалении)
            if(isCheck){//если мы удаляем из списка позицию
                if(!option.multiple){
                   $checkbox.prop('checked',true);
                   return false;
                }
                $selected.find('.option[data-val="'+id+'"]').remove();
            }
            else{//добавим
                if(option.multiple){
                    if( $selected.find('.option[data-val="'+id+'"]').length==0){
                        var $new = '<div class="option" data-val="'+id+'"><div class="unselect"></div><label for="#">'+$this.text()+'</label></div>';
                        $selected.append($new);
                    }
                }
                else{ //при одиночном выборе
                    var $edit = $selected.find('.option');
                    if($edit.length>0){ //если выбранный элемент есть - изменим его текст
                        $edit.data('val',id).find('label').text($this.text());
                    }
                    else{
                        var $new = '<div class="option" data-val="'+id+'"><label for="#">'+$this.text()+'</label></div>';
                        $selected.append($new);
                    }
                    //снимем все чекбоксы кроме выбранного
                    $option.closest('.drop-down').removeClass('active').find(':checkbox').not($this).prop('checked',false);
                }
            }
            return id;
        },
        unselect:function($this,$element,option){
            var $option =  $this.closest('.option'),
                id = $option.data('val'),
                $dropDown = $element.find('.drop-down'),
                $dropOption = $dropDown.find('input[value="'+id+'"]');
            if(option.multiple){
                return id;
            }
            $this.remove();
            $dropOption.prop('checked',false);
            return id;
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