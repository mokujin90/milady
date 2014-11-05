$(window).load(function () {
    base.init();
});

var indexPart = {
    init: function () {
        this.slider();
        this.map();

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
}