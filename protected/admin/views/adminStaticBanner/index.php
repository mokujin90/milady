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
                        'name' => 'url',
                        'filter'=>CHtml::activeTextField($model, 'url',array("class"=>"form-control")),
                    ),
                    array(
                        'header'=>'Место',
                        'type' => 'raw',
                        'value' => 'StaticBanner::getPlace($data->place_id)',
                    ),
                    array(
                        'name' => 'width',
                        'filter'=>CHtml::activeTextField($model, 'width',array("class"=>"form-control")),
                    ),
                    array(
                        'name' => 'height',
                        'filter'=>CHtml::activeTextField($model, 'height',array("class"=>"form-control")),
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminStaticBanner/edit","id" => $data->id))',
                    ),
                ),
            ));?>
        </div>
    </div>
</div>