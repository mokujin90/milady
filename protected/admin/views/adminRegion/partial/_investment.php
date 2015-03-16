<div class="col-xs-12">
    <h2 class="col-xs-12">Инвестиционный климат</h2>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'invest_rating', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'invest_rating', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'invest_rating'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'invest_risk_position', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'invest_risk_position', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'invest_risk_position'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'invest_potential_position', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'invest_potential_position', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'invest_potential_position'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'invest_position_source', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'invest_position_source', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'invest_position_source'); ?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'invest_capital_chart', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('data'=>$model->content->invest_capital_chart, 'header'=>array('', 'Год', '', ''),
                    'options'=>array(),'name'=>'sportChart', 'inputClass' => 'form-control', 'chart' => true, 'withChartMeta' => true,
                    'chartMeta' => array('Округ', 'Регион')
                ));?>
            <?php echo $form->error($model->content, 'invest_capital_chart'); ?>
        </div>
    </div>
    <hr class="col-xs-12">
    <h2 class="col-xs-12">Банковская сфера</h2>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "Крупнейшие банки"); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('model'=>$model->banks, 'header'=>RegionCompany::getHeader(),
                    'options'=>array(),'name'=>'RegionBank', 'inputClass' => 'form-control',
                    'fieldType' => array('media_id' => 'media')
                ));?>
        </div>
    </div>
    <hr class="col-xs-12">
    <h2 class="col-xs-12">Структура поддержки и обслуживания бизнеса</h2>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "Крупнейшие банки"); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('model'=>$model->businessBanks, 'header'=>RegionCompany::getHeader(),
                    'options'=>array(),'name'=>'RegionBusinessBank', 'inputClass' => 'form-control',
                    'fieldType' => array('media_id' => 'media')
                ));?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "Организации, координирующие инвестиционную деятельность"); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('model'=>$model->orgs, 'header'=>RegionCompany::getHeader(),
                    'options'=>array(),'name'=>'RegionOrg', 'inputClass' => 'form-control',
                    'fieldType' => array('media_id' => 'media')
                ));?>
        </div>
    </div>
    <hr class="col-xs-12">
    <h2 class="col-xs-12">Направления региональной инвестиционной политики</h2>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'invest_politics_text', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'invest_politics_text', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'invest_politics_text'); ?>
        </div>
    </div>
    <!--div class="form-group">
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
    </div-->
</div>