<?php

class GroupController extends BaseController
{

    public function actionIndex()
    {
        $this->layout = 'bootstrapCabinet';
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));
        $models = Group::model()->findAll($criteria);
        $this->render('index', array('models' => $models));
    }

    public function actionCreate()
    {
        $this->layout = 'bootstrapCabinet';
        $model=new Group;
        $model->user_id = $this->user->id;
        if(isset($_POST['Group']))
        {
            $model->attributes=$_POST['Group'];
            $model->media_id = Yii::app()->request->getParam('media_id') == "" ? null : Yii::app()->request->getParam('media_id');
            $model->background_media_id = Yii::app()->request->getParam('background_media_id') == "" ? null : Yii::app()->request->getParam('background_media_id');
            if($model->save()){
                $this->redirect(array('index'));
            }
        }
        $this->render('edit',array(
            'model'=>$model,
        ));
    }

    public function actionUpdate($id)
    {
        $this->layout = 'bootstrapCabinet';

        $model=$this->loadModel($id);

        if(isset($_POST['Group']))
        {
            $model->media_id = Yii::app()->request->getParam('media_id') == "" ? null : Yii::app()->request->getParam('media_id');
            $model->attributes=$_POST['Group'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('group_id' => $model->id));
        $models = GroupDiscussion::model()->findAll($criteria);

        $this->render('edit',array(
            'model'=>$model,
            'models' => $models
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        $this->redirect(array('index'));
    }


    public function loadModel($id)
    {
        $model=Group::model()->findByAttributes(array('user_id' => $this->user->id, 'id' => $id));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function loadDiscussionModel($id)
    {
        $model=GroupDiscussion::model()->findByAttributes(array('id' => $id));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        if($model->group->user_id !=  $this->user->id){
            throw new CHttpException(404,'The requested page does not exist.');
        }
        return $model;
    }

    public function actionDiscussionCreate($id)
    {
        $this->layout = 'bootstrapCabinet';
        $model=$this->loadModel($id);

        $discuss=new GroupDiscussion();
        $discuss->group_id = $model->id;
        if(isset($_POST['GroupDiscussion']))
        {
            $discuss->attributes=$_POST['GroupDiscussion'];
            if($discuss->save()){
                $this->redirect(array('update', 'id' => $id));
            }
        }
        $this->render('editDiscuss',array(
            'model'=>$discuss,
        ));
    }

    public function actionDiscussionUpdate($id)
    {
        $this->layout = 'bootstrapCabinet';
        $discuss=$this->loadDiscussionModel($id);

        if(isset($_POST['GroupDiscussion']))
        {
            $discuss->attributes=$_POST['GroupDiscussion'];
            if($discuss->save()){
                $this->redirect(array('update', 'id' => $discuss->group->id));
            }
        }
        $this->render('editDiscuss',array(
            'model'=>$discuss,
        ));
    }

    public function actionDiscussionDelete($id)
    {
        $this->layout = 'bootstrapCabinet';
        $discuss=$this->loadDiscussionModel($id);

        if($discuss)
        {
            $discuss->delete();
        } else {
            throw new CHttpException(404,'The requested page does not exist.');
        }
        $this->redirect(array('update', 'id' => $discuss->group->id));
    }
}