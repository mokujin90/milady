<?if($model->innovative):?>
    <div class="invest-item opacity-box">
        <div class="info-block">
            <?$dateVal = new DateTime($model->create_date)?>
            <div class="date"><?=$dateVal->format('d.m.Y H:i')?></div>
            <img class="image" src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">
            <a class="comment-link" href="#"><i class="icon icon-balloon"><span>15</span></i> <?=Yii::t('main', 'коммент')?>.</a>
        </div>
        <div class="data-block">
            <div class="title">
                <div class="type"><?=Yii::t('main', 'Инновационный проект')?>:</div>
                <h2><?=$model->name?></h2>
            </div>
            <div class="location"><?=$model->innovative->short_description?></div>
            <div class="stats">
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Сумма инвестиций (млн. руб)')?></div>
                    <div class="value"><?=$model->innovative->investment_sum?></div>
                </div>
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Срок окупаемости (лет)')?></div>
                    <div class="value"><?=$model->innovative->period?></div>
                </div>
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Внутренняя норма доходности (%)')?></div>
                    <div class="value"><?=$model->innovative->profit_norm?></div>
                </div>
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Чистый дисконтированный доход (млн. руб)')?></div>
                    <div class="value"><?=$model->innovative->profit_clear?></div>
                </div>
            </div>
        </div>
        <div class="map-block">
            <h2><?=$model->region->name?></h2>
            <div class="map">
                <img src="https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=218x210&maptype=roadmap&markers=color:blue%7C40.709187,-74.010894">
            </div>
            <a class="map-link" href="#"><?=Yii::t('main', 'Большая карта')?></a>
        </div>
    </div>
<?endif?>
