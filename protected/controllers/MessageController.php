<?php

class MessageController extends BaseController
{
    public $layout = 'messageLayout';
    public $defaultAction = 'inbox';
    private $pagesCount = 20;

    public function actionCreate()
    {
        $model = new Message();
        $systemType = Yii::app()->request->getParam('system',false);
        $projectId = Yii::app()->request->getParam('project_id',NULL); //к какому проету относится
        if($systemType && array_key_exists($systemType,Project::model()->systemMessage)){
            $model->user_to = null;
            $model->admin_type = Project::model()->systemMessage[$systemType]['id'];
            $model->subject = Project::model()->systemMessage[$systemType]['name'];
            $model->project_id =$projectId;
        }
        if (Yii::app()->request->isPostRequest && isset($_REQUEST[$model->tableName()])) {
            $model->attributes = $_POST[$model->tableName()];
            $model->user_from = Yii::app()->user->id;
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
                $this->redirect(array('message/inbox'));
            }
        }
        $this->render('create', array('model' => $model,'systemType'=>$systemType));
    }

    /**
     * Прочтение какого-либо сообщения, с возможностью ответить
     */
    public function actionDetail($id)
    {
        $model = Message::model()->with('userFrom', 'files')->findByPk($id);
        if (!$this->checkAccess($model)) {
            throw new CHttpException(404, Yii::t('main', 'Указанное сообщение не найдено'));
        }
        if ($model->user_to == Yii::app()->user->id && $model->is_read == 0) {
            $model->checkRead();
        }
        $answer = new Message();
        $answer->user_to = $model->user_from;
        $answer->subject = "Re: " . $model->subject;

        $this->render('detail', array('model' => $model, 'answer' => $answer));
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
        $this->render('detail', array('model' => $model, 'answer' => $answer));
    }

    /**
     * Показать список входящих сообщений
     * @param int $system по умолчанию показываем только не системные
     */
    public function actionInbox($system = 0)
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_to' => Yii::app()->user->id, 'delete_by_userto' => 0));
        $criteria->addCondition($system == 0 ? 'user_from IS NOT NULL' : 'user_from IS NULL');
        $criteria->order = 'create_date DESC';
        $criteria->together = true;
        $pages = $this->applyLimit($criteria, 'Message', $this->pagesCount);
        $models = Message::model()->with('userFrom')->findAll($criteria);
        $this->render('list', array('models' => $models, 'pages' => $pages));
    }

    public function actionSent()
    {
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
            $html .= CHtml::link($item->normal_name,$medias[$item->media_id]->makeWebPath(),array('target'=>'_blank'));
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
}