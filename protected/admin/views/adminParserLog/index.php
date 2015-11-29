<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading" style="overflow: hidden;">
            <?$this->renderPartial('../admin/_gridPageSize')?>
        </div>
        <div class="padding-md">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                //'type'=>'striped',
                'id' => 'grid-view',
                'template'=>"{items}\n{pager}",
                'filter'=>$model,
                'dataProvider'=>$model->search(),
                'enableSorting'=>true,
                'ajaxUpdate'=>true,
                'summaryText'=>'Отображено {start}-{end} из {count}',
                'template' => "{summary}{items}{pager}",
                'pager' => array('class' => 'CLinkPager', 'header' => ''),
                'columns' => array(
                    array(
                        'name' => 'datetime',
                        'filter'=>CHtml::activeTextField($model, 'datetime',array("class"=>"form-control")),
                    ),
                    array(
                        'name' => 'parsed_count',
                        'filter'=>CHtml::activeTextField($model, 'parsed_count',array("class"=>"form-control")),
                    ),
                    array(
                        'header'=>'Регион',
                        'type' => 'raw',
                        'value' => '$data->parser->region->name',
                    ),
                    array(
                        'name' => 'success',
                        'header'=>'Успешно',
                        'type' => 'raw',
                        'value' => function($data){
                            $value =  $data->success?"Да":"Нет";
                            $class =  $data->success?"label-success":"label-danger";
                            return "<div class='label $class'>$value</div>";
                        },
                        'filter'=>CHtml::activeDropDownList($model, 'success', array(''=> '---', 0 => 'Нет', 1=>'Да'),array("class"=>"form-control", 'style' => 'width: 100px;')),
                    ),

                ),
            ));?>
        </div>
    </div>
</div>