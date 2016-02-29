<?if($model->businesses):?>
    <div class="invest-item opacity-box">
        <div class="info-block">
            <?$dateVal = new DateTime($model->create_date)?>
            <div class="date"><?=$dateVal->format('d.m.Y H:i')?></div>
            <?=$model->logo?Candy::preview(array($model->logo, 'scale' => '100x100', 'class' => 'image')):'<img class="image" src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">'?>
            <a class="comment-link" href="<?=$this->createUrl('project/detail',array('id'=>$model->id,'#'=>'comments'))?>"><i class="icon icon-balloon"><span><?=$model->commentCount?></span></i> <?=Yii::t('main', 'коммент')?>.</a>
        </div>
        <div class="data-block">
            <div class="title">
                <div class="type"><?=Yii::t('main', 'Продажа бизнеса')?>:</div>
                <h2><?=CHtml::link($model->name, $this->createUrl('project/detail', array('id' => $model->id)), array('title' => $model->name))?></h2>
            </div>
            <div class="location"><?=CHtml::encode($model->businesses->short_description)?></div>
            <div class="stats">
                <?$tmp = Project::getIndustryTypeDrop()?>
                <?if(isset($tmp[$model->industry_type])):?>
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Отрасль')?></div>
                    <div class="value wide"><?=$tmp[$model->industry_type]?></div>
                </div>
                <?endif?>

                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Стоимость бизнеса (млн руб)')?></div>
                    <div class="value"><?=$model->businesses->price?></div>
                </div>
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Доля (%)')?></div>
                    <div class="value"><?=$model->businesses->share?></div>
                </div>
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Местоположение')?></div>
                    <div class="value wide"><?=$model->region->name?></div>
                </div>
            </div>
        </div>
        <div class="map-block">
            <h2><?=$model->region->name?></h2>
            <div class="map">
                <?php $this->widget('Map', array(
                    'projects'=>array($model),
                    'onlyImage'=>true,
                    'htmlOptions'=>array(
                        'width'=>218,
                        'height'=>210
                    )
                )); ?>            </div>
            <a class="map-link" href="<?=$this->createUrl('project/detail',array('id'=>$model->id,'#'=>'map'))?>"><?=Yii::t('main', 'Большая карта')?></a>
        </div>
    </div>
<?endif?>
