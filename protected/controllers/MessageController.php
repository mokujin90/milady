<?php

class MessageController extends BaseController
{
    public $layout = 'messageLayout';
    public $defaultAction = 'inbox';
    private $pagesCount = 20;

    public function actionCreate()
    {
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Написать сообщение');
        $messageData = Yii::app()->request->getPost('Message');
        if (isset($messageData['dialog_id'])) {
            $dialog = Dialog::model()->findByPk($messageData['dialog_id']);
            if (!$this->checkDialogAccess($dialog)) {
                throw new CHttpException(404, Yii::t('main', 'Нет диалога.'));
            }
        }
        $systemType = Yii::app()->request->getParam('system',false);

        if (!empty($dialog)) {
            $systemType = $dialog->admin_type;
        }

        $params = array('user_to_name'=>''); //дефолтные значения

        $projectId = Yii::app()->request->getParam('project_id',NULL); //к какому проету относится
        $userTo = Yii::app()->request->getParam('to',NULL);
        $model = new Message($systemType ? 'admin' : 'chat');
        if($projectId){
            if($project = Project::model()->findByPk($projectId)){
                $userTo = $project->user_id;
            }
        }
        if(!empty($userTo)){
            $model->user_to = $userTo;
            if (!$model->userTo) {
                throw new CHttpException(404, Yii::t('main', 'Указанный пользователь не найден'));
            }
            $params['user_to_name'] = $model->userTo->name;
        }
        if(!empty($projectId)){
            $model->project_id =$projectId;
        }
        if($systemType && array_key_exists($systemType,Project::model()->systemMessage)){
            $model->user_to = null;
            $model->admin_type = Project::model()->systemMessage[$systemType]['id'];
            $model->subject = Project::model()->systemMessage[$systemType]['name'];
            $model->project_id = $projectId;
        }
        if (Yii::app()->request->isPostRequest) {
            if (isset($_REQUEST['Message']) && isset($_REQUEST['Message']['text'])) {
                $_REQUEST['Message']['text'] = trim($_REQUEST['Message']['text']);
            }

            if (!isset($_REQUEST['file_id']) && !(isset($_REQUEST['Message']) && !empty($_REQUEST['Message']['text']))) {
                return;
            }
            $model->attributes = $_POST[$model->tableName()];
            $model->user_from = Yii::app()->user->id;
            if(!empty($model->admin_type) && empty($model->user_to)){
                $model->user_to = null;
             }
            if ($model->save()) {
                //обработка вложенных файлов
                if (isset($_REQUEST['file_id']) && is_array($_REQUEST['file_id'])) {
                    foreach ($_REQUEST['file_id'] as $media) {
                        if (!is_null(Message2Media::model()->findByAttributes(array('media_id' => $media['id'])))) {
                            continue; //мы не сохраняем media, которые были вписаны вручную
                        }
                        $newMessage2Media = new Message2Media();
                        $newMessage2Media->message_id = $model->id;
                        $newMessage2Media->media_id = $media['id'];
                        $newMessage2Media->normal_name = $media['old_name'];
                        $newMessage2Media->save();
                    }
                }
                if($model->userTo && $model->userTo->is_subscribe == 1){
                    Mail::send($model->userTo->email,Mail::S_NEW_MESSAGE,'new_message',array('model'=>$model));
                }
                if(Yii::app()->request->isAjaxRequest){
                   return;
                }
                $this->redirect(array('message/detail', 'id' => $model->dialog_id));
            }
        }
        $this->render('create', array('model' => $model,'systemType'=>$systemType,'params'=>$params));
    }

    /**
     * Прочтение какого-либо сообщения, с возможностью ответить
     */
    public function actionDetail($id)
    {
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Сообщение');
        $dialog = Dialog::model()->findByPk($id);
        if (!$this->checkDialogAccess($dialog)) {
            throw new CHttpException(404, Yii::t('main', 'Указанное сообщение не найдено'));
        }
        if(isset($_POST) && isset($_POST['type']) &&  $_POST['type'] == 'ajax'){
            if (isset($_POST['time'])) {
                $criteria = new CDbCriteria();
                $criteria->addCondition('dialog_id = :dialog AND t.create_date > :date');
                $criteria->params = array(':dialog' => $id, ':date' => $_POST['time']);
                $criteria->order = 't.id DESC';
                $models = Message::model()->with('userFrom', 'files')->findAll($criteria);
                foreach($models as $item){ //TODO проставить в одно дейстивет (set is_read = 1 where dialog_id = :dialog)
                    if ($item->user_to == Yii::app()->user->id && $item->is_read == 0) {
                        $item->checkRead();
                    }
                }
                $json = array(
                    'html' => $this->renderPartial('_messages', array('models' => $models), true),
                    'time' => date('Y-m-d H:i:s')
                );
                echo json_encode($json);
                return;
            }
        }
        $models = Message::model()->with('userFrom', 'files')->findAllByAttributes(array('dialog_id' =>$id), array('order' => 't.id'));
        $time = date('Y-m-d H:i:s');
        foreach($models as $item){ //TODO проставить в одно дейстивет (set is_read = 1 where dialog_id = :dialog)
            if ($item->user_to == Yii::app()->user->id && $item->is_read == 0) {
                $item->checkRead();
            }
        }

        $answer = new Message();
        $answer->user_to = $dialog->getUserTo();
        $answer->dialog_id = $dialog->id;
        $answer->subject = $dialog->subject;
        $answer->admin_type = $dialog->admin_type;
        $this->render('detail', array('models' => $models, 'model' => $dialog->getLastMessage(), 'answer' => $answer, 'dialog' => $dialog));
    }

    /**
     * Просмотреть отправленное сообщение
     * @param $id
     */
    public function actionView($id)
    {
        $this->breadcrumbs = array('Отправленное сообщение');
        $model = Message::model()->with('userFrom')->findByPk($id);
        if (!$this->checkAccess($model)) {
            throw new CHttpException(404, Yii::t('main', 'Указанное сообщение не найдено'));
        }
        $answer = new Message(); //отправить повторное сообщение
            $answer->user_to = $model->user_to;
            $answer->subject = $model->subject;
        $this->render('detail', array('model' => $model, 'answer' => $answer));
    }

    /**
     * Показать список входящих сообщений
     * @param int $system по умолчанию показываем только не системные
     */
    public function actionInbox($type = 'chat')
    {
        $this->layout = 'bootstrapCabinet';
        $this->breadcrumbs = array('Cообщения');
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user2Dialogs.user_id' => Yii::app()->user->id, 't.type' => $type));
        $criteria->order = 'update_date DESC';
        $criteria->with = 'user2Dialogs';
        $criteria->together = true;
        $pages = $this->applyLimit($criteria, 'Dialog', $this->pagesCount);
        $models = Dialog::model()->findAll($criteria);
        $this->render('listDialog', array('models' => $models, 'pages' => $pages));
    }

    public function actionInboxOld($system = 0)
    {
        $this->breadcrumbs = array('Входящие сообщения');
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_to' => Yii::app()->user->id, 'delete_by_userto' => 0));
        $criteria->addCondition($system == 0 ? 'user_from IS NOT NULL OR (user_from IS NULL AND admin_type IS NOT NULL) '
            : 'user_from IS NULL AND admin_type IS NULL');
        $criteria->order = 'create_date DESC';
        $criteria->together = true;
        $pages = $this->applyLimit($criteria, 'Message', $this->pagesCount);
        $models = Message::model()->with('userFrom')->findAll($criteria);
        $this->render('list', array('models' => $models, 'pages' => $pages));
    }

    public function actionSent()
    {
        $this->breadcrumbs = array('Отправленные сообщения');
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_from' => Yii::app()->user->id, 'delete_by_userfrom' => 0));
        $criteria->order = 'create_date DESC';
        $criteria->together = true;
        $pages = $this->applyLimit($criteria, 'Message', $this->pagesCount);
        $models = Message::model()->with('userTo')->findAll($criteria);
        $this->render('list', array('models' => $models, 'pages' => $pages));
    }

    public function actionRemove($action)
    {
        if (!in_array($action, array('inbox', 'sent', 'recycle')) || !isset($_REQUEST['id'])) {
            throw new CHttpException(403, Yii::t('main', 'Ошибка доступа'));
        }
        $models = Message::model()->findAllByAttributes(array('id' => $_REQUEST['id']));
        foreach ($models as $model) {
            if (!$this->checkAccess($model))
                continue;
            if ($action == 'sent') { #удаляем из отправленных
                $model->delete_by_userfrom = 1;
                $model->is_read = 1;
                $model->save();
            } elseif ($action == 'inbox') {
                $model->delete_by_userto = 1;
                $model->is_read = 1;
                $model->save();
            } else {
                $model->delete();
            }
        }
    }

    public function actionRecycle()
    {
        $this->breadcrumbs = array('Удаленные сообщения');
        $criteria = new CDbCriteria();
        $criteria->addCondition('(user_from = :currentUser AND  delete_by_userfrom = 1) OR (user_to = :currentUser AND delete_by_userto = 1)');
        $criteria->params = array(':currentUser' => Yii::app()->user->id);
        $criteria->order = 'create_date DESC';
        $criteria->together = true;
        $pages = $this->applyLimit($criteria, 'Message', $this->pagesCount);
        $models = Message::model()->with('userTo', 'userFrom')->findAll($criteria);
        $this->render('recycle', array('models' => $models, 'pages' => $pages));
    }

    /**
     * @param Message2Media[] $list
     */
    public static function drawFileList($list = array())
    {
        $html='';
        $mediaId = CHtml::listData($list, 'media_id', 'media_id');
        $medias = Media::model()->findAllByAttributes(array('id'=>$mediaId),array('index'=>'id'));
        foreach($list as $item){
            if(!array_key_exists($item->media_id,$medias))
                continue; // мало ли в Media не будет запрашиваемого файла
            $html .= CHtml::link('<i class="fa fa-paperclip fa-lg"></i> ' . $item->normal_name,$medias[$item->media_id]->makeWebPath(),array('target'=>'_blank'));
        }

        return $html;

    }

    /**
     * Проверка доступности на единичное сообщение
     * @param Message $model
     * @throws CHttpException
     */
    private function checkAccess($model)
    {
        return !is_null($model) && ($model->user_to == Yii::app()->user->id || $model->user_from == Yii::app()->user->id);
    }

    private function checkDialogAccess($model)
    {
        foreach($model->user2Dialogs as $item){
            if($item->user_id == Yii::app()->user->id) return true;
        }
        return false;
    }

    public function actionDeal(){
        if($_POST && $_POST['dialog_id'] && $_POST['action_id']){
            $dialog = Dialog::model()->findByPk($_POST['dialog_id']);
            if (!$this->checkDialogAccess($dialog)) {
                throw new CHttpException(404, Yii::t('main', 'Нет диалога.'));
            }
            if(!$deal = $dialog->deal){
                $deal = new Deal();
                $deal->dialog_id = $dialog->id;
                $deal->status = 'pending';
            }
            $deal->sender_id = Yii::app()->user->id;
            $deal->subject_id = $dialog->getUserTo();
            $message = new Message();
            $message->user_from = Yii::app()->user->id;
            $message->user_to = $dialog->getUserTo();
            $message->dialog_id = $dialog->id;
            $message->project_id = $dialog->project_id;
            if($_POST['action_id'] == 'on_open_deal'){
                $deal->status = 'on_open';
                $message->text = 'Отправлена заявка на открытие сделки.';
            } elseif($_POST['action_id'] == 'open_deal') {
                if($deal->status = 'on_open_deal'){
                    $message->text = 'Сделка открыта.';
                } else {
                    $message->text = 'Отказ на закрытие сделки.';
                }
                $deal->status = 'open';
                $deal->sender_id = null;
            } elseif($_POST['action_id'] == 'remove_deal') {
                $message->text = 'Отказ на открытие сделки.';
            } elseif($_POST['action_id'] == 'on_close_deal') {
                $deal->status = 'on_close';
                $message->text = 'Отправлен Запрос на закрытие сделки.';
            } elseif($_POST['action_id'] == 'close_deal') {
                $deal->sender_id = null;
                $deal->status = 'close';
                $message->text = 'Сделка закрыта.';
            }

            if ($_POST['action_id'] != 'remove_deal') {
                if($deal->save()){
                    $message->save();
                }
            } else {
                if($deal->delete()){
                    $message->save();
                }
            }
            $this->redirect(array('message/detail', 'id' => $dialog->id));
        }
    }
}