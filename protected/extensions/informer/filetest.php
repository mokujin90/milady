<?php
/*��������� �������� ���� ����� bfm.ru*/
$name = array("rtsi",
        "rtsstd",
        "micex",
        "micex_10",
        "dji",
        "nasd",
        "spx",
        "ftse",
        "hsi",
        "nikkei",
        "usd",
        "eur",
        "chf",
        "jpy",
        "eur_usd",
        "gbp_usd",
        "eur_jpy",
        "usd_chf",
        "jpy_usd",
        "usd_cad",
        "br1",
        "light",
        "golds",
        "silv",
        "plat",
        "pall",
        "copper",
        "gazp",
        "gmkn",
        "rosn",
        "sber",
        "sngs",
        "lkoh",
        "vtbr_1",
        "gazp_3",
        "gmkn_1",
        "lkoh_3",
        "rosn_1",
        "sber_1",
        "sngs_3");
foreach ($name as $value){
    echo $value;
    $grabpath = "http://www.bfm.ru/stock/flash/data_($value)_list_none.csv";
    echo "<br/>".$grabpath;
    $newfile = "data/$value.csv";//���� � ��������� ������ � ���
    echo "<br/>".$newfile;
    $arr=@file($grabpath);//�������� ���� � ������
    if (count($arr)) {
    $fp = fopen ($newfile, "w");//���������� � ��� ����
        foreach ($arr as $output) {
            fwrite($fp, trim($output)."\r\n");
        }
    fclose($fp);
    }
}   
?>