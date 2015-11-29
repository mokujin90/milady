<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <?php echo CHtml::link(Yii::t('main','Добавить документ'),'/admin/Law/edit',array('class'=>'btn btn-success'))?>
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
                        'header'=>'Раздел',
                        'type' => 'raw',
                        'value' => 'CHtml::encode(Law::getName($data->division_id))',
                    ),
                    array(
                        'header'=>'Регион',
                        'type' => 'raw',
                        'value' => 'CHtml::encode($data->regionName)',
                    ),
                    array(
                        'name' => 'normal_name',
                        'filter'=>CHtml::activeTextField($model, 'normal_name',array("class"=>"form-control")),
                    ),
                    array(
                        'name' => 'create_date',
                        'filter'=>CHtml::activeTextField($model, 'create_date',array("class"=>"form-control")),
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminLaw/edit","id" => $data->id))',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminLaw/delete","id" => $data->id),array("class"=>"delete-button"))',
                    )

                ),
            ));?>
        </div>
    </div>
</div>