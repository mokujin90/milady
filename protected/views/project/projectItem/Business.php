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
            <div class="location"><?=$model->businesses->short_description?></div>
            <div class="stats">
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Сумма инвестиций (млн. руб)')?></div>
                    <div class="value"><?=$model->investment_sum?></div>
                </div>
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Срок окупаемости (лет)')?></div>
                    <div class="value"><?=$model->period?></div>
                </div>
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Внутренняя норма доходности (%)')?></div>
                    <div class="value"><?=$model->profit_norm?></div>
                </div>
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Чистый дисконтированный доход (млн. руб)')?></div>
                    <div class="value"><?=$model->profit_clear?></div>
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
