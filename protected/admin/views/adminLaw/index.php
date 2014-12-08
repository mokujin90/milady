<?php echo CHtml::link(Yii::t('main','Добавить документ'),'/admin/Law/edit',array('class'=>'btn'))?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    //'type'=>'striped',
    'template'=>"{items}\n{pager}",
    'filter'=>$model,
    'dataProvider'=>$model->search(),
    'enableSorting'=>true,
    'ajaxUpdate'=>true,
    'summaryText'=>'Отображено {start}-{end} из {count}',
    'template' => "{summary}{items}{pager}",
    'pager' => array('class' => 'CLinkPager', 'header' => ''),
    'columns' => array(
        'id',
        array(
            'header'=>'Раздел',
            'type' => 'raw',
            'value' => 'CHtml::encode(Law::getName($data->division_id))',
        ),
        array(
            'header'=>'Регион',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->regionName)',
        ),
        'normal_name',
        'create_date',
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Редактировать")."</button>",array("adminLaw/edit","id" => $data->id))',
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Удалить")."</button>",array("adminLaw/delete","id" => $data->id))',
        )

    ),
));