<?php
/**
 * Единый центр со списком сообщений, входящих или исходящих
 * @var MessageController $this
 * @var Message[] $models
 */
$admin = Candy::get($admin,false);
$action = Yii::app()->controller->action->id; # inbox или sent
?>
<?$this->widget('CLinkPager', array('pages'=>$pages));?>
    <div class="main-column">
        <div class="full-column opacity-box overflow">
            <div class="table-header deleted">
                <span class="user-info"><?=Yii::t('main','От кого')?></span>
                <span class="user-info"><?= Yii::t('main','Кому')?></span>
                <span class="hide-320"><?= Yii::t('main','Тема письма')?></span>
            </div>
            <div class="row message list clear">
                <?if(empty($models)):?>
                    <p><?= Yii::t('main','Удаленных сообщений нет')?></p>
                <?endif?>
                <table class="deleted">
                    <?foreach($models as $model):?>
                        <tr class="item">
                            <td class="user-info">
                                <span class="from"><?=!$model->userFrom ? 'Системное сообщение' : $model->userFrom->name?></span>
                            </td>
                            <td class="user-info">
                                <span class="to"><?=$model->userTo->name?></span>
                            </td>
                            <td>
                                <a class="subject full-td" href="<?=$this->createUrl($admin ? 'adminMessages/detail':'message/detail',array('id'=>$model->id))?>">
                                    <?=$model->subject?>
                                </a>
                            </td>
                        </tr>
                    <?endforeach?>
                </table>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?$this->widget('CLinkPager', array('pages'=>$pages,));?>
<?=CHtml::hiddenField('action',Yii::app()->controller->action->id,array('id'=>'action-name'))?>