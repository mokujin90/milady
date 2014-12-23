<?php
/**
 *
 * @var RegionController $this
 */
?>
<style>
    ul,ol{
        margin-left: 40px;
    }
    table{
        font-size: 12px;
        text-align: center;
    }
    table p{
        margin: 0 2px;
    }
    tr:nth-child(even){
        background: #FFF;
    }
</style>
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
