function get(variable,defaultValue){
    return typeof variable == 'undefined' ? defaultValue : variable;
}
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
         $(document).on('click.comment','.comment-new',function(){
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
         $(document).on('click.comment','.comment .new-answer',function(){
            var $this = $(this).closest('.comment'),
                hasAnswer = $this.hasClass('answered');
            comment.unAnswered();
            if(!hasAnswer){ //обеспечим выделение, если эта реплика раньше не выделялась
                comment.answered($this);
                comment._getTextarea().focus();
                $(this).val(Yii.t('main','Отменить'));
            }
            return false;
         });

         $(document).on('click.comment','#show-more-comment',function(){
                var $this = $(this);
                var page = $this.data('page');
             comment.refresh(++page,'page');
             $this.data('page',page);

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

    refresh:function(page,action){
        page = typeof page == "undefined" ? 0 : page;
        action = typeof action == 'undefined' ? 'refresh' : action;
        var $answered = $('.comment.answered'),
            $find = $('.comment.find'),
        data = {
            objectId : $('#Comment_object_id').val(),
            objectType: $('#Comment_type').val(),
            params:{
                answered:$answered.length==0 ? null : $answered.data('id'),
                find:$find.length==0 ? null : $find.data('id'),
                page:page,
                action:action
            }

        }

        $.ajax({
            url: "/comment/refresh",
            data:data,
            cache: false,
            success: function(data) {
                if(action == 'refresh'){
                    comment._replace(data);
                }
                else if(action=='page'){
                    comment._add(data);
                    if(data==''){
                        $('#show-more-comment').hide();
                    }
                }
            }
        });
    },
    autosize:function($this){
        while($this.outerHeight() < $this[0].scrollHeight + parseFloat($this.css("borderTopWidth")) + parseFloat($this.css("borderBottomWidth"))) {
            $this.height($this.height()+1);
        };
    },
    create:function(){
        var serialize = $('.comment-widget').serializeArray();
        serialize.push({"name":"total","value":$('#show-more-comment').data('page')});
        $.get( "/comment/create", serialize, function( data ) {
            comment._replace(data);
            comment._getTextarea().val('');
        });
    },
    remove:function(id){
        $.get( "/comment/delete", {commentId:id,total:$('#show-more-comment').data('page')}, function( data ) {
            $('#comment-'+id+'-id').remove();
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
        $('.comment .new-answer').val('Ответить');
    },
    findComment:function(id){
        var $find = $('.comment[data-id="'+id+'"]'),
            hasFind = $find.hasClass('find');
        $('.comment.find').removeClass('find');
        if(!hasFind){
            $find.addClass('find');
        }
    },
    _add:function(data){
      $('#content-comment').append(data);
    },
    _replace:function(data){
        $('#content-comment').html(data);
    },
    _getTextarea:function(){
        return $('#comment-write');
    }
}
comment.init();