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
        array(
            'header'=>'Тип',
            'type' => 'raw',
            'value' => 'Banner::typeList($data->type)',
        ),
        'price',
        array(
            'header'=>'Статус',
            'type' => 'raw',
            'value' => 'Banner::statusList($data->status)',
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Редактировать")."</button>",array("adminBanner/edit","id" => $data->id))',
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Удалить")."</button>",array("adminBanner/delete","id" => $data->id),array("class"=>"delete-button"))',
        )

    ),
));