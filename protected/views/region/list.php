<div class="region-page">
    <div id="general">
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        <?foreach ($models as $model):?>
            <div class="light-gray-gradient line bottom back">
                <div class="main">
                    <h2><?=$model->name?> округ</h2>
                </div>
            </div>
            <div class="content main fullmargin">
            <?foreach ($model->regions as $region):?>
                <a class="region-item" href="<?=$region->content?$this->createUrl('region/index',array('id'=>$region->id)) :''?>">
                    <?=isset($region->content->logo) ? Candy::preview(array($region->content->logo, 'scale' => '100x100', 'scaleMode' => 'in')) : '<img src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">'?><br>
                    <?=$region->name?>
                </a>
            <?endforeach?>
            </div>
        <?endforeach?>
    </div>
</div>
<style>
    .region-item{
        text-align: center;
        width: 200px;
        display: inline-block;
        margin: 16px;
    }
    .region-item img{
        max-width: 100px;
        max-height: 100px;
    }
</style>