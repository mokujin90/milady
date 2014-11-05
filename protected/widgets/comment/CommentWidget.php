<?php

class CommentWidget extends CWidget
{
    const DEFAULT_OBJECT = 'project';
    const DATE_FORMAT = 'd.m.Y H:i:s';

    const JS_AJAX_RELOAD = 1; //включено или нет ajax-обновление
    const JS_INTERVAL_RELOAD = 10000; //таймер автообновления в микросекундах
    /**
     * Id объекта.
     * @var int | null
     */
    public $objectId = null;

    /**
     * Часть сайта к которой необходимо вывести комментарий
     * @var string
     */
    public $objectType = self::DEFAULT_OBJECT;

    /**
     * Направление сортировки комментариев (только для корневых реплик)
     * @var string
     */
    public $sort = 'ASC';

    /**
     * На будущее - возможность прогрузки ОДНОГО комментария
     * @var null
     */
    public $commentId = null;

    /**
     * Показатель, что виджет запустили в режиме обновления контента
     * @var bool
     */
    public $reload = false;

    /**
     * Параметры, в которых будут дополнительные настройки
     * @var array
     */
    public $params = array();

    protected $tree = array();

    public function run()
    {
        $this->assets();
        if (!is_null($this->commentId)) { //одиночный вывод
            $comment = Comment::model()->findByPk($this->commentId);
            $this->render('_comment', array('comment' => $comment));
        } else if (!is_null($this->objectId)) {
            $this->tree = self::getTree($this->objectId);
            $this->render('commentTree');
        }

    }

    /**
     * Так как у нас комментарии должны быть древовидными, а в БД все гладкое, то составим древовидную
     * двухуровневую структуру из комментариев с нужным
     * @param $type
     * @param $id
     * @return $tree вида [[parent]=>Comment,[child]=>[Comment,Comment,Comment]*n]
     */
    public static function getTree($id, $type = self::DEFAULT_OBJECT)
    {
        $tree = array();
        $models = Comment::findCommentByObjectId($id, $type);

        # в первый раз пройдемся и заполним первый уровень комментариев, удаляя ненужные элементы
        foreach ($models as $key => $item) {
            #если мы наткнулись на реплику с родителем
            if (!is_null($item->parent_id))
                continue;
            $tree[$item->id]['parent'] = $item;
            unset($models[$key]);
        }
        foreach ($models as $item) {
            $parentId = self::getFirstParent($models, $item->id);
            $tree[$parentId]['child'][$item->id] = $item;
        }
        return $tree;
    }

    /**
     * По переданному массиву AR-комментариев и id комментария попробуем найти самого первого предка
     * (то есть корневой комментарий) у этого комментария
     * #рекурсия
     * @param $models
     */
    private static function getFirstParent(&$models, $commentId)
    {
        #если родительской реплики нет в flat-массиве (а корневых не будет - мы их удалили)
        if (!array_key_exists($models[$commentId]->parent_id, $models)) {
            #если родительская реплика - это и есть корневая - вернем её
            return $models[$commentId]->parent_id;
        } else {
            return self::getFirstParent($models, $models[$commentId]->parent_id);
        }
    }

    /**
     * Вернем AR родителя в нашей структуре
     * @param $tree Comment корневой комментарий
     * @param $comment Comment текущий
     */
    public function getAnswer($comment, $tree)
    {

        if ($tree->id == $comment->parent_id) {
            return $tree;
        } else {
            return $this->tree[$tree->id]['child'][$comment->parent_id];
        }
    }

    public function assets()
    {
        if (!$this->reload) {
            Yii::app()->clientScript->registerScript('ajax_reload',
                "var ajax_reload='" . self::JS_AJAX_RELOAD . "', interval_reload ='".self::JS_INTERVAL_RELOAD."';",
                CClientScript::POS_HEAD);
        }
        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->assetManager->publish(
                dirname(__FILE__) . '/assets/comment.js', false, -1, YII_DEBUG
            ),
            CClientScript::POS_END
        );
    }

    /**
     * Вернуть классы для каждого комментрия. Рассчитает новая ли реплика.
     * Ответит на вопрос а не выделена ли она для ответа (при ajax-обновлении это выделение затрется)
     */
    public function getCommentClass(Comment $comment)
    {
        $isNewSecond = 30;
        $class = 'comment ';
        if (Candy::differenceSecond(Candy::currentDate(), $comment->create_date) < $isNewSecond) {
            $class .= 'new ';
        }
        if (isset($this->params['answered']) && $this->params['answered'] == $comment->id){
            $class .= 'answered ';
        }
        if(isset($this->params['find']) && $this->params['find'] == $comment->id){
            $class .= 'find ';
        }
        return $class;
    }

}