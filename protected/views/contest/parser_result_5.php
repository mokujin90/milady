<?
$this->breadcrumbs = array('Конкурсы' => $this->createUrl('/support-innovation/tenders/'), "Премии, гранты");
?>
<div class="main bread-block">
    <?$this->renderPartial('/partial/_breadcrumbs')?>
</div>
<div class="content list-columns columns single-column">
    <div class="full-column opacity-box">
<?
	if(isset($_GET['el2']))
	{
		$get_premii = "SELECT * FROM `support-innovation-parser-5` WHERE `id` = '".mysql_escape_string($_GET['el2'])."'";
        $row_premii = Yii::app()->db->createCommand($get_premii)->queryRow();

        if($row_premii)
        {
?>
			<h2><?=$row_premii['ruName']?></h2>
			
			<?=$row_premii['text']?>
<?
		}
		else{
			echo "<script>location.replace('/support-innovation/tenders/');</script>";
		}
	}
?>
</div></div>