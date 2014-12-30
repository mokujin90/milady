<?php

class Candy
{
    const DATETIME = "Y-m-d H:i:s";
    const DATE = 'Y-m-d';
    const NORMAL = 'd.m.Y';
    public static $weekDay = array(1 => 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье');
    //Вернуть текущую дату в нужном формате
    public static function currentDate($format = "Y-m-d H:i:s")
    {
        return date($format);
    }

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
     * @param null|str $oldFormat для некоторых форматов, к примеру 'd/m/Y' или timestamp не сработает стандартный
     * определитель форматирования, и поэтому придется указать вручную
     * @return string
     */
    public static function formatDate($date, $format = 'd.m.Y',$oldFormat = null)
    {
        $newDate = is_null($oldFormat) ? new DateTime($date) : DateTime::createFromFormat($oldFormat,$date);
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
                $classArr = explode(" ", (string)$tag_params['class']);
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

    public static function differenceSecond($maxDate,$minDate){
        $maxDate = new DateTime($maxDate);
        $minDate = new DateTime($minDate);
        return $diffInSeconds = $maxDate->getTimestamp() - $minDate->getTimestamp();;
    }

    /**
     * @param str $dateStart обычная дата которую необходимо увеличить
     * @param $interval формата '+ 1 days'
     * @param $format формат выходного значения
     * @return DateTime
     */
    public static function editDate($dateStart, $interval, $format = self::DATETIME)
    {
        return date($format, strtotime($dateStart . " $interval"));
    }

    /**
     * Функция возвращает окончание для множественного числа слова на основании числа и массива окончаний
     * @param  $number Integer Число на основе которого нужно сформировать окончание
     * @param  $endingsArray  Array Массив слов или окончаний для чисел (1, 4, 5),
     *         например array('яблоко', 'яблока', 'яблок')
     * @return String
     */
    public static function getNumEnding($number, $endingArray)
    {
        $number = $number % 100;
        if ($number >= 11 && $number <= 19) {
            $ending = $endingArray[2];
        } else {
            $i = $number % 10;
            switch ($i) {
                case (1):
                    $ending = $endingArray[0];
                    break;
                case (2):
                case (3):
                case (4):
                    $ending = $endingArray[1];
                    break;
                default:
                    $ending = $endingArray[2];
            }
        }
        return $ending;
    }
    /**
     * Выборка случайного элемента с учетом веса
     *
     * @param array $values индексный массив элементов
     * @param array $weights индексный массив соответствующих весов
     * @return mixed выбранный элемент
     */
    static function rand_by_weight ( $values, $weights )
    {
        $total = array_sum( $weights );
        $n = 0;
        $num = mt_rand( 1, $total );
        foreach ( $values as $i => $value )
        {
            $n += $weights[$i];
            if ( $n >= $num )
            {
                return $values[$i];
            }
        }
    }

    /**
     * @param str $dateStart обычная дата которую необходимо увеличить
     * @param $interval формата '+ 1 days'
     * @param $format формат выходного значения
     * @return DateTime
     */
    public static function date_plus($dateStart, $interval, $format = self::DATETIME)
    {
        if(is_null($dateStart)){
            $dateStart = self::currentDate();
        }
        return date($format, strtotime($dateStart . " $interval"));
    }

    public static function unsetJsonKey(&$json, $key)
    {
        $array = CJSON::decode($json);

        if (array_key_exists($key, $array)) {
            unset($array[$key]);
        }
        $json = CJSON::encode($array);
    }

    public static function pushJson(&$json, $key, $value)
    {
        $array = CJSON::decode($json);
        $array[$key] = $value;
        $json = CJSON::encode($array);
    }

    /**
     * По дате отдаст номера дня недели в формате проекта, а не ISO-8601 (т.е. -1)
     * @param $date
     */
    public static function getWeekDay($date=null){
        if(is_null($date)){
            $date = self::currentDate();
        }
        return date('N', strtotime( $date))-1;
    }
}