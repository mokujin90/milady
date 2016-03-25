<?if($model->bgMedia){?>
<style>
    .profile-top {
        background: url(<?=Candy::preview(array($model->bgMedia,'scale'=>'1000x263', 'scaleMode' => 'out', 'src_only' => 1, ))?>) #ccc no-repeat center top;
    }
</style>
<?}?>

<div class="profile">
    <div class="profile-top">
        <div class="profile-top-left">
            <h1 class="profile-top__name"><?=$model->getInvestorName()?></h1>
            <p class="profile-top__type"><?=Yii::t('main', 'Инвестор')?></p>
            <?if($model->id != Yii::app()->user->id) {?>
                <?if(Yii::app()->user->isGuest) {?>
                    <?=CHtml::link(Yii::t('main', 'Написать сообщение'), '#auth-content', array('class' => 'blue-btn profile-top__btn auth-fancy'))?>
                <?}else{?>
                    <?=CHtml::link(Yii::t('main', 'Написать сообщение'), array('message/create' ,'to' => $model->id), array('class' => 'blue-btn profile-top__btn'))?>
                <?}?>
            <?}?>
        </div><!--profile-top-left-->

        <div class="profile-top-right">
            <ul class="profile-dates">
                <li class="profile-date profile-date__reg">
                    <span class="profile-date__type"><?=Yii::t('main', 'Дата регистрации')?></span>
                    <span class="profile-date__desc"><?=Candy::formatDate($model->create_date)?></span>
                </li>
                <?if(!empty($model->last_login_date)){?>
                <li class="profile-date profile-date__reg">
                    <span class="profile-date__type"><?=Yii::t('main', 'Последнее посещение')?></span>
                    <span class="profile-date__desc"><?=Candy::formatDate($model->last_login_date)?></span>
                </li>
                <?}?>
            </ul>

            <!--span class="profile__ac-type profile__ac-type_pro">PRO</span-->

            <div class="profile__user-photo">
                <?=$model->logo ? Candy::preview(array($model->logo, 'scale' => '187x157')):'<img src="/images/frontend/user/user-default.png" alt="Фото">'?>
            </div><!--profile__user-photo-->

        </div><!--profile-top-right-->

    </div><!--profile-top-->

    <div class="profile-block">
        <ul class="profile-data profile-data_first">
            <?if(!empty($model->name)){?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'ФИО')?></span>
                    <span class="profile-data__desc">
                        <?=CHtml::encode($model->name)?>
                    </span>
            </li>
            <?}?>
            <?if(!empty($model->region)){?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'Регион')?></span>
                    <span class="profile-data__desc">
                        <?=CHtml::encode($model->region->name)?>
                    </span>
            </li>
            <?}?>
            <?if(!empty($model->contact_address)){?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'Адрес')?></span>
                    <span class="profile-data__desc">
                        <?=CHtml::encode($model->contact_address)?>
                    </span>
            </li>
            <?}?>
            <?if(!empty($model->post)){?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'Должность')?></span>
                    <span class="profile-data__desc">
                        <?=CHtml::encode($model->post)?>
                    </span>
            </li>
            <?}?>
            <?if(!empty($model->phone)){?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'Телефон')?></span>
                    <span class="profile-data__desc">
                        <?=CHtml::encode($model->phone)?>
                    </span>
            </li>
            <?}?>
        </ul>

        <ul class="profile-data profile-data_second">
            <?if(!empty($model->contact_email)){?>
            <li>
                <span class="profile-data__name">E-mail</span>
                    <span class="profile-data__desc">
                        <?=CHtml::encode($model->contact_email)?>
                    </span>
            </li>
            <?}?>
            <?if(!empty($model->user2Regions)){?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'Какие регионы интересны')?></span>
                    <span class="profile-data__desc">
                        <?=implode(', ', CHtml::listData($model->user2Regions, 'id', function($data){return $data->region->name;}));?>
                    </span>
            </li>
            <?}?>
            <?if(!empty($model->investorIndustry)){?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'Отрасль')?></span>
                    <span class="profile-data__desc profile-data__desc_imp">
                        <?=CHtml::encode($model->investorIndustry->name)?>
                    </span>
            </li>
            <?}?>
            <?if(!empty($model->investor_finance_amount)){?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'Сумма финансирования')?></span>
                <span class="profile-data__desc">
                    <?=Candy::formatNumber($model->investor_finance_amount)?> <i class="icon icon-rub-black"></i>
                </span>
            </li>
            <?}?>
        </ul>

    </div><!--profile-block-->
    <?if(!empty($model->company_name)){?>
    <div class="profile-block">
        <h2 class="profile-block__title">
            <i class="icon icon-prof-1"></i>
            <span><?=Yii::t('main', 'Компания')?></span>
        </h2>

        <ul class="profile-data profile-data_first">
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'Наименование')?></span>
                    <span class="profile-data__desc">
                        <?=CHtml::encode((empty($model->company_form) ? '' : ($model->company_form . " ")) . $model->company_name);?>
                    </span>
            </li>
            <?if(!empty($model->company_address)){?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'Адрес компании')?></span>
                    <span class="profile-data__desc">
                        <?=CHtml::encode($model->company_address)?>
                    </span>
            </li>
            <?}?>

            <?if(!empty($model->companyIndustry)) {?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'Сфера')?></span>
                    <span class="profile-data__desc">
                        <?=CHtml::encode($model->companyIndustry->name)?>
                    </span>
            </li>
            <?}?>
        </ul>

        <ul class="profile-data profile-data_second">
            <?if(!empty($model->company_site)) {?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'Web сайт')?></span>
                    <span class="profile-data__desc">
                        <?=CHtml::encode($model->company_site)?>
                    </span>
            </li>
            <?}?>
            <?if(!empty($model->inn)) {?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'ИНН')?></span>
                    <span class="profile-data__desc">
                        <?=CHtml::encode($model->inn)?>
                    </span>
            </li>
            <?}?>
            <?if(!empty($model->ogrn)) {?>
            <li>
                <span class="profile-data__name"><?=Yii::t('main', 'ОГРН')?></span>
                    <span class="profile-data__desc">
                        <?=CHtml::encode($model->ogrn)?>
                    </span>
            </li>
            <?}?>
        </ul>

    </div><!--profile-block-->
    <?if(!empty($model->company_description)) {?>
    <div class="profile-block">
        <h2 class="profile-block__title profile-block__title_fix">
            <i class="icon icon-prof-2"></i>
            <span><?=Yii::t('main', 'Описание компании')?></span>
        </h2>

        <p class="profile-desc__name"><?=Yii::t('main', 'Общая информация о компании')?></p>
        <p class="profile-desc__desc">
            <?=CHtml::encode($model->company_description)?>
        </p>
    </div><!--profile-block-->
    <?}?>
    <?}?>


</div><!--profile-->
<?$this->renderPartial('../partial/_register', array('class' => 'registration_one'))?>