<?php

class TestController extends CController
{
    public function actionIndex()
    {
        $this->layout = false;
        if($_POST['ip']){
            $connection=Yii::app()->db;
            foreach(explode("\n", $_POST['ip']) as $item){
                /*$data = explode(":", $item);
                $ip = trim($data[0]);
                $port = trim($data[1]);*/
                //$command=$connection->createCommand("INSERT INTO proxy (ip, port) VALUES ('$ip', '$port')");
                $x = trim($item);
                if($x != '')
                $command=$connection->createCommand("INSERT INTO user_agent (name) VALUES ('" . trim($item) . "')");
                try{
                    $command->execute();
                } catch(Exception $e){

                }
            }
        }
        $this->render('index');
    }
}