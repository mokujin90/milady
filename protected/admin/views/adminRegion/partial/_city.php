<?
/**
 * @var $this AdminRegionController
 */
?>
<div class="col-xs-12">
    <ul>
    <?php foreach($model->regionCities as $city):?>
        <li><?=CHtml::link($city->name,array('adminCity/edit','id'=>$city->id))?></li>
    <?php endforeach;?>
    </ul>
</div>
<div><?=CHtml::link("Добавить новый город",array('adminCity/edit','regionId'=>$model->id),array('class'=>'btn btn-xs btn-success'))?></div>
