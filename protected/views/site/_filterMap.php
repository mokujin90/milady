<?php
/**
 * @var $form CActiveForm
 */

$model = isset($filter) ? $filter : new RegionFilter();
$type = Candy::get($type,null);
$ajax = Candy::get($ajax,false);
?>
<div class="abs main filter-block" id="filter-map">
    <div class="transparent">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'filter-map-form',
            'action'=>$this->createUrl('site/filterProject'),
            'htmlOptions'=>array(

            )
        )); ?>
            <div class="row type-row">
                <?$this->widget('crud.dropDownList',
                    array(
                        'elements'=>Project::getStaticProjectType(),
                        'selected'=>$type,
                        'options'=>array('multiple'=>false,'placeholder'=>Yii::t('main','Тип проекта')),
                        'htmlOptions'=>array(
                            'class'=>'filter-map-select',
                            'ajax'=>$ajax
                        ),
                        'name'=>'projectType'
                    ));?>
                <?php echo $form->error($model,'type'); ?>
            </div>
            <div class="row object-row">
                <?$this->widget('crud.dropDownList',
                    array(
                        'elements'=>Project::getObjectTypeDrop(),
                        'selected'=>$model->objectList,
                        'options'=>array('multiple'=>false,'placeholder'=>$model->getAttributeLabel('objectList')),
                        'htmlOptions'=>array(
                            'class'=>'filter-map-select',
                            'ajax'=>$ajax
                        ),
                         'name'=>'objectList'
                    ));?>
                <?php echo $form->error($model,'type'); ?>
            </div>
            <div class="row place-row">
                <?$this->widget('crud.dropDownList',
                    array(
                        'elements'=>Region::getDrop(),
                        'selected'=>$model->placeList,
                        'options'=>array('multiple'=>false,'placeholder'=>$model->getAttributeLabel('placeList')),
                        'htmlOptions'=>array(
                            'class'=>'filter-map-select',
                            'ajax'=>$ajax
                        ),
                        'name'=>'placeList'
                    ));?>
                <?php echo $form->error($model,'type'); ?>
            </div>
            <div class="button-panel">
                <?=CHtml::submitButton(Yii::t('main','Расширенный фильтр'),array('name'=>'full-filter','class'=>'btn'))?>
                <?php echo CHtml::link(Yii::t('main','Сбросить'),array('site/index'),array('class'=>'btn reset'))?>
                <?php echo CHtml::link(Yii::t('main','Убрать фильтр'),'#',array('class'=>'btn slide-filter hide'))?>
            </div>
        <?php $this->endWidget(); ?>
    </div>

</div>