<?php
function get_web_page( $url )
{
  $uagent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8";

  $ch = curl_init( $url );

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // ���������� ���-��������
  curl_setopt($ch, CURLOPT_HEADER, 0);           // �� ���������� ���������
  //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // ��������� �� ����������
  curl_setopt($ch, CURLOPT_ENCODING, "utf-8");     
  curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // ������� ����������
  curl_setopt($ch, CURLOPT_TIMEOUT, 120);        // ������� ������
  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);       // ��������������� ����� 10-��� ���������

  $content = curl_exec( $ch );
  $err     = curl_errno( $ch );
  $errmsg  = curl_error( $ch );
  $header  = curl_getinfo( $ch );
  curl_close( $ch );
  $header = $content;
  return $header;
}
?>