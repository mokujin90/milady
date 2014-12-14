<?
$investors2project = $model->investor2Projects;
?>
<div class="main-column opacity-box">
    <div class="full-column">
        <div class="row">
            <div class="caption"><?= Yii::t('main','Присоединенные инвесторы')?></div>
        </div>
        <div class="row project list">
            <?if(empty($investors2project)):?>
                <p>Список пуст</p>
            <?endif?>
            <table class="border">
                <tbody>
                <?foreach($investors2project as $investor):?>
                    <tr class="item ">
                        <td class="user-info">
                            <?=$investor->user->name?>
                        </td>
                        <td width="30%" >
                            <?php if(!$investor->is_active):?>
                                <?php echo CHtml::link(Yii::t('main','Добавить в проект'),array('project/approveRequest','requestId'=>$investor->id),array())?>
                            <?php endif;?>
                        </td>
                        <td width="30%" >
                            <?php echo CHtml::link(Yii::t('main','Удалить из проекта'),array('project/removeRequest','requestId'=>$investor->id),array())?>
                        </td>
                    </tr>
                <?endforeach?>

                </tbody>
            </table>

        </div>
    </div>
</div>