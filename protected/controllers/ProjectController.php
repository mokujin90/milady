<?php

class ProjectController extends BaseController
{
    /**
     * id проекта к которому обращаемся. Необходим, чтобы не таскать между методами параметр
     * @var int
     */
    private $id;

    /**
     * Детальная страница проекта
     * @param $id
     */
    public function actionDetail($id)
    {
        $this->render('detail');
    }

    /**
     * Мини-фронт контроллер, для выдачи дополнительных данных по проекту. Отдается через ajax
     * Вызывает другие закрытые методы, которые в свою очередь возваращают куски вью
     * @param $id
     * @param $action
     */
    public function actionGetInfo($id, $action)
    {
        if (!Yii::app()->request->isAjaxRequest) {
            return false;
        }
        $this->id = $id;
        $availableAction = array('comments');
        if (in_array($action, $availableAction)) {
            $this->{"load" . ucfirst($action)}();
        }
        Yii::app()->end();
    }

    private function loadComments()
    {
        $models = Comment::getTree($this->id);
        $this->renderPartial("_comments", array('models'=>$models));
    }
}