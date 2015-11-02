<?php
/**
 *
 * @var SiteController $this
 */
Yii::app()->clientScript->registerScript('init', 'favList.init();', CClientScript::POS_READY);
?>

<div class="padding-md">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <?= Yii::t('main','Избранные старницы')?>
            <div class="btn-group">
                <button class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Фильтр <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="/user/favoriteList">Все</a></li>
                    <li><a href="/user/favoriteList/type/project">Проекты</a></li>
                    <li><a href="/user/favoriteList/type/news">Новости</a></li>
                    <li><a href="/user/favoriteList/type/analytics">Аналитика</a></li>
                </ul>
            </div>
            <?=CHtml::link(Yii::t('main','Удалить выбранное'),'#',array('class'=>'btn btn-xs btn-danger many-delete pull-right'))?>
        </div>

        <table class="table table-striped" id="responsiveTable">
            <thead>
            <tr>
                <th></th>
                <th>Тип</th>
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
                    <?
                    if ($model->project) {?>
                        <td><span class="label label-success">Проект</span></td>
                        <td><?=CHtml::link($model->project->name, $this->createUrl('project/detail', array('id' => $model->project->id)));?></td>
                    <?} elseif ($model->news) {?>
                        <td><span class="label label-warning">Новости</span></td>
                        <td><?=CHtml::link($model->news->name, $model->news->createUrl());?></td>
                    <?} elseif ($model->analytics) {?>
                        <td><span class="label label-info">Аналитика</span></td>
                        <td><?=CHtml::link($model->analytics->name, $model->analytics->createUrl());?></td>
                    <?}?>
                </tr>
            <?endforeach?>
            </tbody>
        </table>
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
