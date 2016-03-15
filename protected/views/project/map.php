    <div class="projects-wrap clear-fix">
        <h2 class="page-title page-title_dib">Проекты на карте</h2>

        <div class="view-type view-type_mt-fix">
            <a href="<?=$this->createUrl('project/index')?>"><span class="view-type__item view-type__item_list"></span></a>
            <span class="view-type__item view-type__item_map active"></span>

        </div><!--view-type-->

    </div><!--projects-wrap-->
</section><!--page-->

<section class="page-big clear-fix">
    <aside class="aside p-filter projects-map-aside">
        <div class="aside-block aside-block_no-shadow filter filter_with-scroll">
            <?$this->renderPartial('/partial/_filter',array('filter'=>$filter))?>
        </div><!--aside-block-->
    </aside>

    <div class="projects-map-wrap">
        <div id="projects-map">
        <?php $this->widget('Map', array(
            'id'=>'map',
            'target'=>$this->region->name,
            'region' => $this->region,
            'extendAjaxPopup'=>true,
            'showProjectBalloon'=>true,
            'htmlOptions'=>array(
                'style'=>'height:670px;'
            ),
            'projects' => $models
        )); ?>
        </div>
    </div><!--projects-map-wrap-->

    <?$this->renderPartial('../partial/_register', array('class' => 'registration_center'))?>

</section><!--page-big-->