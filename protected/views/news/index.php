<?
/**
 * @var $articleArray array
 * @var $exclude array
 * @var $title string
 */
?>
<? Yii::app()->clientScript->registerScript('init', 'newsPart.init();', CClientScript::POS_READY); ?>

<style>
    .news-date-block{
        height: 30px;
    }
    .date-label{
        width: 85px;
        display: inline-block;
        vertical-align: top;
    }
</style>
<?if(false): //баннеры?>
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


<h2 class="page-title"><?=$title;?></h2>
    <div class="news-ftr clear-fix">
        <form action="<?=$this->createUrl('news/index')?>" method="get">
            <?=CHtml::hiddenField('type',$type);?>
            <div class="news-ftr-date">
                <p class="news-ftr-date__selected">
                    <span class="news-ftr-date__from date-label"><?=Yii::app()->request->getParam('from','');?></span>
                    <span class="news-ftr-date__colon">-</span>
                    <span class="news-ftr-date__to date-label"><?=Yii::app()->request->getParam('to','');?></span>
                </p>

                <div class="news-date-block">

                    <div class="news-date-select">
                        <span><?=Yii::t('main','с');?></span>
                        <label class="news-date-select__from">
                            <?$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'name'=>'from',
                                'id'=>'datepicker-from',
                                'value'=>Yii::app()->request->getParam('from',''),
                                'language'=>Yii::app()->language,
                                "options"=>array(
                                    "onSelect"=>new CJavaScriptExpression("function( selectedDate ) { $('.news-ftr-date__from').text(selectedDate);}"),
                                    'beforeShow'=> new CJavaScriptExpression("function(input, inst){
                                    var calendar = inst.dpDiv;
                                    /*setTimeout(function() {
                                        calendar.position({
                                            my: 'left top',
                                            at: 'left bottom',
                                            collision: 'none',
                                            of: input
                                        });
                                    }, 1);*/
                                    }")
                                ),
                            ));?>
                            <i class="icon-date"></i>
                        </label>
                        <span><?=Yii::t('main','по');?></span>
                        <label class="news-date-select__to">
                            <?$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'name'=>'to',
                                'id'=>'datepicker-to',
                                'value'=>Yii::app()->request->getParam('to',''),
                                'language'=>Yii::app()->language,
                                "options"=>array(
                                    "onSelect"=>new CJavaScriptExpression("function( selectedDate ) { $('.news-ftr-date__to').text(selectedDate);}"),
                                    'beforeShow'=> new CJavaScriptExpression("function(input, inst){
                                    var calendar = inst.dpDiv;
                                    /*setTimeout(function() {
                                        calendar.position({
                                            my: 'right top',
                                            at: 'right bottom',
                                            collision: 'none',
                                            of: input
                                        });
                                    }, 1);*/
                                    }")
                                ),
                            ));?>
                            <i class="icon-date"></i>
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" class="blue-btn news-ftr__search"><?=Yii::t('main','Поиск');?></button>
        </form>
    </div>


<div class="news-list">
    <?foreach($articleArray as $article):?>
        <?$model = Candy::getIndexItem($article);?>
        <?if(!$model):?>
            <?continue;?>
        <?endif;?>
        <?$this->renderPartial('article',array('model'=>$model,'article'=>$article,'type'=>$type));?>
    <?endforeach;?>

</div><!--news-list-->
<?if(count($articleArray)>8):?>
<div class="ajax-more-article"></div>
    <form class="more-btn-wrap" action="<?=$this->createUrl('news/more')?>">
        <?=CHtml::hiddenField('page',0)?>
        <?=CHtml::hiddenField('excluded',json_encode($excluded))?>
        <?if(Yii::app()->request->getParam('tag',false)):?>
            <?=CHtml::hiddenField('tag',Yii::app()->request->getParam('tag'))?>
        <?endif;?>
        <?if(Yii::app()->request->getParam('region',false)):?>
            <?=CHtml::hiddenField('region',Yii::app()->request->getParam('region'))?>
        <?endif;?>
        <?if(Yii::app()->request->getParam('from',false)):?>
            <?=CHtml::hiddenField('from',Yii::app()->request->getParam('from'))?>
        <?endif;?>
        <?if(Yii::app()->request->getParam('to',false)):?>
            <?=CHtml::hiddenField('to',Yii::app()->request->getParam('to'))?>
        <?endif;?>
        <?if(Yii::app()->request->getParam('type',false)):?>
            <?=CHtml::hiddenField('type',Yii::app()->request->getParam('type'))?>
        <?endif;?>
        <?if($isMoreLimit):?>
            <button id="ajax-load-article" data-page="0" class="news-list__add-btn"><?=Yii::t('main','Показать еще');?></button>
        <?endif;?>

    </form>
<?endif;?>

<?$this->renderPartial('../partial/_register', array('class' => 'registration_one'))?>
