<?php

class SiteController extends BaseController
{
    function getCoordinates($address){

        $address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern

        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";

        $response = file_get_contents($url);

        $json = json_decode($response,TRUE); //generate array object from the response from the web

        if(!isset($json['results'][0])){
            return array( 0 => 0, 1 => 0);
        }
        return array(0 => $json['results'][0]['geometry']['location']['lat'],
            1 => $json['results'][0]['geometry']['location']['lng']
          );
    }


    public function actionLoad($val = 0){ //import function.

        /*User::model()->deleteAll('is_imported = 1');
        foreach(ImportUsers::model()->findAll() as $user){
            $new = new User();
            $new->is_imported = 1;
            $new->old_id = $user->id;

            $new->name = $user->fio;
            $new->type = 'initiator';
            $new->login = $user->login;
            $new->password = $user->pass;
            $new->email = $user->email;
            $new->company_name = $user->company;
            $new->phone = str_replace("+", "", $user->phone);
            $new->fax = $user->fax;
            $new->is_active = 1;
            $new->create_date = Candy::currentDate();
            if(!$new->save()){
                var_dump($new->errors);
                echo "error save {$user->id} : {$user->fio} <br>";
            }
        }*/
        //Project::model()->deleteAll('is_imported = 1');
        foreach (ImportInvestmentProjects::model()->findAll(array('offset' => $val * 50, 'limit' => 50)) as $project) {

            $new = new Project();

            $new->is_imported = 1;
            $new->old_id = $project->id;

            $user = User::model()->findByAttributes(array('old_id' => $project->idAuthor));
            $user_id = !$user ? 66 : $user->id; //admin user

                $new->user_id = $user_id;
                if($region = Region::model()->findByAttributes(array('name' =>$project->place))){
                    $new->region_id = $region->id;
                }
                $new->status = 'approved';
                $new->create_date = "2015-01-01 00:00:00";
                if(!empty($project->photo)){
                    $new->logo_id = Media::uploadByUrl("http://www.iip.ru/" . str_replace("../", "", $project->photo));
                }
                //$new->file_id = $project->id;
                $new->type = Project::T_INVEST;
                $new->name = $project->ruName;
                $new->latin_name = $project->engName;
                //$new->object_type = $project->id;
                $new->investment_sum = (int)$project->sumInvestment;
                $new->period = $project->finSrok;
                $new->profit_norm = $project->finNormaDohod;
                $new->profit_clear = $project->finCleanDohod;
                //$new->complete = $project->id;
                //$new->industry_type = $project->id;
                //$new->url = $project->id;
                //$new->contact_partner = $project->id;
                $new->contact_address = $project->cAddress;
                $new->contact_face = $project->contact;
                $new->contact_role = $project->post;
                $new->contact_phone =  str_replace("+", "", $project->phone);
                $new->contact_fax = $project->fax;
                $new->contact_email = $project->email;

                $coords = $this->getCoordinates(empty($project->address) ? $project->companyAddress : $project->address);
                $new->lat = $coords[0];
                $new->lon = $coords[1];
                if($new->save()){
                    $newI = new InvestmentProject();
                    $newI->project_id = $new->id;
                    //$newI->finance = $project->id;
                    $desc = strip_tags ($project->shortDesc);
                    if(mb_strlen($desc) > 500){
                        $newI->short_description = mb_strcut($desc, 0 , 500);
                        $newI->full_description = $project->shortDesc;
                    } else {
                        $newI->short_description = $desc;
                    }
                    $newI->address = empty($project->address) ? $project->companyAddress : $project->address;
                    //$newI->market_size = $project->id;
                    //$newI->investment_form = $project->id;
                    //$newI->investment_direction = $project->id;
                    //$newI->financing_terms = $project->id;
                    $newI->products = $project->products;
                    $newI->max_products = $project->maxProducts;
                    $newI->no_finRevenue = $project->finRevenue;
                    $newI->no_finCleanRevenue = $project->finCleanRevenue;
                    $newI->profit = (int)$project->finRentabl;
                    $newI->company_legal = $project->companyAddress;
                    $newI->company_description = $project->companyDesc;

                    $industry = Project::getIndustryTypeDrop();
                    $getIndustryTypeDrop = array_search($project->industry, $industry);
                    if ($getIndustryTypeDrop !== false) {
                        $newI->company_area = $getIndustryTypeDrop;
                    }

                    $newI->company_name = $project->companyName;
                    $newI->project_price = $project->polnayaSum;
                    $newI->term_finance = $project->termsFinance;
                    //$newI->stage_project = $project->id;
                    $newI->capital_dev = $project->kapConstruction;
                    //$newI->equipment = $project->id;
                    $newI->guarantee = $project->finGarantii;
                    //$newI->full_description = $project->id;
                    //$newI->finance_plan = $project->id;
                    if(!$newI->save()){
                        var_dump($newI->errors);
                        echo "CANT CREATE INVEST PROJECT FOR {$new->id} | {$project->id} <BR>";
                    }
                } else {
                    var_dump($new->errors);
                    echo "CANT CREATE PROJECT {$project->id} <BR>";
                }
           /* } else {
                echo "NO USER FOR PROJECT {$project->id} <BR>";
            }*/

        }


        die;

        /*$types = ReferenceRegionCompanyType::model()->findAll(array('index' => 'name'));

        foreach (RegionCompany::model()->findAll() as $model) {
            if(!$exist = ReferenceRegionCompany::model()->findByAttributes(array('name' => $model->name))){
                $exist = new ReferenceRegionCompany();
                $exist->name = $model->name;
                $exist->media_id = $model->media_id;
                $exist->url = $model->url;
                $exist->type_id = $types[$model->type]->id;
                $exist->save();
            }
            $mm = new Region2Company();
            $mm->region_id = $model->region_id;
            $mm->company_id = $exist->id;
            $mm->type = $model->type;
            $mm->save();
        }*/
        /*foreach(Project::getFinanceTypeDrop() as $item){
            $model = new ReferenceFinanceType();
            $model->name = $item;
            $model->save();
        }*/
            // Open an IMAP stream to our mailbox
            $current_mailbox = array(
                'mailbox' => '{imap.yandex.ru:993/imap/ssl}INBOX',
                'username' => 'iip-support@yandex.ru',
                'password' => 'support2015',
            );
            $stream = @imap_open($current_mailbox['mailbox'], $current_mailbox['username'], $current_mailbox['password']);

            if (!$stream) {
                echo "Could not connect to. Error: " . imap_last_error();
            } else {
                $date = new DateTime();

                // Get our messages from the last week
                $emails = imap_search($stream, 'SINCE '. date('d-M-Y',strtotime("-1 day")));

                // Instead of searching for this week's messages, you could search
                // for all the messages in your inbox using: $emails = imap_search($stream, 'ALL');
                if (!count($emails) || empty($emails)){
                    echo "<p>No e-mails found.</p>";
                } else {
                    // If we've got some email IDs, sort them from new to old and show them
                    sort($emails);

                    foreach($emails as $email_id){

                        // Fetch the email's overview and show subject, from and date.
                        $overview = imap_fetch_overview($stream,$email_id,0);
                        //Makeup::dump($overview);
                        if(isset($overview[0]->date)){
                            $date = new DateTime($overview[0]->date);
                            Makeup::dump($date->format('Y-m-d H:i:s'));
                        }
                        $message = imap_fetchbody($stream,$email_id,2);
                        $structure = imap_fetchstructure($stream, $email_id, FT_UID);
                       Makeup::dump($structure);
                        $body = imap_fetchbody($stream, imap_msgno($stream, $email_id), "1.1");
                        if(empty($body)){
                            $body = imap_fetchbody($stream, imap_msgno($stream, $email_id), "1");
                        }

                        $part = isset($structure->parts) ? $structure->parts[0] : $structure;
                        var_dump($part->encoding);
                        if($part->encoding == 0) {
                            $message = imap_8bit($body);
                        } else {
                            $message = imap_base64($body);
                        }
                        if(isset($part->parameters) && is_array($part->parameters)){
                            foreach($part->parameters as $param){
                                if($param->attribute == 'charset'){
                                    if($param->value != 'utf-8'){
                                        $message = iconv($param->value, 'utf-8', $message);
                                        break;
                                    }
                                }
                            }
                        }
                        Makeup::dump($message);
                        preg_match('/.*<(.*@.*\..*)>.*/', $overview[0]->from,$res);
                         Makeup::dump($res[1]);
                        // Makeup::dump($structure);
                       //  Makeup::dump($body);
                        echo '<hr>';
                    }
                }

                // Close our imap stream.
                imap_close($stream);
            }
    }
    public function actionIndex()
    {
        $this->layout = 'mainIndex';
        $this->interface['slim_menu'] = false;

        $sql = Yii::app()->db->createCommand()
            ->select('("news") as object, id, create_date')
            ->from("News")
            ->where('is_active = 1 AND on_main = 1 AND (region_id = :region_id OR region_id is null)', array(':region_id' => $this->getCurrentRegion()));
        $sqlTmp = Yii::app()->db->createCommand()
            ->select('("analytics") as object, id, create_date')
            ->from("Analytics")
            ->where('is_active = 1 AND on_main = 1');
        $sql = $sql->union($sqlTmp->getText());
        $sql->limit = 9;
        $sql->order('create_date DESC');

        $articles = $sql->queryAll();

        //news load
        /*$mainNewsCriteria = new CDbCriteria();
        $mainNewsCriteria->addColumnCondition(array('is_active' => 1, 'on_main' => 1, 'is_main' => 1));
        $mainNewsCriteria->addCondition('region_id = :region_id OR region_id is null');
        $mainNewsCriteria->params += array(':region_id' => $this->getCurrentRegion());
        $mainNewsCriteria->order = 'create_date DESC';
        $mainNews = News::model()->find($mainNewsCriteria);

        $newsCriteria = new CDbCriteria();
        $newsCriteria->addColumnCondition(array('is_active' => 1, 'on_main' => 1));
        $newsCriteria->addCondition('region_id = :region_id OR region_id is null');
        $newsCriteria->params += array(':region_id' => $this->getCurrentRegion());
        if ($mainNews) {
            $newsCriteria->addCondition(array("id != {$mainNews->id}"));
        }
        $newsCriteria->addCondition("id < 373");

        $newsCriteria->order = 'create_date DESC';
        $newsCriteria->limit = 4;
        $news = News::model()->findAll($newsCriteria);

        //analytics load
        $mainAnalyticsCriteria = new CDbCriteria();
        $mainAnalyticsCriteria->addColumnCondition(array('is_active' => 1, 'on_main' => 1, 'is_main' => 1));
        $mainAnalyticsCriteria->order = 'create_date DESC';
        $mainAnalyticsCriteria->addCondition("id < 40");
        $mainAnalytics = Analytics::model()->find($mainAnalyticsCriteria);

        $analyticsCriteria = new CDbCriteria();
        $analyticsCriteria->addColumnCondition(array('is_active' => 1, 'on_main' => 1));
        if ($mainAnalytics) {
            $analyticsCriteria->addCondition(array("id != {$mainAnalytics->id}"));
        }
        $analyticsCriteria->addCondition("id < 50");

        $analyticsCriteria->order = 'create_date DESC';
        $analyticsCriteria->limit = 3;
        $analytics = Analytics::model()->findAll($analyticsCriteria);*/

        $this->render('index', array(
            'articles' => $articles
            /*'news' => $news, 'mainNews' => $mainNews,
            'analytics' => $analytics, 'mainAnalytics' => $mainAnalytics,*/
        ));
    }

    public function actionMore()
    {
        $this->layout = false;
        if (Yii::app()->request->isAjaxRequest) {
            $data = $_REQUEST;
            $excluded = array(
                'news' => array(0),
                'analytics' => array(0)
            );
            if ($data['excluded']) {
                $json = json_decode($data['excluded']);
                if (isset($json->news) && is_array($json->news)) {
                    $excluded['news'] += $json->news;
                }
                if (isset($json->analytics) && is_array($json->analytics)) {
                    $excluded['analytics'] += $json->analytics;
                }
            }

            $sql = Yii::app()->db->createCommand()
                ->select('("news") as object, id, create_date')
                ->from("News")
                ->where('is_active = 1 AND on_main = 1 AND (region_id = :region_id OR region_id is null) AND id NOT IN (' . implode(',', $excluded['news']) . ')', array(':region_id' => $this->getCurrentRegion()));
            $sqlTmp = Yii::app()->db->createCommand()
                ->select('("analytics") as object, id, create_date')
                ->from("Analytics")
                ->where('is_active = 1 AND on_main = 1 AND id NOT IN (' . implode(',', $excluded['analytics']) . ')');
            $sql = $sql->union($sqlTmp->getText());
            if (!empty($data['page'])) {
                $sql->offset = $data['page'] * 3;
            }
            $sql->limit = 3;
            $sql->order('create_date DESC');
            $articles = $sql->queryAll();
            $this->render('_ajaxArticle', array('articles' => $articles));
        }
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
        Candy::cleanBuffer();
        print $map->showMap();
    }

    public function actionContacts()
    {
        $this->breadcrumbs = array(Yii::t('main', 'Контакты'));
        $model = Content::model()->findByAttributes(array('system_type' => 'contacts'));
        $this->render('contacts', array('content' => $model));
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

    public function actionTeam()
    {
        $this->breadcrumbs = array(Yii::t('main', 'Команда'));
        $model = Content::model()->findByAttributes(array('system_type' => 'team'));
        $this->render('team', array('content' => $model));
    }

    public function actionAboutus()
    {
        $this->breadcrumbs = array(Yii::t('main', 'О портале'));
        $model = Content::model()->findByAttributes(array('system_type' => 'about'));
        $pages = $model->content2Object;
        $this->render('page', array('content' => $model, 'pages' => $pages));
    }

    public function actionContent($page)
    {
        $content = Content::model()->findByAttributes(array('system_type' => 'about'));
        $pages = $content->content2Object;

        if(!$model = Content::model()->findByAttributes(array('url' => $page))){
            throw new CHttpException(404, Yii::t('main', 'Страница не найдена'));
        }
        $this->breadcrumbs = array($model->name);
        $this->render('page', array('content' => $model, 'pages' => $pages));
    }

    public function actionSearch($search)
    {
        $this->layout = 'main_old';

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
        Candy::cleanBuffer();
        define('DEFAULT_COLUMN', 4);
        $data = array();
        $regions = Region::model()->findAll(array('order' => 'name','condition'=>'is_single=0'));
        $singleRegions = CHtml::listData(Region::model()->findAll(array('order' => 'name','condition'=>'is_single=1')),'id','name');
        $columnCount = ceil(count($regions) / DEFAULT_COLUMN);
        $i = 0;
        $currentColumn = 1;
        if ($district) { //если нужно распихать еще и по округам
            $tempData = array();
            foreach ($regions as $model) {
                $tempData[$model->district_id][$model->id] = $model->name;
            }

        } else { //просто разбиваем на четыре колонки и если больше заданного переносим в следующую колонку
            $tempData = array_fill_keys(Candy::$alphabet,array());
            foreach($regions as $model){
                $firstChar = mb_strtolower(mb_substr($model->name,0,1));
                if(array_key_exists($firstChar,$tempData)){
                    $tempData[$firstChar][$model->id] = $model->name;
                }
            }
        }

        if(count($singleRegions)){
            $data[$currentColumn][0] = $singleRegions;
        }
        foreach ($tempData as $districtId => $regionList) {
            foreach ($regionList as $key => $name) {
                $i++;
                $data[$currentColumn][$districtId][$key] = $name;
                if ($i >= $columnCount && $currentColumn < DEFAULT_COLUMN) {
                    $i = 0;
                    $currentColumn++;
                }
            }

        }
        $districtList = CHtml::listData(District::model()->findAll(), 'id', 'name'); //для вывода
        $this->renderPartial('_regionList', array('data' => $data, 'district' => $district, 'districtList' => $districtList));
    }

    public function actionGetRegionJSON($term)
    {
        $json = array();
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('name', $term, true);
        $models = Region::model()->findAll($criteria);
        foreach ($models as $model) {
            $json[] = array('label' => $model->name, 'value' => $model->id);
        }
        $this->renderJSON($json);
    }

    public function actionError()
    {
        $error = Yii::app()->errorHandler->error;
        if ($error) {
            $this->render('error', array('code' => $error['code'], 'message' => $error['message']));
        }

    }
}