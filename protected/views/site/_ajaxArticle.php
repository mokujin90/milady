<div class="row">
    <?foreach($articles as $article) {
        if($model = Candy::getIndexItem($article)) { ?>
            <div class="articles-item articles-item_half articles-item_half_mr articles-item_half_big">
                <?=$model->media?Candy::preview(array($model->media, 'scale' => '311x145', 'upScale' => '1')):''?>
                <span class="articles-item__tag articles-item__tag_<?=$article['object']?>"><?=$model->getLabel()?></span>
                <p class="articles-item__date"><?=Candy::formatDate($model->create_date, 'd/m')?></p>
                <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(),array('class'=>'articles-item__preview articles-item__preview_small'))?>
                <p class="articles-item__text"><?=$model->announce?></p>
            </div><!--articles-item-->
    <?}}?>
</div>