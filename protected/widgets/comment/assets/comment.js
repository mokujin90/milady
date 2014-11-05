var comment = {
    init:function(){
        this.trigger();
    },
     /**
     * Все события на элементы вешаем тут
     */
    trigger:function(){
         ajax_reload = get(ajax_reload,1);
         interval_reload = get(interval_reload,10000);
         //комментировать
         $('.comment-new').bind('click.comment',function(){
             var $this = $(this),
                 $textarea = comment._getTextarea();
             if($textarea.val()==''){
                 $textarea.focus();
                 return false;
             }
             comment.create();
             comment.unAnswered();
             return false;
         });
         //удаление комментария
         $(document).on('click.comment','.delete-comment',function(){
             comment.remove($(this).data('comment'));
             comment.unAnswered();
             return false;
         });

         //выделить комментария для овтета
         $(document).on('click.comment','.comment',function(){
            var $this = $(this),
                hasAnswer = $this.hasClass('answered');
            comment.unAnswered();
            if(!hasAnswer){ //обеспечим выделение, если эта реплика раньше не выделялась
                comment.answered($this);
                comment._getTextarea().focus();
            }
            return false;
         });
        //поиск комментарий на который овтечали
         $(document).on('click.comment','.answer-find',function(){
             comment.findComment($(this).data('parent'))
             return false;
         });
         if(ajax_reload == 1){//автообновление
             setInterval(comment.refresh, interval_reload);
         }
         //автосайз для поля ввода
         $(document).on('keyup.comment','.comment-write',function(){
             var $this = $(this);
             comment.autosize($this);
             if($this.val()==''){
                 comment.unAnswered();
             }
         });
    },

    refresh:function(){
        var $answered = $('.comment.answered'),
            $find = $('.comment.find'),
        data = {
            objectId : $('#Comment_object_id').val(),
            objectType: $('#Comment_type').val(),
            params:{
                answered:$answered.length==0 ? null : $answered.data('id'),
                find:$find.length==0 ? null : $find.data('id')
            }
        }
        $.ajax({
            url: "/comment/refresh",
            data:data,
            cache: false,
            success: function(data) {comment._replace(data);}
        });
    },
    autosize:function($this){
        while($this.outerHeight() < $this[0].scrollHeight + parseFloat($this.css("borderTopWidth")) + parseFloat($this.css("borderBottomWidth"))) {
            $this.height($this.height()+1);
        };
    },
    create:function(){
        $.get( "/comment/create", $('.comment-widget').serialize(), function( data ) {
            comment._replace(data);
            comment._getTextarea().val('');
        });
    },
    remove:function(id){
        $.get( "/comment/delete", {commentId:id}, function( data ) {
            comment._replace(data);
        });
    },
    answered:function($comment){
        var $nameBlock = $comment.find('.right-part .name'),
            userId = $nameBlock.data('user'),
            name = $('#current_user_id').val() != userId ?  $nameBlock.text()+", " : "", //для себя не надо показывать
            id = $comment.data('id');
        $comment.addClass('answered');
        $('#Comment_parent_id').val(id);
        comment._getTextarea().val(name);

    }, //разотметить комментарий на ответ
    unAnswered:function(){
        $('.comment.answered').removeClass('answered');
        $('#Comment_parent_id').val('');
    },
    findComment:function(id){
        var $find = $('.comment[data-id="'+id+'"]'),
            hasFind = $find.hasClass('find');
        $('.comment.find').removeClass('find');
        if(!hasFind){
            $find.addClass('find');
        }


    },
    _replace:function(data){
        $('#content-comment').replaceWith(data);
    },
    _getTextarea:function(){
        return $('#comment-write');
    }
}
comment.init();