<?php
/**
 *
 * @var RegionController $this
 */
?>
<div class="region-page">
    <div id="general">

        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        
        <?foreach($attr as $attrVal):?>
            <?if($region->getAttribute($attrVal)):?>
            <div class="light-gray-gradient line bottom back">
                <div class="main">
                    <h2><?=$region->getAttributeLabel($attrVal)?></h2>
                </div>
            </div>

            <div class="content main fullmargin">
                <?=$region->getAttribute($attrVal)?>
            </div>
            <?endif?>
        <?endforeach?>
    </div>
</div>
