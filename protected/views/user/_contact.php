<?
/**
 * @var $model Project
 */
?>
<h2><?= Yii::t('main', 'Контактная информация') ?></h2>
<?php if (in_array($model->type, array(Project::T_SITE))): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'contact_partner'); ?>
        <?php echo $form->textField($model, 'contact_partner'); ?>
        <?php echo $form->error($model, 'contact_partner'); ?>
    </div>
<?php endif; ?>

<div class="row">
    <?php echo $form->labelEx($model, 'contact_address'); ?>
    <?php echo $form->textArea($model, 'contact_address', array('placeholder' => Makeup::holder())); ?>
    <?php echo $form->error($model, 'contact_address'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'contact_face'); ?>
    <?php echo $form->textField($model, 'contact_face'); ?>
    <?php echo $form->error($model, 'contact_face'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'contact_role'); ?>
    <?php echo $form->textField($model, 'contact_role'); ?>
    <?php echo $form->error($model, 'contact_role'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'contact_phone'); ?>
    <?php echo $form->textField($model, 'contact_phone', array('placeholder' => Makeup::holder(1))); ?>
    <?php echo $form->error($model, 'contact_phone'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'contact_fax'); ?>
    <?php echo $form->textField($model, 'contact_fax'); ?>
    <?php echo $form->error($model, 'contact_fax'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model, 'contact_email'); ?>
    <?php echo $form->emailField($model, 'contact_email'); ?>
    <?php echo $form->error($model, 'contact_email'); ?>
</div>