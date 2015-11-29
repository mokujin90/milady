<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <?$this->renderPartial('../admin/_gridPageSize')?>
            <div class="dropdown">
                <a href="<?=$this->createUrl('adminProject/index')?>" class="btn btn-default" type="button">
                    <?= Yii::t('main','Опубликованные проекты')?>
                </a>
            </div>
        </div>
        <div class="padding-md">
            <?php
            $sort = new CSort();
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'grid-view',
                'template'=>"{items}\n{pager}",
                'filter'=>$model,
                'dataProvider'=>$model->search(false),
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
                        'header'=>'Пользователь',
                        'value' => '$data->user->name',
                    ),
                    array(
                        'name' => 'type',
                        'type' => 'raw',
                        'filter' => CHtml::activeDropDownList($model, 'type', array('' => '----') + Project::getStaticProjectType(), array("class"=>"form-control")),
                        'value' => '$data->getProjectType()',
                    ),
                    array(
                        'name' => 'create_date',
                        'filter'=>CHtml::activeTextField($model, 'create_date',array("class"=>"form-control")),
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminProject/edit","id" => $data->id))',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminProject/delete","id" => $data->id),array("class"=>"delete-button"))',
                    )

                ),
            ));?>
        </div>
    </div>
</div>

