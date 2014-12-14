<?php
	/*Функция для добавления биржевых индексов в csv файлы раз в день*/
	function addstr($file,$file_tmp,$strdate,$strval) {
		// проверяем, не было ли сбоя в предыдущем запуске скрипта
		if(file_exists($file_tmp)) copy($file_tmp, $file);
		$strval = preg_replace('/([^0-9.])/', '', $strval);
		if (trim($strdate) != '' && trim($strval) != '') {
			if(!file_exists($file)) file_put_contents($file, $strdate.','.$strval."\r\n");
			else {
				// копируем содержимое файла в tmp
				if(copy($file, $file_tmp)) {
					// удачно скопировался, можно перезаписывать основной файл
					if($w=fopen($file,"w")) {
						//$strval = preg_replace('/([^0-9.])/', '', $strval);
						$str = $strdate.','.$strval."\r\n";
						flock($w,2); // локируем файл
						if(!$r=fopen($file_tmp,"r")) die("can't open file");
						flock($r,1);
						$first=str_replace("\r\n","",fgets($r,10240));
						$check_date = substr($first, 0, strpos($first, ','));
						list($y, $m, $d) = explode('-', $check_date);
						list($ny, $nm, $nd) = explode('-', $strdate);
						if (mktime(0,0,0,$m,$d,$y) < mktime(0,0,0,$nm,$nd,$ny)) fputs($w,trim($str)."\r\n"); // записываем первую строку
						fputs($w,trim($first)."\r\n");
						while($str = fgets($r,10240)) fputs($w,trim($str)."\r\n"); //читаем и пишем построчно
						flock($r,3);
						fclose($r);
						flock($w,3);
						fclose($w);
						unlink($file_tmp);
					}
				}
			}
		}
	}
?>