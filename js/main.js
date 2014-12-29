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
            //slideWidth: 674,
            slideMargin: 10,
            useCSS:true
        });
    },
    map:function(){
        //скрыть-показать карты
        $('#map-up').click(function(){
            var $this = $(this);
            $this.toggleClass('icon-slide-up icon-slide-down');
            if($this.hasClass('icon-slide-up')){
                $this.closest('.line').prev().slideDown();
            }
            else{
                $this.closest('.line').prev().slideUp();
            }

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
        var hash = document.location.hash.substr(1, document.location.hash.length),
            $inputs = $('.blue-menu').find('a').filter(function(){
                if($(this).data('action') == hash)return $(this);
            });
        if(hash!=''){
            $inputs.click();
            $('html,body').animate({
                    scrollTop: $("#scrollable").offset().top},
                'slow');
        }
        $('#new-request').click(function(){
            var $this = $(this);
            $.get( $this.attr('href') ,function( data ) {
                if(data.status == 'Ok'){
                    $this.text(Yii.t('main','Заявка в обработке'));
                }
                $.confirmDialog({
                    content: data.status == 'Ok' ? Yii.t('main',"Заявка отправлена. Написать сообщение инициатору?") : Yii.t('main',"Вы не можете отправлять заявку") ,
                    confirmText: data.status == 'Ok' ? 'Написать' : false,
                    cancelText:'Отмена',
                    confirmCallback:function(){
                        window.location = '/message/create/to/'+data.initiator+'/project_id/'+data.project_id;
                    }
                });
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
},
feedPart = {
    block:false,
    init:function(){
        $('.project-filter .drop-ok').click(function(){
            if(!feedPart.block){
                feedPart._ajaxGet();
            }
        });
        $('.project-filter .elements input:checkbox').change(function(){
            if(!$('.project-filter .elements [name="project[]"]:checked').length){
                $('.project-filter .drop-ok').css('visibility', 'hidden');
            } else {
                $('.project-filter .drop-ok').css('visibility', 'inherit');
            }
        });
    },
    _ajaxGet:function(){
        feedPart.block = true;
        var $form = $('#form-projects-filter');
        $.ajax({ url: "/user/getUrl",
            async: true,
            type:'POST',
            data:{
                get:$('#url').val(),
                projects: $form.serializeArray()
            },
            success: function(url) {
                feedPart.block = false;
                location.href = url;
            }
        });
    }
},
banner={
    init:function(){
        $('#banner-type').on('select',function(e,id){
            var $region = $('#region-list .elements').find(':checkbox:checked');
            if($region.length>0){
                banner._recommend(id,$region.val());
            }

        });
        $('#region-list').on('select',function(e,id){
            var $type = $('#banner-type .elements').find(':checkbox:checked');
            if($type.length>0){
                banner._recommend(id,$type.val());
            }
        });
    },
    _recommend:function(id,regionId){
        $.ajax({ url: "/banner/getRecommendPrice",
            type:'GET',
            data:{
                type:id,
                regionId:regionId
            },
            success: function(data) {
                var $postfix = id == 'click' ? Yii.t('main','за клик') : Yii.t('main','за 1000 просмотров');
                $('#recommend_price').text(data+" руб. "+ $postfix);
            }
        });
    }
}