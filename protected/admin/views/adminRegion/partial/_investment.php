<div class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'investment_climate', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'investment_climate', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'investment_climate'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'investment_banking', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'investment_banking', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'investment_banking'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'investment_support_structure', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'investment_support_structure', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'investment_support_structure'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'investment_regional', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'investment_regional', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'investment_regional'); ?>
        </div>
    </div>
</div>