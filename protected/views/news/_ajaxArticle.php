<div class="row">
    <?foreach($articles as $article):?>
        <?$model = Candy::getIndexItem($article);?>
        <?if(!$model):?>
            <?continue;?>
        <?endif;?>
        <?$this->renderPartial('article',array('model'=>$model,'article'=>$article));?>
    <?endforeach;?>
</div>