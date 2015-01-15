<?
    $this->breadcrumbs = array('Конкурсы' => $this->createUrl('/support-innovation/tenders/'), "Конкурсы в рамках ФЦП «Научные и педагогические кадры инновационной России на 2009-2013 годы»");
?>
<div class="main bread-block">
    <?$this->renderPartial('/partial/_breadcrumbs')?>
</div>
<div class="content list-columns columns single-column">
    <div class="full-column opacity-box">
<?
	if(isset($_GET['el3']))
	{
		$get_docs = "SELECT * FROM `support-innovation-parser-3` WHERE `id` = '".mysql_escape_string($_GET['el3'])."'";
        $row_docs = Yii::app()->db->createCommand($get_docs)->queryRow();

        if($row_docs)
		{
?>
			<h2><?=$row_docs['ruName']?></h2>
			
			
			<style>
				table {
				width:100%;
				border-collapse:collapse;
				}
				table th, .orderInfoHdr{
					color: #25408F;
					font:13px 'Trebushet MS', Helvetica, Arial, sans-serif;
					background: #B4CEEB;
					border: 1px solid #DAE7F5;
					padding:4px;
				}
				table td {
					border: 1px solid #DAE7F5;
					padding:4px;
				}
				table table td { border:none; }
				.showlist {
					height: 30px;
					line-height: 30px;
					font-size: 14px;
					color: #264392;
					width: 250px;
					padding-left: 70px;
					background: #B4CEEB 6px center no-repeat;
					cursor: pointer;
					border-radius: 3px;
					margin: 14px 0px;
					text-decoration: none;
				}
			</style>
			<a href="/support-innovation/tenders/fcp/3/" style="text-decoration:none;"><div class="showlist">Назад к списку конкурсов</div></a>
			<?=$row_docs['docs']?>
			<a href="/support-innovation/tenders/fcp/3/" style="text-decoration:none;"><div class="showlist">Назад к списку конкурсов</div></a>
<?
		}else{
			echo "<script>location.replace('/support-innovation/tenders/fcp/3/');</script>";
		}
	}
	elseif(isset($_GET['el1']))
	{
?>
		<style>
			table {
				width:100%;
				border-collapse:collapse;
			}
			table th{
				color: #25408F;
				font:13px 'Trebushet MS', Helvetica, Arial, sans-serif;
				background: #B4CEEB;
				border: 1px solid #DAE7F5;
				padding:3px;
			}
			table td {
				border: 1px solid #DAE7F5;
				padding:3px;
				text-align:center;
			}
		</style>
		<h2>Конкурсы в рамках ФЦП «Научные и педагогические кадры инновационной России на 2009-2013 годы»</h2>
		
		<table>
			<tr>
				<th></th>
				<th>Дата размещения</th>
				<th>Мероприятие</th>
				<th>Наименование конкурса</th>
				<th>Ссылка на конкурсную документацию</th>
			</tr>
<?
		// Пагинатор (конфигурация)
		$countall ="SELECT COUNT(*) AS countall FROM `support-innovation-parser-3`";
        $total = Yii::app()->db->createCommand($countall)->queryScalar();
		$path = '/support-innovation/tenders/fcp/3/';
		$perpage = 10;
		$curpage = (isset($_GET['el2'])? $_GET['el2']: 1);
		if($curpage <= 0) { $curpage = 1; }
		
		$get_article = "SELECT * FROM `support-innovation-parser-3`";
        $command = Yii::app()->db->createCommand($get_article);
        $dataProvider = new CArrayDataProvider($command->queryAll(), array(
            'pagination' => array(
                'pageSize' => $perpage,
                'pageVar'=>'el2'
            ),
        ));
        $command = $dataProvider->getData();
        $pages = $dataProvider->pagination;
        $get_article = "SELECT * FROM `support-innovation-parser-3` LIMIT " . ($perpage * ($curpage - 1)) . ", {$perpage} ";
        $rows = Yii::app()->db->createCommand($get_article)->queryAll();

        if(!empty($rows))
		{
			$i = 0;
            foreach ($rows as $item)
			{	
				$i++;
?>					
				<tr>
					<td><?=($i+($perpage * ($curpage - 1)))?>.</td>
					<td><?=date("d.m.Y",$item['date'])?></td>
					<td><?=$item['event']?></td>
					<td style="text-align:left;"><?=$item['ruName']?></td>
					<td><a href="/support-innovation/tenders/fcp/3/view/<?=$item['id']?>/" style="color:#D01519;;">Конкурсная документация</a></td>
				</tr>
<?
			}
		}
?>
		</table>
        <?$this->widget('CLinkPager', array('pages'=>$pages));?>

        <?
	}
?>