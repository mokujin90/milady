<div class="panel panel-default table-responsive">
    <div class="panel-heading">
        <?= Yii::t('main','Новости проекта')?>
        <a href="<?=$this->createUrl('user/projectNews', array('project' => $model->id))?>" class="btn corner-btn btn-xs btn-success pull-right"><?= Yii::t('main','Добавить')?></a>

    </div>

    <table class="table table-striped" id="responsiveTable">
        <tbody>
        <?if(empty($model->news)):?>
            <p>Список пуст</p>
        <?endif?>
        <?foreach($model->news as $newsModel):?>
            <tr>
                <td><?=CHtml::link($newsModel->name, $this->createUrl('user/projectNews', array('id' => $newsModel->id)))?></td>
                <td><?=CHtml::link('Удалить',array('project/newsDelete','id'=>$newsModel->id),array('class'=>'btn btn-xs btn-danger pull-right delete-button'))?></td>
            </tr>
        <?endforeach?>
        </tbody>
    </table>
</div>
