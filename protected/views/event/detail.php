<div class="news-page">
    <div id="general">
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        <div class="content list-columns columns">
            <div class="full-column">
                <div class="news-item opacity-box">
                    <div class="data">
                        <div class="date"><?=Candy::formatDate($model->create_date)?></div>
                        <div class="name"><?=CHtml::encode($model->name)?></div>
                        <div class="announce">
                            <i><?=CHtml::encode($model->announce)?></i>
                        </div>
                        <?=$model->media?Candy::preview(array($model->media, 'scale' => '960x400', 'class' => 'image-block', 'scaleMode'=>'in')):''?>
                        <div class="full-text">
                            <?=CHtml::encode($model->full_text)?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>