<div class="news-page">
    <div id="general">
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        <div class="content list-columns columns">
            <div class="full-column">
                <?foreach($models as $model):?>
                    <div class="news-item opacity-box">
                        <div class="data">
                            <div class="date"><?=Candy::formatDate($model->create_date)?></div>
                            <?=$model->media?Candy::preview(array($model->media, 'scale' => '200x100', 'class' => 'image')):''?>
                            <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(), array('class' => 'name'))?>
                            <div class="announce">
                                <?=CHtml::encode($model->announce)?>
                            </div>
                        </div>
                    </div>
                <?endforeach?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>