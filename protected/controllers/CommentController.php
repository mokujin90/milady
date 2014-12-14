<?php

class CommentController extends BaseController
{

    public function actionCreate(){

        $comment = new Comment();
        $comment->user_id = Yii::app()->user->id;
        $comment->attributes = $_GET['Comment'];
        $comment->maybeNull('parent_id');
        if($comment->save()){

            if($comment->type == Comment::T_PROJECT && !empty($comment->object_id)){
                Mail::send(Favorite::getSubscribedEmail($comment->object_id),Mail::S_NEW_COMMENT,'new_comment',array('model'=>$comment));
            }
            $this->reload($comment->object_id,$comment->type);
        }
    }

    public function actionRefresh($objectId,$objectType){
        $this->reload($objectId,$objectType,$_GET['params']);
    }

    public function actionDelete($commentId){
        $comment = Comment::model()->findByPk($commentId);
        if(is_null($comment) || $comment->user_id != Yii::app()->user->id){ //TODO: продумать для админа
            return false;
        }
        //чтобы не передавать в реквесте ненужные параметры определим их по удаляемому комментарию
        $objectId = $comment->object_id;
        $objectType = $comment->type;
        $comment->delete(); //бд сделает все за нас
        $this->reload($objectId,$objectType);
    }

    private function reload($objectId,$objectType,$params=array()){
        $this->widget('application.widgets.comment.CommentWidget',array(
            'objectId'=>$objectId,
            'objectType'=>$objectType,
            'reload'=>true,
            'params'=>$params)
        );
        Yii::app()->end();
    }
}