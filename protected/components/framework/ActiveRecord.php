<?php

/**
 * Прослойка между yii'шным AR и моделями пользователя.
 * Весь упор делается на обработку событий (при этом необходимо соблюдение определнной нотации в БД)
 * Class ActiveRecord
 */
class ActiveRecord extends CActiveRecord
{
    public function beforeValidate()
    {
        if(array_key_exists('create_date',$this->attributes)){
            $this->create_date = Candy::currentDate();
        }
        return parent::beforeValidate();
    }

    /**
     * Есть класс аттрибутов, для которых не подходит пустота в качестве значения
     * @param $attribute
     */
    public function maybeNull($attribute){
        $this->$attribute =  empty($this->$attribute) ? null : $this->$attribute;
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
    public function hash($attribute='password'){
        $salt = "*^";
        return md5(($this->{$attribute}).$salt);
    }
}