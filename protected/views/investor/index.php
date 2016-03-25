<?php
/**
 * @var RegionController $this
 * @var RegionFilter $filter
 * @var CActiveForm $form
 */
//Yii::app()->clientScript->registerScript('init', 'regionListPart.init();', CClientScript::POS_READY);
?>
<?php Yii::app()->clientScript->registerScript('init', 'sort.init();', CClientScript::POS_READY);?>
<div class="advertisements spacer"></div><!--advertisements-->

<div class="projects-wrap">
    <h2 class="page-title"><?=Yii::t('main', 'Инвесторы')?></h2>

    <aside class="aside p-filter">
        <div class="aside-block filter">
            <?$this->renderPartial('/partial/_investorFilter',array('filter'=>$filter))?>
        </div><!--aside-block-->
        <?$this->renderPartial('../partial/_register')?>

    </aside>

    <div class="page-right">
        <form class="sort-form" action="<?=$this->createUrl('investor/index');?>">
            <div class="sort sort-wrapper">
                <div class="select select_middle" data-name="sort">
                <?$this->widget('crud.dropDownList',
                    array('name'=>'sort','selected'=>Yii::app()->request->getParam('sort',null),'elements'=>array(
                        'investor_up' => Yii::t('main', 'Тип инвестора')." &uarr;",
                        'investor_down' => Yii::t('main', 'Тип инвестора')." &darr;",
                        'industry_up' => Yii::t('main', 'Предпочтительные отрасли')." &uarr;",
                        'industry_down' => Yii::t('main', 'Предпочтительные отрасли')." &darr;",
                        'country_up' => Yii::t('main', 'Страна инвестора')." &uarr;",
                        'country_down' => Yii::t('main', 'Страна инвестора')." &darr;",
                        'investment_amount_up' => Yii::t('main', 'Сумма финансирования')." &uarr;",
                        'investment_amount_down' => Yii::t('main', 'Сумма финансирования')." &darr;",),
                        'options'=>array(
                            'placeholder' => Yii::t('main','Сортировать по'),
                            'multiple'=>false,
                        ))
                );?>
                </div><!--select-->

                <div class="select select_small" data-name="limit">
                    <?$this->widget('crud.dropDownList',
                        array('name'=>'limit','selected'=>Yii::app()->request->getParam('limit',5),'elements'=>array(5=>5, 10=>10, 20=>20, 50=>50),
                            'options'=>array(
                                'placeholder' => '5',
                                'multiple'=>false,
                            ))
                    );?>
                </div><!--select-->

            </div><!--sort-->
            <?=CHtml::hiddenField('','',array('class'=>'current-select'));?>
        </form>
        <div class="projects investors">
            <?foreach($models as $model):?>
                <div class="project">
                    <div class="project-left">
                        <p class="project__type"><?=$model->investorType ? $model->investorType->name : ''?></p>
                        <p class="project__location">
                            <i class="icon icon-location"></i>
                            <span><?=$model->region ? $model->region->name : ''?></span>
                        </p>

                        <div class="investors__img-wrap">
                            <?=$model->logo ? Candy::preview(array($model->logo, 'scale' => '108x108', 'class' => 'project__bg')):'<img class="project__bg" src="/images/frontend/investors/investor-default.png">'?>
                        </div><!--investors__img-wrap-->

                    </div><!--project-left-->

                    <div class="project-right">
                        <h3 class="project__title"><?=CHtml::link(CHtml::encode(empty($model->company_name) ? $model->name : $model->company_name), $model->getUrl())?></h3>
                        <p class="project__desc">
                            <?=CHtml::encode(Candy::cutString($model->company_description, 350))?>
                        </p>

                        <div class="spacer">
                            <div class="project-params">
                                <div class="project-param">
                                    <span class="project-param__icon-wrap">
                                        <i class="icon icon-param-8"></i>
                                    </span>
                                    <span class="project-param__name">
                                        Сумма <br/> финансирования
                                    </span>
                                    <span class="project-param__desc">
                                        <?if(is_null($model->investor_finance_amount)){?>
                                            Не указана
                                        <?}else{?>
                                            <?=Candy::formatNumber($model->investor_finance_amount)?> <i class="icon icon-rub-black"></i>
                                        <?}?>
                                    </span>
                                </div><!--project-param-->

                                <!--div class="project-param">
                                    <span class="project-param__icon-wrap">
                                        <i class="icon icon-param-10"></i>
                                    </span>
                                    <span class="project-param__name">
                                        Количество сделок
                                    </span>
                                    <span class="project-param__desc">
                                        12
                                    </span>
                                </div><!--project-param-->

                            </div><!--project-params-->

                            <div class="project-params">
                                <!--div class="project-param">
                                    <span class="project-param__icon-wrap">
                                        <i class="icon icon-param-11"></i>
                                    </span>
                                    <span class="project-param__name">
                                        Сумма сделок
                                    </span>
                                    <span class="project-param__desc">
                                        12 млн
                                    </span>
                                </div><!--project-param-->

                            </div><!--project-params-->

                        </div><!--spacer-->

                        <?if($model->investorIndustry) {?>
                            <div class="investors__tag"><?=$model->investorIndustry->name?></div>
                        <?}?>

                    </div><!--project-right-->

                </div><!--project-->
            <?endforeach?>
        </div><!--projects-->

        <?$this->widget('CLinkPager', array('pages'=>$pages));?>

    </div><!--page-right-->

</div><!--projects-wrap-->