<?php

class BaseAction extends CAction {

    //статусы для ajax-ответов в кабинетах
    const S_SUCCESS = 'success';
    const S_NO_MONEY = 'no_money';
    const S_ERROR = 'error';
    const S_BREAK = 'break'; //прерывание операции, вообще ничего не делаем

    /**
     * @var BaseController
     */
    public $controller = null;

    /**
     * @var null User
     */
    protected $currentUser = null;

    /**
     * Сумматор оплачиваемых объектов
     * @var int
     */
    protected $bill = 0;

    /**
     * Текущий баланс пользователя
     * @var int
     */
    public $balance = null;

    protected $json = array();

    /**
     * Действие которое передается через ajax
     * @var string
     */
    protected $action = '';

    /**
     * Флаг о необходимости валидации записи. Применяется когда нам надо срочно сохранить и не валидировать
     * @var bool
     */
    protected $runValidation = true;

    public function run($id = null, $next = null){
        /**
         * Инициализация модели и настроек действия
         */
        $this->controller = $this->getController(); // замена $this в контроллере
        $this->currentUser = $this->controller->user;
        $this->action = Yii::app()->request->getParam('action','');
    }

    public function getBalance(){
        if(is_null($this->balance)){
            $this->balance = $this->controller->balance;
        }
        return $this->balance;
    }

    /**------------------------------ Методы для view -------------------------------**/

}