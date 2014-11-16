<?php
/**
 * @var $this AdminProjectController
 * @var $model Project
 */
Yii::app()->clientScript->registerScript('init', 'project.init();', CClientScript::POS_READY);
Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerCssFile('/css/vendor/jquery-ui.min.css');
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'project-form',
    'enableAjaxValidation'=>false,
)); ?>
    <h1><?php echo $model->getProjectType()?></h1>
    <div class="content columns">
        <div class="main-column opacity-box">
            <div class="row">
                <?=CHtml::textField('Project[user_login]',$model->user->name,array('class'=>'autocomplete user-value','placeholder'=>Yii::t('main','Логин или имя пользователя')))?>
                <?=$form->hiddenField($model,'user_id',array('id'=>'field_autocomplete'))?>
            </div>
            <div class="row">
                <div id="logo_block" class="profile-image">

                    <span class="rel">
                        <?=Candy::preview(array($model->logo, 'scale' => '102x102'))?>
                        <?php echo CHtml::hiddenField('logo_id',$model->logo_id)?>
                    </span>
                </div>
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
                        'scale' => '102x102',
                        'scaleMode' => 'in',
                        'needfields' => 'false'));
                ?>
                <br/>
                <div class="btn open-dialog"><?= Yii::t('main','Загрузить логотип')?></div>
            </div>

        </div>
    </div>
    <?php $this->renderPartial('application.views.user.'.lcfirst($contentModel),array(
        'form'=>$form,
        'model'=>$model,
        'admin'=>true,
        'regions'=>$regions = Region::model()->findAll()
    )); ?>

<? $this->endWidget(); ?>