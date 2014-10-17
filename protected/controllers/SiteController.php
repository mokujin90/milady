<?php

class SiteController extends BaseController
{
    public function actionIndex()
    {
        $this->interface['slim_menu'] = false;
        $this->render('index');
    }

    public function actionLkProfil(){
        $this->render('lk_profil');
    }
    public function actionLkMessage(){
        $this->render('lk_message');
    }

    public function actionRegions(){
        $this->render('regions');
    }
    public function actionInvest(){
        $this->render('invest');
    }

}