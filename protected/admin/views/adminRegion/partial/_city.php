<?
/**
 * @var $this AdminRegionController
 */
?>
<div class="col-xs-12">
    <?php foreach($model->regionCities as $city):?>
        <div><?=CHtml::link($city->name,array('adminCity/edit','id'=>$city->id))?></div>
    <?php endforeach;?>
</div>
<div><?=CHtml::link("Добавить новый город",array('adminCity/edit','regionId'=>$model->id),array('class'=>'btn'))?></div>
