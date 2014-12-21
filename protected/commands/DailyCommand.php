<?php

class DailyCommand extends CConsoleCommand
{
    public $mailer;

    public function run($args)
    {
        if (!count($args)) {
            $this->actionBlockBanner();
        } else {
            return parent::run($args);
        }
    }

    public function actionBlockBanner()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.status = "activate"');
        $criteria->with = array('user.balances');
        $criteria->addCondition('( balances.value < t.price && t.type = "click")
            || (t.type = "view" && ((t.count_view % 1000 = 0 && balances.value < t.price)) )');
        $banners = Banner::model()->findAll($criteria);
        foreach($banners as $model){
            $model->status = 'blocked';
            $model->save();
        }
    }
}