<?
/**
 * @var $model Project
 */
?>
<script type="text/javascript">
    $(function() {
        $('.contact #Project_has_user_contact').change(function(){
            var isShow = $(this).prop('checked');
            if(isShow){
                $('.contact .toggle').hide();
            }
            else{
                $('.contact .toggle').show();
            }
        });
    });
</script>
<div class="panel panel-default contact">
    <div class="panel-heading">
        <?= Yii::t('main', 'Контактная информация') ?>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <?php echo $form->labelEx($model,'has_user_contact',array('class' => 'col-lg-2 control-label')); ?>
            <div class="col-lg-10">
                <label class="label-checkbox inline">
                    <?php echo $form->checkBox($model,'has_user_contact'); ?>
                    <span class="custom-checkbox"></span>
                </label>
                <?php echo $form->error($model,'has_user_contact'); ?>
            </div><!-- /.col -->
        </div><!-- /form-group -->
        <div class="toggle form-group" style="<?if($model->has_user_contact):?>display: none;<?endif;?>">
            <?php if (in_array($model->type, array(Project::T_SITE))): ?>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'contact_partner',array('class' => 'col-lg-2 control-label')); ?>
                    <div class="col-lg-10">
                        <?php echo $form->textField($model,'contact_partner',array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'contact_partner'); ?>
                    </div><!-- /.col -->
                </div><!-- /form-group -->
            <?php endif; ?>

            <div class="form-group">
                <?php echo $form->labelEx($model,'contact_address',array('class' => 'col-lg-2 control-label')); ?>
                <div class="col-lg-10">
                    <?php echo $form->textArea($model,'contact_address',array('placeholder' => Makeup::holder(), 'class' => 'form-control')); ?>
                    <?php echo $form->error($model,'contact_address'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->

            <div class="form-group">
                <?php echo $form->labelEx($model,'contact_face',array('class' => 'col-lg-2 control-label')); ?>
                <div class="col-lg-10">
                    <?php echo $form->textField($model,'contact_face',array('class' => 'form-control')); ?>
                    <?php echo $form->error($model,'contact_face'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->

            <div class="form-group">
                <?php echo $form->labelEx($model,'contact_role',array('class' => 'col-lg-2 control-label')); ?>
                <div class="col-lg-10">
                    <?php echo $form->textField($model,'contact_role',array('class' => 'form-control')); ?>
                    <?php echo $form->error($model,'contact_role'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->

            <div class="form-group">
                <?php echo $form->labelEx($model,'contact_phone',array('class' => 'col-lg-2 control-label')); ?>
                <div class="col-lg-10">
                    <?php echo $form->textField($model,'contact_phone',array('class' => 'form-control')); ?>
                    <?php echo $form->error($model,'contact_phone'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->

            <div class="form-group">
                <?php echo $form->labelEx($model,'contact_fax',array('class' => 'col-lg-2 control-label')); ?>
                <div class="col-lg-10">
                    <?php echo $form->textField($model,'contact_fax',array('class' => 'form-control')); ?>
                    <?php echo $form->error($model,'contact_fax'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->

            <div class="form-group">
                <?php echo $form->labelEx($model,'contact_email',array('class' => 'col-lg-2 control-label')); ?>
                <div class="col-lg-10">
                    <?php echo $form->emailField($model,'contact_email',array('class' => 'form-control')); ?>
                    <?php echo $form->error($model,'contact_email'); ?>
                </div><!-- /.col -->
            </div><!-- /form-group -->
        </div>
    </div>
</div>