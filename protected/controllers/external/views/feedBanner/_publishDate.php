<?php
$this->blockJquery();
?>
<?$hours = array(); for($i=0; $i<24; $i++){$hours[$i] = $i < 10 ? "0$i:00" : "$i:00";}?>
<div class="form-group">
    <label class="col-lg-2 control-label">Дата</label>
    <div class="col-lg-3">
        <?= CHtml::textField('Banner[publishDate][post][date]', '', array(
            'data-provide' => "datepicker",
            'data-date-format' => "yyyy-mm-dd",
            'data-date-today-highlight' => "true",
            'data-date-language' => "en-GB",
            'class' => 'form-control'
        )) ?>
    </div><!-- /.col -->
    <label class="col-lg-2 control-label">Время</label>
    <div class="col-lg-3">
        <?= CHtml::dropDownList('Banner[publishDate][post][hour]', '', $hours, array('class' => 'form-control')) ?>
    </div><!-- /.col -->
    <div class="col-lg-2">
        <div class="btn pull-right"><i class="fa fa-remove fa-lg"></i></div>
    </div><!-- /.col -->
</div><!-- /form-group -->