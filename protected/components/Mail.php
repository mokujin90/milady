<?php

class Mail extends CComponent
{
    const S_REGISTER = 0;
    const S_CHECK_EMAIL = 1;
    const S_RESTORE = 2;

    /**
     * @param $to
     * @param $theme
     * @param $view
     * @param $params array
     * @param bool $command
     * @param bool $withoutView
     * @return bool
     */
    public static function send($to, $theme, $view, $params, $command = false, $withoutView = false)
    {
        if (empty($to)) {
            return false;
        }

        $theme = is_numeric($theme) ? self::getSubject($theme) : $theme;
        $mailer =& Yii::app()->mailer;
        $mailer->CharSet = 'UTF-8';
        $mailer->From = Yii::app()->params['fromEmail'];
        $mailer->FromName = Yii::app()->params['fromName'];
        $mailer->IsSMTP(); // set mailer to use SMTP

        $mailer->Host = "smtp.yandex.ru"; // specify main and backup server
        $mailer->SMTPAuth = true; // turn on SMTP authentication
        $mailer->Username = "termin@wconsults.ru"; // SMTP username
        $mailer->Password = "123456"; // SMTP passwordtest@termin.wconsults.ru
        $mailer->Port = 465;
        $mailer->SMTPSecure = 'ssl';

        $mailer->ClearAddresses();
        $mailer->ClearBCCs();
        if (is_array($to)) {
            foreach ($to as $item) {
                $mailer->AddBCC($item);
            }

        } else {
            $mailer->AddBCC($to);
        }
        $mailer->Subject = Yii::t('main', $theme);
        if ($withoutView) {
            $mailer->Body = $view;
        } else {
            if ($command === false) {
                $mailer->Body = Yii::app()->controller->renderPartial("/mailer/$view", array('params' => $params), true);
            } else {
                $mailer->Body = $command->renderFile("views/mailer/$view.php", array('params' => $params), true);
            }
        }
        $mailer->IsHTML(true);
        if (!$mailer->Send()) {
            //return false;
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mailer->ErrorInfo;
            exit;
        }
        return true;
    }

    private static function getSubject($const){
        switch($const){
            case self::S_REGISTER:
                return Yii::t('main','Регистрация на сайте iip.ru');
            case self::S_CHECK_EMAIL:{
                return Yii::t('main','Подтверждение электронного ящика');
            }
            case self::S_RESTORE:
                return Yii::t('main','Восстановление пароля');
        }
    }

    /**
     * Cформировать ссылку
     * @param $route
     */
    public static function link($route,$params = array()){
        $link = Yii::app()->createAbsoluteUrl($route,$params);
        return CHtml::link($link,$link);
    }
}