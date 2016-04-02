<div class="row">
    <?foreach($articles as $article):?>
        <?$model = Candy::getIndexItem($article);?>
        <?if(!$model):?>
            <?continue;?>
        <?endif;?>
        <?$this->renderPartial('article',array('model'=>$model,'article'=>$article));?>
    <?endforeach;?>
    <?if(count($articles)<9):?>
        <?=CHtml::hiddenField('','',array('id'=>'end_article'));?>
    <?endif;?>
</div>