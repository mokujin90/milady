<?
$this->breadcrumbs = array('Конкурсы' => $this->createUrl('/support-innovation/tenders/'), "Конкурсы на право заключения государственных контрактов");
?>
<div class="main bread-block">
    <?$this->renderPartial('/partial/_breadcrumbs')?>
</div>
<div class="content list-columns columns single-column">
    <div class="full-column opacity-box">
<?
	if(isset($_GET['el2']))
	{
		$get_k = "SELECT * FROM `support-innovation-parser-7` WHERE `id` = '".mysql_escape_string($_GET['el2'])."'";
        $row_k = Yii::app()->db->createCommand($get_k)->queryRow();
		if($row_k)
		{
?>
			<h2><?=$row_k['ruName']?></h2>
			<style>
				table {
					width:100%;
				}
				.orderInfoCol1 {
					width:30%;
					font-weight:bold;
					padding:10px;
				}
				.orderInfoHdr {
					background:#466C97;
					color:#fff;
				}
				.orderInfoHdr td {
					padding:3px;
				}
			</style>
			<?=$row_k['fullText']?>
<?
		}
		else{
			echo "<script>location.replace('/support-innovation/tenders/');</script>";
		}
	}elseif(isset($_GET['el1']))
	{
		// Пагинатор (конфигурация)
        $countall ="SELECT COUNT(*) AS countall FROM `support-innovation-parser-7`";
        $total = Yii::app()->db->createCommand($countall)->queryScalar();
        $path = '/support-innovation/tenders/fcp/6?page=';
        $perpage = 20;
        $curpage = (isset($_GET['page'])? $_GET['page']: 1);
        if($curpage <= 0) { $curpage = 1; }

        $get_k = "SELECT * FROM `support-innovation-parser-7`";

        $command = Yii::app()->db->createCommand($get_k);
        $dataProvider = new CArrayDataProvider($command->queryAll(), array(
            'pagination' => array(
                'pageSize' => $perpage,
                'pageVar'=>'page'
            ),
        ));
        $command = $dataProvider->getData();
        $pages = $dataProvider->pagination;
        $get_k = "SELECT * FROM `support-innovation-parser-7` LIMIT ".($perpage * ($curpage - 1)).", {$perpage} ";
        $rows = Yii::app()->db->createCommand($get_k)->queryAll();

        if(!empty($rows))
        {
?>
			<style>
				.tab-k {
					width:99%;
				}
				.tab-k td {
					border-bottom:1px solid #034480;
					padding:7px 5px;
					vertical-align:top;
				}
			</style>
			
			<h2>Конкурсы на право заключения государственных контрактов</h2>
			
			<table class="tab-k">
<?
                foreach ($rows as $item)

                {
?>
					<tr>
						<td><?=$item['ruName']?></td>
						<td><?=$item['text']?><br /><a href="/support-innovation/tenders/fcp/6/<?=$item['id']?>/">Подробнее &rarr;</a></td>
					</tr>
<?				
				}
?>
			</table><br />
            <?$this->widget('CLinkPager', array('pages'=>$pages));?>

    <?
		}
	}else{
		echo "<script>location.replace('/support-innovation/tenders/');</script>";
	}
?>
</div></div>