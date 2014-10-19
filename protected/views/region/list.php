<?php
/**
 * @var RegionController $this
 * @var RegionFilter $filter
 * @var CActiveForm $form
 */
Yii::app()->clientScript->registerScript('init', 'regionListPart.init();', CClientScript::POS_READY);
?>

<div class="region-page">
    <div id="general">
        <div class="main bread-block">
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>array('Регионы'),
                'htmlOptions' => array('class'=>'breadcrumb'),
                'homeLink'=>CHtml::link('Главная','/',array('class'=>'normal')),
                'separator'=>''
            )); ?>
        </div>
        <?$this->renderPartial('/partial/_filter',array('filter'=>$filter))?>

    </div>
</div>