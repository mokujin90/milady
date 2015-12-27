<div class="padding-md">
    <?$this->renderPartial('_search', array('model' => $model))?>

    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <?$this->renderPartial('../admin/_gridPageSize')?>
            <?php echo CHtml::link(Yii::t('main','Создать пользователя'),'/admin/User/edit',array('class'=>'btn btn-success'))?>
        </div>
        <div class="padding-md">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                //'type'=>'striped',
                'id' => 'grid-view',
                'template'=>"{items}\n{pager}",
                //'filter'=>$model,
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
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminUser/edit","id" => $data->id))',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Баланс")."</button>",array("adminUser/history","id" => $data->id))',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Все проекты пользователя")."</button>",array("adminProject/index","Project[user_id]" => $data->id))',
                    ),

                ),
            ));?>
        </div>
    </div>
</div>