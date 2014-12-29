<?php
/**
 *
 * @var BannerController $this
 * @var Banner[] $models
 */
?>
<div class="lk banner" id="general">
    <div class="content columns">
        <div class="main-column" style="margin-left: 0;">
            <?$this->widget('CLinkPager', array('pages'=>$pages,));?>
            <div class="full-column opacity-box overflow">
                <div class="row">
                    <a href="<?=$this->createUrl('banner/edit')?>" class="btn corner-btn"><?= Yii::t('main','Новый баннер')?></a>
                    <div class="caption"><?= Yii::t('main','Мои баннеры')?></div>
                </div>
                <div class="row project list" style="padding: 0;">
                    <?if(empty($models)):?>
                        <p>Список пуст</p>
                    <?else:?>
                        <table class="border">
                            <?foreach($models as $model):?>
                                <tr class="item">
                                    <td class="user-info"><?=CHtml::encode($model->url)?></td>
                                    <td><?=Banner::statusList($model->status);?></td>
                                    <td><?=CHtml::link(Yii::t('main','Редактировать'),array('edit','id'=>$model->id))?></td>
                                    <td><?=CHtml::link(Yii::t('main','Удалить'),array('remove','id'=>$model->id),array('class'=>'delete-button'))?></td>
                                </tr>
                            <?endforeach?>
                        </table>
                    <?endif?>
                </div>
                <div class="clear"></div>
            </div>
            <?$this->widget('CLinkPager', array('pages'=>$pages,));?>
            <div class="clear"></div>
        </div>
    </div>
</div>