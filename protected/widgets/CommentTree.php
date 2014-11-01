<?php

class CommentTree extends CWidget
{

    /**
     * Id объекта.
     * @var int | null
     */
    public $id = null;

    /**
     * Часть сайта к которой необходимо вывести комментарий
     * @var string
     */
    public $objectType = Comment::DEFAULT_OBJECT;

    public function run()
    {
        //$this->render('stock');
    }

}