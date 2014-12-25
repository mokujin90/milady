<?php

class Mail extends CComponent
{
    const S_REGISTER = 0;
    const S_CHECK_EMAIL = 1;
    const S_RESTORE = 2;
    const S_NEW_COMMENT = 3;
    const S_NEW_NEWS = 4;
    const S_NEW_MESSAGE = 5;
    const S_CHECK_RESTORE = 6;

    /**
     * @param $email array|str
     * @param $theme
     * @param $view
     * @param $params
     * @param bool $command
     * @param bool $withoutView
     * @return bool
     */
    public static function send($email, $theme, $view, $params, $command = false, $withoutView = false)
    {
        if (empty($email)) {
            return false;
        }
        $mailer = self::getMailer($theme);

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

        //если массовая рассылка, то отправляем письма пачками по 50 шт.
        if (is_array($email)) {
            $emailCounter = 0;
            foreach ($email as $emailItem) {
                $emailCounter++;
                $mailer->AddBCC($emailItem);
                if ($emailCounter % 50 == 0) {
                    $mailer->Send();
                    sleep(1);
                    $mailer->ClearAddresses();
                    $mailer->ClearBCCs();
                }
            }
            if ($emailCounter % 50 !== 0) {
                $mailer->Send();
            }
        } else { //одиночная рассылка
            $mailer->AddAddress($email);
            $mailer->Send();
        }
    }

    /**
     * @return $mailer Mailer
     */
    private static function getMailer($theme){
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
        $theme = is_numeric($theme) ? self::getSubject($theme) : $theme;
        $mailer->Subject = Yii::t('main', $theme);
        return $mailer;
    }
    private static function getSubject($const){
        switch($const){
            case self::S_REGISTER:
                return Yii::t('main','Регистрация на сайте iip.ru');
            case self::S_CHECK_EMAIL:
                return Yii::t('main','Подтверждение электронного ящика');
            case self::S_RESTORE:
                return Yii::t('main','Восстановление пароля');
            case self::S_NEW_COMMENT:
                return Yii::t('main','Новый комментарий');
            case self::S_NEW_NEWS:
                return Yii::t('main','Новая новость о проекте');
            case self::S_NEW_MESSAGE:
                return Yii::t('main','Вам пришло новое сообщение');
            case self::S_CHECK_RESTORE:
                return Yii::t('main','Подтверждение электронного ящика для восстановления пароля');
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