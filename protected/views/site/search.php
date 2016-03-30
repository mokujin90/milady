<?php Yii::app()->clientScript->registerScript('sort', 'sort.init();', CClientScript::POS_READY);?>
<?php Yii::app()->clientScript->registerScript('searchPart', 'searchPart.init();', CClientScript::POS_READY);?>
<h2 class="page-title"><?=Yii::t('main','Результаты поиска');?></h2>
<div class="search-page">
    <form class="sort-form" action="<?=$this->createUrl('site/search');?>">
        <?=CHtml::hiddenField('sort',$sort,array('class'=>'current-select'));?>
        <div class="search-input-wrap">
            <div class="search-input">
                <?=CHtml::textField('search',$search,array('class'=>'form-control'));?>
                <div class="crest"></div>
            </div>
            <div class="search-button">
                <?=CHtml::link('<i class="icon icon-link-search"></i>'.Yii::t('main','Поиск'),'#',array('class'=>'blue-btn','id'=>'submit-search'));?>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div class="search-param">
            <div class="search-count">
                <?=Yii::t('main','Найдено результатов: примерно')." ".$count;?>
            </div>
            <div class="sort sort-wrapper">
                <div class="select select_middle" data-name="sort" style="float: right;">
                    <?$this->widget('crud.dropDownList',
                        array('name'=>'sort','selected'=>$sort,'elements'=>array(
                            'date_up' => Yii::t('main', 'По дате')." &uarr;",
                            'date_down' => Yii::t('main', 'По дате')." &darr;",
                            'view_up' => Yii::t('main', 'По просмотрам')." &uarr;",
                            'view_down' => Yii::t('main', 'По просмотрам')." &darr;",
                        ),
                            'options'=>array(
                                'placeholder' => Yii::t('main','Упорядочить по'),
                                'multiple'=>false,
                            ))
                    );?>
                </div>
            </div>
        </div>
    </form>
    <?if(count($data)>0):?>
        <div class="page-wrap">
            <div class="page-wrap-content">
                <div class="article clear-fix">
                    <?foreach($data as $item):?>
                        <?$imageModel = $this->getSearchImage($item);?>
                        <div class="item <?if(is_null($imageModel)):?>no-image<?endif;?>">

                            <?if($imageModel):?>
                                <div class="project-left">
                                    <div class="project__img-wrap">
                                        <?=Candy::preview(array($imageModel,'scale'=>'102x102'));?>
                                    </div>
                                </div>
                            <?endif;?>
                            <div class="project-right">
                                <div class="project__title"><?=CHtml::link($item['name'],$this->getSearchUrl($item),array('target'=>'_blank'));?></div>
                                <div class="project__desc"><?=$item['text'];?></div>
                            </div>
                        </div>
                    <?endforeach?>
                </div>
            </div>
        </div>
    <?endif;?>
    <?$this->widget('CLinkPager', array('pages'=>$pages));?>
</div>
