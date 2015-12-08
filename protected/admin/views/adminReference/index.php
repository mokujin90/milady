<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <?php echo CHtml::link(Yii::t('main','Добавить'), $this->createUrl("adminReference/edit", array("ref" => $_GET["ref"])),array('class'=>'btn btn-success'))?>
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
                    'type' => 'raw',
                    'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminReference/edit","id" => $data->id,"ref" => $_GET["ref"]))',
                ),
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminReference/delete","id" => $data->id,"ref" => $_GET["ref"]),array("class"=>"delete-button"))',
                )
            ),
        ));?>
        </div>
    </div>
</div>
