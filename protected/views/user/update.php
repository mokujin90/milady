<?
/**
 * @var $this UserController
 * @var $model User
 * @var $form CActiveForm
 * @var $params array
 */
Yii::app()->clientScript->registerScript('init', 'userProfilePart.init();', CClientScript::POS_READY);
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
<script type="text/javascript">
    $(function() {
        <?if(isset($params['dialog'])):?>
            $.confirmDialog({
                content: "<?=$params['dialog']?>",
                confirmText: 'Ок',
                cancelText:false
            });
        <?endif;?>
    });
</script>
<div id="general">
    <div class="content columns">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>false,
        )); ?>
            <? $this->renderPartial('/partial/_leftColumn',array('model'=>$model,'types'=>$types));?>
            <div class="main-column opacity-box">
            <div class="inner-column">
                <?$this->widget('crud.dropDownList',
                    array(
                        'model'=>$model,'attribute'=>'region_id',
                        'elements'=>Region::getDrop(),
                        'options'=>array('multiple'=>false),
                    ));?>
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
                <div class="row">
                    <div>
                        <?php echo $form->checkBox($model,'is_subscribe'); ?> <?= Yii::t('main','Подписка')?>
                    </div>

                    <?php echo $form->error($model,'is_subscribe'); ?>
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
            <div style="<?if($model->type!='investor'):?>display:none<?endif;?>" id="investor-block">
                <div class="inner-column">
                    <h2><?= Yii::t('main','Сведенья об инвесторе')?></h2>
                    <div class="row">
                        <?$this->widget('crud.dropDownList',
                            array('model'=>$model, 'attribute'=>'investor_country_id','elements'=>Country::getDrop(),
                                'options'=>array('multiple'=>false),
                            ));?>
                        <?php echo $form->error($model,'investor_country_id'); ?>
                    </div>
                    <div class="row">
                        <?$this->widget('crud.dropDownList',
                            array('model'=>$model, 'attribute'=>'investor_type','elements'=>Project::getObjectTypeDrop(),
                                'options'=>array('multiple'=>false),
                            ));?>
                        <?php echo $form->error($model,'investor_type'); ?>
                    </div>
                </div>
                <div class="inner-column">
                    <div class="row">
                        <?$this->widget('crud.dropDownList',
                            array('model'=>$model, 'attribute'=>'investor_industry','elements'=>Project::getIndustryTypeDrop(),
                                'options'=>array('multiple'=>false),
                            ));?>
                        <?php echo $form->error($model,'investor_industry'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model,'investor_finance_amount'); ?>
                        <?php echo $form->textField($model,'investor_finance_amount',array('size'=>60,'maxlength'=>255)); ?>
                        <?php echo $form->error($model,'investor_finance_amount'); ?>
                    </div>
                </div>
            </div>
            <div class="inner-column">
                <h2><?= Yii::t('main','Управление паролями')?></h2>
                <div class="row">
                    <?php echo $form->label($model,'old_password'); ?>
                    <?=CHtml::passwordField('User[old_password]','')?>
                    <?php echo $form->error($model,'old_password'); ?>
                </div>
                <div class="row">
                    <?php echo $form->label($model,'password'); ?>
                    <?=CHtml::passwordField('User[password]','')?>
                    <?php echo $form->error($model,'password'); ?>
                </div>
                <div class="row">
                    <?php echo $form->label($model,'password_repeat'); ?>
                    <?=CHtml::passwordField('User[password_repeat]','')?>
                    <?php echo $form->error($model,'password_repeat'); ?>
                </div>
            </div>
            <div class="inner-column">
                <h2><?= Yii::t('main','Какие регионы интересны')?></h2>
                <?$this->widget('crud.dropDownList',
                    array(
                        'elements'=>Region::getDrop(),
                        'selected'=>CHtml::listData($model->user2Regions,'region_id','region_id'),
                        'options'=>array('multiple'=>true,'placeholder'=>Yii::t('main','Регионы')),
                        'name'=>'user2region'
                    ));?>
            </div>
            <div class="clear"></div>
            <div class="button-panel center">
                <?=CHtml::submitButton('Сохранить',array('class'=>'btn'))?>
            </div>

        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>