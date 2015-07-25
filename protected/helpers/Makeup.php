<?php

/**
 * Class Makeup
 * Специально для помощи в верстке
 */
class Makeup
{

    /**
     * @notice стилизация всех чекбоксов и радио сделана через связь label + input. В том случае если они не будут привязаны
     * через id инпута, то он и реагировать не будет.
     * Этот метод написан для генереации ничего не значащих id'ишников в тексте. Достаточно один раз вызывать в параметры for у лэйбла, и у параметра id инпута
     * @return string
     */
    public static function id()
    {
        $second = Candy::currentDate('ms');
        static $currentId, $last;
        if (is_null($currentId)) {
            $currentId = 0;
            $last = 0;
        } else {
            if ($last == 0) {
                $last = 1;
            } else {
                $currentId++;
                $last = 0;
            }
        }
        return 'element_id_' . $currentId.$second;
    }

    public static function img()
    {
        return "/images/assets/img-" . rand(0, 1) . ".png";
    }

    public static function dump($var, $die = false)
    {
        CVarDumper::dump($var, 10, true);
        if ($die)
            die;
    }

    public static function holder($type=0){
        if($type==0){
            return Yii::t('main','Россия, Индекс, Субъект РФ, Город, Улица, Дом, Офис (если есть).');
        }
        elseif($type=1){
            return Yii::t('main','+7 (код) телефон');
        }
    }

    public static function makeHttpUrl($url)
    {
        return preg_match('|^https?://|', $url) ? $url : ('http://' . $url);
    }

    public static function makeLinkTextUrl($url)
    {
        $text = preg_replace('|^https?://|', '', $url);
        $text = preg_replace('|/.*|', '', $text);
        $url = self::makeHttpUrl($url);

        return array($text, $url);
    }
}