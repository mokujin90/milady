<?php

class MoneyController extends BaseController
{
    public function actionAdd(){
        if(Yii::app()->request->isPostRequest && isset($_POST['add_value'])){
            if(!is_numeric($_POST['add_value']))
                $this->redirect(array('user/index'));
            $payUrlParams['MrchLogin'] = Yii::app()->params['robokassa']['login'];
            $payUrlParams['OutSum'] = $_POST['add_value'];
            $payUrlParams['InvId'] = Yii::app()->user->id;
            $payUrlParams['Desc'] = 'Пополнение баланса на IIP';
            $payUrlParams['SignatureValue'] = md5(
                $payUrlParams['MrchLogin']. ':' . $payUrlParams['OutSum']. ':' . $payUrlParams['InvId']. ':' . Yii::app()->params['robokassa']['pass1']
            );
            $this->redirect(Yii::app()->params['robokassa']['actionUrl'] . '?' . http_build_query($payUrlParams));
        }
        $this->renderPartial('_add');
    }

    public function actionSuccess(){
        Yii::app()->user->setFlash('msg',Yii::t('main','Пополнение баланса прошло успешно'));
        $this->redirect($this->createUrl('site/index'));
    }

    public function actionReturn(){
        if (isset($_GET)) {
            $outSumm = $_REQUEST["OutSum"];
            $invId = $_REQUEST["InvId"];
            $crc = $_REQUEST["SignatureValue"];
            $pass2 = Yii::app()->params['robokassa']['pass2'];

            $crc = strtoupper($crc);
            $siteCrc = strtoupper(md5("$outSumm:$invId:$pass2"));
            if ($siteCrc != $crc) {
                echo Yii::t('main','Неверный запрос');
                Yii::app()->end();
            }
            Balance::pay($invId,$outSumm,Balance::T_ADD,'Пополнение через Robokassa');
        } else {
            Yii::app()->end( 'Необходим POST запрос');
        }
    }

    public function actionFail(){
        Yii::app()->user->setFlash('msg',Yii::t('main','Неудалось пополнить баланс'));
        $this->redirect($this->createUrl('site/index'));
    }
}