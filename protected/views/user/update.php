<?
/**
 * @var $this UserController
 * @var $model User
 * @var $form CActiveForm
 */
$types = User::getUserType();
?>
<style>
    .red-box {
        background: #F00;
        font-size: 12px;
        line-height: 20px;
        width: 120px;
    }
</style>
<div id="general">
    <div class="content columns">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>false,
        )); ?>
            <? $this->renderPartial('/partial/_leftColumn',array('model'=>$model,'types'=>$types));?>
            <div class="main-column opacity-box">
            <div class="inner-column">
                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'type','elements'=>$types,
                            'options'=>array('multiple'=>false)
                        ));?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'company_description'); ?>
                    <?php echo $form->textArea($model,'company_description',array('rows'=>6, 'cols'=>50,'class'=>'big-textarea')); ?>
                    <?php echo $form->error($model,'company_description'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'phone'); ?>
                    <?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'phone'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'post'); ?>
                    <?php echo $form->textField($model,'post',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'post'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'fax'); ?>
                    <?php echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'fax'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'email'); ?>
                    <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'email'); ?>
                </div>

                <div class="row extra-margin">
                    <?=CHtml::label('какие регионы интересны', 'description')?>
                    <?=CHtml::textArea('description', '', array('class' => 'middle-textarea', 'placeholder' => 'Текст'))?>
                </div>
                <div class="row extra-margin">
                    <?=CHtml::label('какие организации интересны', 'description')?>
                    <?=CHtml::textArea('description', '', array('class' => 'middle-textarea', 'placeholder' => 'Текст'))?>
                </div>
            </div>
            <div class="inner-column">
                <h2><?= Yii::t('main','сведенья об организации')?></h2>
                <div class="row">
                    <?php echo $form->labelEx($model,'company_form'); ?>
                    <?php echo $form->textField($model,'company_form',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'company_form'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'company_name'); ?>
                    <?php echo $form->textField($model,'company_name',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'company_name'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'company_address'); ?>
                    <?php echo $form->textField($model,'company_address',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'company_address'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'company_form'); ?>
                    <?php echo $form->textField($model,'company_form',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'company_form'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'company_scope'); ?>
                    <?php echo $form->textArea($model,'company_scope',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model,'company_scope'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'inn'); ?>
                    <?php echo $form->textField($model,'inn',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'inn'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'ogrn'); ?>
                    <?php echo $form->textField($model,'ogrn',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'ogrn'); ?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="button-panel center">
                <?=CHtml::submitButton('Сохранить',array('class'=>'btn'))?>
            </div>

        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>