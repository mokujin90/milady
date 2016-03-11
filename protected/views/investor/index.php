<?php
/**
 * @var RegionController $this
 * @var RegionFilter $filter
 * @var CActiveForm $form
 */
//Yii::app()->clientScript->registerScript('init', 'regionListPart.init();', CClientScript::POS_READY);
?>
<div class="advertisements spacer"></div><!--advertisements-->

<div class="projects-wrap">
    <h2 class="page-title"><?=Yii::t('main', 'Инвесторы')?></h2>

    <aside class="aside p-filter">
        <div class="aside-block filter">
            <input class="filter__field" type="text" name="company" placeholder="Компания"/>

            <div class="filter-region filter-block open">
                <p class="filter-region__btn filter-block__btn">
                    <i class="filter-region__btn_check filter-block__btn_check"></i>
                    <span>Тип инвестора</span>
                </p>

                <div class="filter-region-list filter-block-list">
                    <label class="checkbox checkbox_full active">
                        <input type="checkbox"/>
                        <span class="checkbox__btn"></span>
                        <span class="checkbox__name">Банки</span>
                    </label>

                </div><!--p-filter-region-list-->

            </div><!--p-filter-region-->

            <div class="p-filter-block__add">
                <span>Подробный фильтр</span>
            </div>

        </div><!--aside-block-->

        <div class="aside-block registration">
            <input class="registration__field" type="text" name="registration" placeholder="введите e-mail"/>
            <button class="blue-btn registration__btn">Зарегистрироваться</button>
            <p class="registration__desc">
                Зарегистрируйтесь! <br/>
                Вам будет предоставлена возможность получать
                самые актуальные данные инвест-проектов региона.
            </p>

        </div><!--aside-block-->

    </aside>

    <div class="page-right">
        <div class="sort">
            <div class="select select_middle">
                <span class="select__btn"></span>
                <p class="select__selected">Тип инвестора</p>
                <div class="select-list">
                    <p class="select-list__item">Сумма инвестиций</p>
                    <p class="select-list__item">Большая</p>
                    <p class="select-list__item">Маленькая</p>
                    <p class="select-list__item">Не очень</p>
                </div><!--select-list-->

            </div><!--select-->

            <div class="select select_small">
                <span class="select__btn"></span>
                <p class="select__selected">5</p>
                <div class="select-list">
                    <p class="select-list__item">10</p>
                    <p class="select-list__item">20</p>
                    <p class="select-list__item">30</p>
                    <p class="select-list__item">40</p>
                </div><!--select-list-->

            </div><!--select-->

        </div><!--sort-->

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
                        <h3 class="project__title"><?=CHtml::link($model->getInvestorName(), $model->getUrl())?></h3>
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
                                            <?=CHtml::encode($model->investor_finance_amount)?> млн <i class="icon icon-rub-black"></i>
                                        <?}?>
                                    </span>
                                </div><!--project-param-->

                                <div class="project-param">
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
                                <div class="project-param">
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

        <div class="projects-pager">
            <a class="projects-pager__text-btn projects-pager__prev" href="#">назад</a>
            <a class="projects-pager__link" href="#">1</a>
            <a class="projects-pager__link projects-pager__link_active" href="#">2</a>
            <a class="projects-pager__link" href="#">3,</a>
            <a class="projects-pager__link" href="#">4,</a>
            <a class="projects-pager__link" href="#">...</a>
            <a class="projects-pager__link" href="#">10</a>
            <a class="projects-pager__text-btn projects-pager__next" href="#">вперед</a>

        </div><!--projects-pager-->

    </div><!--page-right-->

</div><!--projects-wrap-->