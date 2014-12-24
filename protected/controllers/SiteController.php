<?php

class SiteController extends BaseController
{
    public function actionIndex()
    {
        $this->interface['slim_menu'] = false;

        //news load
        $mainNewsCriteria = new CDbCriteria();
        $mainNewsCriteria->addColumnCondition(array('is_active' => 1, 'on_main' => 1));
        $mainNewsCriteria->order='create_date DESC';
        $mainNews = News::model()->find($mainNewsCriteria);

        $newsCriteria = new CDbCriteria();
        $newsCriteria->addColumnCondition(array('is_active' => 1));
        if($mainNews){
            $newsCriteria->addCondition(array("id != {$mainNews->id}"));
        }
        $newsCriteria->order='create_date DESC';
        $newsCriteria->limit = 4;
        $news = News::model()->findAll($newsCriteria);

        //analytics load
        $mainAnalyticsCriteria = new CDbCriteria();
        $mainAnalyticsCriteria->addColumnCondition(array('is_active' => 1, 'on_main' => 1));
        $mainAnalyticsCriteria->order='create_date DESC';
        $mainAnalytics = Analytics::model()->find($mainAnalyticsCriteria);

        $analyticsCriteria = new CDbCriteria();
        $analyticsCriteria->addColumnCondition(array('is_active' => 1));
        if($mainAnalytics){
            $analyticsCriteria->addCondition(array("id != {$mainAnalytics->id}"));
        }
        $analyticsCriteria->order='create_date DESC';
        $analyticsCriteria->limit = 3;
        $analytics = Analytics::model()->findAll($analyticsCriteria);

        $this->render('index', array(
            'news' => $news, 'mainNews' => $mainNews,
            'analytics' => $analytics, 'mainAnalytics' => $mainAnalytics,
        ));
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
    public function actionAnalyticsAndNews()
    {
        $this->render('analytics_and_news');
    }

    public function actionStaticMap(){
        $map = new staticMapLite();
        print $map->showMap();
    }

    public function actionContacts()
    {
        $this->breadcrumbs = array(Yii::t('main', 'Контакты'));
        $model = Content::model()->findByAttributes(array('type' => Content::T_CONTACTS));
        $this->render('static', array('html'=>$model->content));
    }

    /*public function actionFeedback()
    {
        $this->breadcrumbs = array(Yii::t('main', 'Обратная связь'));
        $model = Content::model()->findByAttributes(array('type' => Content::T_FEEDBACK));
        $this->render('static', array('html'=>$model->content));
    }*/

    public function actionAbout()
    {
        $this->breadcrumbs = array(Yii::t('main', 'О проекте'));
        $model = Content::model()->findByAttributes(array('type' => Content::T_ABOUT));
        $this->render('static', array('html'=>$model->content));
    }

    public function actionCommand()
    {
        $this->breadcrumbs = array(Yii::t('main', 'Команда'));
        $model = Content::model()->findByAttributes(array('type' => Content::T_COMMAND));
        $this->render('static', array('html'=>$model->content));
    }

    public function actionSearch($search){
        if(!empty($search)){
            $this->globalSearch = $search;
            $this->breadcrumbs = array('Поиск');
            $filter = new SiteSearch();
            $filter->search = $search;
            $filter->regionId = $this->currentRegion;
            $data = $filter->apply();
            try {
                $pages = $this->applyLimit($data, null, 10);
            } catch (Exception $e) {
                $data = array();
                $pages = new CPagination();
            }
            $this->addAdvancedData($data);
            $this->render('search', array('filter' => $filter, 'data' => $data, 'pages' => $pages));
        } else {
            $this->redirect($this->createUrl('site/index'));
        }
    }
    private function addAdvancedData(array &$data)
    {
        foreach ($data as $key => $item) {
            if ($item['object_name'] == 'project_comment') {
                $data[$key]['model'] = Project::model()->findByPk($data[$key]['target_id']);
            } elseif ($item['object_name'] == 'region_news') {
                $data[$key]['model'] = News::model()->findByPk($data[$key]['id']);
            } elseif ($item['object_name'] == 'project_news') {
                $data[$key]['model'] = Project::model()->findByPk($data[$key]['target_id']);
                $data[$key]['alt_model'] = ProjectNews::model()->findByPk($data[$key]['id']);
            } elseif ($item['object_name'] == 'global_news') {
                $data[$key]['model'] = News::model()->findByPk($data[$key]['id']);
            } elseif ($item['object_name'] == 'analytics') {
                $data[$key]['model'] = Analytics::model()->findByPk($data[$key]['id']);
            } elseif ($item['object_name'] == 'event') {
                $data[$key]['model'] = Event::model()->findByPk($data[$key]['id']);
            } elseif ($item['object_name'] == 'prof_opinion') {
                $data[$key]['model'] = ProfOpinion::model()->findByPk($data[$key]['id']);
            } elseif ($item['object_name'] == 'project') {
                $data[$key]['model'] = Project::model()->findByPk($data[$key]['id']);
                $data[$key]['text'] = Project::getStaticProjectType($item['text']);
            }
        }
    }

    public function actionChangeLang($langId){
        $this->setCookie('languageId',$langId);
        if(!Yii::app()->user->isGuest){
            $this->user->language_id = $langId;
            $this->user->save();
        }
        $this->redirect(Yii::app()->user->returnUrl);
    }
}