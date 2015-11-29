<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <?$this->renderPartial('../admin/_gridPageSize')?>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    <?= Yii::t('main','Создать проект')?>
                    <span class="caret"></span>
                </button>
                <a href="<?=$this->createUrl('adminProject/moderation')?>" class="btn btn-default" type="button">
                    <?= Yii::t('main','Проекты на модерации')?>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation">
                        <?php echo CHtml::link(Yii::t('main','Инвестиционный проект'),array('adminProject/edit','type'=>Project::T_INVEST),array('role'=>'menuitem','tabindex'=>'-1'))?>
                    </li>
                    <li role="presentation">
                        <?php echo CHtml::link(Yii::t('main','Инновационный проект'),array('adminProject/edit','type'=>Project::T_INNOVATE),array('role'=>'menuitem','tabindex'=>'-1'))?>
                    </li>
                    <li role="presentation">
                        <?php echo CHtml::link(Yii::t('main','Инфраструктурный проект'),array('adminProject/edit','type'=>Project::T_INFRASTRUCT),array('role'=>'menuitem','tabindex'=>'-1'))?>
                    </li>
                    <li role="presentation">
                        <?php echo CHtml::link(Yii::t('main','Инвестиционная площадка'),array('adminProject/edit','type'=>Project::T_SITE),array('role'=>'menuitem','tabindex'=>'-1'))?>
                    </li>
                    <li role="presentation">
                        <?php echo CHtml::link(Yii::t('main','Продажа бизнеса'),array('adminProject/edit','type'=>Project::T_BUSINESS),array('role'=>'menuitem','tabindex'=>'-1'))?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="padding-md">
            <?php
            $sort = new CSort();
            $this->widget('zii.widgets.grid.CGridView', array(
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

