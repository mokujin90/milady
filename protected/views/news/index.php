<?
/**
 * @var $articleArray array
 * @var $exclude array
 */
?>
<? Yii::app()->clientScript->registerScript('init', 'newsPart.init();', CClientScript::POS_READY); ?>

<h2 class="page-title"><?=Yii::t('main','Новости. Событие. Аналитка');?></h2>
<form action="<?=$this->createUrl('news/index')?>" method="get">
    <div class="news-ftr clear-fix">
        <div class="news-ftr-date">
            <p class="news-ftr-date__selected">
                <span class="news-ftr-date__from">
                    <?$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'name'=>'from',
                        'id'=>'datepicker-from',
                        'value'=>Yii::app()->request->getParam('from','')
                    ));?>
                </span>
                <span class="news-ftr-date__colon">-</span>
                <span class="news-ftr-date__to">
                    <?$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'name'=>'to',
                        'id'=>'datepicker-to',
                        'value'=>Yii::app()->request->getParam('to','')
                    ));?>
                </span>
            </p>
        </div><!--news-ftr-date-->
        <button type="submit" class="blue-btn news-ftr__search">Поиск</button>
    </div><!--news-ftr-->
</form>
<div class="news-list">
    <?foreach($articleArray as $article):?>
        <?$model = Candy::getIndexItem($article);?>
        <?if(!$model):?>
            <?continue;?>
        <?endif;?>
        <?$this->renderPartial('article',array('model'=>$model,'article'=>$article));?>
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
        <button id="ajax-load-article" data-page="0" class="news-list__add-btn"><?=Yii::t('main','Показать еще');?></button>
    </form>
<?endif;?>

<?$this->renderPartial('../partial/_register', array('class' => 'registration_one'))?>
