<?
/**
 * @var $model Banner
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'region-content-form',
    'enableAjaxValidation'=>false,
)); ?>

    <div class="col-xs-12">
        <div class="form-group">
            <?php echo $form->labelEx($model,'user_id', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?=$model->user->name?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'url', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->textField($model,'url', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'url'); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-4">
                <?php
                $this->widget('application.components.MediaEditor.MediaEditor',
                    array('data' => array(
                        'items' => null,
                        'field' => 'media_id',
                        'item_container_id' => 'logo_block',
                        'button_image_url' => '/images/markup/logo.png',
                        'button_width' => 28,
                        'button_height' => 28,
                    ),
                        'scale' => '300x160',
                        'scaleMode' => 'in',
                        'needfields' => 'false',
                        'crop'=>true));
                ?>
                <?php echo CHtml::button(Yii::t('main','Загрузить фото'),array('class'=>'open-dialog btn'))?>
            </div>
            <div class="col-xs-12 col-sm-8">
                <span id="logo_block" class="rel">
                    <?=Candy::preview(array($model->media, 'scale' => '300x160'))?>
                    <?php echo CHtml::hiddenField('media_id',$model->media_id)?>
                </span>
            </div>
        </div>
        <?php if(in_array(User::T_INVESTOR,$model->usersShow)):?>
            <h2>Настройки для инвесторов</h2>
            <div class="form-group">
                <?php echo CHtml::label('Сумма финансирования','', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
                <div class="col-xs-12 col-sm-8">
                    <?=$model->investor_amount?>
                </div>
            </div>
            <div class="form-group">
                <?php echo CHtml::label('Страны для инвесторов','', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
                <div class="col-xs-12 col-sm-8">
                    <?=implode(', ',CHtml::listData($model->manyCountries,'id','name'))?>
                </div>
            </div>
            <div class="form-group">
               <?
                    $wordTypes = array();
                    $types = CHtml::listData($model->banner2InvestorTypes,'id','type_id');
                    foreach($types as $item){
                        $wordTypes[] = Project::getObjectTypeDrop($item);
                    }
               ?>
                <?php echo CHtml::label('Тип инвестора','', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
                <div class="col-xs-12 col-sm-8">
                    <?=implode(', ',$wordTypes)?>
                </div>
            </div>
            <div class="form-group">
                <?
                    $wordTypes = array();
                    $types = CHtml::listData($model->banner2Industries,'id','industry_id');
                    foreach($types as $item){
                        $wordTypes[] = Project::getObjectTypeDrop($item);
                    }
                ?>
                <?php echo CHtml::label('Предпочтительные отрасли','', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
                <div class="col-xs-12 col-sm-8">
                    <?=implode(', ',$wordTypes)?>
                </div>
            </div>
        <?php endif;?>
        <h2>Общие настройки</h2>
        <div class="form-group">
            <?
                $wordTypes = array();
                foreach($model->daysShow as $item){
                    $wordTypes[] = Candy::$weekDay[$item];
                }
            ?>
            <?php echo CHtml::label('Дни недели','', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?=implode(', ',$wordTypes)?>
            </div>
        </div>
        <div class="form-group">
            <?php echo CHtml::label('Регионы','', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?=implode(', ',CHtml::listData($model->manyRegions,'id','name'))?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'type', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?=Banner::typeList($model->type)?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'price', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?=$model->price?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'status', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
            <div class="col-xs-12 col-sm-8">
                <?php echo $form->dropDownList($model,'status',Banner::statusList(), array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'status'); ?>
            </div>
        </div>
        <h2>Баланс: <?=$model->balance?></h2>
    </div>
    <div class="row buttons text-center">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
    </div>
<? $this->endWidget(); ?>