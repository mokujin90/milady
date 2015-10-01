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
    <div class="panel panel-default inbox-panel">
        <div class="panel-body">
            <label class="label-checkbox inline">
                <input type="checkbox" id="chk-all">
                <span class="custom-checkbox"></span>
            </label>
            <a class="btn btn-sm btn-danger" href="/message/create"><i class="fa fa-plus"></i> Новый диалог</a>

            <?if(!empty($models)):?>
                <div class="pull-right">
                    <a class="btn btn-sm btn-default delete-message"><i class="fa fa-trash-o"></i> <?= Yii::t('main','Удалить выбранные')?></a>
                </div>
            <?endif?>
        </div>
        <ul class="list-group">
            <?if(empty($models)):?>
                <p><?= Yii::t('main','Сообщений нет')?></p>
            <?endif?>
            <?foreach($models as $model):?>
                <?$last = $model->getLastMessage();?>
                <li class="list-group-item clearfix inbox-item">
                    <label class="label-checkbox inline">
                        <input type="checkbox" class="chk-item" value="<?$model->id?>">
                        <span class="custom-checkbox"></span>
                    </label>
                    <span class="starred">
                    <?if($last->is_read==0) {
                        $class = $last->user_from != Yii::app()->user->id ? 'envelope' : 'send';
                    } else {
                        $class = $last->user_from != Yii::app()->user->id ? 'envelope-o' : 'send-o';
                    }
                    ?>
                    <i class="fa fa-<?=$class?> fa-lg"></i>
                    </span>
                    <span class="from"><?=$model->getUserToModel()->name?></span>
                    <span class="from"><?=$model->subject?></span>

                            <span class="detail">
                                <?=CHtml::link($last->getFromUserLabel($userRelation) . ': ' . $last->text, $this->createUrl($detailLink,array('id'=>$model->id)))?>
                            </span>
                            <span class="inline-block pull-right">
                                <?if(count($last->files)):?>
                                    <span class="attachment"><i class="fa fa-paperclip fa-lg"></i></span>
                                <?endif?>
                                <span class="time"><?=$model->update_date?></span>
                            </span>
                </li>
            <?endforeach?>

        </ul><!-- /list-group -->
        <!--div class="panel-footer clearfix">
            <?$this->widget('CLinkPager', array('pages'=>$pages));?>

            <div class="pull-left">112 messages</div>
            <div class="pull-right">
                <span class="middle">Page 1 of 8 </span>
                <ul class="pagination middle">
                    <li class="disabled"><a href="#"><i class="fa fa-step-backward"></i></a></li>
                    <li class="disabled"><a href="#"><i class="fa fa-caret-left large"></i></a></li>
                    <li><a href="#"><i class="fa fa-caret-right large"></i></a></li>
                    <li><a href="#"><i class="fa fa-step-forward"></i></a></li>
                </ul>
            </div>
        </div-->
    </div>
<?=CHtml::hiddenField('action',Yii::app()->controller->action->id,array('id'=>'action-name'))?>