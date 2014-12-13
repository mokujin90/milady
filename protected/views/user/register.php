<?php
/**
 *
 * @var UserController $this
 * @var User $model
 * @var CActiveForm $form
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'htmlOptions'=>array(
        'class'=>'auth-form'
    )
)); ?>
    <div id="general" class="registration">
        <div class="content main">
            <div class="header"><?= Yii::t('main','Регистрация')?></div>
            <div class="block">
                <div class="row">
                    <?$this->widget('crud.dropDownList',
                        array('model'=>$model, 'attribute'=>'type','elements'=>User::getUserType(),
                            'options'=>array('multiple'=>false),
                            'htmlOptions'=>array('id'=>'user_type')
                        ));?>
                    <?=Candy::error($model,'type')?>
                </div>
                <div class="row">
                    <?=$form->textField($model,'login',array('placeholder'=>$model->getAttributeLabel('login')))?>
                    <?=$form->error($model,'login');?>
                </div>
                <div class="row">
                    <?=$form->passwordField($model,'password',array('placeholder'=>$model->getAttributeLabel('password')))?>
                    <?=$form->error($model,'password')?>
                </div>
                <div class="row">
                    <?=$form->passwordField($model,'password_repeat',array('placeholder'=>$model->getAttributeLabel('password_repeat')))?>
                    <?=$form->error($model,'password_repeat')?>
                </div>
                <div class="row">
                    <?=$form->emailField($model,'email',array('placeholder'=>$model->getAttributeLabel('email')))?>
                    <?=$form->error($model,'email')?>
                </div>
                <div class="row" style="text-align: right;">
                    <?=CHtml::submitButton(Yii::t('main','Зарегистрироваться'),array('class'=>'btn'))?>
                </div>
            </div>

        </div>
    </div>
<?php $this->endWidget(); ?>