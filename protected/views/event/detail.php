<?
/**
 * @var $model Event
 */
?>
<?Yii::app()->clientScript->registerCssFile('/css/frontend/leaflet.css');?>
<?Yii::app()->clientScript->registerScriptFile('/js/leaflet.js', CClientScript::POS_HEAD);?>
<?php Yii::app()->clientScript->registerScript('init', 'newsPart.detail();', CClientScript::POS_READY);?>
<script>
    $( document ).ready(function() {
        var $mapWrap = $('#w-contacts-map');
        if($mapWrap.data('lat')!='' && $mapWrap.data('lon')!=''){
            var map = L.map('w-contacts-map').setView([$mapWrap.data('lat'), $mapWrap.data('lon')], 13);

            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
                maxZoom: 18,
                attribution: false,
                id: 'mapbox.streets'
            }).addTo(map);
        }

    });
</script>
<?if(false):?>
    <div class="advertisements spacer">
        <div class="advertising">
            <div class="advertising__img-wrap">
                <img src="images/advertisements/advertising-1.jpg" alt="Фото"/>
            </div><!--advertising__img-wrap-->

            <div class="advertising-text">
                <p class="advertising__title">
                    Инвестируй в будущее
                    Заголовок таргетной рекламы
                </p>
                <p class="advertising__desc">
                    Воронежская область. Петропавловский муниципальный район,
                    территория бывшего совхоза
                </p>

                <a class="advertising__link" href="#">ссылка на сайт</a>

            </div><!--advertising-text-->

        </div><!--advertising-->

        <div class="advertising">
            <div class="advertising__img-wrap">
                <img src="images/advertisements/advertising-1.jpg" alt="Фото"/>
            </div><!--advertising__img-wrap-->

            <div class="advertising-text">
                <p class="advertising__title">
                    Инвестируй в будущее
                    Заголовок таргетной рекламы
                </p>
                <p class="advertising__desc">
                    Воронежская область. Петропавловский муниципальный район,
                    территория бывшего совхоза
                </p>

                <a class="advertising__link" href="#">ссылка на сайт</a>

            </div><!--advertising-text-->

        </div><!--advertising-->

        <div class="advertising">
            <div class="advertising__img-wrap">
                <img src="images/advertisements/advertising-1.jpg" alt="Фото"/>
            </div><!--advertising__img-wrap-->

            <div class="advertising-text">
                <p class="advertising__title">
                    Инвестируй в будущее
                    Заголовок таргетной рекламы
                </p>
                <p class="advertising__desc">
                    Воронежская область. Петропавловский муниципальный район,
                    территория бывшего совхоза
                </p>

                <a class="advertising__link" href="#">ссылка на сайт</a>

            </div><!--advertising-text-->

        </div><!--advertising-->

    </div><!--advertisements-->
<?endif;?>


<h2 class="page-title"><?=Yii::t('main','Событие');?></h2>

<div class="page-wrap">
    <div class="page-wrap-content">
        <div class="article clear-fix">
            <div class="article-top">
                <span class="article__date"><?=Candy::formatDate($model->create_date);?> / <?=Candy::formatDate($model->create_date,'H:i');?></span>

            </div><!--article-top-->

            <h3 class="article__title">
                <?=$model->name;?>
            </h3>

            <p class="article__desc">
                <?=$model->announce;?>
            </p>

            <div class="article-slider">
                <ul class="article-slides">
                    <li class="article-slide">
                        <?=$model->media?Candy::preview(array($model->media, 'scale' => '629x290', 'class' => 'image-block center', 'scaleMode'=>'in')):''?>
                    </li>
                </ul>


                <?if(false):?>
                    <div class="article-slider-listing slider-listing">
                        <span class="article-slider-listing__prev slider-listing__prev"> <i></i> </span> <span class="article-slider-listing__next slider-listing__next"> <i></i> </span>

                    </div><!--article-slider-listing-->
                <?endif;?>


            </div><!--article-slider-->

            <p class="article__desc">
                <?=$model->full_text;?>
            </p>

            <?$this->renderPartial('/partial/_social',array('title'=>$model->name,'description'=>$model->announce,'img'=>isset($model->media) ? $model->media->makeWebPath() : ''))?>

            <?if(!empty($model->tags)):?>
                <div class="article-tags article-tags_last">
                    <?foreach(explode(',', $model->tags) as $tag):?>
                        <?=CHtml::link(CHtml::encode(trim($tag)), $this->createUrl('news/index', array('tag'=>trim($tag))),array('class'=>'article__tag'))?>
                    <?endforeach?>
                </div>
            <?endif?>


        </div><!--article-->


    <? $this->widget('application.widgets.comment.CommentWidget',array('objectType' => 'event', 'objectId'=>$model->id));?>

    </div><!--page-wrap-content-->

    <aside class="page-wrap-aside">
        <div class="w-contacts aside-block">
            <p class="w-contacts__title"><?=Yii::t('main','Контакты организатора');?></p>

            <ul class="w-contacts-list">
                <?if(!empty($model->contact_phone)):?>
                    <li class="w-contacts-item">
                        <span class="w-contacts-item__name"><?= Yii::t('main','Телефон')?></span>
                        <span class="w-contacts-item__desc"><?=$model->contact_phone?></span>
                    </li>
                <?endif;?>

                <?if(!empty($model->contact_email)):?>
                    <li class="w-contacts-item">
                        <span class="w-contacts-item__name">e-mail</span>
                        <span class="w-contacts-item__desc"><?=$model->contact_email?></span>
                    </li>
                <?endif;?>

                <?if(!empty($model->contact_www)):?>
                    <li class="w-contacts-item">
                        <span class="w-contacts-item__name">www</span>
                        <span class="w-contacts-item__desc"><?=$model->contact_www?></span>
                    </li>
                <?endif;?>

                <?if(!empty($model->contact_person)):?>
                    <li class="w-contacts-item">
                        <span class="w-contacts-item__name"><?= Yii::t('main','Контактное <br/> лицо')?></span>
                        <span class="w-contacts-item__desc"><?=$model->contact_person?></span>
                    </li>
                <?endif;?>

                <?if(!empty($model->datetime)):?>
                    <li class="w-contacts-item">
                        <span class="w-contacts-item__name"><?= Yii::t('main','Дата <br/> события')?></span>
                        <span class="w-contacts-item__desc"><?=Candy::formatDate($model->datetime,'d.m.Y / H:i')?></span>
                    </li>
                <?endif;?>

                <?if(!empty($model->contact_place)):?>
                    <li class="w-contacts-item">
                        <span class="w-contacts-item__name"><?= Yii::t('main','Место')?></span>
                    <span class="w-contacts-item__desc"><?=$model->contact_place?></span>
                    </li>
                <?endif;?>


            </ul>
            <div data-lat="<?=$model->lat;?>" data-lon="<?=$model->lon;?>" id="w-contacts-map" class="map"></div>

        </div><!--w-contacts-->

        <div class="aside-block registration">
            <input class="registration__field" type="text" name="registration" placeholder="введите e-mail"/>
            <button class="blue-btn registration__btn">Зарегистрироваться</button>
            <p class="registration__desc">
                Зарегистрируйтесь! <br/>
                Вам будет предоставлена возможность получать
                самые актуальные данные инвест-проектов региона.
            </p>

        </div><!--aside-block-->
        <?if(count($similarNews)>0):?>
            <div class="w-news-list aside-block">
            <p class="w-news-list__title"><?=Yii::t('main','Федеральные новости');?></p>

            <?foreach($similarNews as $news):?>
                <div class="w-news-item">
                    <?=$news->media?Candy::preview(array($news->media, 'scale' => '80x80', 'class' => 'image-block center', 'scaleMode'=>'in')):''?>

                    <div class="w-news-item-right">
                        <p class="w-news-item__date"><?=Candy::formatDate($news->create_date);?> / <small><?=Candy::formatDate($news->create_date,'H:i');?></small></p>
                        <a class="w-news-item__link" href="<?=$this->createUrl('news/detail',array('id'=>$news->id));?>">
                            <?=$news->announce;?>
                        </a>

                    </div><!--w-news-item-right-->

                </div><!--w-news-item-->
            <?endforeach;?>

        </div><!--w-news-list-->
        <?endif;;?>

    </aside><!--page-wrap-aside-->

</div><!--page-wrap-->

