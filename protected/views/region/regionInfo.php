<?php
/**
 *
 * @var RegionController $this
 */
?>
<div class="region-page">
    <div id="general">

        <div class="main">
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>array('Регионы'=>$this->createUrl('region/index'),'Москва'=>$this->createUrl('region/index'), $bread),
                'htmlOptions' => array('class'=>'breadcrumb'),
                'homeLink'=>CHtml::link('Главная','/',array('class'=>'normal')),
                'separator'=>''
            )); ?>
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
