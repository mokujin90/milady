<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b><?= Yii::t('main','Группы')?></b>
            <?=CHtml::link(Yii::t('main','Создать'), $this->createUrl('group/create'), array('class'=>'btn btn-xs btn-success pull-right'))?>
        </div>

        <table class="table table-striped" id="responsiveTable">
            <!--thead>
            <tr>
                <th></th>
                <th>Тип</th>
                <th>Название</th>
            </tr>
            </thead-->
            <tbody>
            <?if(empty($models)):?>
                <tr><td colspan="3">Список пуст</td></tr>
            <?endif?>
            <?foreach($models as $model):?>
                <tr class="item">
                    <td><?=$model->name;?></td>
                    <td style="width: 50px;"><?=CHtml::link(Yii::t('main','Редактировать'),array('update','id'=>$model->id),array('class'=>'btn btn-xs btn-primary'))?></td>
                    <td style="width: 60px;"><?=CHtml::link(Yii::t('main','Удалить'),array('delete','id'=>$model->id),array('class'=>'btn btn-xs btn-danger', 'onclick' => 'return confirm("Удалить?")'))?></td>
                </tr>
            <?endforeach?>
            </tbody>
        </table>
    </div>
</div>