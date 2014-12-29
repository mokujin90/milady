<?php
/**
 *
 * @var UserController $this
 */
?>
<script type="text/javascript">
    jQuery('body').off('click','#yt0');
</script>
<div id="unique-content">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'method'=>'GET',
        'htmlOptions'=>array(
            'class'=>'auth-form feedback-form',
            'id'=>''
        )
    )); ?>
    <div class="row text-center">
        <?= Yii::t('main','Введите уникальный url для проекта. Стоиость услуги '.Price::get(Price::P_CURRENT_URL).' рублей')?>
    </div>
    <div class="row">
        <?=CHtml::textField('url','',array('placeholder'=>Yii::t('main','Url'),'class'=>'new-url'))?>
        <div class="errorMessage" id="User_url_em_" style="display: none;"></div>
    </div>
    <?php echo CHtml::hiddenField('save',1)?>
    <div class="data">
        <?php echo
        CHtml::ajaxSubmitButton('Опубликовать',CHtml::normalizeUrl(array('uniqueUrl','projectId'=>$projectId)),
            array(
                'dataType'=>'json',
                'type'=>'get',
                'success'=>'function(data)
                    {
                    console.log(data);
                        if(data.error!=null){
                            $("#User_url_em_").text(data.error).show();
                        }
                        else{
                            $("#unique-url-value").val($(".new-url").val());
                            $("#unique-url-block").show();
                            $(".btn.unique-url").hide();
                            $.fancybox.close();
                        }

                    }'
            ),array('class' => 'btn'));
        ?>
    </div>

    <?php $this->endWidget(); ?>
</div>