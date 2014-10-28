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
     * Транслитерация строки, с учетом ненужных символов
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

    /**
     * Перевести всю строк в нижний регистр и оставить только буквыы
     * @param $str
     * @return mixed|string
     */
    public static function convertToAlphaNum($str)
    {
        $res = preg_replace('|[^a-zа-я0-9 ]+|ui', ' ', $str);
        $res = trim(preg_replace('| {2,}|u', ' ', $res));
        $res = mb_strtolower($res);
        return $res;
    }

    public static function formatPrice($price){
        return Yii::app()->format->number($price);
    }

    /**
     * Вывести изображение . Первый параметр модель media, далее параметры будут раскидываться кто-куда.
     * @param $params [scale:{ширина}x{высота}]
     * @return string
     */
    public static function preview($params)
    {
        if (!$params[0]) {
            $scale = explode('x',$params['scale']);
            $params['style']= "width:{$scale[0]}px;height:{$scale[1]}px";
            return CHtml::openTag('img',$params);
        }
        $res = $params[0]->makePreview($params);
        if (strcmp($res['src'], '') == 0) return '';
        if (isset($params['src_only'])) return $res['src'];
        $tag_params = array();
        $tag_params['src'] = !empty($params['absoluteUrl']) ? (Yii::app()->request->hostInfo . $res['src'])
            : $res['src'];
        foreach ($params as $k => $v) {
            if (preg_match("/^class$|^title$|^style$|^alt$|^on*+/", $k, $matches))
                $tag_params[$k] = $v;
        }
        if (preg_match("/png$/", $tag_params['src'], $matches)) {
            $classArr = array();
            if (isset($tag_params['class'])) {
                $classArr = preg_split(' ', (string)$tag_params['class']);
            }
            $classArr[] = "png";
            $tag_params['class'] = join(" ", $classArr);
        }
        return CHtml::tag("img", $tag_params, false, true);
    }

    /**
     * Получить имя базы данных. Используется кеш
     * @return int
     */
    public static function dbName()
    {
        static $name = null;
        if (!$name) {
            $name = preg_match("/dbname=([^;]*)/", Yii::app()->db->connectionString, $matches);
            $name = $matches[1];
        }
        return $name;
    }
}