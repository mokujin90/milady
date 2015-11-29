<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading" style="overflow:hidden;">
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
                        'name' => 'email',
                        'filter'=>CHtml::activeTextField($model, 'email',array("class"=>"form-control")),
                    ),
                    array(
                        'header'=>'Текст',
                        'type' => 'raw',
                        'value' => 'substr(CHtml::encode($data->text),0,30)',
                    ),
                    array(
                        'name' => 'create_date',
                        'filter'=>CHtml::activeTextField($model, 'create_date',array("class"=>"form-control")),
                    ),
                    array(
                        'header'=>'Статус',
                        'type' => 'raw',
                        'value' => '$data->is_read ? "Прочтено" : "Не прочтено"',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Открыть")."</button>",array("adminFeedback/edit","id" => $data->id))',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminFeedback/delete","id" => $data->id),array("class"=>"delete-button"))',
                    )

                ),
            ));?>
        </div>
    </div>
</div>