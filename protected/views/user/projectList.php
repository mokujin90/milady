<?php
/**
 *
 * @var SiteController $this
 */
Yii::app()->clientScript->registerScript('init', 'projectList.init();', CClientScript::POS_READY);
?>
<style>
    .red-box {
        background: #F00;
        font-size: 12px;
        line-height: 20px;
        width: 120px;
    }
</style>
<div class="panel-tab clearfix" style="border-bottom: 1px solid #eee;">
    <ul class="tab-bar">
        <li <?= $type == Project::T_INVEST ? 'class="active"' : ''?>><a href="/user/projectList/type/<?=Project::T_INVEST?>">Инвестиционные</a></li>
        <li <?= $type == Project::T_INFRASTRUCT ? 'class="active"' : ''?>><a href="/user/projectList/">Инфраструктурные</a></li>
        <li <?= $type == Project::T_INNOVATE ? 'class="active"' : ''?>><a href="/user/projectList/type/<?=Project::T_INNOVATE?>">Иновационные</a></li>
        <li <?= $type == Project::T_SITE ? 'class="active"' : ''?>><a href="/user/projectList/type/<?=Project::T_SITE?>">Инвестиционные площадки</a></li>
        <li <?= $type == Project::T_BUSINESS ? 'class="active"' : ''?>><a href="/user/projectList/type/<?=Project::T_BUSINESS?>">Бизнес</a></li>
    </ul>
</div>

<div class="padding-md">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Yii::t('main','Проекты')?>
            <?=CHtml::link(Yii::t('main','Удалить'),'#',array('class'=>'btn btn-xs btn-danger many-delete pull-right'))?>
            <div class="btn-group pull-right" style="margin-right: 5px;">
                <button class="btn btn-default dropdown-toggle btn-xs btn-success" data-toggle="dropdown">Добавить <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="/user/InvestmentProject">Инвестиционный проект</a></li>
                    <li><a href="/user/InnovativeProject">Инновационный проект</a></li>
                    <li><a href="/user/InvestmentSite">Инвестиционная площадка</a></li>
                    <li><a href="/user/InfrastructureProject">Инфраструктурный проект</a></li>
                    <li><a href="/user/Business">Продажа бизнеса</a></li>
                </ul>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped" id="responsiveTable">
                <thead>
                <tr>
                    <th width="50px;"></th>
                    <th>Название</th>
                </tr>
                </thead>
                <tbody>
                <?if(empty($models)):?>
                    <tr><td colspan="3">Список пуст</td></tr>
                <?endif?>
                <?foreach($models as $model):?>
                    <tr>
                        <td>
                            <label class="label-checkbox">
                                <input type="checkbox" class="chk-row project-input" value="<?=$model->id?>">
                                <span class="custom-checkbox"></span>
                            </label>
                        </td>
                        <td><?=CHtml::link($model->name, $this->createUrl("user/" . Project::$urlByType[$model->type], array('id' => $model->id)));?></td>
                    </tr>
                <?endforeach?>
                </tbody>
            </table>
        </div>
        <div class="panel-footer clearfix">
            <div class="text-center">
                <?
                $this->widget('CLinkPager', array(
                    'pages'=>$pages,
                    'htmlOptions' => array('class' => 'pagination pagination-split pagination-sm'),
                    'selectedPageCssClass' => 'active',
                    'nextPageLabel' => '»',
                    'prevPageLabel' => '«',
                    'lastPageCssClass' => 'hidden',
                    'firstPageCssClass' => 'hidden'
                ));?>
            </div>
        </div>
    </div>
</div>
