<?php echo CHtml::link(Yii::t('main','Создать новость'),'/admin/Slider/edit',array('class'=>'btn'))?>
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
        'id',
        'url',
        'position',
        array(
            'header'=>'Активность',
            'type' => 'raw',
            'value' => '$data->is_active==1 ? "Да" : "Нет"',
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Редактировать")."</button>",array("adminSlider/edit","id" => $data->id))',
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Удалить")."</button>",array("adminSlider/delete","id" => $data->id),array("class"=>"delete-button"))',
        )

    ),
));