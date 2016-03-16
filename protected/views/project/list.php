<?php Yii::app()->clientScript->registerScript('init', 'sort.init();', CClientScript::POS_READY);?>
<div class="projects-wrap">
    <h2 class="page-title">Список проектов</h2>

    <aside class="aside p-filter">
        <div class="aside-block filter">
            <?$this->renderPartial('/partial/_filter',array('filter'=>$filter))?>
        </div><!--aside-block-->

        <?$this->renderPartial('../partial/_register')?>

        <a class="aside-block map-project-link" href="<?=$this->createUrl('project/map')?>">
                <span class="map-project-link__img-wrap">
                    <img src="/images/frontend/map-icon.jpg"/>
                </span><!--map-project-link__img-wrap-->
            <span class="map-project-link__desc">Проекты на карте</span>

        </a><!--aside-block-->

    </aside>

    <div class="page-right">
        <div class="sort" style="height: 30px;">
            <?=$this->renderPartial('_sort');?>

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
