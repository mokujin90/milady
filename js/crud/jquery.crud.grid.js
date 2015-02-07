var crudGrid = {
    table:null,
    clone:null,
    container:null,
    init:function(selector,options){
        crudGrid.table = $("#"+selector);
        crudGrid.clone = crudGrid.table.find('tfoot tr');
        crudGrid.container = crudGrid.table.closest('div');
        crudGrid.container.find('.new-line').click(function(){
            crudGrid.addLine();
        });
        crudGrid.container.find('.remove-button').click(function(){
            var $checked = crudGrid.table.find('.remove-line:checked');
            $.each($checked,function(){
               $(this).closest('tr').remove();
            });
        });
    },
    /**
     * Убрать пустую строку если есть более одной
     */
    garbageCollector:function(){
        var countCell = crudGrid.clone.find('input').length;
        $.each( crudGrid.table.find('tbody tr'), function(){
            var $this = $(this);
            if($this.find('input:text[value=""]').length==countCell){
                $this.remove();
            }
        });
    },
    addLine:function(numFocus){
        var newLine = crudGrid.clone.clone();
        newLine.removeClass('hidden');
        crudGrid.table.find('tbody').append(newLine);
    }

}
