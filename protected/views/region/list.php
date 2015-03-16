
<?foreach ($models as $model):?>
    <div class="tab">
        <div class="header">
            <div class="main chain">
                <div class="caption"><?=$model->name?> округ</div>
                <span class="r r-block-region logo"></span>
                <div class="toggle">
                    <span class="text"><?= Yii::t('main','Скрыть')?></span>
                    <span class="r r-slide-up-black"></span>
                </div>
            </div>
            <div class="back"></div>
        </div>
        <div class="data toggled-block">
            <div class="main chain trans-block">
                <?foreach ($model->regions as $region):?>
                    <a class="region-item chain" href="<?=$region->content?$this->createUrl("region/{$this->defaultSection}",array('id'=>$region->id)) :''?>">
                        <?=isset($region->content->logo) ? Candy::preview(array($region->content->logo, 'scale' => '100x100', 'scaleMode' => 'in')) : '<img src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">'?>
                        <span class="name"><?=$region->name?></span>
                    </a>
                <?endforeach?>
            </div>
        </div>
    </div>
<?endforeach?>
