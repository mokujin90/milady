<?php echo $form->errorSummary($model->content); ?>
<style type="text/css">
    .form-group{
        clear: both;
    }
</style>
<div class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model,'name', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12 col-sm-4">
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
                    'needfields' => 'false',
                    'crop'=>true));
            ?>
            <?php echo CHtml::button(Yii::t('main','Загрузить герб'),array('class'=>'open-dialog btn'))?>
        </div>
        <div class="col-xs-12 col-sm-8">
            <span id="logo_block" class="rel">
                <?=Candy::preview(array($model->content->logo, 'scaleMode' => 'in', 'scale' => '100x100'))?>
                <?php echo CHtml::hiddenField('logo_id',$model->content->logo_id)?>
            </span>
        </div>
        <div class="map-block" style="height: 300px;clear: both;padding: 10px 0;">
            <?php $this->widget('Map', array(
                'id'=>'map',
                'projects' => $model,
                'draggableBalloon'=>true,
                'htmlOptions'=>array(
                    'style'=>'height:300px'
                )
            )); ?>
            <?=$form->hiddenField($model,'lat',array('id'=>'coords-lat'))?>
            <?=$form->hiddenField($model,'lon',array('id'=>'coords-lon'))?>
        </div>
    </div>
    <?=CHtml::hiddenField('',$model->id,array('id'=>'region-id-value'))?>
    <div class="form-group">
        <?php echo $form->labelEx($model->content,'date_creation', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'date_creation',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'date_creation'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content,'status', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'status',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'status'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content,'mayor_post', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'mayor_post',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'mayor_post'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content,'mayor', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'mayor',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'mayor'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'investor_support', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'investor_support',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'investor_support'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'investor_support_url', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'investor_support_url',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'investor_support_url'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'info', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textArea($model->content,'info',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'info'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'mayor_text', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textArea($model->content,'mayor_text',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'mayor_text'); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12 col-sm-4">
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
                    'scaleMode' => 'out',
                    'needfields' => 'false',
                    'crop'=>true));
            ?>
            <?php echo CHtml::button(Yii::t('main','Загрузить фото мэра'),array('class'=>'open-dialog btn'))?>
        </div>
        <div class="col-xs-12 col-sm-8">
            <span id="mayor_block" class="rel">
                <?=Candy::preview(array($model->content->mayorLogo, 'scale' => '102x102'))?>
                <?php echo CHtml::hiddenField('mayor_logo',$model->content->mayor_logo)?>
            </span>
        </div>
        <?php echo $form->error($model->content,'mayor_logo'); ?>

    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'investor_support_text', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textArea($model->content,'investor_support_text',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'investor_support_text'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'contact_address', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'contact_address',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'contact_address'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content,'contact_phone', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'contact_phone',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'contact_phone'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content,'contact_site', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'contact_site',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'contact_site'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content,'administrative_center', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'administrative_center',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'administrative_center'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'area', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'area', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'area'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'populate', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'populate', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'populate'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'federal_district', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'federal_district',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'federal_district'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'times', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'times',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'times'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'gross_regional_product', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'gross_regional_product', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'gross_regional_product'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'gross_regional_product_personal', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'gross_regional_product_personal', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'gross_regional_product_personal'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'investment_capital', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'investment_capital', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'investment_capital'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'investment_capital_personal', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'investment_capital_personal', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'investment_capital_personal'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'salary', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'salary', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'salary'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'foreign_investment', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'foreign_investment', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'foreign_investment'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'foreign_investment_person', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'foreign_investment_person', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'foreign_investment_person'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'weight_profit', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'weight_profit', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'weight_profit'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'unemployment', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'unemployment', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'unemployment'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'day_sunny', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'day_sunny', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'day_sunny'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'winter_temperatures', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'winter_temperatures', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'winter_temperatures'); ?>
        </div>
    </div>

    <div class="form-group" style="overflow: visible;">
        <?php echo $form->labelEx($model->content,'zoneFormat', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.dropDownList',
                array('model'=>$model->content, 'attribute'=>'zoneFormat','elements'=>RegionContent::getZone(),
                    'options'=>array('multiple'=>true,'placeholder'=>Yii::t('main','Природная зона'))
                ));?>
            <?php echo $form->error($model->content,'zoneFormat'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'year_rain', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'year_rain', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'year_rain'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content,'summer_temperatures', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'summer_temperatures', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'summer_temperatures'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content,'infographic_title', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div class="col-xs-12 col-sm-8">
            <?php echo $form->textField($model->content,'infographic_title', array('class'=>'form-control')); ?>
            <?php echo $form->error($model->content,'infographic_title'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 col-sm-4">
            <?php
            $this->widget('application.components.MediaEditor.MediaEditor',
                array('data' => array(
                    'items' => null,
                    'field' => 'infographic_media_id',
                    'item_container_id' => 'infographic_block',
                    'button_image_url' => '/images/markup/logo.png',
                    'button_width' => 28,
                    'button_height' => 28,
                ),
                    'scale' => '400x300',
                    'scaleMode' => 'in',
                    'needfields' => 'false',
                    'crop'=>true));
            ?>
            <?php echo CHtml::button(Yii::t('main','Загрузить инфографик'),array('class'=>'open-dialog btn'))?>
        </div>
        <div class="col-xs-12 col-sm-8">
            <span id="infographic_block" class="rel">
                <?=Candy::preview(array($model->content->infographic, 'scaleMode' => 'in', 'scale' => '400x300'))?>
                <?php echo CHtml::hiddenField('infographic_media_id',$model->content->infographic_media_id)?>
            </span>
        </div>
        <?php echo $form->error($model->content,'infographic_media_id'); ?>

    </div>
    <h2 class="col-xs-12">Крупнейшие предприятия</h2>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "Крупнейшие предприятия"); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('model'=>$model->companies, 'header'=>RegionCompany::getHeader(),
                    'options'=>array(),'name'=>'RegionCompany', 'inputClass' => 'form-control',
                    'fieldType' => array('media_id' => 'media')
                ));?>
        </div>
    </div>
    <hr class="col-xs-12">
</div>