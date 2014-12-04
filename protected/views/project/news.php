<div class="news-page">
    <div id="general">
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        <div class="content list-columns columns">
            <div class="full-column">
                <?foreach($model->news as $item):?>
                    <div class="news-item opacity-box">
                        <div class="data">
                            <div class="date"><?=Candy::formatDate($item->create_date)?></div>
                            <?=$item->media?Candy::preview(array($item->media, 'scale' => '100x100', 'class' => 'image')):''?>
                            <?=CHtml::link(CHtml::encode($item->name), $item->createUrl(), array('class' => 'name'))?>
                            <div class="announce">
                                <?=CHtml::encode($item->announce)?>
                            </div>
                        </div>
                    </div>
                <?endforeach?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>