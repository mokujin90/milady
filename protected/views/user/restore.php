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
<div class="popup popup-authorization" id="feedback-content" style="width: auto;">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'htmlOptions'=>array(
            'class'=>'popup-form restore-form'
        )
    )); ?>
    <div class="row text-center">

    </div>
    <div class="row">
        <?=CHtml::textField('restore[email]','',array('placeholder'=> Yii::t('main','Введите Ваш E-mail'),'id'=>'send-restore-value', 'class' => 'popup-form__field'))?>
    </div>
    <div class="data">
        <?php echo
        CHtml::button('Отправить',array('class' => 'blue-btn popup-form__btn','id'=>'send-restore-email'));
        ?>
    </div>

    <?php $this->endWidget(); ?>
</div>