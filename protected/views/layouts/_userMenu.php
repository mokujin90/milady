<?if(Yii::app()->user->isGuest):?>
    <div class="personal personal_sing-in">
        <a class="personal__link auth-fancy" href="#auth-content"><?=Yii::t('main','Вход')?></a>
        <span class="personal__colon">/</span>
        <a class="personal__link reg-fancy" href="#reg-content"><?=Yii::t('main','Регистрация')?></a>
    </div><!--personal-->
<?else:?>
    <div class="personal">
                    <span class="personal__icon-wrap">
                        <?=$this->user->logo ? Candy::preview(array($this->user->logo, 'scale' => '29x27')) : '<i class="icon icon-personal pos-center"></i>'?>
                    </span>
        <a href="#" class="personal__user"><?=$this->user->name?></a>
        <div class="personal-list">
            <?php echo CHtml::link(Yii::t('main','Личный кабинет'),array('user/index'),array('class' => 'personal-list__link'))?>
            <?php echo CHtml::link(Yii::t('main','Профиль'),array('user/profile'),array('class' => 'personal-list__link'))?>
            <?if($this->user->type==User::T_INITIATOR){?>
                <?php echo CHtml::link(Yii::t('main','Проекты'),array('user/projectList'),array('class' => 'personal-list__link'))?>
            <?}?>
            <?php //echo CHtml::link(Yii::t('main','Реклама'),array('banner/index'),array('class' => 'personal-list__link'))?>
            <?php echo CHtml::link(Yii::t('main','Избранное'),array('user/favoriteList'),array('class' => 'personal-list__link'))?>
            <?php echo CHtml::link(Yii::t('main','Сообщения') . "<span class='personal-list__count'>" . Message::getUnreadCount('all') ."</span>",array('user/logout'),array('class' => 'personal-list__link'))?>
            <?php echo CHtml::link(Yii::t('main','Выйти'),array('user/logout'),array('class' => 'personal-list__link'))?>
        </div><!--personal-list-->
    </div><!--personal-->
<?endif;?>