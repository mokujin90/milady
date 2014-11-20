<?php

class SiteController extends BaseController
{
    public function actionIndex()
    {
        $this->interface['slim_menu'] = false;
        $this->render('index');
    }


    public function actionLkMessage()
    {
        $this->render('lk_message');
    }

    public function actionInvest()
    {
        $filter = new RegionFilter();
        if (!empty($_GET)) {
            $filter->apply();
        }

        $this->render('invest', array('filter' => $filter));
    }

    public function actionLkProject()
    {
        $item_count = 32;
        $page_size = 5;

        $pages = new CPagination($item_count);
        $pages->setPageSize($page_size);

        // simulate the effect of LIMIT in a sql query
        $end = ($pages->offset + $pages->limit <= $item_count ? $pages->offset + $pages->limit : $item_count);

        $sample = range($pages->offset + 1, $end);

        $this->render('lk_project', array('pages' => $pages));
    }

    public function actionSetRegion($id)
    {
        //на тот случай, если что-то непонятно передано
        if (is_null(Region::model()->findByPk($id))) {
            $id = self::DEFAULT_CURRENT_REGION;
        }
        $this->setCookie('currentRegion', $id);
        $this->redirect(Yii::app()->user->returnUrl);
    }

    public function actionStaticMap(){
        $map = new staticMapLite();
        print $map->showMap();
    }
}