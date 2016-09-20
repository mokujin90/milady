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
                    'id',
                    array(
                        'name' => 'name',
                        'filter'=>CHtml::activeTextField($model, 'name',array("class"=>"form-control")),
                    ),
                    array(
                        'name' => 'login',
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
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Подтвержденные проекты (" . $data->getProjectCount() . ")")."</button>",array("adminProject/index","Project[user_id]" => $data->id))',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить пользователя"  . ($data->getProjectCount() ? (" + проекты (" . $data->getProjectCount() . ")") : ""))."</button>",array("adminUser/delete","id" => $data->id),array("class"=>"delete-button"))',
                        'htmlOptions' => array('style' => 'width:100px;')
                    )
                ),
            ));?>
        </div>
    </div>
</div>