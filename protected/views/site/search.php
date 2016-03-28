<?php Yii::app()->clientScript->registerScript('sort', 'sort.init();', CClientScript::POS_READY);?>
<?php Yii::app()->clientScript->registerScript('searchPart', 'searchPart.init();', CClientScript::POS_READY);?>
<style>
    .search-page .page-wrap-content{
        width: 100%;
    }
    .search-page .project__img-wrap{
        margin: auto;
    }

    .search-page .search-input-wrap{
        margin-bottom: 13px;
    }

    .search-page .search-count{
        font-size: 14px;
        color: #333333;
        line-height: 120%;
        float: left;
        margin-top: 5px;
    }
    .search-page .item{
        margin-bottom: 30px;
    }

    .search-page .project__desc{
        margin-top: 10px;
    }

    .search-page .search-input{
        display: inline-block;
        width: 84%;
    }
    .search-page .search-input input{
        width: 100%;
        height: 30px;
        background-color: #ffffff;
        border: 1px solid #cccccc;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -webkit-transition: border linear 0.2s, box-shadow linear 0.2s;
        -moz-transition: border linear 0.2s, box-shadow linear 0.2s;
        -ms-transition: border linear 0.2s, box-shadow linear 0.2s;
        -o-transition: border linear 0.2s, box-shadow linear 0.2s;
        transition: border linear 0.2s, box-shadow linear 0.2s;
        padding-left: 7px;
    }
    .search-page .search-button{
        display: inline-block;
        float: right;
    }
    .search-page .search-button .blue-btn{
        width: 152px;
        line-height: inherit;
        height: 23px;
        padding-top: 8px;
        position: relative;
        box-sizing: content-box;
    }
    .search-page .search-button .blue-btn:active{
        padding-top: 10px;
        height: 21px;
    }
    .search-page .search-button .blue-btn .icon-link-search{
        position: absolute;
        left: 10px;
    }
    .search-page .search-param{
        margin-bottom: 50px;
    }
    .search-page .project-right{
        width: 830px;
    }
    .search-page .item.no-image .project-right{
        width: 974px;
    }
    .search-page .iipPager{
        text-align: center;
    }
</style>
<h2 class="page-title"><?=Yii::t('main','Результаты поиска');?></h2>
<div class="search-page">
    <form class="sort-form" action="<?=$this->createUrl('site/search');?>">
        <?=CHtml::hiddenField('sort',$sort,array('class'=>'current-select'));?>
        <div class="search-input-wrap">
            <div class="search-input">
                <?=CHtml::textField('search',$search,array('class'=>'form-control'));?>
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
    <?$this->widget('CLinkPager', array('pages'=>$pages));?>
</div>
