<?php
/* @var $this BaseController */
/*
Yii::app()->clientScript->registerCssFile('/css/normalize.css');
Yii::app()->clientScript->registerCssFile('/css/style.css');
Yii::app()->clientScript->registerCssFile('/css/vendor/jquery.fancybox.css');*/
Yii::app()->clientScript->registerCssFile('/css/frontend/reset.css');
Yii::app()->clientScript->registerCssFile('/css/frontend/leaflet.css');
Yii::app()->clientScript->registerCssFile('/css/frontend/style.css');
Yii::app()->clientScript->registerCssFile('/css/frontend/stylereset.css');

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.placeholder.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.bxslider.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/leaflet.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/vendor/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/components.js', CClientScript::POS_END); //js-файл с основными компонентами-синглтонами
Yii::app()->clientScript->registerScriptFile('/js/main.js', CClientScript::POS_END); //js-скрипт для внешней части сайта
Yii::app()->clientScript->registerScriptFile('/js/script.js', CClientScript::POS_END);

/*
#JS
Yii::app()->clientScript->registerScriptFile('/js/vendor/modernizr-2.6.2.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerCoreScript('ckeditor');
Yii::app()->clientScript->registerCoreScript('sroller');
Yii::app()->clientScript->registerScriptFile('/js/plugins.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/js/confirmDialog.js', CClientScript::POS_END);*/?>
<!DOCTYPE html>
<html>
<head lang="ru">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Международные инвестиционные проекты</title>
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
    <![endif]-->
    <link href='https://fonts.googleapis.com/css?family=Roboto&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
</head>
<body>
<?= $content; ?>
<?$this->renderPartial('../layouts/_footer');?>

<span class="scroll-top scroll-btn" data-href=".header"></span>

<div class="popup popup-registration">
    <p class="popup__title">Регистрация</p>
    <a class="popup-registration__link" href="#">Я уже зарегистрирован!</a>

    <form class="popup-form" action=".php">
        <input class="popup-form__field" type="text" name="surname" placeholder="Фамилия"/>
        <input class="popup-form__field" type="text" name="name" placeholder="Имя"/>
        <input class="popup-form__field" type="text" name="email" placeholder="E-mail"/>
        <input class="popup-form__field" type="password" name="pass" placeholder="Пароль"/>

        <button class="blue-btn popup-form__btn">Зарегистрироваться</button>

        <label class="agree">
            <input type="checkbox"/>
            <span class="agree__btn"></span>
            <span class="agree__desc">
                <span class="agree__desc_lin">
                    Да, я согласен получать самые актуальные данные инвест-проектов региона.
                </span>
                <span class="agree__desc_lin">
                    Регистрируясь, я принимаю условия пользовательского соглашения.
                </span>
            </span>
        </label>

    </form>

</div><!--popup-registration-->

<div class="popup popup-authorization">
    <p class="popup__title">Авторизация</p>
    <a class="popup-registration__link" href="#">Я не зарегистрирован!</a>

    <form class="popup-form" action=".php">
        <input class="popup-form__field" type="text" name="email" placeholder="E-mail"/>
        <input class="popup-form__field" type="password" name="pass" placeholder="Пароль"/>
        <a class="popup-form__forgotten" href="#">Я забыл пароль</a>

        <button class="blue-btn popup-form__btn">Войти</button>

    </form>

</div><!--popup-authorization-->

<div class="popup popup-success">
    <p class="popup-success__desc">
        На ваш e-mail отправлена информация для дальнейшей регистрации
    </p>
    <button class="blue-btn popup-form__btn">Закрыть</button>

</div><!--popup-success-->



<script>
    var map = L.map('project-map').setView([51.505, -0.09], 13);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
        maxZoom: 18,
        attribution: false,
        id: 'mapbox.streets'
    }).addTo(map);

</script>

</body>
</html>