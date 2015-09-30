<?php
/**
 * Единый центр со списком сообщений, входящих или исходящих
 * @var MessageController $this
 * @var Dialog[] $models
 */
$admin = Candy::get($admin,false);
$action = Yii::app()->controller->action->id;  # inbox или sent
if($action == 'sent'){
    $detailLink = $admin ? 'adminMessages/view' : 'message/view';
    $userRelation = 'userTo';
}
elseif($action == 'inbox'){
    $detailLink =  $admin ? 'adminMessages/detail' :'message/detail';
    $userRelation = 'userFrom';
}

?>
<?$this->widget('CLinkPager', array('pages'=>$pages));?>
<div class="main-column">
    <div class="full-column opacity-box overflow">
        <?if(!empty($models)):?>
            <div class="row">
                <a href="#" class="btn delete-message"><?= Yii::t('main','Удалить выбранные')?></a>
            </div>
        <?endif?>
        <div class="table-header">
            <span class="user-info"><?= $action != 'sent' ? Yii::t('main','От кого') :  Yii::t('main','Кому')?></span>
            <span class="hide-320"><?= Yii::t('main','Тема письма')?></span>
        </div>
        <div class="row message list clear">
            <?if(empty($models)):?>
                <p><?= Yii::t('main','Сообщений нет')?></p>
            <?endif?>
            <table>
            <?foreach($models as $model):?>
                <?$last = $model->getLastMessage();?>
                <tr class="item <?if($last->is_read==0 && $action != 'sent'):?>new<?endif;?>">
                    <td class="user-info">
                        <?=Crud::checkBox('',false,array('value'=>$model->id))?>
                        <span class="from">
                            <?=$last->getFromUserLabel($userRelation)?>
                        </span>
                    </td>
                    <td>
                        <a class="subject full-td" href="<?=$this->createUrl($detailLink,array('id'=>$model->id))?>">
                            <?=$model->subject?>
                        </a>
                    </td>
                </tr>
            <?endforeach?>
            </table>
        </div>
        <?if(!empty($models)):?>
            <div class="row">
                <a href="#" class="btn delete-message"><?= Yii::t('main','Удалить выбранные')?></a>
            </div>
        <?endif?>
        <div class="clear"></div>
    </div>
</div>
<?$this->widget('CLinkPager', array('pages'=>$pages,));?>
<?=CHtml::hiddenField('action',Yii::app()->controller->action->id,array('id'=>'action-name'))?>