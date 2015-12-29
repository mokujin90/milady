<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading" style="overflow: hidden;">
            <? // php echo CHtml::link(Yii::t('main','Создать вопрос'),'/admin/Comment/edit',array('class'=>'btn btn-success'))?>
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
                    'name' => 'create_date',
                    'filter'=>false,
                ),
                array(
                    'type' => 'raw',
                    'name' => 'parent_id',
                    'value' => function($data){ return $data->parent ? CHtml::link('Ответ на комментарий #' . $data->parent_id ,array("adminComment/edit", "id" => $data->parent_id)) : '---'; },
                    'filter'=>false,
                ),
                array(
                    'type' => 'raw',
                    'name' => 'object_id',
                    'value' => function($data){ return $data->object_id ? $data->getTargetName() : ''; },
                    'filter'=>false,
                ),
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminComment/edit","id" => $data->id))',
                ),
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminComment/delete","id" => $data->id),array("class"=>"delete-button"))',
                )

            ),
        ));?>
        </div>
    </div>
</div>