(function ( $ ) {
    var crudGrid = (function () {
        var widget,
            table = null,
            clone = null,
            container = null;
        return {
            init:function(selector,options,self){
                widget = self;
                options = $.extend({}, $.crudGrid.defaults, options);
                //table.data('crudGrid', widget);

                table = $(selector);
                clone = table.find('tfoot tr');
                container = table.closest('div');
                container.find('.new-line').click(function(){
                    widget.addLine();
                });
                container.find('.remove-button').click(function(){
                    var $checked = table.find('.remove-line:checked');
                    $.each($checked,function(){
                        $(this).closest('tr').remove();
                    });
                });
            },
            /**
             * Убрать пустую строку если есть более одной
             */
            garbageCollector:function(){
                var countCell = clone.find('input').length;
                $.each( table.find('tbody tr'), function(){
                    var $this = $(this);
                    if($this.find('input:text[value=""]').length==countCell){
                        $this.remove();
                    }
                });
            },
            addLine:function(numFocus){
                var newLine = clone.clone();
                newLine.removeClass('hidden');
                table.find('tbody').append(newLine);
            }
        }

    });

    $.crudGrid = function(selector, options) {
        var widget = new crudGrid();
        widget.init(selector, options, widget);
    };

    $.crudGrid.defaults = {

    };

}( jQuery ));