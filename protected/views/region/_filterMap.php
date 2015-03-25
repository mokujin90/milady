<div class="abs main">
    <div class="transparent">
        <div class="header red"><?= Yii::t('main','Общие сведения о регионе')?></div>
        <div class="fieldlist">
            <div class="item">
                <div class="label"><?= Yii::t('main','Административный центр')?></div>
                <div class="value"><?=$region->administrative_center?></div>
            </div>
            <div class="item">
                <div class="label"><?= Yii::t('main','Площадь региона')?></div>
                <div class="value"><?= Yii::t('main','{n} тыс. км',array('{n}'=>$region->area))?><sup>2</sup></div>
            </div>
            <div class="item">
                <div class="label"><?= Yii::t('main','Население региона')?></div>
                <div class="value"><?= Yii::t('main','{n} млн чел',array('{n}'=>$region->populate))?></div>
            </div>
            <div class="item">
                <div class="label"><?= Yii::t('main','Федеральный округ')?></div>
                <div class="value"><?=$region->federal_district?></div>
            </div>
            <div class="item">
                <div class="label"><?= Yii::t('main','Часовой пояс')?></div>
                <div class="value"><?=$region->times?></div>
            </div>
        </div>
        <div class="header red"><?= Yii::t('main','Контактная информация')?></div>
        <div class="fieldlist">
            <div class="item">
                <div class="label"><?= Yii::t('main','Адрес')?></div>
                <div class="value"><?=$this->model->contact_address?></div>
            </div>
            <div class="item">
                <div class="label"><?= Yii::t('main','Телефон')?></div>
                <div class="value"><span><?=$this->model->contact_phone?></span></div>
            </div>
            <div class="item">
                <div class="label"><?= Yii::t('main','Сайт')?></div>
                <div class="value"><a href="<?=$this->model->contact_site?>"><?=$this->model->contact_site?></a></div>
            </div>
        </div>
    </div>
</div>