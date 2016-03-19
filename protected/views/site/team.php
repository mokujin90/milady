<h2 class="page-title page-title_pt"><?=Yii::t('main', 'Команда')?></h2>

<div class="team spacer">
    <?
    $count = 0;
    foreach($content->content2Object as $object){
        if($user = User::model()->findByPk($object->object_id)) {
            if($count%3 == 0 && $count > 0){
                echo '<hr>';
            }
            $count++;
            ?>
            <div class="team-user">
                <div class="team-user__photo">
                    <?=$user->logo ? Candy::preview(array($user->logo, 'scale' => '117x117', 'upScale' => 1)) : '<img src="/images/frontend/team/user-man-default.png" alt="Фото"/>'?>
                </div><!--team-user__photo-->

                <p class="team-user__position"><?=CHtml::encode($user->post)?></p>
                <p class="team-user__name"><?=CHtml::encode($user->name)?></p>
                <?if(Yii::app()->user->isGuest){?>
                    <a class="auth-fancy" href="#auth-content"><div class="blue-btn team-user__btn"><?=Yii::t('main', 'Отправить сообщение')?></div></a>
                <?}else{?>
                    <a href="<?=$this->createUrl('message/create', array('to' => $user->id))?>"><div class="blue-btn team-user__btn"><?=Yii::t('main', 'Отправить сообщение')?></div></a>
                <?}?>
            </div><!--team-user-->
    <?}}?>
</div><!--team-->

<?$this->renderPartial('../partial/_register', array('class' => 'registration_one'))?>
