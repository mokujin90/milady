<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <?php echo CHtml::link(Yii::t('main','Создать пользователя'),'/admin/AdminUser/edit',array('class'=>'btn btn-success'))?>
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
                    'name' => 'login',
                    'filter'=>CHtml::activeTextField($model, 'login',array("class"=>"form-control")),
                ),
                array(
                    'name' => 'name',
                    'filter'=>CHtml::activeTextField($model, 'name',array("class"=>"form-control")),
                ),
                array(
                    'name' => 'create_date',
                    'filter'=>CHtml::activeTextField($model, 'create_date',array("class"=>"form-control")),
                ),
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminAdminUser/edit","id" => $data->id))',
                ),
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminAdminUser/delete","id" => $data->id),array("class"=>"delete-button", "onclick" => "return confirm(\'Удалить?\')"))',
                )

            ),
        ));?>
        </div>
    </div>
</div>