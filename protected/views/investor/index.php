<?php
/**
 * @var RegionController $this
 * @var RegionFilter $filter
 * @var CActiveForm $form
 */
//Yii::app()->clientScript->registerScript('init', 'regionListPart.init();', CClientScript::POS_READY);
?>

<div class="region-page">
    <div id="general">
        <div class="main bread-block">
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>array('Инвесторы'),
                'htmlOptions' => array('class'=>'breadcrumb'),
                'homeLink'=>CHtml::link('Главная','/',array('class'=>'normal')),
                'separator'=>''
            )); ?>
        </div>
        <?$this->renderPartial('/partial/_investorFilter',array('filter'=>$filter))?>
        <div class="content list-columns columns">
            <div class="full-column">
                <?foreach($models as $model):?>
                <div class="investor-item opacity-box">
                    <div class="title">Описание компании</div>
                    <div class="data">
                        <div class="main-data">
                            <?=$model->logo?Candy::preview(array($model->logo, 'scale' => '100x100', 'class' => 'image')):'<img class="image" src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">'?>
                            <div class="name"><?=$model->company_name?></div>
                            <div class="type">Инвестор</div>
                        </div>
                        <div class="contact-data">
                            <div class="label">Контакты</div>
                            <div class="text"><?=$model->company_address?></div>
                        </div>
                        <div class="more-data">
                            <div class="label">Сведения о пользователе</div>
                            <div class="text">
                                Имя: <?=$model->name?><br>
                                Email: <?=$model->email?><br>
                                Телефон: <?=$model->phone?><br>
                                Сфера деятельности: <?=$model->company_scope?>
                            </div>
                        </div>
                    </div>
                </div>
                <?endforeach?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>