<div class="col-xs-12">
    <h2 class="col-xs-12">Транспорт</h2>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'motorway_length', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'motorway_length', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'motorway_length'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'railway_length', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'railway_length', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'railway_length'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'waterway_length', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textField($model->content, 'waterway_length', array('class' => 'form-control')); ?>
            <?php echo $form->error($model->content, 'waterway_length'); ?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "Порты"); ?>
        <div class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('model'=>$model->ports, 'header'=>RegionPlace::getHeader(),
                    'options'=>array(),'name'=>'RegionPort', 'inputClass' => 'form-control'
                ));?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "Аэропорты"); ?>
        <div
            class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('model'=>$model->airports, 'header'=>RegionPlace::getHeader(),
                    'options'=>array(),'name'=>'RegionAirport', 'inputClass' => 'form-control'
                ));?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo CHtml::tag('label', array('class' => "col-xs-12 col-sm-4 control-label"), "ЖД вокзалы"); ?>
        <div
            class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('model'=>$model->stations, 'header'=>RegionPlace::getHeader(),
                    'options'=>array(),'name'=>'RegionStation', 'inputClass' => 'form-control'
                ));?>
        </div>
    </div>
    <h2 class="col-xs-12">Здравохранение</h2>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'hospital_count_chart', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('data'=>$model->content->hospital_count_chart, 'header'=>array('', 'Год', 'Кол-во'),
                    'options'=>array(),'name'=>'hospitalChart', 'inputClass' => 'form-control', 'chart' => true
                ));?>
            <?php echo $form->error($model->content, 'hospital_count_chart'); ?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'hospital2_count_chart', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('data'=>$model->content->hospital2_count_chart, 'header'=>array('', 'Год', 'Кол-во'),
                    'options'=>array(),'name'=>'hospital2Chart', 'inputClass' => 'form-control', 'chart' => true
                ));?>
            <?php echo $form->error($model->content, 'hospital2_count_chart'); ?>
        </div>
    </div>
    <h2 class="col-xs-12">Образование</h2>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'school_count_chart', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('data'=>$model->content->school_count_chart, 'header'=>array('', 'Год', 'Кол-во'),
                    'options'=>array(),'name'=>'schoolChart', 'inputClass' => 'form-control', 'chart' => true
                ));?>
            <?php echo $form->error($model->content, 'school_count_chart'); ?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'university_count_chart', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('data'=>$model->content->university_count_chart, 'header'=>array('', 'Год', '1', '2', '3', '4', '5', '6'),
                    'options'=>array(),'name'=>'uniChart', 'inputClass' => 'form-control', 'chart' => true, 'withChartMeta' => true,
                    'chartMeta' => array('Образовательные организации высшего образования', 'Филиалы образовательных организации высшего образования', 'Образовательные учреждения среднего и профессионального образования')
                ));?>
            <?php echo $form->error($model->content, 'university_count_chart'); ?>
        </div>
    </div>
    <h2 class="col-xs-12">Культурно-спортивный комплекс</h2>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'sport_count_chart', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('data'=>$model->content->sport_count_chart, 'header'=>array('', 'Год', '1', '2', '3', '4', '5', '6'),
                    'options'=>array(),'name'=>'sportChart', 'inputClass' => 'form-control', 'chart' => true, 'withChartMeta' => true,
                    'chartMeta' => array('Стадионы с трибунами на 1500 мест и более', 'Плоскостные спортивные сооружения', 'Спортивные залы', 'Плавательные бассейны')
                ));?>
            <?php echo $form->error($model->content, 'sport_count_chart'); ?>
        </div>
    </div>
    <hr class="col-xs-12">
    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'cult_count_chart', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8">
            <?$this->widget('crud.grid',
                array('data'=>$model->content->cult_count_chart, 'header'=>array('', 'Год', '1', '2', '3', '4', '5', '6'),
                    'options'=>array(),'name'=>'cultChart', 'inputClass' => 'form-control', 'chart' => true, 'withChartMeta' => true,
                    'chartMeta' => array('Учреждения культурнодосугового типа', 'Библиотеки', 'Музеи')
                ));?>
            <?php echo $form->error($model->content, 'cult_count_chart'); ?>
        </div>
    </div>
    <hr class="col-xs-12">





    <!--div class="form-group">
        <?php echo $form->labelEx($model->content, 'infra_social_object', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'infra_social_object', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'infra_social_object'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'infra_health', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'infra_health', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'infra_health'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'infra_communal', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'infra_communal', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'infra_communal'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'infra_education', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'infra_education', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'infra_education'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'infra_sport', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'infra_sport', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'infra_sport'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'infra_transport', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'infra_transport', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'infra_transport'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'infra_trade', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'infra_trade', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'infra_trade'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'infra_organiation_turnover', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'infra_organiation_turnover', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'infra_organiation_turnover'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model->content, 'infra_assets_deprication', array('class' => "col-xs-12 col-sm-4 control-label")); ?>
        <div
            class="col-xs-12 col-sm-8"><?php echo $form->textArea($model->content, 'infra_assets_deprication', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
            <?php echo $form->error($model->content, 'infra_assets_deprication'); ?>
        </div>
    </div-->
</div>