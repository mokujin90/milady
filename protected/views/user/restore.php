<?php
/**
 *
 * @var UserController $this
 */
?>
<script type="text/javascript">
    $('#send-restore-email').click(function(){
        var $this = $(this),
            $email = $('#send-restore-value');
        if($email.val()!=''){
            $.ajax({
                dataType:'json',
                type: "POST",
                url: "/user/restoreForm",
                data: $this.closest('form').serializeArray()
            }).complete(function() {
                $.fancybox.close();
            });

        }
        return false;
    });
</script>
<div id="feedback-content">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'htmlOptions'=>array(
            'class'=>'auth-form restore-'
        )
    )); ?>
    <div class="row text-center">
        <?= Yii::t('main','Введите Ваш e-mail')?>
    </div>
    <div class="row">
        <?=CHtml::textField('restore[email]','',array('placeholder'=>Yii::t('main','E-mail'),'id'=>'send-restore-value'))?>
    </div>
    <div class="data">
        <?php echo
        CHtml::button('Отправить',array('class' => 'btn','id'=>'send-restore-email'));
        ?>
    </div>

    <?php $this->endWidget(); ?>
</div>