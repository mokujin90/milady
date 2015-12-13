<?
/**
 * @var $this AdminRegionController
 */
?>
<div class="col-xs-12">
    <ul>
    <?php foreach($model->regionCities as $city):?>
        <li>
            <label class="label-checkbox inline">
                <?php echo CHtml::checkBox('', !$city->is_hidden, array('data-id' => $city->id, 'class' => 'change-city-visibility')); ?>
                <span class="custom-checkbox"></span>
            </label>
            <?=CHtml::link($city->name,array('adminCity/edit','id'=>$city->id))?>
            <i class="fa fa-refresh fa-spin fa-fw loading" style="opacity: 0;"></i>
        </li>
    <?php endforeach;?>
    </ul>
</div>
<div><?=CHtml::link("Добавить новый город",array('adminCity/edit','regionId'=>$model->id),array('class'=>'btn btn-xs btn-success'))?></div>
