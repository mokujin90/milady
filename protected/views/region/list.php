<?php
/**
 * @var RegionController $this
 * @var RegionFilter $filter
 * @var CActiveForm $form
 */
Yii::app()->clientScript->registerScriptFile('/js/vendor/ion.rangeSlider.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile('/css/vendor/ion.rangeSlider.css');
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
        <div class="content columns">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'filter','htmlOptions'=>array('class'=>'opacity-box form filter'
            ))); ?>
                <h2><?=$filter::$filter?></h2>
                <h3><?= Yii::t('main','Тип площадок')?></h3>

                <div class="row">
                    <div class="field">
                        <?= $form->label($filter,'name')?>
                        <?= $form->textField($filter,'name',array('class'=>'crud'))?>
                    </div>
                    <div class="field">
                        <?= $form->label($filter,'projectName')?>
                        <?= $form->textField($filter,'projectName',array('class'=>'crud'))?>
                    </div>
                    <div class="field">
                        <?= $form->checkBoxList($filter,'viewType',$filter::$viewTypeDrop,array('class'=>'crud','separator'=>''))?>
                    </div>
                </div>
                <div class="row">
                    <div class="field">
                        <?= $form->label($filter,'placeList')?>
                        <?$this->widget('crud.dropDownList',
                                array('model'=>$filter, 'attribute'=>'placeList','elements'=>$filter::$regionDrop ));?>
                    </div>
                    <div class="field">
                        <?= $form->label($filter,'objectList')?>
                        <?$this->widget('crud.dropDownList',
                            array('model'=>$filter, 'attribute'=>'objectList','elements'=>$filter::$objectDrop));?>
                    </div>
                </div>
                <div class="row">
                    <div class="field">
                        <?= $form->label($filter,'investmentFormList')?>
                        <?$this->widget('crud.dropDownList',
                                array('model'=>$filter, 'attribute'=>'investmentFormList','elements'=>$filter::$investmentFormDrop));?>
                    </div>
                </div>
                <div class="row">
                    <div class="field">
                        <?= $form->label($filter,'payback')?>
                        <?= $form->textField($filter,'payback',
                            array('class'=>'crud slider','data-min'=>$filter::$paybackParam['min'],'data-max'=>$filter::$paybackParam['max'],'data-from'=>$filter->payback['from'],'data-to'=>$filter->payback['to']))?>
                    </div>
                    <div class="field">
                        <?= $form->label($filter,'profit')?>
                        <?= $form->textField($filter,'profit',
                            array('class'=>'crud slider','data-min'=>$filter::$profitParam['min'],'data-max'=>$filter::$profitParam['max'],'data-from'=>$filter->profit['from'],'data-to'=>$filter->profit['to']))?>
                    </div>
                    <div class="field">
                        <?= $form->label($filter,'investSum')?>
                        <?= $form->textField($filter,'investSum',
                            array('class'=>'crud slider','data-min'=>$filter::$investSumParam['min'],'data-max'=>$filter::$investSumParam['max'],'data-from'=>$filter->investSum['from'],'data-to'=>$filter->investSum['to']))?>
                    </div>
                    <div class="field">
                        <?= $form->label($filter,'returnRate')?>
                        <?= $form->textField($filter,'returnRate',
                            array('class'=>'crud slider','data-min'=>$filter::$returnRateParam['returnRate'],'data-max'=>$filter::$returnRateParam['max'],'data-from'=>$filter->returnRate['from'],'data-to'=>$filter->returnRate['to']))?>
                    </div>
                </div>
            <div class="row">
                <div class="element">
                    <div class="field switcher-parent">
                        <?= $form->checkBox($filter,'isInvestment',array('class'=>'crud'))?>
                        <?= $form->label($filter,'isInvestment')?>
                    </div>
                    <div class="field switcher-child">
                        <?$this->widget('crud.dropDownList',
                            array('model'=>$filter, 'attribute'=>'investmentList','elements'=>$filter::$objectDrop));?>
                    </div>

                    <div class="field switcher-parent">
                        <?= $form->checkBox($filter,'isInnovative',array('class'=>'crud'))?>
                        <?= $form->label($filter,'isInnovative')?>
                    </div>
                    <div class="field switcher-child">
                        <?$this->widget('crud.dropDownList',
                            array('model'=>$filter, 'attribute'=>'innovativeList','elements'=>$filter::$objectDrop));?>
                    </div>
                </div>

            </div>
            <?php $this->endWidget(); ?>
        </div>

        <div class="dark-gray-gradient line top bottom">
            <div class="main">

            </div>
        </div>

    </div>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(
    'htmlOptions'=>array('class'=>'subscribe-form form'))); ?>
    <?
        $this->widget('crud.dropDownList',array(
            'name'=>'drop',
            'elements'=>array(33=>'Stand up',17=>'Expansion',100=>'Exit',1=>'Strategy',3=>'Singleton'),
            'selected'=>33,
            'options'=>array(
                'multiple'=>false,
            )
        ));
    ?>
<?
$this->widget('crud.dropDownList',array(
    'name'=>'drop',
    'elements'=>array(33=>'Stand up',17=>'Expansion',100=>'Exit',1=>'Strategy',3=>'Singleton'),
    'selected'=>array(17,3),

));
?>
    <?= CHtml::submitButton(Yii::t('main','Подписаться'),array('class'=>'btn'))?>
<?php $this->endWidget(); ?>