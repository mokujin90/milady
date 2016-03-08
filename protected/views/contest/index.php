<style>
    .contest-page ul{
        padding-left: 20px;
    }
    .contest-page ul a{
        text-decoration: none !important;
    }
    .contest-page ul a:hover{
        text-decoration: underline !important;
    }
    .contest-page ul li{
        margin-bottom: 5px;
    }
    .tender-icon{
        height: 32px;
        width: 32px;
        position: absolute;
        top: 0;
        left: 0;
    }
    .tender-icon.konkursy_v_ramkah_fcp{
        background: url(https://cdn0.iconfinder.com/data/icons/kameleon-free-pack-rounded/110/Microscope-32.png) no-repeat;
    }
    .tender-icon.konkursy{
        background: url(https://cdn0.iconfinder.com/data/icons/kameleon-free-pack-rounded/110/Money-Increase-32.png) no-repeat;
    }
    .tender-icon.knpzgk{
        background: url(https://cdn0.iconfinder.com/data/icons/kameleon-free-pack-rounded/110/Clipboard-Plan-32.png) no-repeat;
    }
    .tender-icon.premii_granty{
        background: url(https://cdn0.iconfinder.com/data/icons/kameleon-free-pack-rounded/110/Medal-2-32.png) no-repeat;
    }
    .tender-icon.nanoolimpiady{
        background: url(https://cdn0.iconfinder.com/data/icons/kameleon-free-pack-rounded/110/Microchip-32.png) no-repeat;
    }
    .tenders {
        height: 50px;
        position: relative;
        padding-left: 40px;
        line-height: 36px;
        font-variant: small-caps;
    }
</style>
<div class="contest-page">
    <div id="general">
        <?
        // иначе выводим конкурсы
        if (isset($_GET['view']) && ($_GET['view'] == 'fcp') && ($_GET['el1'] == 1))
        {
            $this->renderPartial('parser_result_1');
        } elseif (isset($_GET['view']) && ($_GET['view'] == 'fcp') && ($_GET['el1'] == 2)) {
            $this->renderPartial('parser_result_2');
        } elseif (isset($_GET['view']) && ($_GET['view'] == 'fcp') && ($_GET['el1'] == 3)) {
            $this->renderPartial('parser_result_3');
        } elseif (isset($_GET['view']) && ($_GET['view'] == 'fcp') && ($_GET['el1'] == 4)) {
            $this->renderPartial('parser_result_4');
        } elseif (isset($_GET['view']) && ($_GET['view'] == 'fcp') && ($_GET['el1'] == 5)) {
            $this->renderPartial('parser_result_5');
        } elseif (isset($_GET['view']) && ($_GET['view'] == 'fcp') && ($_GET['el1'] == 6)) {
            $this->renderPartial('parser_result_6');
        } elseif (isset($_GET['view']) && $_GET['view'] != 'type') {
            // если выводим полный текстe
            $get_article = "SELECT * FROM `support-innovation` WHERE `type` = 'k' and `engName` = '" . mysql_escape_string($_GET['view']) . "'";
            $row_article = Yii::app()->db->createCommand($get_article)->queryRow();

            if ($row_article) {
                ?>

                <div class="crumbs">
                    <a href="/">Главная</a> &rarr; <a href="/">Поддержка инноваций</a> &rarr; <a href="/support-innovation/tenders/">Конкурсы</a> &rarr; <?= $row_article[3] ?>
                </div>

                <h2><?= $row_article[3] ?></h2>
                <div class="text">
                    <?= $row_article[5] ?>
                </div>
            <?
            } else {
                echo "Статья не найдена.";
            }
        } elseif (isset($_GET['view']) && $_GET['view'] == 'type' && isset($_GET['el1'])) {
            $links = array('konkursy', 'konkursy_v_ramkah_fcp', 'premii_granty', 'nanoolimpiady');
            $links_name = array(/*'konkursy' => 'Конкурсы', */'konkursy_v_ramkah_fcp' => 'Конкурсы в рамках ФЦП', 'knpzgk' => 'Конкурсы на право заключения государственных контрактов', 'premii_granty' => 'Премии, гранты', 'nanoolimpiady' => 'Наноолимпиады');
            if (in_array($_GET['el1'], $links)) {
                $this->breadcrumbs = array('Конкурсы' => $this->createUrl('/support-innovation/tenders/'), $links_name[$_GET['el1']]);
                ?>
                <div class="main bread-block">
                    <?$this->renderPartial('/partial/_breadcrumbs')?>
                </div>
                <div class="content list-columns columns single-column">
                <div class="full-column opacity-box">

                <h2><?= $links_name[$_GET['el1']]; ?></h2>
                <?
                if ($_GET['el1'] == 'konkursy') {
                    $get_category = "SELECT DISTINCT `category` FROM `support-innovation` WHERE `type` = 'k'";
                    $rows = Yii::app()->db->createCommand($get_category)->queryAll();

                    if (!empty($rows)) {
                        $i = 1;
                        foreach ($rows as $item) {
                            $get_articles = "SELECT `ruName`, `engName` FROM `support-innovation` WHERE `type` = 'k' and `category` = '" . $item['category'] . "'";
                            $row_articles = Yii::app()->db->createCommand($get_articles)->queryAll();
                            if (!empty($row_articles)) {
                                ?>
                                <ul id="<?= $i ?>" class="mt15">
                                    <?
                                    foreach ($row_articles as $item_art) {
                                        ?>
                                        <li><a href="/support-innovation/tenders/<?= $item_art['engName'] ?>/"
                                               style="text-decoration:underline;"><?= $item_art['ruName'] ?></a></li>
                                    <?
                                    }
                                    ?>
                                </ul>
                            <?
                            }
                            $i++;
                        }
                    }
                } elseif ($_GET['el1'] == 'konkursy_v_ramkah_fcp') {
                    ?>
                    <ul id="p1" class="mt15" >
                        <li><a class="fcp" style="background-position:0px -0px;" href="/support-innovation/tenders/fcp/1/"
                               style="text-decoration:underline;">Исследования и разработки по приоритетным направлениям
                                развития научно-технологического комплекса России на 2007—2013 годы</a></li>
                        <li><a class="fcp" style="background-position:0px -65px;" href="/support-innovation/tenders/fcp/2/"
                               style="text-decoration:underline;">Развитие инфраструктуры наноиндустрии в Российской
                                Федерации на 2008—2011 годы</a></li>
                        <li><a class="fcp" style="background-position:0px -120px;" href="/support-innovation/tenders/fcp/3/"
                               style="text-decoration:underline;">Научные и педагогические кадры инновационной России на
                                2009-2013 годы</a></li>
                        <li><a class="fcp" style="background-position:0px -185px;" href="/support-innovation/tenders/fcp/4/"
                               style="text-decoration:underline;">Развитие фармацевтической и медицинской промышленности
                                Российской Федерации на период до 2020 года и дальнейшую перспективу</a></li>
                    </ul>
                <?
                } elseif ($_GET['el1'] == 'premii_granty') {
                    $get_premii = "SELECT * FROM `support-innovation-parser-5` WHERE `type` = 2 ORDER BY `id`";
                    $rows = Yii::app()->db->createCommand($get_premii)->queryAll();

                    if (!empty($rows)) {
                        ?>
                        <ul id="p1" class="mt15">
                            <?
                            foreach ($rows as $item) {
                                ?>
                                <li><a href="/support-innovation/tenders/fcp/5/<?= $item['id'] ?>/"
                                       style="text-decoration:underline;"><?= $item['ruName'] ?></a></li>
                            <?
                            }
                            ?>
                        </ul>
                    <?
                    }
                } elseif ($_GET['el1'] == 'nanoolimpiady') {
                    $get_premii = "SELECT * FROM `support-innovation-parser-5` WHERE `type` = 4 ORDER BY `id`";
                    $rows = Yii::app()->db->createCommand($get_premii)->queryAll();

                    if (!empty($rows)) {
                        ?>
                        <ul id="p1" class="mt15">
                            <?
                            foreach ($rows as $item) {
                                ?>
                                <li><a href="/support-innovation/tenders/fcp/5/<?= $item['id'] ?>/"
                                       style="text-decoration:underline;"><?= $item['ruName'] ?></a></li>
                            <?
                            }
                            ?>
                        </ul>
                    <?
                    }
                }?>
                </div>
                </div>
           <? }
        }
        else{
        $links = array(/*'konkursy' => 'Конкурсы', */'konkursy_v_ramkah_fcp' => 'Конкурсы в рамках ФЦП', 'knpzgk' => 'Конкурсы на право заключения государственных контрактов', 'premii_granty' => 'Премии, гранты', 'nanoolimpiady' => 'Наноолимпиады');
        $i = 0;
            $this->breadcrumbs = array('Конкурсы');
            ?>
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        <div class="content list-columns columns single-column">
            <div class="full-column opacity-box">
        <?foreach ($links as $key => $row) {
        ?>

                <div class="tenders">
                    <div class="tender-icon <?=$key?>"></div>
                    <?
                    if ($key == 'knpzgk') {
                        ?>
                        <a href="/support-innovation/tenders/fcp/6/"><?= $row; ?></a>
                    <?
                    } else {
                        ?>
                        <a href="/support-innovation/tenders/type/<?= $key; ?>"><?= $row; ?></a>
                    <?
                    }
                    ?>
                </div>
        <?
            $i++;
        }?>
            </div>
        </div>

        <?}?>

    </div>
</div>