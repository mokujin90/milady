<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <?php echo CHtml::link(Yii::t('main','Создать вопрос'),'/admin/FAQ/edit',array('class'=>'btn btn-success'))?>
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
                    'name' => 'question',
                    'filter'=>CHtml::activeTextField($model, 'question',array("class"=>"form-control")),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'parent_id',
                    'value' => function($data){ return $data->parent ? CHtml::link($data->parent->question ,array("adminFAQ/edit", "id" => $data->parent_id)) : '---'; },
                    'filter'=>false,
                ),
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminFAQ/edit","id" => $data->id))',
                ),
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminFAQ/delete","id" => $data->id),array("class"=>"delete-button"))',
                )

            ),
        ));?>
        </div>
    </div>
</div>