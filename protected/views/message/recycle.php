<?php
/**
 * Единый центр со списком сообщений, входящих или исходящих
 * @var MessageController $this
 * @var Message[] $models
 */
$action = $this->actionName;  # inbox или sent
?>
<?$this->widget('CLinkPager', array('pages'=>$pages));?>
    <div class="main-column">
        <div class="full-column opacity-box overflow">
            <div class="table-header deleted">
                <span class="user-info"><?=Yii::t('main','От кого')?></span>
                <span class="user-info"><?= Yii::t('main','Кому')?></span>
                <span><?= Yii::t('main','Тема письма')?></span>
            </div>
            <div class="row message list clear">
                <?if(empty($models)):?>
                    <p><?= Yii::t('main','Удаленных сообщений нет')?></p>
                <?endif?>
                <table class="deleted">
                    <?foreach($models as $model):?>
                        <tr class="item">
                            <td class="user-info">
                                <span class="from"><?=$model->userFrom->name?></span>
                            </td>
                            <td class="user-info">
                                <span class="to"><?=$model->userTo->name?></span>
                            </td>
                            <td>
                                <a class="subject full-td" href="<?=$this->createUrl('message/detail',array('id'=>$model->id))?>">
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
<?=CHtml::hiddenField('action',$this->actionName,array('id'=>'action-name'))?>