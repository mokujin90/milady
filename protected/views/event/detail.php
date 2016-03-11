<?
/**
 * @var $model Event
 */
?>
<?Yii::app()->clientScript->registerCssFile('/css/frontend/leaflet.css');?>
<?Yii::app()->clientScript->registerScriptFile('/js/leaflet.js', CClientScript::POS_HEAD);;?>
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


                <div class="article-slider-listing slider-listing">
                    <span class="article-slider-listing__prev slider-listing__prev"> <i></i> </span> <span class="article-slider-listing__next slider-listing__next"> <i></i> </span>

                </div><!--article-slider-listing-->

            </div><!--article-slider-->

            <p class="article__desc">
                <?=$model->full_text;?>
            </p>

            <?if(false):?>
                <div class="page-social">
                    <a class="page-social__link page-social__link_vk" href="#">
                        <i class="page-social__icon page-social__icon_vk"></i>
                        <span class="page-social__count">100</span>
                    </a>

                    <a class="page-social__link page-social__link_fb" href="#">
                        <i class="page-social__icon page-social__icon_fb"></i>
                        <span class="page-social__count">100</span>
                    </a>

                    <a class="page-social__link page-social__link_in" href="#">
                        <i class="page-social__icon page-social__icon_in"></i>
                        <span class="page-social__count">100</span>
                    </a>

                </div><!--page-social-->
            <?endif;?>


            <?if(!empty($model->tags)):?>
                <div class="article-tags article-tags_last">
                    <?foreach(explode(',', $model->tags) as $tag):?>
                        <?=CHtml::link(CHtml::encode(trim($tag)), $this->createUrl('news/index', array('tag'=>trim($tag))),array('class'=>'article__tag'))?>
                    <?endforeach?>
                </div>
            <?endif?>


        </div><!--article-->

        <div class="comment-block">
            <? $this->widget('application.widgets.comment.CommentWidget',array('objectType' => 'event', 'objectId'=>$model->id));?>

            <?if(false):?>
                <div class="center">
                    <span class="comment-block__view-add"><?=Yii::t('main','Показать ещё');?></span>
                </div><!--center-->
            <?endif;?>


        </div>

    </div><!--page-wrap-content-->

    <aside class="page-wrap-aside">
        <div class="w-contacts aside-block">
            <p class="w-contacts__title"><?=Yii::t('main','Контакты организатора');?></p>

            <ul class="w-contacts-list">
                <li class="w-contacts-item">
                    <span class="w-contacts-item__name">Телефон</span>
                    <span class="w-contacts-item__desc">+7 (495) 123-45-67</span>
                </li>

                <li class="w-contacts-item">
                    <span class="w-contacts-item__name">e-mail</span>
                    <span class="w-contacts-item__desc">info@mail</span>
                </li>

                <li class="w-contacts-item">
                    <span class="w-contacts-item__name">www</span>
                    <span class="w-contacts-item__desc">nazvanie</span>
                </li>

                <li class="w-contacts-item">
                    <span class="w-contacts-item__name">Контактное <br/> лицо</span>
                    <span class="w-contacts-item__desc">Иванов Иван Иванович</span>
                </li>

                <li class="w-contacts-item">
                    <span class="w-contacts-item__name">Дата <br/> события</span>
                    <span class="w-contacts-item__desc">20.02.2016 &nbsp;/&nbsp; 13:00</span>
                </li>

                <li class="w-contacts-item">
                    <span class="w-contacts-item__name">Место</span>
                        <span class="w-contacts-item__desc">
                            г. Москва, ул. Тверская- <br/>Ямская, д. 11
                        </span>
                </li>

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

