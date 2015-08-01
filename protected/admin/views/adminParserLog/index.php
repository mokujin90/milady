<?$this->renderPartial('../admin/_gridPageSize')?>
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
        'datetime',
        'parsed_count',
        array(
            'header'=>'Регион',
            'type' => 'raw',
            'value' => '$data->parser->region->name',
        ),
        array(
            'name' => 'success',
            'header'=>'Успешно',
            'type' => 'raw',
            'value' => '$data->success?"Да":"Нет"',
            'cssClassExpression'=>function($row,$data,$component){
                return ($data->success==1) ? 'green-background' : 'red-background';
            }
        ),

    ),
));