<?if(Yii::app()->user->isGuest){?>
    <div class="aside-block registration <?=isset($class) ? $class : ''?>">
        <?php if(Yii::app()->user->isGuest):?>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'htmlOptions'=>array('class'=>'subscribe-form'))); ?>

            <?= CHtml::emailField('Subscribe[email]','',array('class' => 'registration__field', 'placeholder'=>Yii::t('main','введите e-mail')))?>
            <?= CHtml::submitButton(Yii::t('main', 'Зарегистрироваться'),array('class'=>'blue-btn registration__btn guest-subscribe'))?>
            <?php $this->endWidget(); ?>
        <?php endif;?>
        <p class="registration__desc">
            Зарегистрируйтесь! <br/>
            Вам будет предоставлена возможность получать
            самые актуальные данные инвест-проектов региона.
        </p>
    </div><!--aside-block-->
<?}?>