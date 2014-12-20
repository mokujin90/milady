<div class="search-page">
    <div id="general">
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        <div class="content list-columns columns">
            <div class="main-column">

                <?$this->widget('CLinkPager', array('pages'=>$pages,));?>
                <?if(!count($data)):?>
                    <div class="feed-item opacity-box">
                        <div class="feed-data">
                            Ничего не найдено по запросу "<?=$filter->search?>"
                        </div>
                    </div>
                <?endif?>
                <?foreach($data as $item):?>
                    <div class="feed-item opacity-box">
                        <div class="top-stick"><?=SiteSearch::$type[$item['object_name']]?></div>
                        <div class="date"><?=Candy::formatDate($item['create_date'], 'd.m.Y H:m')?></div>
                        <a href="<?=$item['model']->createUrl()?>"><h2><?=$item['name']?></h2></a>
                        <hr>
                        <!--div class="feed-info">
                            <?if($item['object_name'] == 'project_comment'):?>
                                <div class="info-row">Добавлен новый комментарий</div>
                            <?endif?>
                            <?if($item['object_name'] == 'project_news'):?>
                                <div class="info-row">Добавлена новая <?=CHtml::link('новость', $item['alt_model']->createUrl())?></div>
                            <?endif?>
                        </div-->
                        <div class="feed-data">
                            <?=$item['text']?>
                        </div>
                    </div>
                <?endforeach?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>