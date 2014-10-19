<?php
/**
 *
 * @var SiteController $this
 */
    Yii::app()->clientScript->registerScript('init', 'projectMapPart.init();', CClientScript::POS_READY);
?>
<div class="map project-page">
    <div id="general">
        <?$this->renderPartial('/partial/_filter',array('filter'=>$filter))?>
        <div class="main bread-block">
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>array('Регионы'),
                'htmlOptions' => array('class'=>'breadcrumb'),
                'homeLink'=>CHtml::link('Главная','/',array('class'=>'normal')),
                'separator'=>''
            )); ?>
        </div>
        <div class="content columns">
            <div class="main-column opacity-box">
                <div class="row">
                    <div class="inner-column">
                        <div class="caption"><?= Yii::t('main','Название компании')?></div>
                        <div class="main-company-info chain-block">
                            <div class="logo">
                                <?=CHtml::image(Makeup::img(),'')?>
                            </div>
                            <div class="text">
                                <div class="name">Компания имени мысли и труда</div>
                                <div class="caption notice"><?= Yii::t('main','Описание компании')?>:</div>
                                <div class="value">Воронежская область. Петропаловский район, территория бывшего савхоза "Труд"</div>
                            </div>
                        </div>
                    </div>
                    <div class="inner-column">
                        <div class="caption"><?= Yii::t('main','Инвестиционный проект')?></div>
                        <div class="caption notice"><?= Yii::t('main','Отрасль реализации')?></div>
                    </div>
                </div>
            </div>
            <div class="side-column opacity-box">
                
            </div>
        </div>
    </div>
</div>