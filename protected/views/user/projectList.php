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
            <h1><?= Yii::t('main','Тип площадок')?></h1>
            <div class="side-menu-list">
                <div class="side-menu-item overflow blue-label">
                    <?=Crud::checkBox('',true,array(), '<span>' . Yii::t('main','Инфраструктурные') . '</span>')?>
                </div>
                <div class="side-menu-item overflow blue-label">
                    <?=Crud::checkBox('',true,array(), '<span>' . Yii::t('main','Иновационные') . '</span>')?>
                </div>
                <div class="side-menu-item overflow blue-label">
                    <?=Crud::checkBox('',true,array(), '<span>' . Yii::t('main','Инвестиционные') . '</span>')?>
                </div>
                <div class="side-menu-item overflow blue-label">
                    <?=Crud::checkBox('',true,array(), '<span>' . Yii::t('main','Инвестиционные площадки') . '</span>')?>
                </div>
                <div class="side-menu-item overflow blue-label">
                    <?=Crud::checkBox('',true,array(), '<span>' . Yii::t('main','Бизнес') . '</span>')?>
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
                    <? foreach($models as $model):?>
                        <div class="item">
                            <?=Crud::checkBox('',true,array())?>
                            <a href="<?= $this->createUrl("user/" . Project::$urlByType[$model->type], array('id' => $model->id))?>"><?= $model->name?></a>
                        </div>
                    <? endforeach?>
                </div>
                <div class="clear"></div>
            </div>
            <?$this->widget('CLinkPager', array('pages'=>$pages,));?>
            <div class="clear"></div>
        </div>
    </div>
</div>
