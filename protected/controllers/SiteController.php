<?php

class SiteController extends BaseController
{
    public function actionIndex()
    {
        $this->interface['slim_menu'] = false;

        //news load
        $mainNewsCriteria = new CDbCriteria();
        $mainNewsCriteria->addColumnCondition(array('is_active' => 1, 'on_main' => 1, 'is_main' => 1));
        $mainNewsCriteria->addCondition('region_id = :region_id OR region_id is null');
        $mainNewsCriteria->params +=array(':region_id'=>$this->getCurrentRegion());
        $mainNewsCriteria->order = 'create_date DESC';
        $mainNews = News::model()->find($mainNewsCriteria);

        $newsCriteria = new CDbCriteria();
        $newsCriteria->addColumnCondition(array('is_active' => 1, 'on_main' => 1));
        $newsCriteria->addCondition('region_id = :region_id OR region_id is null');
        $newsCriteria->params +=array(':region_id'=>$this->getCurrentRegion());
        if ($mainNews) {
            $newsCriteria->addCondition(array("id != {$mainNews->id}"));
        }
        $newsCriteria->order = 'create_date DESC';
        $newsCriteria->limit = 4;
        $news = News::model()->findAll($newsCriteria);

        //analytics load
        $mainAnalyticsCriteria = new CDbCriteria();
        $mainAnalyticsCriteria->addColumnCondition(array('is_active' => 1, 'on_main' => 1, 'is_main' => 1));
        $mainAnalyticsCriteria->order = 'create_date DESC';
        $mainAnalytics = Analytics::model()->find($mainAnalyticsCriteria);

        $analyticsCriteria = new CDbCriteria();
        $analyticsCriteria->addColumnCondition(array('is_active' => 1, 'on_main' => 1));
        if ($mainAnalytics) {
            $analyticsCriteria->addCondition(array("id != {$mainAnalytics->id}"));
        }
        $analyticsCriteria->order = 'create_date DESC';
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

    public function actionSetRegion($id, $action, $controller)
    {
        $model = Region::model()->findByPk($id);
        //на тот случай, если что-то непонятно передано
        $this->setCookie('currentRegion', $id);
        $this->redirect($this->createUrl("$controller/$action", array('regionLatin' => $model->latin_name)));
    }

    public function actionAnalyticsAndNews()
    {
        $this->render('analytics_and_news');
    }

    public function actionStaticMap()
    {
        $map = new staticMapLite();
        print $map->showMap();
    }

    public function actionContacts()
    {
        $this->breadcrumbs = array(Yii::t('main', 'Контакты'));
        $model = Content::model()->findByAttributes(array('type' => Content::T_CONTACTS));
        $this->render('static', array('html' => $model->content));
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
        $this->render('static', array('html' => $model->content));
    }

    public function actionCommand()
    {
        $this->breadcrumbs = array(Yii::t('main', 'Команда'));
        $model = Content::model()->findByAttributes(array('type' => Content::T_COMMAND));
        $this->render('static', array('html' => $model->content));
    }

    public function actionSearch($search)
    {
        if (!empty($search)) {
            $this->globalSearch = $search;
            $this->breadcrumbs = array('Поиск');
            $filter = new SiteSearch();
            $filter->search = $search;

            if (mb_strlen($search) > 2) {
                $data = $filter->apply();
                try {
                    $pages = $this->applyLimit($data, null, 10);
                } catch (Exception $e) {
                    $data = array();
                    $pages = new CPagination();
                }
            } else {
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
            } elseif ($item['object_name'] == 'law') {
                $data[$key]['model'] = Law::model()->findByPk($data[$key]['id']);
            } elseif ($item['object_name'] == 'library') {
                $data[$key]['model'] = Library::model()->findByPk($data[$key]['id']);
            }
        }
    }

    public function actionParseUsers()
    {
        $failed = array();
        foreach (Users::model()->findAll(array('condition' => '`group` = "user"')) as $model) {
            $user = new User();
            $user->login = $model->login;
            $user->password = "12345";
            $user->password = "12345";
            $user->email = $model->email;
            $user->type = 'initiator';
            $user->name = $model->fio;
            $user->phone = $model->phone;
            $user->fax = $model->fax;
            $user->is_active = 1;
            $user->company_name = $model->company;
            if (!$user->save()) {
                $failed[] = $model->id;
            }
        }
        Makeup::dump($failed, true);
    }

    public function actionChangeLang($langId)
    {
        $this->setCookie('languageId', $langId);
        if (!Yii::app()->user->isGuest) {
            $this->user->language_id = $langId;
            $this->user->save();
        }
        $this->redirect(Yii::app()->user->returnUrl);
    }

    public function actionFilterProject()
    {
        $this->blockJquery();
        $filter = new RegionFilter();
        $filter->placeList = isset($_POST['placeList']) ? array($_POST['placeList']) : null;
        $filter->setProjectTypeById(Candy::get($_POST['projectType'], null));
        $criteria = $filter->getCriteria();
        if (Yii::app()->request->isAjaxRequest && isset($_POST)) {
            $models = Project::model()->findAll($criteria);
            $this->renderPartial('_map', array('models' => $models, 'filter' => $filter, 'type' => $_POST['projectType']));
            Yii::app()->end();
        } else {
            $query = array('RegionFilter' => get_object_vars($filter));

            $this->redirect($this->createUrl('project/index') . "?" . http_build_query($query));
        }

    }

    public function actionTest()
    {
        $this->render('test');
    }

    /**
     * Вернуть список городов для выпадающего ajax-списка
     * @param string $sort
     */
    public function actionRegionList($district = false)
    {
        define('DEFAULT_COLUMN', 4);
        $data = array();
        $regions = Region::model()->findAll(array('order' => 'name'));
        $columnCount = ceil(count($regions) / DEFAULT_COLUMN);
        $i = 0;
        $currentColumn = 1;
        if ($district) { //если нужно распихать еще и по округам
            $tempData = array();
            foreach ($regions as $model) {
                $tempData[$model->district_id][$model->id] = $model->name;
            }
            foreach($tempData as $districtId => $regionList){
                foreach($regionList as $key=>$name){
                    $i++;
                    $data[$currentColumn][$districtId][$key] = $name;
                    if ($i >= $columnCount && $currentColumn < DEFAULT_COLUMN) {
                        $i = 0;
                        $currentColumn++;
                    }
                }

            }
        } else { //просто разбиваем на четыре колонки и если больше заданного переносим в следующую колонку
            foreach ($regions as $model) {
                $i++;
                $data[$currentColumn][$model->id] = $model->name;
                if ($i >= $columnCount && $currentColumn < DEFAULT_COLUMN) {
                    $i = 0;
                    $currentColumn++;
                }
            }
        }
        $districtList = CHtml::listData(District::model()->findAll(),'id','name'); //для вывода
        $this->renderPartial('_regionList', array('data' => $data, 'district' => $district,'districtList'=>$districtList));
    }

    public function actionGetRegionJSON($term){
        $json = array();
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('name', $term, true);
        $models = Region::model()->findAll($criteria);
        foreach ($models as $model) {
            $json[] = array('label' => $model->name, 'value' => $model->id);
        }
        $this->renderJSON($json);
    }
}