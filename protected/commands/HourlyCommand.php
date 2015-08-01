<?php

class HourlyCommand extends CConsoleCommand
{
    public function run($args)
    {
        Yii::import('application.extensions.simpleHtml.*');
        require_once('simple_html_dom.php');
        $this->actionParseNews();
    }

    public function actionParseNews()
    {
        Media::$path = "../data/mediadb/";
        foreach(ParseNews::model()->findAll() as $parser){
            $log = new ParserLog();
            $log->parser_id = $parser->id;
            $log->datetime = date("Y-m-d H:i:s");
            $log->success = 0;
            $log->save();
            $html = file_get_html($parser->url);
            $parseFunction = "parse_{$parser->script_name}";
            $news = $this->$parseFunction($html);
            $parsed_count = 0;
            foreach ($news as $parseItem) {
                if (!News::model()->countByAttributes(array('name' => $parseItem['title']))) {
                    $createItem = new News();
                    if (isset($parseItem['image'])) {
                        $createItem->media_id = Media::uploadByUrl($parseItem['image']);
                    }
                    if (isset($parseItem['announce'])) {
                        $createItem->announce = $parseItem['announce'];
                    }
                    $createItem->name = $parseItem['title'];
                    $createItem->full_text = $parseItem['full_text'];
                    $createItem->tags = $parseItem['tags'];
                    $createItem->create_date = $parseItem['date'];
                    $createItem->region_id = $parser->region_id;
                    $createItem->is_parsed = 1;
                    $createItem->source_url = $parseItem['source'];
                    $createItem->parsed_date = $log->datetime;
                    if($createItem->save()){
                        $parsed_count++;
                    }
                }
            }
            $log->success = 1;
            $log->parsed_count = $parsed_count;
            $log->save();
        }
    }

    public function parse_mos_ru($html)
    {
        $news = $html->find('#news-slider',0);
        $i = 0;
        $today = date('d');
        $time = strtotime("-1 day");
        $yesterday = date("d", $time);
        $i = 0;
        $result = array();
        $aurl = array();
        foreach ($news->find('.panel') as $article){
            $articleDate = explode('-',trim($article->find('.panel__date',0)->datetime));
            //$articleDate = explode(' ',trim($article->find('.panel__date',0)->plaintext));
            //if ($today==$articleDate[2] or $yesterday==$articleDate[2]){
                $result[$i]['date'] = trim($article->find('.panel__date',0)->datetime);
                //$result[$i]['date'] = $articleDate[2].'.'.$this->getMonth($articleDate[1]).'.'.$articleDate[0];
                $result[$i]['title'] = trim($article->find('.panel__title',0)->plaintext);
                $result[$i]['source'] = 'http://www.mos.ru';
                $aurl[$i] = $article->find('.panel__title',0)->href;
                $i++;
            //}
        }

        $i = 0;
        if (count($aurl)>0)
        {
            foreach ($aurl as $url){
                $newsPage = file_get_html($url);
                $prefix = $newsPage->find('#newslink', 0) ? '#newslink' : '.b-inner';

                $result[$i]['full_text'] = '';
                foreach ($newsPage->find("$prefix p") as $pTag){
                    $text = trim(str_replace('&nbsp;',' ',$pTag->innertext()));
                    if(!empty($text)){
                        $result[$i]['full_text'] .= "<p>" . $text . "</p>";
                    }
                }

                $tags = array();
                foreach ($newsPage->find("$prefix .press-tree-tags a") as $aTag){
                    $tags[] = $aTag->innertext();
                }
                $result[$i]['tags'] = implode(', ', $tags);
                if($newsPage->find("$prefix .m__themes-fancybox",0)){
                    $result[$i]['image'] = $newsPage->find("$prefix .m__themes-fancybox",0)->href;
                }

                $newsPage->clear();
                unset($newsPage);
                $i++;
            }
        }
        return $result;
    }

    public function parse_gov_spb_ru($html)
    {
        $news = $html->find('.article',0);
        $i = 0;
        $today = date('d');
        $time = strtotime("-1 day");
        $yesterday = date("d", $time);
        $i = 0;
        $result = array();
        $aurl = array();
        foreach ($news->find('.nwItem') as $article){
            $articleDate = explode(' ',trim($article->find('.time',0)->plaintext));
            //if ($today==$articleDate[0] or $yesterday==$articleDate[0]){
                $result[$i]['date'] = $articleDate[2].'-'.$this->getMonth($articleDate[1]).'-'.$articleDate[0];
                $result[$i]['title'] = strip_tags(trim($article->find('.name a',0)->plaintext));
                $result[$i]['source'] = "http://gov.spb.ru";
                $aurl[$i] = "http://gov.spb.ru" . $article->find('.name a',0)->href;
                $i++;
            //}
        }

        $i = 0;
        if (count($aurl)>0)
        {
            foreach ($aurl as $url){
                $newsPage = file_get_html($url);
                $prefix = '.crm';

                $result[$i]['full_text'] = '';
                foreach ($newsPage->find("$prefix p") as $pTag){
                    $text = trim(str_replace('&nbsp;',' ',$pTag->innertext()));
                    if(!empty($text)){
                        $result[$i]['full_text'] .= "<p>" . $text . "</p>";
                    }
                }

                $result[$i]['tags'] = '';
                if($newsPage->find("$prefix #gallery .bigimage img",0)){
                    $result[$i]['image'] = "http://gov.spb.ru" . $newsPage->find("$prefix #gallery .bigimage img",0)->getAttribute('data-url');
                }

                $newsPage->clear();
                unset($newsPage);
                $i++;
            }
        }
        return $result;
    }

    public function parse_bryanskobl_ru($html)
    {
        $news = $html->find('.content',0);
        $i = 0;
        $today = date('d');
        $time = strtotime("-1 day");
        $yesterday = date("d", $time);
        $i = 0;
        $result = array();
        $aurl = array();
        foreach ($news->find('.omega') as $article){
            $articleDate = explode(' ',trim(str_replace('&nbsp;',' ',$article->find('.news-date',0)->plaintext)));
            //if ($today==$articleDate[0] or $yesterday==$articleDate[0]){
                $result[$i]['date'] = $articleDate[2].'-'.$this->getMonth($articleDate[1]).'-'.$articleDate[0];
                $result[$i]['title'] = $this->clearHtml($article->find('.news-header-item a',0)->plaintext);
                $result[$i]['source'] = "http://www.bryanskobl.ru";
                $aurl[$i] = "http://www.bryanskobl.ru" . $article->find('.news-header-item a',0)->href;
                $i++;
            //}
        }

        $i = 0;
        if (count($aurl)>0)
        {
            foreach ($aurl as $url){
                $newsPage = file_get_html($url);

                $result[$i]['full_text'] = '';
                foreach ($newsPage->find(".news-content p") as $pTag){
                    $text = trim(str_replace('&nbsp;',' ',$pTag->innertext()));
                    if(!empty($text)){
                        $result[$i]['full_text'] .= "<p>" . $text . "</p>";
                    }
                }

                $tags = array();
                foreach ($newsPage->find(".news-keywords a") as $aTag){
                    $tags[] = $aTag->innertext();
                }
                $result[$i]['tags'] = implode(', ', $tags);

                if($newsPage->find(".content .pirobox_gall",0)){
                    $result[$i]['image'] = "http://www.bryanskobl.ru" . $newsPage->find(".content .pirobox_gall",0)->href;
                }

                $newsPage->clear();
                unset($newsPage);
                $i++;
            }
        }
        return $result;
    }

    public function parse_belregion_ru($html)
    {
        $news = $html->find('.news-list',0);
        $i = 0;
        $today = date('d');
        $time = strtotime("-1 day");
        $yesterday = date("d", $time);
        $i = 0;
        $result = array();
        $aurl = array();
        foreach ($news->find('.news-item') as $article){
            $articleDate = explode(' ',trim(str_replace('&nbsp;',' ',$article->find('.news-date-time',0)->plaintext)));
            //if ($today==$articleDate[0] or $yesterday==$articleDate[0]){
                $result[$i]['date'] = $articleDate[2].'-'.$this->getMonth($articleDate[1]).'-'.$articleDate[0];
                $result[$i]['title'] = $this->clearHtml($article->find('.news-text a',0)->plaintext);
                $result[$i]['source'] = "http://www.belregion.ru";
                $result[$i]['image'] = "http://www.belregion.ru" . $article->find(".preview_picture",0)->src;
                $aurl[$i] = "http://www.belregion.ru" . $article->find('.news-text a',0)->href;
                $i++;
            //}
        }

        $i = 0;
        if (count($aurl)>0)
        {
            foreach ($aurl as $url){
                $newsPage = file_get_html($url);

                $result[$i]['full_text'] = '';
                foreach ($newsPage->find(".news-detail p") as $pTag){
                    $text = trim(str_replace('&nbsp;',' ',$pTag->innertext()));
                    if(!empty($text)){
                        $result[$i]['full_text'] .= "<p>" . $text . "</p>";
                    }
                }

                $result[$i]['tags'] = '';

                /*if($newsPage->find(".news-detail .detail_picture",0)){
                    $result[$i]['image'] = "http://www.belregion.ru" . $newsPage->find(".news-detail .detail_picture",0)->src;
                }*/

                $newsPage->clear();
                unset($newsPage);
                $i++;
            }
        }
        return $result;
    }

    public function parse_avo_ru($html)
    {
        $news = $html->find('.blog_homepage',0);
        $i = 0;
        $today = date('d');
        $time = strtotime("-1 day");
        $yesterday = date("d", $time);
        $i = 0;
        $result = array();
        $aurl = array();
        foreach ($news->find('.article_column') as $article){
            $articleDate = explode(' ',trim(str_replace('&nbsp;',' ',$article->find('.date',0)->plaintext)));
            //if ($today==$articleDate[0] or $yesterday==$articleDate[0]){
            $result[$i]['image'] = "http://www.avo.ru" . $article->find("img",0)->src;
            $result[$i]['source'] = "http://www.avo.ru";
            $result[$i]['announce'] = $this->clearHtml($article->find("p",0)->plaintext);
            $aurl[$i] = "http://www.avo.ru" . $article->find('a',0)->href;
            $i++;
            //}
        }

        $i = 0;
        if (count($aurl)>0)
        {
            foreach ($aurl as $url){
                $newsPage = file_get_html($url);
                $result[$i]['title'] = $this->clearHtml($newsPage->find('#page .contentheading',0)->plaintext);
                $dateExp = $this->clearHtml(mb_substr($newsPage->find('#page .createdate',0)->plaintext, -18));
                $dateExp = explode(' ', $dateExp);
                $dateExp = explode('.',$dateExp[0]);
                $result[$i]['date'] = $dateExp[2].'-'.$dateExp[1].'-'.$dateExp[0];

                $result[$i]['full_text'] = trim($newsPage->find('#page',0)->innertext());
                $result[$i]['tags'] = '';

                $newsPage->clear();
                unset($newsPage);
                $i++;
            }
        }
        return $result;
    }


    function getMonth($month) {
        $aMonth = array(
            'января'=>'01',
            'Января'=>'01',
            'февраля'=>'02',
            'Февраля'=>'02',
            'марта'=>'03',
            'Марта'=>'03',
            'апреля'=>'04',
            'Апреля'=>'04',
            'мая'=>'05',
            'Мая'=>'05',
            'июня'=>'06',
            'Июня'=>'06',
            'июля'=>'07',
            'Июля'=>'07',
            'августа'=>'08',
            'Августа'=>'08',
            'сентября'=>'09',
            'Сентября'=>'09',
            'ноября'=>'10',
            'Ноября'=>'10',
            'октября'=>'11',
            'Октября'=>'11',
            'декабря'=>'12',
            'Декабря'=>'12');
        return $aMonth["$month"];
    }

    function clearHtml($text){
        return strip_tags(trim(str_replace(array('&laquo;', '&nbsp;', '&raquo;'),' ',$text)));
    }
}