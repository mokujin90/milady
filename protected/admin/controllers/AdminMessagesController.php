<?php

class AdminMessagesController extends AdminBaseController
{
    public $defaultAction = 'index';
    public $actionName;

    protected function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'messages';
        $this->pageCaption = 'Сообщения';
        $this->activeMenu = array('user', 'message');
        return true;
    }

    public function actionInbox()
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('t.type' => 'admin'));
        $criteria->order = 'update_date DESC';
        $pages = $this->applyLimit($criteria, 'Dialog');
        $models = Dialog::model()->findAll($criteria);
        $this->render('listDialog', array('models' => $models, 'pages' => $pages));
    }

    public function actionDetail($id)
    {
        $this->breadcrumbs = array('Сообщение');
        $dialog = Dialog::model()->findByPk($id);
        if (!$dialog) {
            throw new CHttpException(404, Yii::t('main', 'Указанное сообщение не найдено'));
        }
        if(isset($_POST) && isset($_POST['type']) &&  $_POST['type'] == 'ajax'){
            if (isset($_POST['time'])) {
                $criteria = new CDbCriteria();
                $criteria->addCondition('dialog_id = :dialog AND create_date > :date');
                $criteria->params = array(':dialog' => $id, ':date' => $_POST['time']);
                $criteria->order = 't.id DESC';
                $models = Message::model()->with('userFrom', 'files')->findAll($criteria);
                foreach($models as $item){ //TODO проставить в одно дейстивет (set is_read = 1 where dialog_id = :dialog)
                    if ($item->user_to == null && $item->is_read == 0) {
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
        $models = Message::model()->with('userFrom', 'files')->findAllByAttributes(array('dialog_id' =>$id), array('order' => 't.id DESC'));
        $time = date('Y-m-d H:i:s');
        foreach($models as $item){ //TODO проставить в одно дейстивет (set is_read = 1 where dialog_id = :dialog)
            if ($item->user_to == null && $item->is_read == 0) {
                $item->checkRead();
            }
        }

        $answer = new Message();
        $answer->user_to = $dialog->getUserTo(true);
        $answer->dialog_id = $dialog->id;
        $answer->subject = $dialog->subject;
        $this->render('detail', array('models' => $models, 'model' => $dialog->getLastMessage(), 'answer' => $answer, 'time' => $time));
    }

    public function actionCreate()
    {
        $model = new Message('chat');
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST[$model->tableName()];
            $model->user_from = null;
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
            }
        }
        $this->redirect(array('adminMessages/detail', 'id' => $model->dialog_id));
    }


    /**
     * Просмотреть отправленное сообщение
     * @param $id
     */
    public function actionView($id)
    {
        $model = Message::model()->with('userFrom')->findByPk($id);
        if (!$this->checkAccess($model)) {
            throw new CHttpException(404, Yii::t('main', 'Указанное сообщение не найдено'));
        }
        $answer = new Message(); //отправить повторное сообщение
        $answer->user_to = $model->user_to;
        $answer->subject = $model->subject;
        $this->render('application.views.message.detail', array('model' => $model, 'answer' => $answer,'admin'=>true));
    }

    public function actionSent()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('admin_type is NOT NULL AND delete_by_userfrom = 0 AND t.user_from   is null');
        $criteria->order = 'create_date DESC';
        $criteria->together = true;
        $pages = $this->applyLimit($criteria, 'Message');
        $models = Message::model()->with('userTo')->findAll($criteria);
        $this->render('application.views.message.list', array('models' => $models, 'pages' => $pages,'admin'=>true));
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
        $criteria = new CDbCriteria();
        $criteria->addCondition('(user_from IS NULL AND  delete_by_userfrom = 1) OR (user_to IS NULL AND delete_by_userto = 1)');
        $criteria->order = 'create_date DESC';
        $criteria->together = true;
        $pages = $this->applyLimit($criteria, 'Message');
        $models = Message::model()->with('userTo', 'userFrom')->findAll($criteria);
        $this->render('application.views.message.recycle', array('models' => $models, 'pages' => $pages,'admin'=>true));
    }
    /**
     * Проверка доступности на единичное сообщение
     * @param Message $model
     * @throws CHttpException
     */
    private function checkAccess($model)
    {
        return !is_null($model) && (empty($model->user_to) || empty($model->user_from));
    }


}

?>
