<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <?php echo CHtml::link(Yii::t('main','Добавить'), $this->createUrl("adminReferenceTransport/edit"),array('class'=>'btn btn-success'))?>
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
                    'name' => 'type',
                    'value' => function($data){
                        return ReferenceTransport::$types[$data->type];
                    },
                    'filter' => false
                ),
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminReferenceTransport/edit","id" => $data->id))',
                ),
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminReferenceTransport/delete","id" => $data->id),array("class"=>"delete-button"))',
                )
            ),
        ));?>
        </div>
    </div>
</div>
