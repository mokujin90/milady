<?Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.growl.js', CClientScript::POS_END);?>
<style>
    input#fixed-save {
        position: fixed;
        bottom: 8px;
        right: 60px;
        z-index: 1049;
        padding: 8px;
        box-shadow: 0 0 10px;
        background: #3c8dbc;
        color: #FFF;
        opacity: 0.5;
        font-weight: bold;
        border-radius: 20px;
    }
    input#fixed-save:hover {
        opacity: 1;
    }
</style>
<div class="padding-md">
    <?php
    /**
     * @var $this RegionContentController
     */
    Yii::app()->clientScript->registerCoreScript('ckeditor');
    Yii::app()->clientScript->registerScript('init', 'region.init();', CClientScript::POS_READY);
    ?>

    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="/#tab1" role="tab" data-toggle="tab"><?= Yii::t('main','Основная информация')?></a></li>
        <li class=""><a href="/#tab2" role="tab" data-toggle="tab"><?= Yii::t('main','Рег. аналитика')?></a></li>
        <li class=""><a href="/#tab3" role="tab" data-toggle="tab"><?= Yii::t('main','Инвест. паспорт')?></a></li>
        <li class=""><a href="/#tab4" role="tab" data-toggle="tab"><?= Yii::t('main','Инновац. паспорт')?></a></li>
        <li><a href="/#tab5" role="tab" data-toggle="tab"><?= Yii::t('main','Инфраструкт. паспорт')?></a></li>
        <li><a href="/#city-tab" role="tab" data-toggle="tab"><?= Yii::t('main','Города')?></a></li>
    </ul>
    <br>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'region-content-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            "onkeypress"=>"return event.keyCode != 13;",
            'class' => 'form-horizontal no-margin form-border'
        )
    )); ?>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <?php $this->renderPartial('partial/_main',array(
                    'form'=>$form,
                    'model'=>$model,
                )); ?>
            </div>
            <div class="tab-pane" id="tab2">
                <?php $this->renderPartial('partial/_analytics',array(
                    'form'=>$form,
                    'model'=>$model,
                )); ?>
            </div>
            <div class="tab-pane" id="tab3">
                <?php $this->renderPartial('partial/_investment',array(
                    'form'=>$form,
                    'model'=>$model,
                )); ?>
            </div>
            <div class="tab-pane" id="tab4">
                <?php $this->renderPartial('partial/_innovation',array(
                    'form'=>$form,
                    'model'=>$model,
                )); ?>
            </div>
            <div class="tab-pane" id="tab5">
                <?php $this->renderPartial('partial/_infra',array(
                    'form'=>$form,
                    'model'=>$model,
                )); ?>
            </div>
            <div class="tab-pane" id="city-tab">
                <?php $this->renderPartial('partial/_city',array(
                    'form'=>$form,
                    'model'=>$model,
                )); ?>
            </div>
        </div>
        <div class="row buttons text-center">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
            <?if(!$model->isNewRecord):?>
                <?php echo CHtml::submitButton('Применить', array('class'=>'btn', 'name'=>'update')); ?>
            <?endif?>
            <?if(!$model->isNewRecord):?>
                <?php echo CHtml::ajaxSubmitButton('Быстрое сохранение', '', array(
                    'success' => "function(response) {
                        response = JSON.parse(response);
                        if(response.result){
                            $.growl({ title: '<i class=\'fa fa-fw fa-check\'></i> Success', message: 'Сохранено', priority: 'success'});
                        } else{
                            $.growl({ title: '<i class=\'fa fa-fw fa-warning\'></i> Error', message: response.errors, priority: 'danger'});
                        }
                      }",
                ), array('class'=>'btn', 'id' => 'fixed-save')); ?>
            <?endif?>

        </div>
    <? $this->endWidget(); ?>
    <?php $this->renderPartial('_mediaGrid'); ?>
</div>

