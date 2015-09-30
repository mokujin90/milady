<div class="analitycs-page">
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
                        <?=$model->media?Candy::preview(array($model->media, 'scale' => '960x400', 'class' => 'image-block center', 'scaleMode'=>'in')):''?>
                        <div class="full-text">
                            <?=$model->full_text//CHtml::encode($model->full_text)?>
                        </div>
                        <?if(!empty($model->tags)):?>
                            <div class="tags">
                                <b>Теги:</b>
                                <?foreach(explode(',', $model->tags) as $tag):?>
                                <?=CHtml::link(CHtml::encode(trim($tag)), $this->createUrl('analytics/index', array('tag'=>trim($tag))))?>
                                <?endforeach?>
                            </div>
                        <?endif?>
                        <?if($model->file):?>
                            <div class="document-list">
                                <span class="r r-file-pdf"></span>
                                <?= CHtml::link('Прикрепленный документ',$model->file->makeWebPath(),array('style'=>'float: left;', 'class' => 'link'))?>
                            </div>
                            <br>
                        <?endif?>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<style>
    .document-list {
        padding: 10px 0 0 63px;
        position: relative;
        margin-bottom: 18px;
        min-height: 51px;
    }
    .document-list a{
        font-weight: bold;
        color: #26538e;
    }
    .r-file-pdf {
        width: 40px;
        height: 45px;
        background-position: -243px -291px;
    }
    .r {
        position: absolute;
        left: 0;
        top: 5px;
        background-image: url(/images/markup/region_sprite.png);
        background-repeat: no-repeat;
        display: inline-block;
    }
</style>