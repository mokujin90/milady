<div class="row">
    <?php echo $form->labelEx($model->content,'social_overview'); ?>
    <?php echo $form->textArea($model->content,'social_overview',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'social_overview'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'social_natural_resources'); ?>
    <?php echo $form->textArea($model->content,'social_natural_resources',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'social_natural_resources'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'social_ecology'); ?>
    <?php echo $form->textArea($model->content,'social_ecology',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'social_ecology'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'social_population'); ?>
    <?php echo $form->textArea($model->content,'social_population',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'social_population'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'social_economy'); ?>
    <?php echo $form->textArea($model->content,'social_economy',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'social_economy'); ?>
</div>