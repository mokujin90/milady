<?php echo $form->errorSummary($model->content); ?>

<div class="row">
    <?php echo $form->labelEx($model,'name'); ?>
    <?php echo $form->textField($model,'name',array()); ?>
    <?php echo $form->error($model,'name'); ?>
</div>

<div class="row">
    <span id="logo_block" class="rel">
        <?=Candy::preview(array($model->content->logo, 'scale' => '100x100'))?>
        <?php echo CHtml::hiddenField('logo_id',$model->content->logo_id)?>
    </span>

    <?php
    $this->widget('application.components.MediaEditor.MediaEditor',
        array('data' => array(
            'items' => null,
            'field' => 'logo_id',
            'item_container_id' => 'logo_block',
            'button_image_url' => '/images/markup/logo.png',
            'button_width' => 28,
            'button_height' => 28,
        ),
            'scale' => '100x100',
            'scaleMode' => 'in',
            'needfields' => 'false'));
    ?>
    <?php echo CHtml::button(Yii::t('main','Загрузить герб'),array('class'=>'open-dialog btn'))?>
</div>
<div class="row">
    <?php echo $form->labelEx($model->content,'мayor'); ?>
    <?php echo $form->textField($model->content,'мayor',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($model->content,'мayor'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'investor_support'); ?>
    <?php echo $form->textField($model->content,'investor_support',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($model->content,'investor_support'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'investor_support_url'); ?>
    <?php echo $form->textField($model->content,'investor_support_url',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($model->content,'investor_support_url'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'info'); ?>
    <?php echo $form->textArea($model->content,'info',array('rows'=>6, 'cols'=>50)); ?>
    <?php echo $form->error($model->content,'info'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'mayor_text'); ?>
    <?php echo $form->textArea($model->content,'mayor_text',array('rows'=>6, 'cols'=>50)); ?>
    <?php echo $form->error($model->content,'mayor_text'); ?>
</div>

<div class="row">
    <div id="mayor_block" class="rel">
        <?=Candy::preview(array($model->content->mayor, 'scale' => '102x102'))?>
        <?php echo CHtml::hiddenField('mayor_logo',$model->content->mayor_logo)?>
    </div>

    <?php
    $this->widget('application.components.MediaEditor.MediaEditor',
        array('data' => array(
            'items' => null,
            'field' => 'mayor_logo',
            'item_container_id' => 'mayor_block',
            'button_image_url' => '/images/markup/logo.png',
            'button_width' => 28,
            'button_height' => 28,
        ),
            'scale' => '102x102',
            'scaleMode' => 'in',
            'needfields' => 'false'));
    ?>
    <?php echo CHtml::button(Yii::t('main','Загрузить фото мэра'),array('class'=>'open-dialog btn'))?>
    <?php echo $form->error($model->content,'mayor_logo'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'investor_support_text'); ?>
    <?php echo $form->textArea($model->content,'investor_support_text',array('rows'=>6, 'cols'=>50)); ?>
    <?php echo $form->error($model->content,'investor_support_text'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'administrative_center'); ?>
    <?php echo $form->textField($model->content,'administrative_center',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($model->content,'administrative_center'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'area'); ?>
    <?php echo $form->textField($model->content,'area'); ?>
    <?php echo $form->error($model->content,'area'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'populate'); ?>
    <?php echo $form->textField($model->content,'populate'); ?>
    <?php echo $form->error($model->content,'populate'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'federal_district'); ?>
    <?php echo $form->textField($model->content,'federal_district',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($model->content,'federal_district'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'times'); ?>
    <?php echo $form->textField($model->content,'times',array('size'=>50,'maxlength'=>50)); ?>
    <?php echo $form->error($model->content,'times'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'gross_regional_product'); ?>
    <?php echo $form->textField($model->content,'gross_regional_product'); ?>
    <?php echo $form->error($model->content,'gross_regional_product'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'gross_regional_product_personal'); ?>
    <?php echo $form->textField($model->content,'gross_regional_product_personal'); ?>
    <?php echo $form->error($model->content,'gross_regional_product_personal'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'investment_capital'); ?>
    <?php echo $form->textField($model->content,'investment_capital'); ?>
    <?php echo $form->error($model->content,'investment_capital'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'investment_capital_personal'); ?>
    <?php echo $form->textField($model->content,'investment_capital_personal'); ?>
    <?php echo $form->error($model->content,'investment_capital_personal'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'salary'); ?>
    <?php echo $form->textField($model->content,'salary'); ?>
    <?php echo $form->error($model->content,'salary'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'cost_of_living'); ?>
    <?php echo $form->textField($model->content,'cost_of_living'); ?>
    <?php echo $form->error($model->content,'cost_of_living'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'foreign_investment'); ?>
    <?php echo $form->textField($model->content,'foreign_investment'); ?>
    <?php echo $form->error($model->content,'foreign_investment'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'foreign_investment_person'); ?>
    <?php echo $form->textField($model->content,'foreign_investment_person'); ?>
    <?php echo $form->error($model->content,'foreign_investment_person'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'weight_profit'); ?>
    <?php echo $form->textField($model->content,'weight_profit'); ?>
    <?php echo $form->error($model->content,'weight_profit'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'unemployment'); ?>
    <?php echo $form->textField($model->content,'unemployment'); ?>
    <?php echo $form->error($model->content,'unemployment'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'city'); ?>
    <?php echo $form->textField($model->content,'city',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($model->content,'city'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'day_sunny'); ?>
    <?php echo $form->textField($model->content,'day_sunny'); ?>
    <?php echo $form->error($model->content,'day_sunny'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'winter_temperatures'); ?>
    <?php echo $form->textField($model->content,'winter_temperatures'); ?>
    <?php echo $form->error($model->content,'winter_temperatures'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'nature_zone'); ?>
    <?php echo $form->textField($model->content,'nature_zone'); ?>
    <?php echo $form->error($model->content,'nature_zone'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'year_rain'); ?>
    <?php echo $form->textField($model->content,'year_rain'); ?>
    <?php echo $form->error($model->content,'year_rain'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model->content,'summer_temperatures'); ?>
    <?php echo $form->textField($model->content,'summer_temperatures'); ?>
    <?php echo $form->error($model->content,'summer_temperatures'); ?>
</div>