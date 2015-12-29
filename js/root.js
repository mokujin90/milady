$(window).load(function () {
   $(document).on('click','.delete-media-button',function(){
        var $this = $(this);
       if($this.parent().hasClass('region-document')){
           $this.parent().find('.fid').val('');
       } else if($this.parent().hasClass('file-block')){
           $('#file_block>*').remove();
       } else {
           $('#logo_block>*').remove();
       }
       $this.remove();
   });
    form.localization();
    form.datepicker();
});
var region = {
    init:function(){
        common.initMedia();
        this.tinyMCE();
        this.city();
        messagePart.upload();
        this.regionCompany();
        this.regionCity();
    },
    tinyMCE:function(){
        var $tiny = $('textarea.rte');
        if($tiny.length>0){
            console.log($tiny);
            $tiny.tinymce({
                script_url : '/js/vendor/tiny_mce/tiny_mce.js',
                language : 'ru',
                // General options
                theme : "advanced",
                plugins: 'imgmanager,pagebreak,style,table,advhr,advlink,iespell,inlinepopups,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template',
                // Theme options
                theme_advanced_buttons1 : 'imgmanager,formatselect,bold,italic,sub,sup,|,bullist,numlist,blockquote,|,link,unlink,|,copy,paste,pastetext,pasteword,|,removeformat,cleanup,code',
                theme_advanced_buttons2 : "",
                theme_advanced_buttons3 : "",
                theme_advanced_buttons4 : "",
                theme_advanced_resizing : true,

                content_css : "/css/tinymce.css",
                theme_advanced_blockformats:  "h2,h4",
                height: 300,
                convert_urls : false,
                relative_urls : false,
                remove_script_host : false
            });
        }
        /*tinymce.init({
            selector: "textarea.rte",
            menubar : false,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste moxiemanager"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });*/

    },
    city:function(){
        $(document).keypress(function(event)
        {
            if(event.keyCode === 13)
            {
                return false;
            }
        });
    },
    regionCity:function(){
        $('.change-city-visibility').change(function(){
            var self = $(this);
            var loading = self.closest('li').find('.loading');
            loading.css('opacity', 1);
            $.ajax('/admin/Region/changeCityVisibility', {
                method: "POST",
                dataType: "json",
                data: {
                    value: self.prop('checked') ? 1 : 0,
                    id: self.data('id')
                }
            })
            .always(function(data) {
                if(data.success === true) {
                    loading.css('opacity', 0);
                } else {
                    alert('Ошибка сохранения.');
                }
            });
        });
    },
    regionCompany:function(){
        $('.remove-company-line').click(function(){
            var table = $(this).closest('.company-table');
            var $checked = table.find('.remove-line:checked');
            $.each($checked,function(){
                $(this).closest('tr').remove();
            });
        });
        $('.new-company-line').click(function(){
            var table = $(this).closest('.company-table');
            var newLine = table.find('tfoot tr').clone();
            newLine.removeClass('hidden');
            newLine.find('.select-transport').prop('disabled', false);
            newLine.find('select').chosen({
                no_results_text: "Не найдено по совпадению"
            });
            table.find('tbody').append(newLine);
        });
        $(document).on('change', '.select-company-type', function(){
            var $self = $(this);
            var $selectId = $self.closest('tr').find(".select-company-id");
            $selectId.prop('disabled', true);
            if($self.val() == ''){
                return;
            }
            $.ajax('/admin/Region/getCompaniesJSON', {
                method: "POST",
                dataType: "json",
                data: {
                    type_id: $self.val()
                }
            })
            .always(function(data) {
                if(data.success === true) {
                    var options = '<option value="">---</option>';
                    $.each(data.options, function(){
                        options += '<option value="'+this.id+'">'+this.name+'</option>'
                    });
                    $selectId.html(options);
                    $selectId.prop('disabled', false);
                    $selectId.trigger("chosen:updated");
                } else {
                    alert('Server error.');
                }
            });
        });
    }

},
project = {
    init:function(){
        region.init();
        this.autocomplete();
    },
    autocomplete:function(){
        $( ".autocomplete" ).autocomplete({
            minLength: 2,
            //прогрузка с сервера
            source: function( request, response ) {
                $.getJSON( "/user/getUserJSON", request, function( data, status, xhr ) {
                    response( data );
                });
            },
            select: function( event, ui ) {
                $('#field_autocomplete').val(ui.item.value);
                $(this).val(ui.item.label);
                return false;
            },
            focus: function( event, ui ) {
                $(this).val(ui.item.label);
                return false;
            }
        });
    }
},
common={
    initMedia:function(){
        /*$('.open-dialog').click(function(){
            $(this).closest('.form-group').find('span[id^="ws_"]').click();
        });*/
    }
},
content = {
    init:function(){
        /*tinymce.init({
            selector: "textarea",
            width:$('#content-wrapper form').width()-100,
            height:500,
            menubar : false,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste moxiemanager"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });*/
        $('textarea.rte').tinymce({
            script_url : '/js/vendor/tiny_mce/tiny_mce.js',
            language : 'ru',
            // General options
            theme : "advanced",
            plugins: 'fullscreen,imgmanager,pagebreak,style,table,advhr,advlink,iespell,inlinepopups,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template',

            // Theme options
            theme_advanced_buttons1 : 'imgmanager,|,search,replace,formatselect,bold,italic,sub,sup,|,bullist,numlist,blockquote,|,link,unlink,|,copy,paste,pastetext,pasteword,|,removeformat,cleanup,code,fullscreen',
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            theme_advanced_buttons4 : "",
            theme_advanced_resizing : true,

            content_css : "/css/tinymce.css",
            theme_advanced_blockformats:  "h2,h4",
            height: 300,
            width:$('#content-wrapper form').width()-100,
            convert_urls : false,
            relative_urls : false,
            remove_script_host : false
        });
        $('.tags-input').tagsInput({
            'height':'auto',
            'width':'90%',
            'defaultText':'Добавить'
        });
    }
},
historyPart = {
    init:function(){
        $('.balance').fancybox($.extend({}, fancybox.init('auth no-header'), {
            width:365,
            height:'auto'
        }));
    }
};
var adminStatistic = {
    init:function(){
        var data = typeof chartInit !== 'undefined' ? chartInit : [];
        var max = 1;
        var created = [];
        $.each(data, function(key, item){
            if(item.count > max){
                max = parseInt(item.count);
            }
            created.push([key, item.count]);
        });

        var options = {
            height: '100%',
            series: {
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            grid: {
                hoverable: true
            },
            yaxis: {
                min: 0,
                max: max + (0.1 * max)
            },
            xaxis:{
                tickFormatter: function (val, axis) {
                    var date = new Date(val*1000);
                    var d = "0" + (date.getDate()+1);
                    var m = "0" + (date.getMonth()+1);
                    var y = date.getFullYear();
                    var formattedTime = y + '-' + m.substr(-2) + '-' + d.substr(-2);
                    return formattedTime;
                }
            },
            tooltip: true,
            tooltipOpts: {
                content: function(label, xval, yval, flotItem){
                    var date = new Date(xval*1000);
                    var d = "0" + date.getDate();
                    var m = "0" + (date.getMonth()+1);
                    var y = date.getFullYear();
                    var formattedTime = y + '-' + m.substr(-2) + '-' + d.substr(-2);
                    return yval + " (" + formattedTime + ")";
                },
                shifts: {
                    x: -60,
                    y: 25
                },
                legend: {
                    noColumns: 0,
                    position: 'nw',
                    show: true,
                    margin: 10
                }
            }
        };
        $.plot($("#flot-chart"), [
                {
                    data: created,
                    label: "&nbsp;Количество созданных&nbsp;",
                    lines: {show: true},
                    color: '#727cb6'
                }
            ],
            options);
        options.yaxis = {
            min: 0,max: 1
        };
        options.tooltipOpts.content =  function(label, xval, yval, flotItem){
            var date = new Date(xval*1000);
            var d = "0" + date.getDate();
            var m = "0" + (date.getMonth()+1);
            var y = date.getFullYear();
            var minutes = date.getMinutes();
            var formattedTime = y + '-' + m.substr(-2) + '-' + d.substr(-2);
            return yval.toString().substr(0,4) + " (" + formattedTime + ")";
        };
    }
}
