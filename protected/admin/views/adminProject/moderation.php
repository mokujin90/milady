<div class="dropdown">
    <a href="<?=$this->createUrl('adminProject/index')?>" class="btn btn-default" type="button">
        <?= Yii::t('main','Опубликованные проекты')?>
    </a>
</div>
<?$this->renderPartial('../admin/_gridPageSize')?>
<?php
$sort = new CSort();
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid-view',
    'template'=>"{items}\n{pager}",
    'filter'=>$model,
    'dataProvider'=>$model->search(false),
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
            'header'=>'Пользователь',
            'value' => '$data->user->name',
        ),
        array(
            'name' => 'type',
            'type' => 'raw',
            'filter' => Project::getStaticProjectType(),
            'value' => '$data->getProjectType()',
        ),
        'create_date',
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Редактировать")."</button>",array("adminProject/edit","id" => $data->id))',
        ),
        array(
            'type' => 'raw',
            'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success\">".Yii::t("main","Удалить")."</button>",array("adminProject/delete","id" => $data->id),array("class"=>"delete-button"))',
        )

    ),
));

