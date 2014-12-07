
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
        array(
            'type' => 'raw',
            'value' => 'Content::getName($data->id)',
        ),
        array(
            'type' => 'raw',
            'value' => 'Candy::formatDate($data->update_date)',
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Редактировать")."</button>",array("adminContent/edit","id" => $data->id))',
        ),
    ),
));