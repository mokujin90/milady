<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <?php echo CHtml::link(Yii::t('main','Создать новость'),'/admin/News/edit',array('class'=>'btn btn-success'))?>
            <?$this->renderPartial('../admin/_gridPageSize')?>
        </div>
        <div class="padding-md">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'grid-view',
            'template'=>"{items}\n{pager}",
            'filter'=>$model,
            'dataProvider'=>$model->search(),
            'enableSorting'=>true,
            'ajaxUpdate'=>true,
            'summaryText'=>'Отображено {start}-{end} из {count}',
            'pager' => array('class' => 'CLinkPager', 'header' => ''),
            'columns' => array(
                array(
                    'name' => 'name',
                    'filter'=>CHtml::activeTextField($model, 'name',array("class"=>"form-control")),
                ),
                array(
                    'name' => 'create_date',
                    'filter'=>CHtml::activeTextField($model, 'create_date',array("class"=>"form-control")),
                ),
                array(
                    'name' => 'on_main',
                    'value' => function($data){ return $data->on_main ? 'Да' : 'Нет';},
                    'filter'=>CHtml::activeDropDownList($model, 'on_main', array(''=> '---', 0 => 'Нет', 1=>'Да'),array("class"=>"form-control", 'style' => 'width: 100px;')),

                ),
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminNews/edit","id" => $data->id))',
                ),
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminNews/delete","id" => $data->id),array("class"=>"delete-button"))',
                )

            ),
        ));?>
        </div>
    </div>
</div>