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
                <?
                $sideMenu = array(
                    Project::T_INFRASTRUCT => Yii::t('main', 'Инфраструктурные'),
                    Project::T_INNOVATE => Yii::t('main', 'Иновационные'),
                    Project::T_INVEST => Yii::t('main', 'Инвестиционные'),
                    Project::T_SITE => Yii::t('main', 'Инвестиционные площадки'),
                    Project::T_BUSINESS => Yii::t('main', 'Бизнес'),
                );
                foreach ($sideMenu as $type => $name) {
                    $params = $_GET;
                    unset($params['page']);
                    if (empty($params['hide'][$type])) {
                        $params['hide'][$type] = $type;
                    } else {
                        unset($params['hide'][$type]);
                    }
                    ?>
                    <div class="side-menu-item overflow blue-label">
                        <?=Crud::checkBox("hide[$type]",empty($_GET['hide'][$type]),array('disabled' => true)) . CHtml::link($name, $this->createUrl('', $params))?>
                    </div>
                <?}?>
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
                    <?if(empty($models)):?>
                        <p>Список пуст</p>
                    <?endif?>
                    <?foreach($models as $model):?>
                        <div class="item">
                            <?=Crud::checkBox('',true,array())?>
                            <?=CHtml::link($model->name, $this->createUrl("user/" . Project::$urlByType[$model->type], array('id' => $model->id)))?>
                            <?=CHtml::link('Удалить',array('project/delete','id'=>$model->id),array('class'=>'btn right-button delete-button'))?>
                        </div>
                    <?endforeach?>
                </div>
                <div class="clear"></div>
                <script>
                    $('.corner-btn').click(function(){
                        $.fancybox({content: $('.test').clone().css('display', 'block')});
                    });
                </script>
                <style>
                    .test a{
                        margin-right: 4px;
                        margin-bottom: 4px;
                        display: block;
                    }
                </style>
                <div class="test" style="font-size: 15px; display: none;">
                    <a href="/user/InvestmentProject" class="btn">Инвестиционный проект</a>
                    <a href="/user/InnovativeProject" class="btn">Инновационный проект</a>
                    <a href="/user/InvestmentSite" class="btn">Инвестиционная площадка</a>
                    <a href="/user/InfrastructureProject" class="btn">Инфраструктурный проект</a>
                    <a href="/user/Business" class="btn">Продажа бизнеса</a>
                </div>
            </div>
            <?$this->widget('CLinkPager', array('pages'=>$pages,));?>
            <div class="clear"></div>
        </div>
    </div>
</div>
