       <div class="diagram">
				<?
                    define ('DIRSEP', DIRECTORY_SEPARATOR);
                    $cat_path = /*"../informer/";*/realpath(dirname(__FILE__) . DIRSEP);
					$file = "$cat_path/categories.txt";//файл для хранения текущих котировок
					$period = 7200; //минимальное время между обновлениями котировок
					$flag = 0;//флаг необходимости обновить котировки на сервере
					$flagfile = "$cat_path/parseflag.txt";
					$first = file_get_contents("$flagfile");
                    $w = fopen($flagfile,"w");
					if (($first+$period) < time()) {
						$flag = 1; 
						fputs($w,time());
					}
					else fputs($w,"$first");
					fclose($w);
					//Если флаг просрочен обновляем все котировки и добавляем новое значение в csv архив
                    $graph_name = array();
					if ($flag) {
						require_once "$cat_path/fileadd.php";//функция модификации csv файлов раз в день
						include_once "$cat_path/simple_html_dom.php";//Класс для парсинга
                        //Парсим котировки в массив
//-----------------------парсинг ЦБ РФ----------------------------
                        // Получаем текущие курсы валют в rss-формате с сайта www.cbr.ru
                        $date = date("d/m/Y");
                        // Формируем ссылку
                        $link = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=$date";
                        // Загружаем HTML-страницу
                        $fd = fopen($link, "r");
                        $content="";
                        if ($fd)  {
                            // Чтение содержимого файла в переменную
                            while (!feof ($fd)) $content .= fgets($fd, 4096);
                            fclose ($fd);
                        }
                        // Разбираем содержимое, при помощи регулярных выражений
                        $pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i";
                        preg_match_all($pattern, $content, $out, PREG_SET_ORDER);
                        $curData = array();
                        foreach($out as $cur)
                        {
                            if($cur[2] == 840) $curData['usd'] = str_replace(",",".",$cur[4]);
                            if($cur[2] == 978) $curData['eur'] = str_replace(",",".",$cur[4]);
                            if($cur[2] == 756) $curData['chf'] = str_replace(",",".",$cur[4]);
                            if($cur[2] == 392) $curData['jpy'] = str_replace(",",".",$cur[4]);
                        }
                        $name = array(
                            'usd' => 'USD',
                            'eur' => 'EUR',
                            'chf' => 'CHF',
                            'jpy' => 'JPY'
                        );

                        foreach($name as $key => $row) {
                            if(!isset($curData[$key])){
                                continue;
                            }
                            $value = (float)$curData[$key];
                            $yearday = $yeardelta = $day_complete = $first_iter = $daydelta = 0;
                            if (file_exists($cat_path.'/data/'.$key.'.csv')) {
                                $handle = fopen($cat_path.'/data/'.$key.'.csv', 'r');
                                while (!feof($handle)) {
                                    $string = fgets($handle, 10240);
                                    $check_date = explode(',', $string);
                                    if(trim($check_date[0]) != '' && trim($check_date[1]) != '') {
                                        if($first_iter == 0) {
                                            $first_date = explode('-', $check_date[0]);
                                            //echo $table_name[$key].': '.$first_date; die();
                                            $first_iter = 1;
                                        }
                                        $date1 = mktime(0,0,0,$first_date[1],$first_date[2],$first_date[0]);
                                        $date2 = explode('-',$check_date[0]);
                                        $date2 = mktime(0,0,0,$date2[1],$date2[2],$date2[0]);
                                        $days = $date1-$date2;
                                        $days = $days/86400;
                                        if ($days >= 1 && $day_complete == 0) {
                                            $daydelta = $value*100/$check_date[1]-100;
                                            $day_complete = 1;
                                        }
                                        if ($days >= 364) {
                                            $yeardelta = $value*100/$check_date[1]-100;
                                            break;
                                        }
                                    }
                                }
                                fclose ($handle);
                            }
                            $all['currencies']['cbrf'][$name[$key]]['prop'] = $graph_name[] = $key;
                            $all['currencies']['cbrf'][$name[$key]]['date'] = date('d').'/'.date('m');
                            $all['currencies']['cbrf'][$name[$key]]['value'] = number_format(str_replace(' ', '', $value),2, '.', '');
                            $all['currencies']['cbrf'][$name[$key]]['daydelta'] = number_format(str_replace(' ', '', $daydelta),2, '.', '');
                            $all['currencies']['cbrf'][$name[$key]]['yeardelta'] = number_format(str_replace(' ', '', $yeardelta),2, '.', '');
                            addstr($cat_path.'/data/'.$key.'.csv', $cat_path.'/data/'.$key.'_tmp.csv', date('Y-m-d'), $value); //Добавляем данные в csv хранилище
                        }
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_URL, 'http://quote.rbc.ru/commodities/');
                        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727)");
                        curl_setopt($ch, CURLOPT_REFERER, "http://google.com");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_ENCODING, "");
                        $tmp_html = curl_exec($ch);
                        curl_close($ch);
                        file_put_contents($cat_path .'/tmp_parser.txt',$tmp_html);
                        $html = file_get_contents($cat_path.'/tmp_parser.txt');
                        $html = iconv("UTF-8", "CP1251", $html);
                        if (!empty($html)) {
                            $name = array(
                                'br1' => 'Brent Crude Oil ICE',
                                'light' => 'WTI Crude Oil NYMEX',
                                'golds' => iconv("UTF-8", "CP1251", "Золото NYMEX"),
                                'silv' =>  iconv("UTF-8", "CP1251", "Серебро NYMEX"),
                                'plat' => iconv("UTF-8", "CP1251", "Платина NYMEX"),
                                'copper' => iconv("UTF-8", "CP1251", "Медь LME"),
                                'pall' => iconv("UTF-8", "CP1251", "Палладий"),
                                'eur_usd' => 'EUR/USD',
                                'gbp_usd' => 'GBP/USD',
                                'usd_chf' => 'USD/CHF',
                                'usd_cad' => 'USD/CAD',
                                'jpy_usd' => 'USD/JPY'
                            );
                            $category = array(
                                'br1' => 'commodities',
                                'light' => 'commodities',
                                'golds' => 'commodities',
                                'silv' => 'commodities',
                                'plat' => 'commodities',
                                'copper' => 'commodities',
                                'pall' => 'commodities',
                                'eur_usd' => 'currencies',
                                'gbp_usd' => 'currencies',
                                'usd_chf' => 'currencies',
                                'usd_cad' => 'currencies',
                                'jpy_usd' => 'currencies'
                            );
                            $subcategory = array(
                                'br1' => 'oils',
                                'light' => 'oils',
                                'golds' => 'metals',
                                'silv' => 'metals',
                                'plat' => 'metals',
                                'copper' => 'metals',
                                'pall' => 'metals',
                                'eur_usd' => 'forex',
                                'gbp_usd' => 'forex',
                                'usd_chf' => 'forex',
                                'usd_cad' => 'forex',
                                'jpy_usd' => 'forex'
                            );
                            $table_name = array(
                                'br1' => 'Brent',
                                'light' => 'Light',
                                'golds' => "Золото",
                                'silv' => "Серебро",
                                'plat' => "Платина",
                                'copper' => "Медь",
                                'pall' => "Палладий",
                                'eur_usd' => 'EUR/USD',
                                'gbp_usd' => 'GBP/USD',
                                'usd_chf' => 'USD/CHF',
                                'usd_cad' => 'USD/CAD',
                                'jpy_usd' => 'USD/JPY'
                            );
                            $count = count($name);
                            foreach($name as $key => $row) {
                                $start_from = mb_strpos($html, $row, 0 , 'CP1251');
                                $pos_start = mb_strpos($html, '<td class="znach">', $start_from, 'CP1251');
                                $pos_end = mb_strpos($html, '</td>', $pos_start, 'CP1251');
                                $value = mb_substr($html, $pos_start+18, $pos_end-$pos_start-18, 'CP1251');
                                $value = number_format(str_replace(' ', '', $value),2, '.', '');
                                $handle = fopen($cat_path.'/data/'.$key.'.csv', 'r');
                                $yearday = 0;
                                $yeardelta = 0;
                                $day_complete = 0;
                                while (!feof($handle)) {
                                    $string = fgets($handle, 10240);
                                    $check_date = explode(',', $string);
                                    $date1 = mktime(0,0,0,date('m'),date('d'),date('Y'));
                                    $date2 = explode('-',$check_date[0]);
                                    $date2 = mktime(0,0,0,$date2[1],$date2[2],$date2[0]);
                                    $days = $date1-$date2;
                                    $days = $days/86400;
                                    if ($days >= 1 && $day_complete == 0) {
                                        $daydelta = $value*100/$check_date[1]-100;
                                        $day_complete = 1;
                                    }
                                    if ($days >= 364) {
                                        $yeardelta = $value*100/$check_date[1]-100;
                                        break;
                                    }
                                }
                                fclose ($handle);
                                $all[$category[$key]][$subcategory[$key]][$table_name[$key]]['prop'] = $key;
                                $all[$category[$key]][$subcategory[$key]][$table_name[$key]]['date'] = date('d').'/'.date('m');
                                $all[$category[$key]][$subcategory[$key]][$table_name[$key]]['value'] = number_format(str_replace(' ', '', $value),2, '.', '');
                                $all[$category[$key]][$subcategory[$key]][$table_name[$key]]['daydelta'] = number_format(str_replace(' ', '', $daydelta),2, '.', '');
                                $all[$category[$key]][$subcategory[$key]][$table_name[$key]]['yeardelta'] = number_format(str_replace(' ', '', $yeardelta),2, '.', '');
                                addstr($cat_path.'/data/'.$key.'.csv', $cat_path.'/data/'.$key.'_tmp.csv', date('Y-m-d'), $value);
                            }
                        }
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_URL, 'http://mfd.ru/MarketData/?ID=4');
                        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727)");
                        curl_setopt($ch, CURLOPT_REFERER, "http://google.com");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_ENCODING, "");
                        $tmp_html = curl_exec($ch);
                        curl_close($ch);
                        file_put_contents($cat_path.'/tmp_parser.txt',$tmp_html);
                        $html = file_get_contents($cat_path.'/tmp_parser.txt');
                        if(!empty($html)) {
                            $pos_start = mb_strpos($html, 'id="marketDataList"', 0, 'UTF-8');
                            $pos_end = mb_strpos($html, '</table>', $pos_start, 'UTF-8');
                            $html = mb_substr($html, $pos_start, $pos_end - $pos_start, 'UTF-8');
                            $name = array(
                                'dji' => 'DJ Industrial',
                                'nasd' => 'NASDAQ Comp',
                                'spx' => 'S&amp;P 100',
                                'ftse' => 'FTSE 100',
                                'hsi' => 'Hang Seng',
                                'nikkei' => 'Nikkei 225',
                            );
                            $table_name = array(
                                'dji' => 'DJI',
                                'nasd' => 'NASD',
                                'spx' => 'S&amp;P',
                                'ftse' => 'FTSE',
                                'hsi' => 'HSI',
                                'nikkei' => 'NIKKEI',
                            );
                            $count = count($name);
                            foreach ($name as $key => $row) {
                                $start_from = mb_strpos($html, $row, 0, 'UTF-8');
                                $pos_start = mb_strpos($html, '<td>', $start_from, 'UTF-8');
                                $pos_end = mb_strpos($html, '<td>', $pos_start + 1, 'UTF-8');
                                $date = trim(mb_substr($html, $pos_start + 4, $pos_end - $pos_start - 4, 'UTF-8'));
                                $pos_start = $pos_end;
                                $pos_end = mb_strpos($html, '<td>', $pos_start + 1, 'UTF-8');
                                $value = trim(mb_substr($html, $pos_start + 4, $pos_end - $pos_start - 4, 'UTF-8'));
                                $value = number_format(str_replace(' ', '', $value), 2, '.', '');
                                $pos = strpos($date, ' ');
                                if ($pos !== false) {
                                    $tmp_date = explode('.', substr($date, 0, $pos));
                                } else {
                                    $tmp_date[0] = date('d');
                                    $tmp_date[1] = date('m');
                                    $tmp_date[2] = date('Y');
                                }
                                $done_date = $tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0];
                                if (file_exists($cat_path . '/data/' . $key . '.csv')) {
                                    $handle = fopen($cat_path . '/data/' . $key . '.csv', 'r');
                                    $yearday = 0;
                                    $yeardelta = 0;
                                    $day_complete = 0;
                                    while (!feof($handle)) {
                                        $string = fgets($handle, 10240);
                                        $check_date = explode(',', $string);
                                        $date1 = mktime(0, 0, 0, $tmp_date[1], $tmp_date[0], $tmp_date[2]);
                                        $date2 = explode('-', $check_date[0]);
                                        if (isset($date2[1])) {
                                            $date2 = mktime(0, 0, 0, $date2[1], $date2[2], $date2[0]);
                                        } else {
                                            $date2 = $date1;
                                        }

                                        $days = $date1 - $date2;
                                        $days = $days / 86400;
                                        if ($days >= 1 && $day_complete == 0) {
                                            if ($check_date[1] != 0) {
                                                $daydelta = $value * 100 / $check_date[1] - 100;
                                            } else {
                                                $daydelta = 0;
                                            }

                                            $day_complete = 1;
                                        }
                                        if ($days >= 364) {
                                            $yeardelta = $value * 100 / $check_date[1] - 100;
                                            break;
                                        }
                                    }
                                    fclose($handle);
                                }
                                $all['indexes']['market_world'][$table_name[$key]]['prop'] = $key;
                                $all['indexes']['market_world'][$table_name[$key]]['date'] = date('d') . '/' . date('m');
                                $all['indexes']['market_world'][$table_name[$key]]['value'] = $value;
                                $all['indexes']['market_world'][$table_name[$key]]['daydelta'] = number_format(str_replace(' ', '', $daydelta), 2, '.', '');
                                $all['indexes']['market_world'][$table_name[$key]]['yeardelta'] = number_format(str_replace(' ', '', $yeardelta), 2, '.', '');
                                addstr($cat_path . '/data/' . $key . '.csv', $cat_path . '/data/' . $key . '_tmp.csv', $done_date, $value);
                            }
                        }
                        //Записываем сериализованный массив котировок в файл
                        file_put_contents($file, serialize($all));

                        //Начало прорисовки графиков
                        //pChart library inclusions
                        require_once('class/pdata.class.php');
                        require_once('class/pdraw.class.php');
                        require_once('class/pimage.class.php');
                        require_once('class/pscatter.class.php');
                        $name = array('rtsi', 'rtsstd', 'micex', 'micex_10', 'dji', 'nasd', 'spx', 'ftse', 'hsi', 'nikkei', 'usd', 'eur', 'chf', 'jpy', 'eur_usd', 'gbp_usd', 'eur_jpy', 'usd_chf', 'jpy_usd', 'usd_cad', 'br1', 'light', 'golds', 'silv', 'plat', 'pall', 'copper', 'gazp', 'gmkn', 'rosn', 'sber', 'sngs', 'lkoh', 'vtbr_1', 'gazp_3', 'gmkn_1', 'lkoh_3', 'rosn_1', 'sber_1', 'sngs_3');

                        foreach ($name as $cat) {
                            //Объект графика
                            $arr = array();
                            if (file_exists($cat_path.'/data/'.$cat.'.csv') && filesize($cat_path.'/data/'.$cat.'.csv') > 20) {
                                $arr = @file($cat_path.'/data/'.$cat.'.csv');//открываем данные
                                $period = 6; //длина выборки для графика в месяцах
                                //извлекаем данные за период
                                $startm = substr($arr[0],5,2);
                                $finishm = $startm - $period+1;
                                if ($finishm < 1) $finishm = $finishm + 12;
                                $zu = 0;
                                $val = $date = $y = $m = $d = $stamp = array();
                                while(isset($arr[$zu]) && (substr($arr[$zu],5,2) != $finishm)) {
                                    if (trim($arr[$zu]) == '') break;
                                    list($date[], $val[]) = explode(',', $arr[$zu]);
                                    list($y[], $m[], $d[]) = explode('-', $date[$zu]);

                                    if (!isset($maxY) || $maxY < (float)$val[$zu] or $zu == 0) $maxY = (float)$val[$zu];
                                    if (!isset($minY) || $minY > (float)$val[$zu] or $zu == 0) $minY = (float)$val[$zu];
                                    $val[$zu] = (float)$val[$zu];
                                    $stamp[] = mktime(0,0,0,(int)$m[$zu],(int)$d[$zu],(int)$y[$zu]);
                                    if (!isset($minT) || $minT < $stamp[$zu] or $zu==0) $maxT = $stamp[$zu];
                                    if (!isset($minT) || $minT > $stamp[$zu]or $zu==0) $minT = $stamp[$zu];
                                    $zu++;
                                }
                                //Create the pData object
                                $myData = new pData();

                                //Ось Х
                                $myData->addPoints($stamp,"time");
                                $myData->setAxisXY(0,AXIS_X);
                                $myData->setAxisPosition(0,AXIS_POSITION_BOTTOM);
                                $myData->setAxisDisplay(0,AXIS_FORMAT_DATE,"M");

                                //CОсь Y
                                $myData->addPoints($val,"value");
                                $myData->setSerieOnAxis("value",1);
                                $myData->setAxisXY(1,AXIS_Y);
                                $myData->setAxisPosition(1,AXIS_POSITION_LEFT);

                                //Набор данных для отображения
                                $myData->setScatterSerie("time","value",0);
                                $myData->setScatterSerieColor(0,array("R"=>255,"G"=>0,"B"=>0));
                                $myData->setScatterSerieWeight(0, 2);
                                //Draw the background
                                $myPicture = new pImage(300,200,$myData);

                                //вычисляем параметры для Оси Х
                                $myPicture->Antialias = FALSE;
                                $minT = mktime(0, 0, 0, date("m",$minT), 2, date("Y",$minT));
                                $maxT = mktime(0, 0, 0, date("m")+1, 2, date("Y"));
                                $delta = mktime(0, 0, 0, date("m")+1, 2, date("Y")) - $minT;
                                $margin = 62-2*(int)date("d");
                                $dt = floor($delta/6);
                                $myPicture->drawFilledRectangle(0,0,300,200,array("R"=>250,"G"=>250,"B"=>250));
                                $myPicture->setFontProperties(array("FontName"=>"$cat_path/fonts/tahoma.ttf","FontSize"=>8));
                                //вычисляем и выводимподписи на графике
                                $TS = array("R"=>0,"G"=>0,"B"=>0,"Angle"=>0,"FontSize"=>8);
                                $deltaY=$maxY-$minY;
                                $dY = $deltaY/4;
                                for ($i=1; $i<4; $i++) {
                                    $coord = $maxY-$dY*$i;
                                    if ($coord > 100) $lbl = sprintf("%01.1f", $coord);
                                    else {
                                        if ($coord > 10) $lbl = sprintf("%01.2f", $coord);
                                        else {
                                            if ($coord > 1) $lbl = sprintf("%01.3f", $coord);
                                            else $lbl = sprintf("%01.4f", $coord);
                                        }
                                    }
                                    $myPicture->drawText(260,floor(10+40*$i)-2,"$lbl",$TS);
                                }
                                $myPicture->setGraphArea(-4,10,300+$margin,170);

                                //Рисуем график
                                $myScatter = new pScatter($myPicture,$myData);

                                //Draw the scale
                                $AxisBoundaries = array(0=>array("Min"=>$minT,"Max"=>$maxT,"Rows"=>6,"RowHeight"=>$dt),1=>array("Min"=>$minY,"Max"=>$maxY,"Rows"=>4,"RowHeight"=>$dY));
                                $ScaleSettings = array("Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundaries,"XLabelsRotation"=>45,"LabelRotation"=>45,"Floating"=>TRUE,"GridR"=>100,"GridG"=>100,"GridB"=>100,);
                                $myScatter->drawScatterScale($ScaleSettings);

                                //Turn on shadow computing
                                $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

                                //Draw a scatter plot chart
                                $myScatter->drawScatterLineChart();

                                //Render the picture (choose the best way)
                                $myPicture->render('data/informer/'.$cat.'.png');
                            }
                        }
                    }
                    else $all = unserialize(file_get_contents($file));
                    if(isset($all['indexes']['market_world']['HSI'])){
                        unset($all['indexes']['market_world']['HSI']);
                    }
					$titles = array("indexes"=>"Индексы","currencies"=>"Валюты","commodities"=>"Товары","shares"=>"Акции", "market_ru"=>"Российские", "market_world"=>"Мировые", "cbrf"=>"ЦБ РФ", "forex"=>"Forex", "micex"=>"ММВБ", "micexinnov"=>"ММВБ INNOV", "rts"=>"РТС", "rtsstandart"=>"РТС STD", "nasdaq"=>"NASDAQ", "oils"=>"Нефть", "metals"=>"Металлы", "micex"=>"micex", "rts"=>"rts");
				?>
					<script>
						var image_cache = [];
					</script>
                <style>
                    .b-quotation-list {
                        margin-bottom: 10px;
                    }

                    .b-quotation ol, .b-quotation ul{list-style:none; margin: 0; padding: 0;}
                    .b-quotation .b-quotation-list{
                        border: 1px solid #A9A9A9;
                        overflow: hidden;
                        margin-top: 0;
                        border-radius: 3px;}
                    .b-quotation table thead tr{
                        background: rgb(238,238,238); /* Old browsers */
                        background: -moz-linear-gradient(top,  rgba(238,238,238,1) 0%, rgba(204,204,204,1) 100%); /* FF3.6+ */
                        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(238,238,238,1)), color-stop(100%,rgba(204,204,204,1))); /* Chrome,Safari4+ */
                        background: -webkit-linear-gradient(top,  rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* Chrome10+,Safari5.1+ */
                        background: -o-linear-gradient(top,  rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* Opera 11.10+ */
                        background: -ms-linear-gradient(top,  rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* IE10+ */
                        background: linear-gradient(to bottom,  rgba(238,238,238,1) 0%,rgba(204,204,204,1) 100%); /* W3C */
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */

                    }
                    .b-quotation table thead th{
                        color: #222 !important;
                    }
                    .b-quotation table tr{
                        background: #7d7e7d; /* Old browsers */
                        background: -moz-linear-gradient(top,  #7d7e7d 0%, #565656 100%); /* FF3.6+ */
                        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#7d7e7d), color-stop(100%,#565656)); /* Chrome,Safari4+ */
                        background: -webkit-linear-gradient(top,  #7d7e7d 0%,#565656 100%); /* Chrome10+,Safari5.1+ */
                        background: -o-linear-gradient(top,  #7d7e7d 0%,#565656 100%); /* Opera 11.10+ */
                        background: -ms-linear-gradient(top,  #7d7e7d 0%,#565656 100%); /* IE10+ */
                        background: linear-gradient(to bottom,  #7d7e7d 0%,#565656 100%); /* W3C */
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7d7e7d', endColorstr='#565656',GradientType=0 ); /* IE6-9 */

                    }
                    .b-quotation table tr.selected {
                        background: #74ADD3;
                        background: -moz-linear-gradient(top, rgba(116,173,211,1) 0%, rgba(38,142,211,1) 50%, rgba(55,150,214,1) 100%);
                        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#74ADD3), color-stop(50%,#268ED3), color-stop(100%,#3796D6));
                        background: -webkit-linear-gradient(top, #74ADD3 0%,#268ED3 50%,#3796D6 100%);
                        background: -o-linear-gradient(top, rgba(116,173,211,1) 0%,rgba(38,142,211,1) 50%,rgba(55,150,214,1) 100%);
                        background: -ms-linear-gradient(top, rgba(116,173,211,1) 0%,rgba(38,142,211,1) 50%,rgba(55,150,214,1) 100%);
                        background: linear-gradient(to bottom, #74ADD3 0%,#268ED3 50%,#3796D6 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#74add3', endColorstr='#3796d6',GradientType=0 );
                    }
                    .b-quotation table{border-collapse:collapse;border-spacing:0}
                    .b-quotation{
                       /*margin: 13px auto;*/
                        margin: 6px auto;
                        position:relative;top:0;left:0;width:300px;display:block;font: 12px Tahoma, Arial, Helvetica, Sans-serif;
                    }
                    .b-quotation-tabs{
                        height:52px
                    }
                    .b-quotation-tabs .level-1-item{
                        float:left;height:30px;text-align:center;line-height:30px;font-size:110%;color:white;width: 99px;
                        margin-right: 1px;
                    }
                    .level-1-item-indexes{
                        width:75px
                    }
                    .level-1-item-commodities{
                        width:75px
                    }
                    .level-1-item-shares{
                        width:75px
                    }
                    .level-1-item-currencies{
                        width:75px
                    }
                    .b-quotation-tabs .level-1-link{
                        position:relative;top:0;left:0;z-index:2;height:29px;cursor:pointer;text-decoration: underline;
                    }
                    .b-quotation-tabs .level-1-item .level-1-link{
                        background: #BBB;
                        color: #333;
                        text-transform: uppercase;
                        text-decoration: none;
                    }
                    .b-quotation-tabs .level-1-item-active .level-1-link{
                        background: #508BCC;
                        color: #FFF;
                    }
                    .b-quotation-tabs .level-2{
                        position:absolute;top:30px;left:0;z-index:1;display:none;width:300px;height:20px;line-height:20px;background:#333;color:#000
                    }
                    .b-quotation-tabs .level-1-item-active .level-2{
                        display:block
                    }
                    .b-quotation-tabs .level-2-item{
                        padding: 0 20px;
                        cursor: pointer;
                        background: #666;
                        float:left;
                        margin-right: 1px;
                    }
                    .b-quotation-tabs .level-2-item-active{
                        background:white;
                    }
                    .b-quotation-list{
                        margin:-5px 0 0;display:none
                    }
                    .b-quotation-list-active{
                        display:block
                    }
                    .b-quotation-list-item{
                        display:none;
                    }
                    .b-quotation-list-item img{
                        /*margin-top: 10px;*/
                    }
                    .b-quotation-list-item-active{
                        display:block;
                        text-align: center;
                    }
                    .b-quotation-table{
                        width:100%;
                        line-height:24px;
                        background:#f4f4f4;
                    }
                    .b-quotation-table td,.b-quotation-table th{
                        padding:0 2px
                    }
                    .b-quotation-table thead th{
                        white-space:nowrap;font-size:110%;font-weight:normal
                    }
                    .b-quotation-table tr{
                        border-top:1px solid #d7d8db
                    }
                    .b-quotation-table tbody th{
                        font-size:110%;font-weight:bolder
                    }
                    .b-quotation-table tbody th a{
                        color:black;
                        text-decoration: none;
                    }
                    .b-quotation-table .num{
                        text-align:right;font-size:110%
                    }
                    .b-quotation-table .time{
                        /*color:#b2b2b2*/
                    }
                    .b-quotation-table .n{
                        /*color:#dd0053!important*/
                    }
                    .b-quotation-table .p{
                        /*color:#008e07!important*/
                    }
                    .b-quotation-table tbody tr:hover td,.b-quotation-table .selected td,.b-quotation-table tbody tr:hover th,.b-quotation-table .selected th,.b-quotation-table tbody tr:hover th a,.b-quotation-table .selected th a{
                       color:white;cursor:pointer
                    }
                    .b-quotation-table td, .b-quotation-table th{
                        color:white;
                     }
                    /* investment-indicators */
                    .indicator{
                        float: left;
                        width: 310px;
                        min-height:260px;
                        margin: 5px 5px 10px 5px;
                        border: 1px solid #C9DBE4;
                        border-radius: 5px;
                    }
                    .indicator article{
                        margin: auto;
                    }
                    .indicator .level-1-item-active{
                        background-color: transparent;
                        height: 17px;
                        line-height: 17px;
                        margin: 5px 0 5px;
                        background: url('/images/markup/blue.jpg');
                        border: 0px solid transparent;
                        border-radius: 3px;
                    }
                    .indicator .level-1-item{
                        background-color: transparent;
                        height: 17px;
                        line-height: 17px;
                        margin: 5px 0 5px;
                    }
                    .indicator .level-1-link {
                        height: 17px;
                        line-height: 17px;
                        text-decoration: none;
                        width: auto;
                        float: left;
                        margin-left: 50%;
                    }
                    .indicator .level-1-link span{
                        font-size:11px;
                        margin: 0 0 0 -100%;
                        padding: 0;
                        text-align: center;
                        white-space: nowrap;
                        border-bottom: 1px dashed #264392;
                    }
                    .indicator .level-1-item-active .level-1-link span{
                        font-size:11px;
                        border-bottom: 1px dashed transparent;
                    }
                    .indicator .level-1-item-1{
                        width:100%;
                    }
                    .indicator .level-1-item-2{
                        width:50%;
                    }
                    .indicator .level-1-item-3{
                        width:33%;
                    }
                    .indicator .level-1-item-4{
                        width:25%;
                    }
                    .indicator .b-quotation-list-item-active{
                        text-align: left;
                    }
                    .indicator .b-quotation-tabs{
                        height: 29px;
                    }
                    .indicator .b-quotation table{
                        background: #E9FBFF;
                    }
                    .indicator .b-quotation-table tbody th {
                        padding-left: 12px;
                        font-size: 11px;
                        line-height: 20px;
                        font-weight: normal;
                        white-space: nowrap;
                        overflow: hidden;
                    }
                    .indicator .b-quotation-table tbody td {
                        padding-right: 12px;
                        font-size: 11px;
                        line-height: 20px;
                        font-weight: normal;
                    }
                    .indicator .b-quotation-tabs .level-1-item .level-1-link{
                        background: #BBB;
                        color: #333;
                        text-transform: uppercase;
                        text-decoration: none;
                    }
                    .indicator .b-quotation-tabs .level-1-item-active .level-1-link{
                        color: #fff;
                    }
                    .indicator .b-quotation-table a {
                        font-size: 11px !important;
                    }

                    .b-quotation-table tr {
                        border-top: 1px solid #B8CAD3;
                    }
                    .indicator h3{
                        font-size: 16px;
                        font-family: Tahoma;
                        font-weight: normal;
                        margin: 6px;
                        color: #222255;
                    }
                </style>
					<article class="b-quotation" id="block-stock">
						<ul class="b-quotation-tabs level-1">
						<?
							//Вывод заголовков информера
							$i = 0;
							foreach ($all as $catkey => $catval) 
							{
								if (!$i) 
								{ 
									echo "<li class='level-1-item level-1-item-$catkey level-1-item-active' itemprop='$catkey'><div class='level-1-link'>".$titles[$catkey]."</div><ul class='level-2'>"; 
								}else 
								{
									echo "<li class='level-1-item level-1-item-$catkey ' itemprop='$catkey'><div class='level-1-link'>".$titles[$catkey]."</div><ul class='level-2'>";
								}
								$i++;
								$mu = 0;
								foreach ($catval as $subcatkey => $subcatval)
								{
									if (!$mu) 
									{
										echo "<li class='level-2-item level-2-item-active' itemprop='$subcatkey'>".$titles[$subcatkey]."</li>"; 
									}else 
									{	
										echo "<li class='level-2-item' itemprop='$subcatkey'>".$titles[$subcatkey]."</li>";
									}
									$mu++;
								}
								echo '</ul></li>';
							}
						echo '</ul>';
						
						//Вывод графиков и курсов
						$k = 0;
						foreach ($all as $catkey => $catval) 
						{
							echo "<script>image_cache['$catkey'] = [];</script>";
							if (!$k) 
							{
								echo "<ul class='b-quotation-list b-quotation-list-active' id='$catkey'>";
							}else 
							{
								echo "<ul class='b-quotation-list' id='$catkey'>";
							}
							
							$k++;
							$jj = 0;
							foreach ($catval as $subcatkey => $subcatval)
							{
								echo "<script>image_cache['$catkey']['$subcatkey'] = [];</script>";
								$i = 0; 
								if ($jj==0) 
								{
									echo "<li class='b-quotation-list-item b-quotation-list-item-active' id='$subcatkey'>"; 
								}else
								{
									echo "<li class='b-quotation-list-item' id='$subcatkey'>";
								}
								
								$jj++;
								
								foreach ($subcatval as $namekey => $nameval)
								{
									if (!$i) 
									{
                                        if($subcatkey=="nasdaq"){
                                            echo "<img src='/data/informer/nasdaq/".$nameval['prop'].".png' width='300' height='200' id='image-$subcatkey' />";
                                        }
                                        else{
                                            echo "<img src='/data/informer/".$nameval['prop'].".png' width='300' height='200' id='image-$subcatkey' />";
                                        }
                                    }
									$i++; 
								}
								
								echo "<table class='b-quotation-table' itemprop='$subcatkey'>
									<thead>
									<tr>
									<td colspan='2'></td>
									<th class='num'>Знач.</th>
									<th class='num'>День%</th>
									<th class='num'>52 нед,%</th>
									</tr>
									</thead>
									<tbody>";
								$i = 0;
								foreach ($subcatval as $namekey => $nameval)
								{
								    if( $subcatkey=="nasdaq"){
                                        echo "<script>image_cache['$catkey']['$subcatkey']['".$nameval['prop']."'] = '/data/informer/nasdaq/".$nameval['prop'].".png';</script>";
                                    }
                                    else{
                                        echo "<script>image_cache['$catkey']['$subcatkey']['".$nameval['prop']."'] = '/data/informer/".$nameval['prop'].".png';</script>";
									}
									if (!$i) 
									{
										echo "<tr class='selectable selected' itemprop='".$nameval['prop']."'>";
									}else
									{
										echo "<tr class='selectable' itemprop='".$nameval['prop']."'>";
									}
									$i++; 
									echo "<th>".$namekey."</th>";
										echo "<td class='time'>" . (isset($nameval['date']) ? $nameval['date'] : '---' ) ."</td>";
										echo"<td class='num'>$nameval[value]</td>";
									
									if ($nameval['daydelta'] < 0) 
									{ 
										echo"<td class='num n'>$nameval[daydelta]</td>"; 
									}else 
									{ 
										echo"<td class='num p'>$nameval[daydelta]</td>"; 
									}
									
									if ($nameval['yeardelta'] < 0)
									{
										echo"<td class='num n'>$nameval[yeardelta]</td> </tr>";
									}else 
									{
										echo"<td class='num p'>$nameval[yeardelta]</td> </tr>";
									}
								}
								echo '</tbody></table>';
							}
							echo '</ul></li>';
						} 
					?>
					</ul>
					
					<script>
						function image_cache_load(group, type) 
						{
							for(key in image_cache[group][type]) 
							{
								if(typeof(image_cache[group][type][key]) == 'string') 
								{
									var image = new Image();
									image.src = image_cache[group][type][key];
									image_cache[group][type][key] = image;
								}
							}
						}
						
						$(function()
						{
							image_cache_load($('#block-stock .level-1-item-active').attr('itemprop'), $('#block-stock .level-2-item-active').attr('itemprop'));
						});
						
						$('#block-stock .level-1-item').click(function()
						{
							$(this).parent().find('.level-1-item').removeClass('level-1-item-active');
							$(this).addClass('level-1-item-active');
							$('#'+$(this).attr('itemprop')).parent().find('.b-quotation-list').removeClass('b-quotation-list-active');
							$('#'+$(this).attr('itemprop')).addClass('b-quotation-list-active');
							image_cache_load($(this).attr('itemprop'), $(this).find('.level-2-item-active').attr('itemprop'));
						});
						
						$('#block-stock .level-2-item').click(function()
						{
							$(this).parent().find('.level-2-item').removeClass('level-2-item-active');
							$(this).addClass('level-2-item-active');
							$('#'+$(this).attr('itemprop')).parent().find('.b-quotation-list-item').removeClass('b-quotation-list-item-active');
							$('#'+$(this).attr('itemprop')).addClass('b-quotation-list-item-active');
						});
						
						$('#block-stock table tr.selectable').hover(function()
						{
							$(this).parent().find('tr.selectable').removeClass('selected');
							$(this).addClass('selected');
							var img = $('#image-'+$(this).parents('.b-quotation-table').attr('itemprop'));
                            if ($(this).parents('.b-quotation-table').attr('itemprop')=='nasdaq'){
                                addp = "/data/informer/"+$(this).parents('.b-quotation-table').attr('itemprop')+"/";
                            }
                            else {
                                addp="/data/informer/";
                            }
							img.attr('src',addp + $(this).attr('itemprop') + ".png");
						});
					</script> 
				</article>
			</div>