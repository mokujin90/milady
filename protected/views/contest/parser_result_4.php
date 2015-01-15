<?
$this->breadcrumbs = array('Конкурсы' => $this->createUrl('/support-innovation/tenders/'), "Развитие фармацевтической и медицинской промышленности Российской Федерации на период до 2020 года и дальнейшую перспективу");
?>
<div class="main bread-block">
    <?$this->renderPartial('/partial/_breadcrumbs')?>
</div>
<div class="content list-columns columns single-column">
    <div class="full-column opacity-box">
        <?

        if(isset($_GET['el5']))
        {
            $get_article = "SELECT * FROM `support-innovation-parser-4` WHERE `type` = '".mysql_escape_string($_GET['el1'])."' and `parent` = ".mysql_escape_string($_GET['el5'])." ORDER BY `id`";
            $rows = Yii::app()->db->createCommand($get_article)->queryAll();

            if(!empty($rows))
            {
                $get_header = "SELECT `ruName` FROM `support-innovation-parser-4` WHERE `type` = '".mysql_escape_string($_GET['el1'])."' and `parent` = ".mysql_escape_string($_GET['el5'])." LIMIT 1";
                $row_header = Yii::app()->db->createCommand($get_article)->queryRow();

                ?>
                <h2><?=$row_header['ruName']?></h2>
                <?
                foreach ($rows as $item)
                {
                    ?>
                    <div class="text">
                        <?=$item['text']?>
                    </div>
                <?
                }
            }
        }
        elseif(isset($_GET['el4']))
        {
            $get_article = "SELECT * FROM `support-innovation-parser-4` WHERE `type` = '".mysql_escape_string($_GET['el1'])."' and `parent` = ".mysql_escape_string($_GET['el4'])." ORDER BY `id`";
            $rows = Yii::app()->db->createCommand($get_article)->queryAll();

            if(!empty($rows))
            {
                $get_header = "SELECT `ruName` FROM `support-innovation-parser-4` WHERE `type` = '".mysql_escape_string($_GET['el1'])."' and `parent` = ".mysql_escape_string($_GET['el4'])." LIMIT 1";
                $row_header = Yii::app()->db->createCommand($get_article)->queryRow();

                ?>
                <h2><?=$row_header['ruName']?></h2>
                <?
                foreach ($rows as $item)
                {
                    ?>
                    <div class="text">
                        <?=$item['text']?>
                    </div>
                <?
                }
            }
        }
        elseif(isset($_GET['el3']))
        {
            $get_article = "SELECT * FROM `support-innovation-parser-4` WHERE `type` = '".mysql_escape_string($_GET['el1'])."' and `parent` = ".mysql_escape_string($_GET['el3'])." ORDER BY `id`";
            $rows = Yii::app()->db->createCommand($get_article)->queryAll();

            if(!empty($rows))
            {
                $get_header = "SELECT `ruName` FROM `support-innovation-parser-4` WHERE `type` = '".mysql_escape_string($_GET['el1'])."' and `parent` = ".mysql_escape_string($_GET['el3'])." LIMIT 1";
                $row_header = Yii::app()->db->createCommand($get_article)->queryRow();

                ?>
                <h2><?=$row_header['ruName']?></h2>
                <?
                foreach ($rows as $item)
                {
                    ?>
                    <div class="text">
                        <?=$item['text']?>
                    </div>
                <?
                }
            }
        }
        elseif(isset($_GET['el2']))
        {
            $get_article = "SELECT * FROM `support-innovation-parser-4` WHERE `type` = '".mysql_escape_string($_GET['el1'])."' and `parent` = ".mysql_escape_string($_GET['el2'])." ORDER BY `id`";
            $rows = Yii::app()->db->createCommand($get_article)->queryAll();

            if(!empty($rows))
            {
                $get_header = "SELECT `ruName` FROM `support-innovation-parser-4` WHERE `type` = '".mysql_escape_string($_GET['el1'])."' and `parent` = ".mysql_escape_string($_GET['el2'])." LIMIT 1";
                $row_header = Yii::app()->db->createCommand($get_article)->queryRow();
                ?>
                <h2><?=$row_header['ruName']?></h2>
                <?
                foreach ($rows as $item)
                {
                    ?>
                    <div class="text">
                        <?=$item['text']?>
                    </div>
                <?
                }
            }
        }
        elseif(isset($_GET['el1']))
        {
            $get_article = "SELECT * FROM `support-innovation-parser-4` WHERE `type` = '".mysql_escape_string($_GET['el1'])."' and `parent` = 0";
            $rows = Yii::app()->db->createCommand($get_article)->queryAll();

            if(!empty($rows))
            {
                $get_header = "SELECT `ruName` FROM `support-innovation-parser-4` WHERE `type` = '".mysql_escape_string($_GET['el1'])."' and `parent` = 0 LIMIT 1";
                $row_header = Yii::app()->db->createCommand($get_article)->queryRow();
                ?>
                <h2><?=$row_header['ruName']?></h2>
                <?
                foreach ($rows as $item)
                {
                    ?>
                    <div class="text">
                        <a href="/support-innovation/tenders/fcp/<?=mysql_escape_string($_GET['el1'])?>/<?=$item['id']?>/"><? if (preg_match('/^[0-9]/',$item['text'])) echo 'Конкурсы '.$item['text'].'а'; else echo $item['text']?></a>
                    </div>
                <?
                }
            }
        }
        ?>
    </div>
</div>