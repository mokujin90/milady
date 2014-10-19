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
            <h1>Тип площадок</h1>
            <div class="side-menu-list">
                <div class="side-menu-item overflow blue-label">
                    <?=Crud::checkBox('',true,array(), '<span>Инфраструктурные</span>')?>
                </div>
                <div class="side-menu-item overflow blue-label">
                    <?=Crud::checkBox('',true,array(), '<span>Иновационные</span>')?>
                </div>
                <div class="side-menu-item overflow blue-label">
                    <?=Crud::checkBox('',true,array(), '<span>Инвестиционные</span>')?>
                </div>
                <div class="side-menu-item overflow blue-label">
                    <?=Crud::checkBox('',true,array(), '<span>Инвестиционные площадки</span>')?>
                </div>
                <div class="side-menu-item overflow blue-label">
                    <?=Crud::checkBox('',true,array(), '<span>Бизнес</span>')?>
                </div>

            </div>
        </div>
        <div class="main-column">
            <!--div class="full-column opacity-box">

            </div-->
            <?$this->widget('CLinkPager', array('pages'=>$pages,));?>
            <div class="full-column opacity-box overflow">
                <div class="row">
                    <a href="#" class="btn corner-btn"><?= Yii::t('main','Новый проект')?></a>
                    <div class="caption"><?= Yii::t('main','Мои проекты')?></div>
                </div>
                <div class="row project list">
                    <div class="item">
                        <?=Crud::checkBox('',true,array())?>
                        <a href="#">Make the "Cobra Bar"</a>
                    </div>
                    <div class="item">
                        <?=Crud::checkBox('',true,array())?>
                        <a href="#">Make the "Cobra Bar"</a>
                    </div><div class="item">
                        <?=Crud::checkBox('',true,array())?>
                        <a href="#">Make the "Cobra Bar"</a>
                    </div><div class="item">
                        <?=Crud::checkBox('',true,array())?>
                        <a href="#">Make the "Cobra Bar"</a>
                    </div><div class="item">
                        <?=Crud::checkBox('',true,array())?>
                        <a href="#">Make the "Cobra Bar"</a>
                    </div><div class="item">
                        <?=Crud::checkBox('',true,array())?>
                        <a href="#">Make the "Cobra Bar"</a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <?$this->widget('CLinkPager', array('pages'=>$pages,));?>
            <div class="clear"></div>
        </div>
    </div>
</div>
