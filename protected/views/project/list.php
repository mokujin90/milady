<br>
<div class="projects-wrap">
    <h2 class="page-title">Список проектов</h2>

    <aside class="aside p-filter">
        <div class="aside-block filter">
            <?$this->renderPartial('/partial/_filter',array('filter'=>$filter))?>
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

        <a class="aside-block map-project-link" href="<?=$this->createUrl('project/map')?>">
                <span class="map-project-link__img-wrap">
                    <img src="/images/frontend/map-icon.jpg"/>
                </span><!--map-project-link__img-wrap-->
            <span class="map-project-link__desc">Проекты на карте</span>

        </a><!--aside-block-->

    </aside>

    <div class="page-right">
        <div class="sort">
            <div class="select select_big select__open">
                <span class="select__btn"></span>
                <p class="select__selected">Сумма инвестиций</p>
                <div class="select-list">
                    <span class="select-list__item">Ссылка 1</span>
                    <span class="select-list__item">Ссылка 2</span>
                    <span class="select-list__item">Ссылка 3</span>
                    <span class="select-list__item">Ссылка 4</span>
                    <span class="select-list__item">Ссылка 5</span>
                    <span class="select-list__item">Ссылка 6</span>
                    <span class="select-list__item">Ссылка 7</span>
                </div><!--select-list-->

            </div><!--select-->

            <div class="select select_small select__open">
                <span class="select__btn"></span>
                <p class="select__selected">10</p>
                <div class="select-list">
                    <span class="select-list__item">1</span>
                    <span class="select-list__item">2</span>
                    <span class="select-list__item">3</span>
                    <span class="select-list__item">4</span>
                    <span class="select-list__item">5</span>
                    <span class="select-list__item">6</span>
                    <span class="select-list__item">7</span>
                </div><!--select-list-->

            </div><!--select-->

            <div class="view-type">
                <span class="view-type__item view-type__item_list active"></span>
                <a href="<?=$this->createUrl('project/map')?>"><span class="view-type__item view-type__item_map"></span></a>
            </div><!--view-type-->

        </div><!--sort-->

        <div class="projects">
            <? foreach($models as $model) {?>
                <div class="project">
                    <div class="project-left">
                        <?$dateVal = new DateTime($model->create_date)?>
                        <p class="project__date"><?=$dateVal->format('d.m.Y')?></p>
                        <p class="project__type"><?=$model->getStaticProjectType($model->type)?></p>
                        <p class="project__location">
                            <i class="icon icon-location"></i>
                            <span><?=$model->region->name?></span>
                        </p>
                        <div class="project__img-wrap">
                            <?=$model->logo ? Candy::preview(array($model->logo, 'scale' => '102x102', 'upScale' => 1, 'class' => 'project__bg')):'<img class="project__bg" src="/images/frontend/investors/investor-default.png">'?>
                        </div>
                    </div><!--project-left-->

                    <div class="project-right">
                        <h3 class="project__title"><?=CHtml::link($model->name, $this->createUrl('project/detail', array('id' => $model->id)))?></h3>
                        <?=$this->renderPartial('projectItemPartial/' . Project::$urlByType[$model->type], array('model' => $model));?>

                        <div class="project-counts">
                            <span class="project-counts__length"><?=$model->view_count?></span>
                            <span class="project-counts__text"><?=Candy::getNumEnding($model->view_count,array(Yii::t('main','Просмотр'),Yii::t('main','Просмотра'),Yii::t('main','Просмотров')))?></span>
                        </div><!--project-counts-->

                    </div><!--project-right-->

                </div><!--project-->
            <?}?>
        </div><!--projects-->
        <?$this->widget('CLinkPager', array('pages'=>$pages));?>

    </div><!--page-right-->

</div><!--projects-wrap-->
