<?php

class InvestorController extends BaseController
{

    public function actionIndex(){
        $this->breadcrumbs = array('Инвесторы');
        $limit = Yii::app()->request->getParam('limit',5);
        $sort = Yii::app()->request->getParam('sort',null);
        $criteria = new CDbCriteria();
        $criteria->addCondition('type = "investor" AND is_active = 1');
        $filter = new InvestorFilter();

        if (isset($_GET['reset'])) {
            unset($_SESSION['InvestorFilter']);
        }

        if (isset($_GET['InvestorFilter'])) {
            $filter->apply($criteria);
            $_SESSION['InvestorFilter'] = $_GET['InvestorFilter'];
        } elseif (isset($_SESSION['InvestorFilter'])) {
            $_REQUEST['InvestorFilter'] = $_SESSION['InvestorFilter'];
            $filter->apply($criteria);
        }

        if($sort == 'investor_up'){
            $criteria->order = 'investor_type ASC';
        }
        elseif($sort == 'industry_up'){
            $criteria->order = 'investor_industry ASC';
        }
        elseif($sort == 'country_up'){
            $criteria->order = 'investor_country_id ASC';
        }
        elseif($sort == 'investment_amount_up'){
            $criteria->order = 'investor_finance_amount ASC';
        }
        else if($sort == 'investor_down'){
            $criteria->order = 'investor_type DESC';
        }
        elseif($sort == 'industry_down'){
            $criteria->order = 'investor_industry DESC';
        }
        elseif($sort == 'country_down'){
            $criteria->order = 'investor_country_id DESC';
        }
        elseif($sort == 'investment_amount_down'){
            $criteria->order = 'investor_finance_amount DESC';
        }
        $pages = $this->applyLimit($criteria,'User',$limit);
        $models = User::model()->findAll($criteria);
        $this->render('index',array('models' => $models,'filter'=>$filter, 'pages' => $pages));
    }

    public function actionView($id){
        $model = User::model()->findByAttributes(array('id' => $id, 'type' => 'investor', 'is_active' => 1));
        if (!$model) {
            throw new CHttpException(404, Yii::t('yii', 'Page not found.'));
        }
        $this->breadcrumbs = array('Инвесторы' => $this->createUrl('investor/index'), $model->getInvestorName());
        $this->render('view',array('model' => $model));
    }

}