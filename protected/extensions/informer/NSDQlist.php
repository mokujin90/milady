<?php
//Парсер списка компаний nasdaq
require_once 'fileadd.php';//функция модификации csv файлов раз в день
include_once 'simple_html_dom.php';//Класс для парсинга
require ("../lib/conn.php");
$url = "http://money.cnn.com/data/markets/nasdaq/?page=";
$html = file_get_html($url.'1');
$table = $html->find('div#wsod_indexConstituents');
$paging = $table[0]->find('div.paging',0);
$pos_start = mb_strpos($paging, 'this.value = ', 0, 'CP1251');
$pos_end = mb_strpos($paging, ';', $pos_start, 'CP1251');
$maxpage = (int)trim(mb_substr($paging, $pos_start+13, $pos_end-$pos_start-13, 'CP1251'));
if (!is_int($maxpage)) $maxpage = 174;
$minpage = (int)file_get_contents('nasdaq_last_page.txt');
if (!is_int($minpage) || $minpage >= $maxpage) $minpage = 1;
echo 'Начинаем со страницы: '.$minpage.'<br/>';
$url="http://money.cnn.com/data/markets/nasdaq/?page=";
for ($i=$minpage;$i<=$maxpage;$i++) {
	file_put_contents('nasdaq_last_page.txt', $i);
    $html = file_get_html($url.$i);
    $table=$html->find('div#wsod_indexConstituents table.wsod_dataTableBig',0);
	$first = 0;
	echo $i.'<br/>';
    foreach ($table->find('tr') as $row) {
        if (isset($row) && $first != 0) {
            $col   = trim($row->find('a',0)->plaintext);
            $name  = trim($row->find('td',0)->plaintext);
            $v     = trim($row->find('td',1)->plaintext);
            $dd    = trim($row->find('td',3)->plaintext);
            $yd    = trim($row->find('td',6)->plaintext);
            $name  = substr($name,strlen($col));
            if ($col != '' and $name != '') {
				$date = date('Y-m-d');
                $quu = "INSERT INTO nasdaq (shortname, name, d, v, dd, yd)
                    VALUES ('".$col."','".$name."','".$date."','".$v."','".$dd."','".$yd."')
                    ON DUPLICATE KEY UPDATE shortname='$col',name='$name',d='$date',v='$v', dd='$dd', yd='$yd'";
                mysql_query($quu);
				addstr('data/nasdaq/'.$col.'.csv','data/nasdaq/'.$col.'_tmp.csv',$date,$v);//Добавляем данные в csv хранилище
            }
			echo $col."|".$name."|".$v."|".$dd."|".$yd."<br/>";
        }
		$first++;
    }
    $html->clear();
    unset($html);
	flush();
}