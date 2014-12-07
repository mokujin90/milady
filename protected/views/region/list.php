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
                <div><a href="#"><?=$region->name?></a></div>
            <?endforeach?>
            </div>
        <?endforeach?>
    </div>
</div>