<div class="row">
    <?php echo $form->labelEx($model->content,'innovation_proportion'); ?>
    <?php echo $form->textArea($model->content,'innovation_proportion',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'innovation_proportion'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'innvation_costs'); ?>
    <?php echo $form->textArea($model->content,'innvation_costs',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'innvation_costs'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'innvation_NIOKR'); ?>
    <?php echo $form->textArea($model->content,'innvation_NIOKR',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'innvation_NIOKR'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'innvation_scientific_potential'); ?>
    <?php echo $form->textArea($model->content,'innvation_scientific_potential',array('rows'=>6, 'cols'=>50,'class'=>'rte')); ?>
    <?php echo $form->error($model->content,'innvation_scientific_potential'); ?>
</div>