<?php
require ("../lib/conn.php");
$query="SELECT id, shortname FROM nasdaq ORDER BY id ";
$res=mysql_query($query);
while ($item = mysql_fetch_assoc($res)){
    $postfields = http_build_query( array ('..requester..' => 'ContentBuffer',
    'params' => 'B64ENCeyJ0aW1lZnJhbWUiOiIxODAiLCJpbnRlcnZhbCI6ImF1dG8iLCJzdHlsZSI6Im1vdW50YWluIiwic2NhbGUiOiJsaW5lYXIiLCJkaXZpZGVuZHMiOmZhbHNlLCJzcGxpdHMiOmZhbHNlLCJlYXJuaW5ncyI6ZmFsc2UsInNob3dOZXdzIjpmYWxzZSwiZHJhd1RyYW5zYWN0aW9ucyI6ZmFsc2UsInVwcGVyIjpbXSwibG93ZXIiOltdLCJpbmRleCI6W119',
    'returns' => 'fileName:File.Name,eventPoints:eventPoints,rangeExport:rangeExport,datesExport:datesExport,chartCoords:chartCoords,timeStamp:timeStamp,timezoneDelta:timezoneDelta',
    'symb' => $item['shortname']));
    $opts = array('http' =>
    array(
    'method'  => 'POST',
    'header'  => 'Content-type: application/x-www-form-urlencoded',
    'content' => $postfields,
    )
    );
    $context  = stream_context_create($opts);
    $result = file_get_contents('http://markets.money.cnn.com/research/quote/chart/buffer_interactiveChart.asp', false, $context);                        
    $jdec = json_decode($result);
    $data=explode("|",$jdec->chartCoords);
    $newfile = 'data/nasdaq/'.$item['shortname'].'.csv';//путь к хранилищу данных у нас
    echo $item['id'].'<br/>';
    $fp = fopen ($newfile, "w");//записываем в наш файл
    for ($i=count($data)-1;$i>=0;$i--){
        $points=explode('*',$data[$i]);
        $d=explode('/',$points[0]);
        $d = $d[2].'-'.$d[0].'-'.$d[1];
        $v=$points[4];
        fwrite($fp, $d.','.$v."\r\n");
    }
    fclose($fp);
}


