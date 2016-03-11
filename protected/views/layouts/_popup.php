<div class="hidden popup popup-registration" id="reg-content">
    <p class="popup__title"><?=Yii::t('main','Регистрация')?></p>
    <a class="popup-registration__link auth-fancy" href="#auth-content"><?=Yii::t('main','Я уже зарегистрирован!')?></a>

    <form class="popup-form" action=".php">
        <input class="popup-form__field" type="text" name="surname" placeholder="Фамилия"/>
        <input class="popup-form__field" type="text" name="name" placeholder="Имя"/>
        <input class="popup-form__field" type="text" name="email" placeholder="E-mail"/>
        <input class="popup-form__field" type="password" name="pass" placeholder="Пароль"/>

        <button class="blue-btn popup-form__btn"><?=Yii::t('main','Зарегистрироваться')?></button>

        <label class="agree">
            <input type="checkbox"/>
            <span class="agree__btn"></span>
            <span class="agree__desc">
                <span class="agree__desc_lin">
                    <?=Yii::t('main','Да, я согласен получать самые актуальные данные инвест-проектов региона.')?>
                </span>
                <span class="agree__desc_lin">
                    <?=Yii::t('main','Регистрируясь, я принимаю условия пользовательского соглашения.')?>
                </span>
            </span>
        </label>

    </form>

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

        <?php echo CHtml::ajaxSubmitButton('Войти',CHtml::normalizeUrl(array('user/login')),
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
        На ваш e-mail отправлена информация для дальнейшей регистрации
    </p>
    <button class="blue-btn popup-form__btn">Закрыть</button>

</div><!--popup-success-->
