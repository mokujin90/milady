<?php
/**
 *
 * @var SiteController $this
 */
?>
<style>
    .red-box {
        background: #F00;
        font-size: 12px;
        line-height: 20px;
        width: 120px;
    }
</style>
<div class="lk project" id="general">
    <div class="content columns">
        <div class="side-column opacity-box">
            <h1>Мои сообщения</h1>
            <div class="side-menu-list">
                <div class="side-menu-item">
                    <a href="#"><i class="icon icon-inbox"></i>Входящие</a>
                    <div class="new-count icon icon-blue-circle">15</div>
                </div>
                <div class="side-menu-item">
                    <a href="#"><i class="icon icon-write"></i>Написать</a>
                </div>
                <div class="side-menu-item">
                    <a href="#"><i class="icon icon-outbox"></i>Отправленные</a>
                </div>
                <div class="side-menu-item">
                    <a href="#"><i class="icon icon-project-message"></i>Проекты</a>
                    <div class="new-count icon icon-blue-circle">15</div>
                </div>
                <div class="side-menu-item">
                    <a href="#"><i class="icon icon-trash"></i>Корзина</a>
                </div>
            </div>
        </div>
        <div class="main-column">
            <div class="full-column opacity-box">

            </div>
            <?$this->widget('CLinkPager', array('pages'=>$pages,));?>
            <div class="full-column opacity-box">
                <div class="row">
                    <div class="caption"><?= Yii::t('main','Мои проекты')?></div>
                    <a href="#"><button class="btn"><?= Yii::t('main','Новый проекты')?></button></a>
                </div>
                <div class="row project list">
                    <div class="item"><?=CHtml::checkBox('',true,array())?></div>
                </div>
            </div>
            <?$this->widget('CLinkPager', array('pages'=>$pages,));?>
            <div class="clear"></div>
        </div>
    </div>
</div>
