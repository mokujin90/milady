<?
/**
 * @var $form CActiveForm
 */
?>
<div class="hidden popup popup-registration" id="reg-content">
    <p class="popup__title"><?=Yii::t('main','Регистрация')?></p>
    <a class="popup-registration__link auth-fancy" href="#auth-content"><?=Yii::t('main','Я уже зарегистрирован!')?></a>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>'/user/register',
        'htmlOptions'=>array(
            'class'=>'popup-form register-form'
        )
    )); ?>
        <?$user = new User()?>
        <div class="select select_middle">
            <?$this->widget('crud.dropDownList',
                array('model'=>$user, 'attribute'=>'type','elements'=>User::getUserType(),
                    'options'=>array(
                        'multiple'=>false,
                    ))
            );?>
            <?=Candy::error($user,'type')?>
        </div><!--select-->
        <?=CHtml::activeTextField($user,'name',array('class'=>'popup-form__field','placeholder'=>Yii::t('main','Имя и фамилия')))?>
        <?=Candy::error($user,'name')?>
        <?=CHtml::activeTextField($user,'login',array('class'=>'popup-form__field','placeholder'=>Yii::t('main','Логин')))?>
        <?=Candy::error($user,'login')?>
        <?=CHtml::activeEmailField($user,'email',array('class'=>'popup-form__field','placeholder'=>Yii::t('main','E-mail')))?>
        <?=Candy::error($user,'email')?>
        <?=CHtml::activePasswordField($user,'password',array('class'=>'popup-form__field','placeholder'=>Yii::t('main','Пароль')))?>
        <?=Candy::error($user,'password')?>
        <?=CHtml::activePasswordField($user,'password_repeat',array('class'=>'popup-form__field','placeholder'=>Yii::t('main','Пароль повторно')))?>
        <?=Candy::error($user,'password_repeat')?>
        <?php echo CHtml::ajaxSubmitButton('Зарегистрироваться',CHtml::normalizeUrl(array('user/register')),
            array(
                'dataType'=>'json',
                'type'=>'post',
                'success'=>'function(data){form.ajaxError(data,".register-form")}'
            ),array('class' => 'blue-btn popup-form__btn','id' => 'register-action'));
        ?>


        <label class="agree">
            <?=CHtml::activeCheckBox($user,'agree')?>
            <span class="agree__btn"></span>
            <span class="agree__desc">
                <span class="agree__desc_lin">
                    <?=Yii::t('main','Да, я согласен получать самые актуальные данные инвест-проектов региона.')?>
                </span>
                <span class="agree__desc_lin">
                    <?=Yii::t('main','Регистрируясь, я принимаю условия пользовательского соглашения.')?>
                </span>
            </span>
            <?=Candy::error($user,'agree')?>
        </label>

    <?php $this->endWidget(); ?>

</div><!--popup-registration-->

<div class="hidden popup popup-authorization" id="auth-content">

    <p class="popup__title"><?=Yii::t('main','Авторизация')?></p>
    <a class="popup-registration__link reg-fancy" href="#reg-content"><?=Yii::t('main','Я не зарегистрирован!')?></a>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>'/user/login',
        'htmlOptions'=>array(
            'class'=>'popup-form auth-form'
        )
    )); ?>
        <?php echo CHtml::textField('LoginForm[username]','',array('class' => 'popup-form__field', 'placeholder'=>Yii::t('main','Логин')))?>
        <div class="errorMessage" id="LoginForm_username_em_" style="display: none;"></div>
        <?php echo CHtml::passwordField('LoginForm[password]','',array('class' => 'popup-form__field', 'placeholder'=>Yii::t('main','Пароль')))?>
        <div class="errorMessage" id="LoginForm_password_em_" style="display: none;"></div>
        <?php //echo CHtml::checkBox('LoginForm[rememberMe]',true,array('id'=>'login_forget_me'))?>
        <?php //echo CHtml::label(Yii::t('main','Запомнить меня'),'login_forget_me')?>
        <?php echo CHtml::link(Yii::t('main','Я забыл пароль'),array('user/restoreForm'),array('class'=>'popup-form__forgotten is-forget fancy-open fancybox.ajax'))?>

        <?php echo CHtml::ajaxSubmitButton(Yii::t('main','Войти'),CHtml::normalizeUrl(array('user/login')),
            array(
                'dataType'=>'json',
                'type'=>'post',
                'success'=>'function(data){form.ajaxError(data,".auth-form")}'
            ),array('class' => 'blue-btn popup-form__btn','id' => 'login-action'));
        ?>

    <?php $this->endWidget(); ?>

</div><!--popup-authorization-->

<div class="hidden popup popup-success">
    <p class="popup-success__desc">
        <?= Yii::t('main','На ваш e-mail отправлена информация для дальнейшей регистрации')?>
    </p>
    <button class="blue-btn popup-form__btn"><?= Yii::t('main','Закрыть')?></button>
</div><!--popup-success-->
