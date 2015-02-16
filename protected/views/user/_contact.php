<?
/**
 * @var $model Project
 */
?>
<script type="text/javascript">
    $(function() {
        $('.contact #Project_has_user_contact').change(function(){
            var isShow = $(this).attr('checked');
            if(isShow){
                $('.contact .toggle').hide();
            }
            else{
                $('.contact .toggle').show();
            }
        });
    });
</script>
<h2><?= Yii::t('main', 'Контактная информация') ?></h2>
<div class="contact">
    <div class="row">
        <?php echo $form->checkBox($model, 'has_user_contact'); ?>
        <?php echo $form->labelEx($model, 'has_user_contact',array('style'=>'display:inline-block;')); ?>
        <?php echo $form->error($model, 'has_user_contact'); ?>
    </div>
    <div class="toggle" style="<?if($model->has_user_contact):?>display: none;<?endif;?>">
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
    </div>
</div>