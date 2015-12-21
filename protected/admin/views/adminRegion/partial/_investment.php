<div class="col-xs-12">
    <h2 class="col-xs-12">Инвестиционный климат</h2>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'invest_rating', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'invest_rating', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'invest_rating'); ?>
        </div>
    </div>
    <?php $this->renderPartial('partial/_proofFields',array(
        'model'=>$model,
        'field' => 'invest_rating',
        'relation' => 'regionProofInvestRating'
    )); ?>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'invest_risk_position', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'invest_risk_position', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'invest_risk_position'); ?>
        </div>
    </div>
    <?php $this->renderPartial('partial/_proofFields',array(
        'model'=>$model,
        'field' => 'invest_risk_position',
        'relation' => 'regionProofRiskPosition'
    )); ?>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'invest_potential_position', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'invest_potential_position', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'invest_potential_position'); ?>
        </div>
    </div>
    <?php $this->renderPartial('partial/_proofFields',array(
        'model'=>$model,
        'field' => 'invest_potential_position',
        'relation' => 'regionProofPotentialPosition'
    )); ?>
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
                    'options'=>array(),'name'=>'capitalChart', 'inputClass' => 'form-control', 'chart' => true, 'withChartMeta' => true,
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
            <?$this->renderPartial('partial/_companies',  array('models'=>$model->banks, 'name' => 'RegionBank'));?>
            <?/*$this->widget('crud.grid',
                array('model'=>$model->banks, 'header'=>RegionCompany::getHeader(),
                    'options'=>array(),'name'=>'RegionBank', 'inputClass' => 'form-control',
                    'fieldType' => array('media_id' => 'media')
                ));*/?>
        </div>
    </div>
    <hr class="col-xs-12">
    <h2 class="col-xs-12">Структура поддержки и обслуживания бизнеса</h2>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "Бизнес-ассоциации и некоммерческие партнерства"); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->renderPartial('partial/_companies',  array('models'=>$model->businessBanks, 'name' => 'RegionBusinessBank'));?>
            <?/*$this->widget('crud.grid',
                array('model'=>$model->businessBanks, 'header'=>RegionCompany::getHeader(),
                    'options'=>array(),'name'=>'RegionBusinessBank', 'inputClass' => 'form-control',
                    'fieldType' => array('media_id' => 'media')
                ));*/?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "Организации, координирующие инвестиционную деятельность"); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->renderPartial('partial/_companies',  array('models'=>$model->orgs, 'name' => 'RegionOrg'));?>
            <?/*$this->widget('crud.grid',
                array('model'=>$model->orgs, 'header'=>RegionCompany::getHeader(),
                    'options'=>array(),'name'=>'RegionOrg', 'inputClass' => 'form-control',
                    'fieldType' => array('media_id' => 'media')
                ));*/?>
        </div>
    </div>
    <hr class="col-xs-12">
    <h2 class="col-xs-12">Направления региональной инвестиционной политики</h2>
    <div class="form-group" style="clear: both;  margin-bottom: 10px;">
    <?php echo CHtml::label('Прикрепленные документы','', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div id="col-xs-12 col-sm-8 upload-block">
            <?=$this->renderPartial('_upload',array('model'=>$model))?>
        </div>
    </div>

    <div class="form-group" style="clear: both;  margin-bottom: 10px;">
        <?php echo $form->labelEx($model->content, 'invest_politics_text', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'invest_politics_text', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor form-control')); ?>
            <?php echo $form->error($model->content, 'invest_politics_text'); ?>
        </div>
    </div>
</div>