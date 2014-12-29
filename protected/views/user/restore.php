<?php
/**
 *
 * @var UserController $this
 */
?>
<div id="feedback-content">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'htmlOptions'=>array(
            'class'=>'auth-form feedback-form'
        )
    )); ?>
    <div class="row text-center">
        <?= Yii::t('main','Введите Ваш e-mail')?>
    </div>
    <div class="row">
        <?=CHtml::textField('restore[email]','',array('placeholder'=>Yii::t('main','E-mail')))?>
    </div>
    <div class="data">
        <?php echo
        CHtml::ajaxSubmitButton('Отправить',CHtml::normalizeUrl(array('user/restoreForm')),
            array(
                'dataType'=>'json',
                'type'=>'post',
                'success'=>'function(data)
                        {
                            $.fancybox.close();
                        }'
            ),array('class' => 'btn'));
        ?>
    </div>

    <?php $this->endWidget(); ?>
</div>