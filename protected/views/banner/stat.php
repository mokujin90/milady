<?php
/**
 * @var $form CActiveForm
 */
Yii::app()->clientScript->registerScriptFile('/js/vendor/flot/jquery.flot.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/vendor/flot/jquery.flot.time.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/vendor/flot/curvedLines.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/vendor/flot.tooltip/js/jquery.flot.tooltip.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/vendor/flot/jquery.flot.resize.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('/js/vendor/flot/jquery.flot.resize.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('initChart', "var chartInit = " . $chart . ";", CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('init', 'feedBannerStat.init();', CClientScript::POS_READY);

?>
<style>
    .flot-chart {
        display: block;
        height: 200px;
    }

    .flot-chart-content {
        width: 100%;
        height: 100%;
    }
</style>
<div class="padding-md">

    <div class="row clear-fix">
        <div class="col-lg-12">
            <?php $form=$this->beginWidget('CActiveForm',array('htmlOptions'=>array('class'=>'form-horizontal no-margin form-border'))); ?>
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <span class="pull-left"><i class="fa fa-filter fa-lg"></i> Фильтр</span>
                    <ul class="tool-bar">
                        <?=CHtml::submitButton('Применить',array('class'=>'btn btn-primary btn-xs'))?>
                    </ul>
                </div>
                <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">С</label>
                            <div class="col-lg-4">
                                <?= CHtml::textField('filter[from]', $filter['from'], array(
                                    'data-provide' => "datepicker",
                                    'data-date-format' => "yyyy-mm-dd",
                                    'data-date-today-highlight' => "true",
                                    'data-date-language' => "en-GB",
                                    'class' => 'form-control',
                                    'style'=>'width: 60%;'
                                )) ?>
                            </div>
                            <label class="col-lg-2 control-label">По</label>
                            <div class="col-lg-4">
                                <?= CHtml::textField('filter[to]', $filter['to'], array(
                                    'data-provide' => "datepicker",
                                    'data-date-format' => "yyyy-mm-dd",
                                    'data-date-today-highlight' => "true",
                                    'data-date-language' => "en-GB",
                                    'class' => 'form-control',
                                    'style'=>'width: 60%;'
                                )) ?>
                            </div>
                        </div>

                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>

    </div>
    <div class="row clear-fix">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <span class="pull-left"><i class="fa fa-bar-chart-o fa-lg"></i> Клики/Показы</span>
                    <ul class="tool-bar">
                        <a href="<?=$model->createEditUrl()?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil fa-lg"></i> Редактировать объявление</a>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="flot-chart">
                        <div class="flot-chart-content" id="flot-chart"></div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row row-merge">
                        <div class="col-xs-4 text-center border-right">
                            <h4 class="no-margin"><?=$stat['view'] ? $stat['view'] : 0?></h4>
                            <small class="text-muted">Всего показов</small>
                        </div>
                        <div class="col-xs-4 text-center border-right">
                            <h4 class="no-margin"><?=$stat['click'] ? $stat['click'] : 0?></h4>
                            <small class="text-muted">Всего кликов</small>
                        </div>
                        <div class="col-xs-4 text-center border-right">
                            <h4 class="no-margin"><?=number_format($stat['view'] ? $stat['click'] / $stat['view'] : 0, 2)?></h4>
                            <small class="text-muted">Средний CTR</small>
                        </div>
                    </div><!-- ./row -->
                </div>
            </div><!-- /panel -->

        </div><!-- /.col -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <span class="pull-left"><i class="fa fa-bar-chart-o fa-lg"></i> CTR</span>
                    <!--ul class="tool-bar">
                        <li><a href="#" class="refresh-widget" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a></li>
                    </ul-->
                </div>
                <div class="panel-body">
                    <div class="flot-chart">
                        <div class="flot-chart-content" id="flot-ctr-chart"></div>
                    </div>
                </div>
            </div><!-- /panel -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</div>