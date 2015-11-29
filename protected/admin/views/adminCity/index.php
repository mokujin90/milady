<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <?php echo CHtml::link(Yii::t('main','Создать город'),'/admin/City/Edit',array('class'=>'btn btn-success'))?>
        </div>
        <div class="padding-md">
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
                        'name' => 'name',
                        'filter'=>CHtml::activeTextField($model, 'name',array("class"=>"form-control")),
                    ),
                    array(
                        'type' => 'raw',
                        'value' => '$data->region->name',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminCity/edit","id" => $data->id))',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminCity/delete","id" => $data->id),array("class"=>"delete-button"))',
                    )

                ),
            ));?>
        </div>
    </div>
</div>