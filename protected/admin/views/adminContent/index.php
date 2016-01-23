<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <?php echo CHtml::link(Yii::t('main','Добавить страницу'),'/admin/Content/edit',array('class'=>'btn btn-success'))?>
            <?$this->renderPartial('../admin/_gridPageSize')?>
        </div>
        <div class="padding-md">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                //'type'=>'striped',
                'template'=>"{items}\n{pager}",
                'dataProvider'=>$model->search(),
                'enableSorting'=>true,
                'ajaxUpdate'=>true,
                'summaryText'=>'Отображено {start}-{end} из {count}',
                'template' => "{summary}{items}{pager}",
                'pager' => array('class' => 'CLinkPager', 'header' => ''),
                'columns' => array(
                    'name',
                    array(
                        'type' => 'raw',
                        'value' => 'Candy::formatDate($data->update_date)',
                    ),
                    array(
                        'type' => 'raw',
                        'value' => 'CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Редактировать")."</button>",array("adminContent/edit","id" => $data->id))',
                    ),

                    array(
                        'type' => 'raw',
                        'value' => function($data){
                                if(is_null($data->type)){
                                    return CHtml::link("<button type=\"button\" class=\"btn btn-success btn-xs\">".Yii::t("main","Удалить")."</button>",array("adminContent/delete","id" => $data->id),array("class"=>"delete-button"));
                                }
                            return '';
                        },
                    )
                ),
            ));?>
        </div>
    </div>
</div>