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
        if(isset($this->create_date)){
            $this->create_date = Candy::currentDate();
        }
        return parent::beforeValidate();
    }

    /**
     * Быстрый метод для создания словарей. Пригождается для всевозможных dropDownList'ов
     */
    static function getDrop($key = 'id', $field = 'name')
    {
        return CHtml::listData(self::model()->findAll(), $key, $field);
    }
}