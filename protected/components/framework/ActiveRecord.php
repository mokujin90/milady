<?php

/**
 * Прослойка между yii'шным AR и моделями пользователя.
 * Весь упор делается на обработку событий (при этом необходимо соблюдение определнной нотации в БД)
 * Class ActiveRecord
 */
class ActiveRecord extends CActiveRecord
{
    public $count = 0;
    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            if (array_key_exists('create_date', $this->attributes)) {
                if(empty($this->create_date)){
                    $this->create_date = Candy::currentDate();
                }
            }
        }
        if (array_key_exists('update_date', $this->attributes)) {
            $this->update_date = Candy::currentDate();
        }
        return parent::beforeValidate();
    }

    /**
     * Есть класс аттрибутов, для которых не подходит пустота в качестве значения
     * @param $attribute
     */
    public function maybeNull($attribute)
    {
        $this->$attribute = empty($this->$attribute) ? null : $this->$attribute;
    }

    /**
     * Быстрый метод для создания словарей. Пригождается для всевозможных dropDownList'ов
     */
    static function getDrop($key = 'id', $field = 'name')
    {
        return CHtml::listData(self::model()->findAll(), $key, $field);
    }

    /**
     * Вернуть хеш от выбранного аттрибута и соли
     * @param $attribute
     */
    public function hash($attribute = 'password')
    {
        $salt = "*^";
        return md5(($this->{$attribute}) . $salt);
    }

    /**
     * Метод, который сможет принять кусок реквеста и сохранить в нормальном виде в таблицу, которая является промежуточной,
     * т.е. HAS_MANY
     * @param $request массив значений
     * @param $keyName подразумевается, что это значение является основным, т.е. может повторяться
     * @param $key значение ключа в такой таблице (ключ, имеется ввиду основная еденица, которая связывается)
     * @param $valueName
     */
    public function manySave($request, $key = null, $keyName, $valueName)
    {
        $childModel = get_class($this);
        #проверка на необходимость выполнять код дальше

        if (!$this->hasAttribute($keyName) || !$this->hasAttribute($valueName) || (is_null($key) && count($request) == 0))
            return false;
        $models = $this->model()->findAllByAttributes(array("{$keyName}" => $key),array('index'=>$valueName));
        $oldData = CHtml::listData($models, 'id', $valueName);
        $createItem = array_diff($request, $oldData);
        $deleteItem = array_diff($oldData, $request);


        #добавление элементов
        if(count($createItem)){
            foreach ($createItem as $item) {
                $model = new $childModel();
                $model->attributes = array($keyName => $key, $valueName => $item);
                $model->save();
            }
        }
        #удаление записей
        if(!is_null($key) && count($deleteItem)){
            $this->deleteAllByAttributes(array($keyName=>$key,$valueName=>$deleteItem));
        }
    }

}