<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <?if($this->user->can('admin-user')){?>
            <?php echo CHtml::beginForm('/admin/City/parseCity', 'post', array('enctype' => "multipart/form-data", 'class' => 'overflow-hidden', 'style' => 'margin: 10px 0;')); ?>

            <div class="col-xs-8">
                <?php echo CHtml::fileField('csv', '', array('class' => 'form-control'))?>
            </div>

            <div class="col-xs-4 submit">
                <?php echo CHtml::submitButton('Загрузить города', array('class' => 'btn btn-success col-xs-12')); ?>
            </div>

            <?php echo CHtml::endForm(); ?>
        <?}?>

        <div class="panel-heading">
            <?php echo CHtml::link(Yii::t('main','Создать город'),'/admin/City/Edit',array('class'=>'btn btn-success'))?>
        </div>
        <div class="padding-md">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                //'type'=>'striped',
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
                        'name' => 'name',
                        'filter'=>CHtml::activeTextField($model, 'name',array("class"=>"form-control")),
                    ),
                    array(
                        'type' => 'raw',
                        'value' => '$data->region->name',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminCity/edit","id" => $data->id))',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminCity/delete","id" => $data->id),array("class"=>"delete-button"))',
                    )

                ),
            ));?>
        </div>
    </div>
</div>