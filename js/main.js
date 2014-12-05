$(window).load(function () {
    base.init();
});

var indexPart = {
    init: function () {
        this.slider();
        this.map();
        eventWidget.init();
    },
    slider:function(){
        $('.bxslider').bxSlider({
            minSlides: 1,
            maxSlides: 1,
            slideWidth: 674,
            slideMargin: 10,
            useCSS:true
        });
    },
    map:function(){
        //скрыть-показать карты
        $('#map-up').click(function(){
            $(this).closest('.line').prev().slideUp();
        });
    }
},
regionsPart={
    init:function(){

    }
},
userProfilePart={
    init:function(){
        $('#user_type').on('select',function(e,id){
            id == 'investor' ? $('#investor-block').show() : $('#investor-block').hide();
        });
    }
},
projectDetail={
    init:function(){
        messagePart.upload();
    }
},
projectMapPart = {
    init:function(){
        $('.blue-menu .item').click(function(){
            var $this = $(this),
                data = {
                    action:$this.data('action'),
                    id:$('#project-id-value').val()
                };
            $.get( "/project/getInfo", data,function( data ) {
                $('#ajax-content').html(data);
            });
            return false;
        });
        $('.favorite').click(function(){
            var $this = $(this);
            if($this.data('project-id')) {
                $.ajax({ url: "/user/toggleFavorite",
                    async: false,
                    data:{
                        id:$this.data('project-id'),
                        type: 'project'
                    },
                    dataType: 'json',
                    success: function(json) {
                        if(json.success) {
                            $('.favorite').toggleClass('add').text($('.favorite').hasClass('add') ? Yii.t('main','Добавить в избранное') : Yii.t('main', 'В избранном'));
                        }
                    }
                });
            }
            return false;
        });
    }
},
messagePart = {
    /**
     * Общая часть для сообщений
     */
    init:function(admin){
        admin = typeof admin == 'undefined' ? false : admin;
        this.autocomplete();
        this.upload();
        $('.delete-message').click(function(){
            var $checked = $('.lk-crud:checked'),
                action = $('#action-name').val(),
                idList = $checked.map(function(){return $(this).val();}).get();
            if(idList.length==0){
                return false;
            }
            $.get( admin ? "/admin/Messages/remove" : "/message/remove", {id:idList,action:action},function( data ) {
                $checked.closest('tr').remove();
            });
            return false;
        });
    },
    autocomplete:function(){
        var cache = {};
        $( ".autocomplete" ).autocomplete({
            minLength: 2,
            //прогрузка с сервера
            source: function( request, response ) {
                var term = request.term;
                if ( term in cache ) {
                    response( cache[ term ] );
                    return;
                }
                $.getJSON( "/user/getUserJSON", request, function( data, status, xhr ) {
                    cache[ term ] = data;
                    response( data );
                });
            },
            select: function( event, ui ) {
                $('#Message_user_to').val(ui.item.value);
                $(this).val(ui.item.label);
                return false;
            },
            focus: function( event, ui ) {
                $(this).val(ui.item.label);
                return false;
            }
        });
    },
    upload:function(){
        //эмуляция нажатия на картинку
        $('.attach-action').click(function(){
            var $this = $(this),
                type = $this.data('type');
            $('#'+type).find('.photos').find('span:eq(0)').click();
            $('.attach-wrap').removeClass('active'); //закроем popup окошко
        });
        $(document).on('click.media','a.delete-file',function(){
           $(this).closest('.uploaded-file-name').parent().remove();
            return false;
        });
        //открытие/скрытие окна
        $('.attach-btn').click(function () {
            $(this).closest('.attach-wrap').toggleClass('active');
        });
    }
}