<?php

class SiteController extends BaseController
{

    public function actionIndex()
    {
        $this->interface['slim_menu'] = false;
        $this->render('index');
    }

    public function actionRegions(){
        $this->render('regions');
    }

    public function getBreadcrumbs()
    {
        static $count = 0;
        if ($count++ > 0) {
            return parent::getBreadcrumbs();
        }

        switch ($this->action->id) {
            case 'error':
                $this->addBreadcrumb(array('name' => 'Ошибка'));
                break;
        }

        return parent::getBreadcrumbs();
    }
}