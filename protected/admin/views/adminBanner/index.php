<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading" style="overflow: hidden;">
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
                        'name' => 'url',
                        'filter'=>CHtml::activeTextField($model, 'url',array("class"=>"form-control")),
                    ),
                    array(
                        'header'=>'Тип',
                        'type' => 'raw',
                        'value' => 'Banner::typeList($data->type)',
                    ),
                    array(
                        'name' => 'price',
                        'filter'=>CHtml::activeTextField($model, 'price',array("class"=>"form-control")),
                    ),
                    array(
                        'header'=>'Статус',
                        'type' => 'raw',
                        'value' => 'Banner::statusList($data->status)',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminBanner/edit","id" => $data->id))',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminBanner/delete","id" => $data->id),array("class"=>"delete-button"))',
                    )

                ),
            ));?>
        </div>
    </div>
</div>