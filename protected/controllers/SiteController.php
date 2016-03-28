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
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    public function actionLoad($val = 0) { //import function.

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
foreach(User::model()->findAll() as $user){
    $user->company_name = str_replace('\"','"',$user->company_name);
    $user->save();

}
die;
        foreach (Investors::model()->findAll() as $investor) {
            $investor->email = trim($investor->email);
            if(empty($investor->email)){
                $investor->email = null;
                $user = new User();
            } else {
                if(!$user = User::model()->findByAttributes(array('email' => $investor->email))){
                    $user = new User();
                }
            }
            if($user->isNewRecord){
                echo "NEW USER ID {$investor->id}";
                continue;
            }
            $user->type = 'investor';
            $user->is_imported = 2;
            $user->is_active = 1;
            $user->company_name = str_replace('\"','"',$investor->ruName);
            $user->company_address = $investor->address;
            $user->name = $investor->contact;
            $user->post = $investor->post;
            $user->login = $investor->email;
            $user->company_site = !empty($investor->web) ? $investor->web : null;
            $user->password = $this->randomPassword();
            $user->company_phone = str_replace("+", "", $investor->phone);
            $user->fax = $investor->fax;
            $user->email = $user->company_email =$investor->email;
           // $a = htmlentities($investor->shortDesc);
            //$b = html_entity_decode($a);
            //$user->company_description = str_replace('\r\n','',preg_replace("/&#?[a-z0-9]{2,8};/i","",filter_var($b, FILTER_SANITIZE_STRING)));

            /*
                       if(!empty($investor->country)){
                           if($country = Country::model()->findByAttributes(array('name' => $investor->country))){
                               $user->investor_country_id = $country->id;
                           } else {
                               $country = new Country();
                               $country->name = $investor->country;
                               if($country->save()){
                                   $user->investor_country_id = $country->id;
                               }
                           }
                       }

                       if(!empty($investor->type)){
                           $type = Project::getObjectTypeDrop();
                           $getDrop = array_search($investor->type, $type);
                           if ($getDrop !== false) {
                               $user->investor_type = $getDrop;
                           }
                       }

                       $user->investor_finance_amount = $investor->sum * 1000000;

                       if(!empty($investor->industry)){
                           $explode = explode(',', $investor->industry);
                           if(isset($explode[0])){
                               $type = Project::getIndustryTypeDrop();
                               $getDrop = array_search(trim($explode[0]), $type);
                               if ($getDrop !== false) {
                                   $user->investor_industry = $getDrop;
                               }
                           }
                       }

                      if(!empty($investor->photo)){
                           $user->logo_id = Media::uploadByUrl("http://www.iip.ru/" . str_replace("../", "", $investor->photo));
                       }*/
            if(!$user->save()){
                echo "CANT SAVE {$investor->id}<BR>";
                var_dump($user->getErrors());
                echo "<hr>";
            }
        }

        die;
        foreach (InvestmentProject::model()->with('project')->findAll(array('offset' => $val * 500, 'limit' => 500)) as $project) {
            $project->project->industry_type = $project->company_area;
            if(!$project->project->save()){
                var_dump($project->project->errors);
            }
        }die;
        foreach (ImportInvestmentProjects::model()->findAllByAttributes(array('moderated' => 0)) as $project) {
            if ($projectNew = Project::model()->findByAttributes(array('old_id' => $project->id))) {
                $projectNew->status = 'moderation';
                if (!$projectNew->save()) {
                    var_dump($projectNew->errors);
                }
            }
        }
        die;
        $regions = Region::model()->findAll(array('index' => 'id'));

        foreach (Project::model()->findAllByAttributes(array('is_imported' => 1, 'lon' => 0, 'lat' =>0)) as $project) {
            $project->lon = $regions[$project->region_id]->lon;
            $project->lat = $regions[$project->region_id]->lat;
            if(!$project->save()){
                var_dump($project->errors);
            }
        }
        die;
        foreach (Project::model()->findAllByAttributes(array('investment_sum' => 4294967295)) as $project) {
            $old = ImportInvestmentProjects::model()->findByPk($project->old_id);
            $project->investment_sum = (int)$old->sumInvestment * 1000000;
            if(!$project->save()){
                var_dump($project->errors);
            }
        }die;
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

    /**
     * @var $data
     * @param null $search
     */
    public function actionSearch($search = null,$sort = null)
    {
        if (!empty($search)) {
            $this->globalSearch = $search;
            $this->breadcrumbs = array('Результаты поиска');
            $filter = new SiteSearch();
            $filter->sort = $sort;
            $filter->search = $search;

            if (mb_strlen($search) > 2) {
                $data = $filter->apply();
                $count = count($data->queryAll());
                try {
                    $pages = $this->applyLimit($data, null, 10);
                } catch (Exception $e) {
                    $data = array();
                    $pages = new CPagination();
                }
            } else {
                $data = array();
                $pages = new CPagination();
                $count = 0;
            }

            $this->addAdvancedData($data);
            $this->render('search', array('filter' => $filter, 'data' => $data, 'pages' => $pages,'count'=>$count,'search'=>$search,'sort'=>$sort));
        } else {
            $this->redirect($this->createUrl('site/index'));
        }
    }

    protected function getSearchUrl($item){
        if($item['object_name'] == 'law' || $item['object_name'] == 'library'){
            return $item['model']->media->makeWebPath();
        }
        else{
            return $item['model']->createUrl();
        }
    }

    protected  function getSearchImage($item){
        if(in_array($item['object_name'],array('region_news','global_news','analytics','event','ProfOpinion')) && isset($item['model']->media)){
            return $item['model']->media;
        }
        elseif(in_array($item['object_name'],array('project')) && isset($item['model']->logo)){
            return $item['model']->logo;
        }

        return null;
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