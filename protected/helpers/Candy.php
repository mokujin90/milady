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
    public static function get(&$variable, $default = 0)
    {
        return (empty($variable) && !isset($variable)) ? $default : $variable;
    }

    /**
     * @param $text
     * @return mixed
     */
    public static function getLatin($text)
    {
        $text = self::convertToAlphaNum($text);
        $assoc = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
            'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i',
            'й' => 'i', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
            'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
            'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '',
            'э' => 'a', 'ю' => 'uo', 'я' => 'ya',
        );
        $text = str_replace(array_keys($assoc), array_values($assoc), $text);
        $text = str_replace(' ', '-', $text);
        return $text;
    }

    public static function convertToAlphaNum($str)
    {
        $res = preg_replace('|[^a-zа-я0-9 ]+|ui', ' ', $str);
        $res = trim(preg_replace('| {2,}|u', ' ', $res));
        $res = mb_strtolower($res);
        return $res;
    }

    /**
     * Сформировать массив с процентами от 0 до 100 с шагом n
     */
    public static function getPercent($step = 5,$from=0,$to=100){
        $result = array();
        for ($i = $from; $i <= $to; $i +=$step) {
            $result[$i] = $i;
        }
        return $result;
    }
}