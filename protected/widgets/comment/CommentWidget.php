<?php

class CommentWidget extends CWidget
{
    const DEFAULT_OBJECT = 'project';
    const DATE_FORMAT = 'd.m.Y';
    const TIME_FORMAT = ' H:i';

    const COUNT_IN_PAGE = 5;
    const JS_AJAX_RELOAD = 0; //включено или нет ajax-обновление
    const JS_INTERVAL_RELOAD = 10000; //таймер автообновления в микросекундах

    const ACTION_REFRESH = 'refresh';
    const ACTION_PAGE = 'page';
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

    //уже загруженное количество "страниц"
    public $total = null;
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

    public $action = 'start';
    /**
     * Параметры, в которых будут дополнительные настройки
     * @var array
     */
    public $params = array();

    protected $tree = array();

    public $page = 0;
    public function run()
    {
        $this->assets();
        if(isset($this->params['page'])){
            $this->page = $this->params['page'];
        }
        if(isset($this->params['action'])){
            $this->action = $this->params['action'];
        }
        if(isset($this->params['total'])){
            $this->total = $this->params['total'];
        }

        if (!is_null($this->commentId)) { //одиночный вывод
            $comment = Comment::model()->findByPk($this->commentId);
            $this->render('_comment', array('comment' => $comment));
        } else if (!is_null($this->objectId)) {
            $this->tree = self::getTree($this->objectId, $this->objectType,$this->page,$this->action,$this->total);
            if(!count($this->tree)==0 || $this->reload==false){ //для скрытия кнопки "Показать еще"
                $this->render('commentTree');
            }
        }
    }

    /**
     * Так как у нас комментарии должны быть древовидными, а в БД все гладкое, то составим древовидную
     * двухуровневую структуру из комментариев с нужным
     * @param $type
     * @param $id
     * @return $tree вида [[parent]=>Comment,[child]=>[Comment,Comment,Comment]*n]
     */
    public static function getTree($id, $type = self::DEFAULT_OBJECT, $page = 0,$action,$total)
    {
        $tree = array();
        $models = Comment::findCommentByObjectId($id, $type,$page,$action,$total);

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

    public function getCommentId($id){
        return "comment-{$id}-id";
    }
}