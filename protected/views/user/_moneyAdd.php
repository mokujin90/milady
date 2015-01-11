<?php
/**
 *
 * @var UserController $this
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'money-add-form',
    'enableAjaxValidation'=>false,
)); ?>
    <div class="center">
        <h4><?= Yii::t('main','')?>Укажите сумму, на которую хотите пополнить баланс</h4>
        <?php echo CHtml::textField('add_value','10')?>
        <?=CHtml::submitButton(Yii::t('main','Пополнить'),array('name'=>'add','class'=>'btn'))?>
    </div>

<?php $this->endWidget(); ?>