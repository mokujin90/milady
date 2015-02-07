<h2><?= Yii::t('main','Информация для фильтра')?></h2>
<div class="row">
    <?php echo $form->labelEx($model,'investment_sum'); ?>
    <?php echo $form->textField($model,'investment_sum'); ?>
    <?php echo $form->error($model,'investment_sum'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'period'); ?>
    <?php echo $form->textField($model,'period'); ?>
    <?php echo $form->error($model,'period'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'profit_norm'); ?>
    <?php echo $form->textField($model,'profit_norm'); ?>
    <?php echo $form->error($model,'profit_norm'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'profit_clear'); ?>
    <?php echo $form->textField($model,'profit_clear'); ?>
    <?php echo $form->error($model,'profit_clear'); ?>
</div>