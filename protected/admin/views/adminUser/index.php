<?php
/**
 *
 * @var AdminUserController $this
 * @var \User $model
 */
?>

<?$this->renderPartial('../admin/_gridPageSize')?>

<?php echo CHtml::link(Yii::t('main','Создать пользователя'),'/admin/User/edit',array('class'=>'btn'))?>

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
        'name',
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Редактировать")."</button>",array("adminUser/edit","id" => $data->id))',
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Баланс")."</button>",array("adminUser/history","id" => $data->id))',
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Все проекты пользователя")."</button>",array("adminProject/index","Project[user_id]" => $data->id))',
        ),

    ),
));