<?php
/**
 *
 * @var ProjectController $this
 * @var Project $model
 */
?>
<?php if($model->type == Project::T_INVEST):?>
    <?
        $finance = count($model->investment->financeFormat) ? $model->investment->financeFormat : array('one'=>'','two'=>'','three'=>'');
        $no_finRevenueFormat = count($model->investment->no_finRevenueFormat) ? $model->investment->no_finRevenueFormat : array('one'=>'','two'=>'','three'=>'');
        $no_finCleanRevenueFormat = count($model->investment->no_finCleanRevenueFormat) ? $model->investment->no_finCleanRevenueFormat : array('one'=>'','two'=>'','three'=>'');
    ?>
    <h2><?= Yii::t('main','Организационный план')?></h2>
    <div class="row">
        <?php echo CHtml::activeLabel($model->investment,'capital_dev'); ?>
        <?php echo $model->investment->capital_dev; ?>
    </div>
    <div class="row">
        <?php echo CHtml::activeLabel($model->investment,'equipment'); ?>
        <?php echo $model->investment->equipment; ?>
    </div>
    <h2><?= Yii::t('main','Производственный план')?></h2>
    <div class="row">
        <?php echo CHtml::activeLabel($model->investment,'products'); ?>
        <?php echo $model->investment->products; ?>
    </div>
    <div class="row">
        <?php echo CHtml::activeLabel($model->investment,'max_products'); ?>
        <?php echo $model->investment->max_products; ?>
    </div>
    <h2><?= Yii::t('main','Финансовый план')?></h2>
    <div class="row">
        <?php echo CHtml::activeLabel($model->investment,'no_finRevenue'); ?>
        <?$this->widget('crud.grid',
            array('header'=>array('one'=>'1 год','two'=>'2год','three'=>'3 год',),
                'data'=>array($no_finRevenueFormat),
                'name'=>'finRevenue',
                'action'=>1,
                'options'=>array('button'=>false)
            ));?>
    </div>
    <div class="row">
        <?php echo CHtml::activeLabel($model->investment,'no_finCleanRevenue'); ?>
        <?$this->widget('crud.grid',
            array('header'=>array('one'=>'1 год','two'=>'2год','three'=>'3 год',),
                'data'=>array($no_finCleanRevenueFormat),
                'name'=>'finCleanRevenue',
                'action'=>1,
                'options'=>array('button'=>false)
            ));?>
    </div>
    <?php echo CHtml::label(Yii::t('main','Финансовые показатели (за 3 последних года'),''); ?>
    <div class="row">
        <?$this->widget('crud.grid',
            array('header'=>array('one'=>'2014 г.','two'=>'2013 г.','three'=>'2012 г.',),
                'data'=>array($finance),
                'name'=>'Finance',
                'action'=>1,
                'options'=>array('button'=>false)
            ));?>
    </div>
<?php endif;?>
