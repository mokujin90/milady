<div class="abs main region-info-abs">
    <div class="transparent">
        <div class="header red"><?= Yii::t('main','Общие сведения о регионе')?></div>
        <div class="fieldlist">
            <?if(!empty($region->administrative_center)):?>
            <div class="item">
                <div class="label"><?= Yii::t('main','Административный центр')?></div>
                <div class="value"><?=$region->administrative_center?></div>
            </div>
            <?endif?>
            <?if(!empty($region->area)):?>
            <div class="item">
                <div class="label"><?= Yii::t('main','Площадь региона')?></div>
                <div class="value"><?= Yii::t('main','{n} км',array('{n}'=>number_format($region->area,0,',',' ')))?><sup>2</sup></div>
            </div>
            <?endif?>
            <?if(!empty($region->populate)):?>
            <div class="item">
                <div class="label"><?= Yii::t('main','Население региона')?></div>
                <div class="value"><?= Yii::t('main','{n} чел.',array('{n}'=>number_format($region->populate,0,',',' ')))?></div>
            </div>
            <?endif?>
            <?if(!empty($region->federal_district)):?>
            <div class="item">
                <div class="label"><?= Yii::t('main','Федеральный округ')?></div>
                <div class="value"><?=$region->federal_district?></div>
            </div>
            <?endif?>
            <?if(!empty($region->times)):?>
            <div class="item">
                <div class="label"><?= Yii::t('main','Часовой пояс')?></div>
                <div class="value"><?=$region->times?></div>
            </div>
            <?endif?>
        </div>
        <?if(!empty($this->model->contact_phone) ||
            !empty($this->model->contact_phone) ||
            !empty($this->model->contact_site)
        ):?>
        <div class="header red"><?= Yii::t('main','Контактная информация')?></div>
        <div class="fieldlist">
            <?if(!empty($this->model->contact_address)):?>
            <div class="item">
                <div class="label"><?= Yii::t('main','Адрес')?></div>
                <div class="value"><?=$this->model->contact_address?></div>
            </div>
            <?endif?>
            <?if(!empty($this->model->contact_phone)):?>
            <div class="item">
                <div class="label"><?= Yii::t('main','Телефон')?></div>
                <div class="value"><span><?=$this->model->contact_phone?></span></div>
            </div>
            <?endif?>
            <?if(!empty($this->model->contact_site)):?>
            <div class="item">
                <div class="label"><?= Yii::t('main','Сайт')?></div>
                <div class="value"><a href="<?=$this->model->contact_site?>"><?=$this->model->contact_site?></a></div>
            </div>
            <?endif?>
        </div>
        <?endif?>
    </div>
</div>