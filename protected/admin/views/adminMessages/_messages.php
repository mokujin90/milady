<?foreach($models as $item):?>
    <li class="<?=($item->user_from == NULL && $item->admin_type) || $item->from_admin ? 'right' : 'left'?> clearfix">
        <?if(($item->user_from == NULL && $item->admin_type) || $item->from_admin){?>
            <span class="chat-img pull-right"><?= $item->userFrom ? Candy::preview(array($item->userFrom->logo, 'scale' => '45x45')) : '<img src="/images/assets/img-1.png">'?></span>
        <?} else {?>

            <span class="chat-img pull-left"><?= $item->userFrom ? Candy::preview(array($item->userFrom->logo, 'scale' => '45x45')) : '<img src="/images/assets/img-1.png">'?></span>
        <?}?>
        <div class="chat-body clearfix">
            <div class="header">
                <?php if($item->project):?>
                    <? //=Yii::t('main','��������� �� ������� "{project}"',array('{project}'=>$item->project->name))?>
                    <?=$item->project->name?>
                <?php endif;?>
                <strong class="primary-font">
                    <?= CHtml::tag('strong', array(), $item->getFromUserLabel('userFrom'));?>
                </strong>
                <small class="pull-right text-muted" style="margin: 0 5px;"><i class="fa fa-calendar fa-fw"></i> <?= $item->create_date?></small>
            </div>
            <p></p>
            <?if($item->user_from && !$item->admin_type):?>
                <?=CHtml::tag('div', array('class' => 'system message-textarea'), nl2br(trim(CHtml::encode($item->text))))?>
            <?else:?>
                <?=CHtml::tag('div', array('class' => 'system message-textarea'), $item->text)?>
            <?endif?>
            <div id="file-list">
                <?=MessageController::drawFileList($item->files)?>
            </div>
            <div class="clear"></div>

        </div>
    </li>
<?endforeach?>