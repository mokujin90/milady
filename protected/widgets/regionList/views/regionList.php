<div class="region-list tabs-wrap">
    <div class="region-list-top">
        <div class="region-list-tabs tab-links">
            <span class="region-list-tab tab-link active" data-index="0">По алфавиту</span>
            <span class="region-list-colon">|</span>
            <span class="region-list-tab tab-link" data-index="1">По федеральным округам</span>
        </div><!--region-list-tabs-->

        <input id="find-city-text" class="region-list__field" type="text" name="region"
               placeholder="введите название региона"/>

    </div><!--region-list-top-->

    <div class="region-tabs tabs">
        <div class="region-tab region-tab_alphabet tab active">
            <ul class="region-slides">
                <li class="region-slide spacer">
                <?$showDistrict = array();?>
                <?foreach($this->data as $id=>$column):?>
                    <?if ($id == 5) {?>
                        </li>
                        <li class="region-slide spacer">
                    <?}?>
                    <div class="region-slide-col">
                        <?foreach($column as $districtId=>$items):?>
                            <?if(!array_key_exists($districtId,$showDistrict)):?>
                                <?if($districtId!==0):?>
                                    <p class="region-slide__title"><?=$districtId?></p>
                                <?endif;?>
                            <?endif;?>
                            <?$showDistrict[$districtId] = 1;?>
                            <nav class="region-slide-links">
                            <?foreach($items as $regionId=>$regionName):?>
                                <?=CHtml::link($regionName,'#',array('data-region'=>$regionId, 'class' => 'region-slide-link'))?>
                            <?endforeach;?>
                            </nav>
                        <?endforeach;?>
                    </div><!--region-slide-col-->
                <?endforeach?>
                </li>
            </ul>

            <div class="region-slider">
                <span class="region-slider__prev"></span>
                <div class="region-slider-listing">
                    <a class="region-slider-listing__item active" href="#" data-slide-index="0"></a>
                    <a class="region-slider-listing__item" href="#" data-slide-index="1"></a>
                </div><!--region-slider-listing-->

                <span class="region-slider__next"></span>

            </div><!--region-slider-->
        </div><!--region-tab-->
    </div><!--region-tabs-->
</div><!--region-list-->
