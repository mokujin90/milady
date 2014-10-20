<?if($model->businesses):?>
    <div class="invest-item opacity-box">
        <div class="info-block">
            <?$dateVal = new DateTime($model->create_date)?>
            <div class="date"><?=$dateVal->format('d.m.Y H:i')?></div>
            <img class="image" src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">
            <a class="comment-link" href="#"><i class="icon icon-balloon"><span>15</span></i> <?=Yii::t('main', 'коммент')?>.</a>
        </div>
        <div class="data-block">
            <div class="title">
                <div class="type"><?=Yii::t('main', 'Инвестиционный проект')?>:</div>
                <h2><?=$model->name?></h2>
            </div>
            <div class="location"><?=$model->businesses->short_description?></div>
            <div class="stats">
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Прибыль в месяц (млн. руб.)')?></div>
                    <div class="value"><?=$model->businesses->profit?></div>
                </div>
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Операционные расходы (млн. руб.)')?></div>
                    <div class="value"><?=$model->businesses->costs?></div>
                </div>
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Возраст (лет)')?></div>
                    <div class="value"><?=$model->businesses->age?></div>
                </div>
                <div class="stat-row">
                    <div class="name"><?=Yii::t('main', 'Стоимость бизнеса (млн. руб.)')?></div>
                    <div class="value"><?=$model->businesses->price?></div>
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