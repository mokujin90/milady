<?php

class AdminMessagesController extends AdminBaseController
{
    public $defaultAction = 'index';
    public $layout = 'message';
    public $actionName;

    protected function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'messages';
        $this->pageCaption = 'Сообщения';
        return true;
    }

    public function actionInbox()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'create_date DESC';
        $criteria->addCondition('t.admin_type IS NOT NULL AND t.user_to IS NULL');
        $criteria->together = true;
        $pages = $this->applyLimit($criteria, 'Message');
        $models = Message::model()->with('userFrom')->findAll($criteria);
        $this->render('application.views.message.list', array('models' => $models, 'pages' => $pages, 'admin' => true));
    }

    public function actionDetail($id)
    {
        $model = Message::model()->with('userFrom', 'files')->findByPk($id);
        if (!$this->checkAccess($model)) {
            throw new CHttpException(404, Yii::t('main', 'Указанное сообщение не найдено'));
        }
        if ($model->user_to == null && $model->is_read == 0) {
            $model->checkRead();
        }
        $answer = new Message();
        $answer->user_to = $model->user_from;
        $answer->subject = "Re: " . $model->subject;

        $this->render('application.views.message.detail', array('model' => $model, 'answer' => $answer,'admin'=>true));
    }

    public function actionCreate()
    {
        $model = new Message();
        if (Yii::app()->request->isPostRequest && isset($_REQUEST[$model->tableName()])) {
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
                $this->redirect(array('adminMessages/inbox'));
            }
        }
        $this->render('application.views.message.create', array('model' => $model,'systemType'=>false,'admin'=>true));
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
