<?
require ("../lib/conn.php");
//-------------------------------Перенос проектов с htex--------------------------------
echo "startHtex<br>";
mysql_query("SET NAMES cp1251");
$q = 'SELECT * FROM `innovative` ';
        $res = mysql_query($q);
        $i=0;
while ($row = mysql_fetch_assoc($res)) {
    $date = time();
	$edate = 0;
        $header =$row['ruName'];
 $mysqli = new mysqli('mysql4.leaderhost.ru', 'skadus1_base', 'basepass', 'skadus1_site98');
        if (mysqli_connect_errno()) { 
        printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n",
        mysqli_connect_error()); 
       exit; 
        }
        $prequery="SELECT * FROM ".$db_pref."news WHERE `cat_id`='77' AND `iipid`=".$row['id']." ";
        $result = $mysqli->query($prequery);
        $num_rows = $result->num_rows;
//Вставка только новых строк
        if ($num_rows<1){
              $query="INSERT into `".$db_pref."news` 
                     (`cat_id`, `date`, `edate`, `header`, `anons`, `author`, `author_mail`, `source`, `source_url`, `hide`, `hot`, `dok1`, `dok2`, dok3, kw, dr, pole1, pole2, pole3,pole4, pole5, pole7, pole8, pole9, pole10, pole11, pole12, pole13, pole14, pole15, pole16, pole17, pole18, pole19, pole21, pole22, pole23, pole25, pole26, pole27, pole28, pole33, pole34, pole35, pole36, pole37, pole38, pole39, pole40, pole41, pole42, pole43, pole44, pole45,pole46, pole47, pole48, pole31, pole32) 
		      VALUES (78, '".$date."', '".$edate."', '".$header."', '".$anons."', '".$author."', '".$author_mail."', '".$source."', '".$source_url."', 0, 0, '".$dok1_name."', '".$dok2_name."', '".$dok3_name."', '".$kw."', '".$dr."', '".$row['companyName']."', '".$row['companyAddress']."','".$row['companyDesc']."','".$row['address']."','".$row['companyIndustry']."', '".$row['fio']."', '".$row['post']."',
               '".$row['phone']."', '".$row['fax']."', '".$row['email']."', '".$row['ruName']."', '".$row['descProject']."', '".$row['placeProject']."', '".$row['patent']."', '".$row['sizeMarket']."', '".$row['stepProject']."', '".$row['sumInvestment']."', '".$row['historyProject']."', '".$row['priceProject']."', '".$row['financingTerms']."', '".$row['directionInvestment']."', '".$row['profit']."',
                '".$row['period']."', '".$row['clearProfit']."', '".$row['normaProfit']."', '".$row['risk']."', '".$row['sizeInvestment']."', '".$row['goalInvestment']."', '".$row['structureBefore']."', '".$row['structureAfter']."', '".$row['typeInvestment']."', '".$row['typeFinance']."','".$row['mainTerms']."','".$row['investmentTranches']."','".$row['swot']."','".$row['strategy']."','".$row['periodExit']."','".$row['priceExit']."','".$row['multiExit']."','".$row['shortDesc']."','".$row['programm']."','".$row['descProduct']."','".$row['relevance']."')";

              $mysqli->query($query);
              echo $query;
              echo mysql_error();
        }
}
        $result->close();
        $mysqli->close(); 

?>
