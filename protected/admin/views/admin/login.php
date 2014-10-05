<?php $this->layout = 'adminlogin' ?>
<div class="auth">
	<?php echo CHtml::beginForm() ?>
	<?php echo CHtml::errorSummary($form, 'Допущены ошибки:') ?>
	<div class="bg">
		<dl>
			<dt><label for="login">Логин:</label></dt>
			<dd><?php echo CHtml::activeTextField($form, 'username', array('value' => '', 'class' => 'txt', 'id' => 'login')) ?></dd>
			<dt><label for="pass">Пароль:</label></dt>
			<dd><?php echo CHtml::activePasswordField($form, 'password', array('value' => '', 'class' => 'txt', 'id' => 'pass')) ?></dd>
			<dd><div class="remember"><?php echo CHtml::activeCheckBox($form, 'rememberMe', array('id' => 'rememberMe')) ?> <label for="rememberMe"><span>запомнить меня</span></label></div></dd>
			<dd class="goto"><?php echo CHtml::submitButton('Войти', array('class' => 'submit')) ?></dd>
		</dl>
	</div>
	<?php echo CHtml::endForm() ?>
</div>