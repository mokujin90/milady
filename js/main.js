$(window).load(function () {
    if(typeof base !='undefined'){
        base.init();
    }

    $('.description-counter').after('<div class="notice">Символов осталось: <b><span class="value">255</span></b></div>');
    $('.description-counter').keyup(function () {
        var left = 255 - $(this).val().length;
        $notice = $(this).next('.notice');
        $notice.find('.value').text(left);
    }).keyup();
});
var newsPart ={
    init:function(){
        indexPart.moreInit();
        },
        detail:function(){
            $('.article-slides').bxSlider({
                pagerCustom: '.article-slider-pager',
                nextSelector: '.article-slider-listing__next',
                prevSelector: '.article-slider-listing__prev',
                nextText: ' ',
                prevText: ' ',
                onSliderLoad: function () {
                    $(".article-slider .bx-pager.bx-default-pager").remove();
                }
            });
        }

};
var social = {
    init:function(){
        $('.page-social__link').click(function(){
            window.open($(this).attr("href"),'displayWindow', 'width=700,height=400,left=200,top=100,location=no, directories=no,status=no,toolbar=no,menubar=no');
            return false;
        });
        var currentUrl = window.location.href;
        social._fbCounter(currentUrl);
        social._vkCounter(currentUrl);
        social._linkedCounter(currentUrl);
        console.log(1);
    },
    _fbCounter:function(url){
        $.getJSON('http://api.facebook.com/restserver.php?method=links.getStats&callback=?&urls=' + url + '&format=json', function(data) {
            // вставляем в DOM
            $('.page-social__link_fb .page-social__count').text(data[0].share_count);
        });
    },
    _vkCounter:function(url){
        VK = {};
        VK.Share = {};
        // объявляем callback метод
        VK.Share.count = function(index, count){
            // вставляем в DOM
            $('.page-social__link_vk .page-social__count').text(count);
        };
        $.getJSON('http://vkontakte.ru/share.php?act=count&index=1&url=' + url + '&format=json&callback=?');
    },
    _linkedCounter:function(url){
        $.getJSON('http://www.linkedin.com/countserv/count/share?url=' + url + '&callback=?', function (data) {
            $('.page-social__link_in .page-social__count').text(data.count);
        });
    }
};
var indexPart = {
    init: function () {
        this.moreInit();
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
    moreInit:function(){
        $('#ajax-load-article').click(function(){
            var $self = $(this);
            if ($self.hasClass('disabled')) {
                return false;
            }
            var $form = $(this).closest('form');
            $self.addClass('disabled');
            $.get($form.attr('action'),$form.serializeArray(),function(data){
                $('.ajax-more-article').append(data);
                $self.removeClass('disabled');
                if($('#end_article').size()==0){
                    $form.find('[name=page]').val(parseInt($form.find('[name=page]').val()) + 1);
                } else {
                    $form.hide();
                }
            });
            return false;
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
        //сворачивание
        $(document).on('click.map','.slide-filter',function(){
           $('#filter-map').hide();
            return false;
        });
        //ajax-отправка при изменении формы
        $(document).on('click.map','.filter-map-select .option input',function(e){
            var $this = $(this),
                id = $this.val();
            indexPart._ajaxFilterMap(e,id);
            return false;
        });
    },
    _ajaxFilterMap:function(e,id){
        var $form = $('#filter-map-form'),
            currentSelect = $(e.target).find('.elements input[value="'+id+'"]').attr('name'),
            serializeArray = {};
        serializeArray[currentSelect] = id;//ну не прогружается еще инпут, когда мы кликнули
        $.each($form.serializeArray(), function(key, val) {
            serializeArray[val.name] = val.value;
        });
        $.post( "/site/filterProject",serializeArray, function( data ) {
            mapJs.currentMap.remove();
            $('#map_map').empty().append(data)
        });
    },
    initFavorite:function() {
        $('.favorite').click(function () {
            var $this = $(this);
            if ($this.data('id')) {
                $.ajax({
                    url: "/user/toggleFavorite",
                    async: false,
                    data: {
                        id: $this.data('id'),
                        type:  $this.data('type')
                    },
                    dataType: 'json',
                    success: function (json) {
                        if (json.success) {
                            $this.toggleClass('add').text($this.hasClass('add') ? Yii.t('main', 'Добавить в избранное') : Yii.t('main', 'В избранном'));
                        }
                    }
                });
            }
            return false;
        });
    }
},
regionsPart={
    init:function(){
        $('.toggle').click(function(){
            var $this = $(this),
                action = 'close',
                $tab = $this.closest('.tab');
            if($this.hasClass('close')){
                action = 'open';
                $this.removeClass('close');
                $this.find('.toggle-text').text('Скрыть');
            }
            else{
                $this.addClass('close');
                $this.find('.toggle-text').text('Показать');
            }
            if($tab.length>0){ //это для обычных табов
                action=='close' ? $tab.find('.toggled-block').hide() : $tab.find('.toggled-block').show();
            }
            else{
                var $block = $this.closest('.toggled-block').prev('.chain-block');
                action=='close' ? $block.hide() : $block.show();
            }
        });
        $( document ).tooltip({
            autoHide:false,
            items: "[alt-title]",
            content: function() {
                return $(this).attr('alt-title')
            },
            tooltipClass: "proof-tooltip"
        });
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
projectDetailPart={
    init:function(){
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
                            $this.toggleClass('add').text($this.hasClass('add') ? Yii.t('main','Добавить в избранное') : Yii.t('main', 'В избранном'));
                        }
                    }
                });
            }
            return false;
        });
        view.projectRecommend();
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
                            $this.toggleClass('add').text($this.hasClass('add') ? Yii.t('main','Добавить в избранное') : Yii.t('main', 'В избранном'));
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
    isActive: false,
    timeout: null,
    init:function(admin){
        $("html, body").scrollTop($(document).height());
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
        messagePart.timeout = setTimeout(messagePart.ajaxMessage, 5000);
    },
    successAjax:function(){
        clearTimeout(messagePart.timeout);
        messagePart.ajaxMessage();
        $(".overlay.sending").addClass("hidden");
        var $form = $('#message-form');
        $form.find('.reply-message-textarea').val('');
        $form.find('#document_block').empty();
    },
    ajaxMessage:function(){
        if(messagePart.isActive){
            return;
        }
        messagePart.isActive = true;
        $.ajax({ url: location.href,
            async: true,
            type:'POST',
            dataType: 'json',
            data:{
                type:'ajax',
                time:$('#update-ajax-time').val(),
            },
            success: function(data) {
                if(data.html.length){
                    $("html, body").animate({ scrollTop: $(document).height() }, 1000);
                }
                $('#update-ajax-time').val(data.time);
                $('#new-ajax-message').append(data.html);
            }
        }).always(function(){
            messagePart.isActive = false;
            messagePart.timeout = setTimeout(messagePart.ajaxMessage, 5000);
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
    url:location.href,
    minBalance:null,
    id: $('#banner-id-value').val(),
    init:function(minBalance){
        this._investor();
        this._recommend();
        this._save();
        this._balance();
        this.minBalance = minBalance;

    },
    _save:function(){
        $('#save-form').click(function(){
            var $this = $(this);
            $this.prop('disabled',true);
            $.fancybox.showLoading();
            $.get( banner.url, $('#banner-form').serialize()+"&action=save",function( data ) {
                banner._ajaxResult(data);
                $.fancybox.hideLoading();
            });
            return false;
        })
    },
    _recommend:function(){
        $('#get-recommend').click(function(){
            $("#loading-state").show();
            //var priceType = $('#banner-type').find('.elements input:checkbox:checked').val();
            $.get( banner.url, $('#banner-form').serialize()+"&action=recommend",function( data ) {
                if(data.error !='[]' ){
                    banner._ajaxResult(data);
                }
                else{
                    var $postfix = data.type == 'click' ? Yii.t('main','за клик') : Yii.t('main','за 1000 просмотров');
                    $('#recommend_price').val(" "+data.price+" руб. "+ $postfix);
                    $('#target_value').val(" "+data.count);
                }
                $("#loading-state").hide();
            });
            return false;
        });
    },
    _investor:function(){
        $('#user-show').chosen().change(function(e, params){
            $.fancybox.hideLoading();
            if(params['selected']=='investor'){
                $.fancybox.showLoading();
                var checkInvestor = !$(this).find('input[value="investor"]').prop('checked');
                if(checkInvestor){
                    $.get( banner.url, {id:banner.id,action:"investor"},function( data ) {
                        $('#investor_block').html(data);
                        $.fancybox.hideLoading();
                    });
                }
                else{
                    $('#investor_block').html('');
                    $.fancybox.hideLoading();
                }
            }
            if(params['deselected']=='investor'){
                $('#investor_block').html('');
            }

        });
    },
    _balance:function(){
        $(document).on('click','.add-balance-fancy .confirm-alert-action',function(){
            var addValue = $('#add-balance-value').val();
            $.get( banner.url, $('#banner-form').serialize()+"&action=pay&add_value="+addValue,function( data ) {
                if(typeof data.balance=='undefined'){
                    banner._ajaxResult(data);
                }
                else{
                    $('#banner-balance-block span').text(data.balance);
                    $('#banner-id-value').val(data.id);
                }
            });
        });
        $('#add_balance').click(function(){
            var sum = $(this).data('sum');
            $.confirmDialog({
                content: '<div class="alert">'+Yii.t('main','Укажите, пожалуйста, сумму пополнения')+". "+Yii.t('main','Доступно')+' '+sum+'</div>' +
                    '<input type="text" value="'+banner.minBalance+'" class="crud" id="add-balance-value"> ',
                confirmText: Yii.t('main','Пополнить'),
                cancelText:false,
                addClass:'add-balance-fancy',
                confirmCallback:function(){},
                cancelCallback: function(){window.history.back();}
            });
        });
    },
    _ajaxResult:function(data){

        if(data.status == 'success' && typeof data.dialog_text =='undefined' ){
            location.href = data.url;
            return false;
        }
        else if(data.status != 'success'){
            $('#save-form').prop('disabled',false);
        }
        if(typeof data.id =='undefined'){
            $('#banner-id-value').val(data.id);
        }
        var $form = $("#banner-form");
        $form.find(".errorMessage").hide();
        if(typeof data.error!='undefined' && data.error!='[]'){
            var error = $.parseJSON(data.error);
            $.each(error, function(key, val) {

                $form.find("#"+key+"_em_").text(val).show();
            });
        }
        if(data.moderation){
            $('#shadow').show();
            $('#moderation-notice').show().find('#notice-text').text('Отправлено на модерацию');
        }

        if(typeof data.dialog_text !='undefined'){
            if(data.scroll == 1){
                $('#scroll-up').click();
            }
            $.confirmDialog({
                content: '<div class="alert">'+data.dialog_text+'</div>',
                confirmText: data.status == 'no_money' ? 'Пополнить баланс' : 'Ок',
                cancelText:false,
                /*confirmCallback:function(){
                    if(data.status == 'success'){
                        window.history.back();
                    }
                },
                cancelCallback: function(){window.history.back();}*/
            });
        }
        return false;
    }
},
feedBanner={
    url:location.href,
    minBalance:null,
    id: $('#banner-id-value').val(),
    init:function(){
        this._save();
        this._publishDate();
    },
    _save:function(){
        $('#save-form').click(function(){
            var $this = $(this);
            $this.prop('disabled',true);
            $.fancybox.showLoading();
            $.get( banner.url, $('#banner-form').serialize()+"&action=save",function( data ) {
                banner._ajaxResult(data);
                $.fancybox.hideLoading();
            });
            return false;
        });
    },
    _publishDate:function(){
        $('#add-publish-date').click(function(){
            if($('#publish-date-wrap>.form-group').length == 4){
                $('#add-publish-date').hide();
            }
            var $self = $(this);
            var num = $self.data('row');
            $self.data('row', num + 1);
            var $row = $('#new-publish-row').clone();
            $row.find('.date-control').attr('name', 'publishDate[tmp'+num+'][date]');
            $row.find('.hour-control').attr('name', 'publishDate[tmp'+num+'][hour]');
            $('#publish-date-wrap').append($row.html());
        });
        $(document).on('click', '.remove-publish-date', function(){
            if($('#publish-date-wrap>.form-group').length == 5){
                $('#add-publish-date').show();
            }
            $(this).closest('.form-group').remove();
        });
    },
    _investor:function(){
        //показ/скрытие блока об инвесторах
        $('#user-show').change(function(){
            console.log('change');
        });
        $('#user-show').on('select',function(e,id){
            $.fancybox.hideLoading();
            if(id!='investor'){
                return true;
            }
            $.fancybox.showLoading();
            var checkInvestor = !$(this).find('input[value="investor"]').prop('checked');
            if(checkInvestor){
                $.get( banner.url, {id:banner.id,action:"investor"},function( data ) {
                    $('#investor_block').html(data);
                    $.fancybox.hideLoading();
                });
            }
            else{
                $('#investor_block').html('');
                $.fancybox.hideLoading();
            }
        });
        $('#user-show').on('unselect',function(e,id){
            if(id=='investor'){
                $('#investor_block').html('');
            }
        });
    },
    _balance:function(){
        $(document).on('click','.add-balance-fancy .confirm-alert-action',function(){
            var addValue = $('#add-balance-value').val();
            $.get( banner.url, $('#banner-form').serialize()+"&action=pay&add_value="+addValue,function( data ) {
                if(typeof data.balance=='undefined'){
                    banner._ajaxResult(data);
                }
                else{
                    $('#banner-balance-block span').text(data.balance);
                    $('#banner-id-value').val(data.id);
                }
            });
        });
        $('#add_balance').click(function(){
            var sum = $(this).data('sum');
            $.confirmDialog({
                content: '<div class="alert">'+Yii.t('main','Укажите, пожалуйста, сумму пополнения')+". "+Yii.t('main','Доступно')+' '+sum+'</div>' +
                    '<input type="text" value="'+banner.minBalance+'" class="crud" id="add-balance-value"> ',
                confirmText: Yii.t('main','Пополнить'),
                cancelText:false,
                addClass:'add-balance-fancy',
                confirmCallback:function(){},
                cancelCallback: function(){window.history.back();}
            });
        });
    },
    _ajaxResult:function(data){

        if(data.status == 'success' && typeof data.dialog_text =='undefined' ){
            location.href = data.url;
            return false;
        }
        else if(data.status != 'success'){
            $('#save-form').prop('disabled',false);
        }
        if(typeof data.id =='undefined'){
            $('#banner-id-value').val(data.id);
        }
        var $form = $("#banner-form");
        $form.find(".errorMessage").hide();
        if(typeof data.error!='undefined' && data.error!='[]'){
            var error = $.parseJSON(data.error);
            $.each(error, function(key, val) {

                $form.find("#"+key+"_em_").text(val).show();
            });
        }
        if(data.moderation){
            $('#shadow').show();
            $('#moderation-notice').show().find('#notice-text').text('Отправлено на модерацию');
        }

        if(typeof data.dialog_text !='undefined'){
            if(data.scroll == 1){
                $('#scroll-up').click();
            }
            $.confirmDialog({
                content: '<div class="alert">'+data.dialog_text+'</div>',
                confirmText: data.status == 'no_money' ? 'Пополнить баланс' : 'Ок',
                cancelText:false,
                /*confirmCallback:function(){
                    if(data.status == 'success'){
                        window.history.back();
                    }
                },
                cancelCallback: function(){window.history.back();}*/
            });
        }
        return false;
    }
},
projectList = {
    init:function(){
        $('.many-delete').click(function(){
            var $this = $(this);
            var $checked = $('.project-input:checked'),
                idList = $checked.map(function(){return $(this).val();}).get();
            if(idList.length==0){
                return false;
            }
            if(confirm('Подтвердите удаление записи')){
                $checked.closest('tr').remove();
                $.get("/project/remove", {id:idList},function( data ) {
                    $checked.closest('.item').remove();
                });
            };

            return false;
        });
    }
},
favList = {
    init:function(){
        $('.many-delete').click(function(){
            var $this = $(this);
            var $checked = $('.project-input:checked'),
                idList = $checked.map(function(){return $(this).val();}).get();
            if(idList.length==0){
                return false;
            }

            $checked.closest('tr').remove();
            $.get("/user/removeFavorite", {id:idList},function( data ) {
                $checked.closest('.item').remove();
            });

            return false;
        });
    }
},
projectPart={
    init:function(){
        console.log(43);
        form.tinyTable();
    },
    loadPlanMedia: function(){
        $(document).on('click','.delete-media-button',function(){
            var $this = $(this);
            if($this.parent().hasClass('file-block')){
                $this.parent().find('.file_block_rel').remove();
            }
            $this.remove();
        });
    }
},
feedBannerStat ={
    init: function(){
        var data = typeof chartInit !== 'undefined' ? chartInit : [];
        var max = 20;
        var res = [];
        var resClick = [];
        var ctr = [];
        $.each(data, function(key, item){
            if(item.view > max){
                max = parseInt(item.view);
            }
            res.push([key, item.view]);
            resClick.push([key, item.click]);
            ctr.push([key, item.view ? item.click / item.view : 0]);
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
                    var minutes = date.getMinutes();
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
                    var minutes = date.getMinutes();
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
                    data: res,
                    label: "&nbsp;Показы&nbsp;",
                    lines: {show: true},
                    color: '#727cb6'
                },
                {
                    data: resClick,
                    label: "&nbsp;Клики&nbsp;",
                    color: "#fc8675",
                    lines: {
                        show: true
                    }
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
        $.plot($("#flot-ctr-chart"), [
                {
                    data: ctr,
                    lines: {show: true, fill: 0.2},
                    color: '#727cb6'
                }
            ],
            options);
    }
};
var eventAdmin = {
    init:function(){
        $('#load-map').click(function(){
            var $input = $(this).siblings('.form-control'),
                text = $input.val();
            if(text =='')
                return false;
            var googleGeocodeProvider = new L.GeoSearch.Provider.Google();

            googleGeocodeProvider.GetLocations( text, function ( data ) {
                var result = data[0];
               // $input.val(result['label'])

                mapJs.addBalloon({lat:result['Y'],lon:result['X'],draggable:true,'one':true});
                mapJs.currentMap.setView([result['Y'],result['X']], 16);
                // in data are your results with x, y, label and bounds (currently availabel for google maps provider only)
            });
        })
    }
};
var searchPart={
    init:function(){
        $('#submit-search').click(function(){
            var $form = $(this).closest('form');
            $form.submit();
            return false;
        });

        $('.crest').click(function(){
            $(this).siblings('.form-control').val('');
        });
    }
}
