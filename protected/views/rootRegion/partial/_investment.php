<div class="row">
    <?php echo $form->labelEx($model->content,'investment_climate'); ?>
    <?php echo $form->textArea($model->content,'investment_climate',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'investment_climate'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'investment_banking'); ?>
    <?php echo $form->textArea($model->content,'investment_banking',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'investment_banking'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'investment_support_structure'); ?>
    <?php echo $form->textArea($model->content,'investment_support_structure',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'investment_support_structure'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'investment_regional'); ?>
    <?php echo $form->textArea($model->content,'investment_regional',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'investment_regional'); ?>
</div>