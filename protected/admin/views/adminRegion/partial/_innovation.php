<div class="col-xs-12">
    <h2 class="col-xs-12">Инновационная активность региона</h2>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'inno_active_position', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'inno_active_position', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'inno_active_position'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'inno_progress_position', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'inno_progress_position', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'inno_progress_position'); ?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'inno1_chart', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('data'=>$model->content->inno1_chart, 'header'=>array('', 'Год', '%'),
                    'options'=>array(),'name'=>'inno1Chart', 'inputClass' => 'form-control', 'chart' => true
                ));?>
            <?php echo $form->error($model->content, 'inno1_chart'); ?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'inno1_chart', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('data'=>$model->content->inno1_chart, 'header'=>array('', 'Год', '%'),
                    'options'=>array(),'name'=>'inno1Chart', 'inputClass' => 'form-control', 'chart' => true
                ));?>
            <?php echo $form->error($model->content, 'inno1_chart'); ?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'inno3_chart', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('data'=>$model->content->inno3_chart, 'header'=>array('', 'Год', 'Млн.руб.'),
                    'options'=>array(),'name'=>'inno3Chart', 'inputClass' => 'form-control', 'chart' => true
                ));?>
            <?php echo $form->error($model->content, 'inno3_chart'); ?>
        </div>
    </div>
    <hr class="col-xs-12">
    <h2 class="col-xs-12">Инновационная инфраструктура региона</h2>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'active_development_institute_count', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'active_development_institute_count', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'active_development_institute_count'); ?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "Существующая инфраструктура"); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('model'=>$model->developmentInstitutes, 'header'=>RegionCompany::getHeader(),
                    'options'=>array(),'name'=>'RegionDevIns', 'inputClass' => 'form-control',
                    'fieldType' => array('media_id' => 'media')
                ));?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'planned_development_institute_count', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'planned_development_institute_count', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'planned_development_institute_count'); ?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "Строящаяся и планируемая инфраструктура"); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('model'=>$model->planingInfrastructs, 'header'=>RegionCompany::getHeader(),
                    'options'=>array(),'name'=>'RegionPlanInfra', 'inputClass' => 'form-control',
                    'fieldType' => array('media_id' => 'media')
                ));?>
        </div>
    </div>
    <hr class="col-xs-12">
    <h2 class="col-xs-12">Научно-образовательный потенциал региона</h2>
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "Количество образовательных учреждений"); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('model'=>$model->universities, 'header'=>RegionUniversity::getHeader(),
                    'options'=>array(),'name'=>'RegionSchool', 'inputClass' => 'form-control',
                    'fieldType' => array('media_id' => 'media')
                ));?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "Крупнейшие вузы"); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('model'=>$model->greatSchools, 'header'=>RegionCompany::getHeader(),
                    'options'=>array(),'name'=>'RegionSchool', 'inputClass' => 'form-control',
                    'fieldType' => array('media_id' => 'media')
                ));?>
        </div>
    </div>
    <hr class="col-xs-12">
    <!--div class="form-group">
        <?php echo $form->labelEx($model->content, 'innovation_proportion', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'innovation_proportion', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'innovation_proportion'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'innvation_costs', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'innvation_costs', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'innvation_costs'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'innvation_NIOKR', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'innvation_NIOKR', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'innvation_NIOKR'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'innvation_scientific_potential', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'innvation_scientific_potential', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'innvation_scientific_potential'); ?>
        </div>
    </div-->
</div>