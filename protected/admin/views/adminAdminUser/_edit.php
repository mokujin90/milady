<div class="padding-md">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'region-content-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'class' => 'form-horizontal no-margin form-border'
        ),
    )); ?>
        <div class="col-xs-12">
            <div class="form-group">
                <?php echo $form->labelEx($model,'name', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'login', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->textField($model,'login', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'login'); ?>
                </div>
            </div>
            <?if($model->isNewRecord):?>
            <div class="form-group">
                <?php echo $form->labelEx($model,'password', array('class' => "col-xs-12 col-sm-2 control-label")); ?>
                <div class="col-xs-12 col-sm-10">
                    <?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'password'); ?>
                </div>
            </div>
            <?endif?>
            <?foreach(Admin2Right::$rights as $right => $name){?>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label"><?=$name?></label>
                <div class="col-xs-12 col-sm-10">
                    <label class="label-checkbox inline">
                        <?php echo CHtml::checkbox("Admin2Right[$right]", !empty($model->adminRightsField[$right]) ? 1 : 0); ?>
                        <span class="custom-checkbox"></span>
                    </label>
                </div>
            </div>
            <?}?>

        </div>
        <div class="row buttons text-center">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
            <?if(!$model->isNewRecord):?>
                <?php echo CHtml::submitButton('Применить', array('class'=>'btn', 'name'=>'update')); ?>
            <?endif?>
        </div>
    <? $this->endWidget(); ?>
</div>
