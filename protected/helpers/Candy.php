<?php

class Candy
{
    /**
     * Эмуляция $form->error, по той причине, что yii'шная валидация либо соглашается на два ajax-запроса, либо на отсутствие error-полей
     * @param $model
     * @param $field
     */
    public static function error($model, $field)
    {
        return '<div class="errorMessage" id="' . get_class($model) . '_' . $field . '_em_" style="display: none;"></div>';
    }

    public static function dictonaryCondition(array $models, $field = 'id', $key = 'id', $conditionField, $conditionValue)
    {
        $dictionary = array();
        foreach ($models as $item) {
            if ($item->{$conditionField} == $conditionValue) {
                $dictionary[$item->{$key}] = $item->{$field};
            }
        }
        return $dictionary;
    }

    /**
     * Такой-то сахар
     * @param $date
     * @param string $format
     * @return string
     */
    public static function formatDate($date, $format = 'd.m.Y')
    {
        $newDate = new DateTime($date);
        return $newDate->format($format);
    }

    /**
     * Сахар, для преобразования любой переменной в массив
     * @param $var
     * @return array
     */
    public static function recommend($var)
    {
        return is_array($var) ? $var : array($var);
    }

    /**
     * Обычный сеттер для переменной, с дефолтным значением в случае неопределенности
     * @param $variable
     * @param int $default
     * @return int
     */
    public static function get($variable, $default = 0)
    {
        return is_null($variable) ? $default : $variable;
    }
}