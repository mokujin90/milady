<div class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'innovation_proportion', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'innovation_proportion', array('rows' => 6, 'cols' => 50, 'class' => 'rte')); ?>
            <?php echo $form->error($model->content, 'innovation_proportion'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'innvation_costs', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'innvation_costs', array('rows' => 6, 'cols' => 50, 'class' => 'rte')); ?>
            <?php echo $form->error($model->content, 'innvation_costs'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'innvation_NIOKR', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'innvation_NIOKR', array('rows' => 6, 'cols' => 50, 'class' => 'rte')); ?>
            <?php echo $form->error($model->content, 'innvation_NIOKR'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'innvation_scientific_potential', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'innvation_scientific_potential', array('rows' => 6, 'cols' => 50, 'class' => 'rte')); ?>
            <?php echo $form->error($model->content, 'innvation_scientific_potential'); ?>
        </div>
    </div>
</div>