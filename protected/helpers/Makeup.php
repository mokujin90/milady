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
        static $id, $last;
        if (is_null($id)) {
            $id = 0;
            $last = 0;
        } else {
            if ($last == 0) {
                $last = 1;
            } else {
                $id++;
                $last = 0;
            }
        }
        return 'element_id_' . $id.$second;
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
}