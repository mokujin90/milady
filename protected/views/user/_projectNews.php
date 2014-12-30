<?php if(!$model->isNewRecord):?>
    <div class="main-column opacity-box">
        <div class="full-column">
            <div class="row">
                <a href="<?=$this->createUrl('user/projectNews', array('project' => $model->id))?>" class="btn corner-btn"><?= Yii::t('main','Добавить')?></a>
                <div class="caption"><?= Yii::t('main','Новости проекта')?></div>
            </div>
            <div class="row project list">
                <?if(empty($model->news)):?>
                    <p>Список пуст</p>
                <?endif?>
                <?foreach($model->news as $newsModel):?>
                    <div class="item">
                        <?=Crud::checkBox('',true,array())?>
                        <?=CHtml::link($newsModel->name, $this->createUrl('user/projectNews', array('id' => $newsModel->id)))?>
                        <?=CHtml::link('Удалить',array('project/newsDelete','id'=>$newsModel->id),array('class'=>'btn right-button delete-button'))?>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </div>
<?php endif;?>