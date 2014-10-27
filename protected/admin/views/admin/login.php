<?php
/* @var $this SiteController */
$this->layout = false;
?>
<html class=" js no-touch localstorage svg">
<head>
    <meta charset="utf-8">
    <title><?= Yii::t('main','Административная часть')?></title>
    <link href="/css/admin/bootstrap.css" media="all" rel="stylesheet" type="text/css">
    <link href="/css/admin/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css">
    <link href="/css/admin/theme-colors.css" media="all" rel="stylesheet" type="text/css">
    <link href="/css/admin/demo.css" media="all" rel="stylesheet" type="text/css">
    <style></style>
</head>
<body class="contrast-red login contrast-background">
<div class="middle-container">
    <div class="middle-row">
        <div class="middle-wrapper">
            <div class="login-container-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <img width="121" src="https://cdn0.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Mail.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-container">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                            <h1 class="text-center title">Admin panel</h1>


                            <?php echo CHtml::beginForm() ?>
                            <?php echo CHtml::errorSummary($form, 'Допущены ошибки:') ?>
                            <div class="form-group">
                                <div class="controls with-icon-over-input">
                                    <?php echo CHtml::activeTextField($form, 'username', array('value' => '', 'class' => 'form-control', 'id' => 'login')) ?>
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls with-icon-over-input">
                                    <?php echo CHtml::activePasswordField($form, 'password', array('value' => '', 'class' => 'form-control', 'id' => 'pass')) ?>
                                    <i class="icon-lock text-muted"></i>
                                </div>
                            </div>

                            <?php echo CHtml::submitButton(Yii::t('main','Войти'), array('class' => 'btn btn-block')); ?>

                            <?php echo CHtml::endForm() ?>

                            <div class="text-center">
                                <hr class="hr-normal">
                                <!--a href="#">Forgot your password?</a-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-container-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <!--a href="#">
                                    <i class="icon-user"></i>
                                    <strong>Sign up</strong>
                                </a-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>