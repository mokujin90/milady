<?php
/**
 * @var UserController $this
 * @var CActiveForm $form
 */
Yii::app()->clientScript->registerScript('init', 'feedPart.init();', CClientScript::POS_READY);
?>
<div class="user-index-page">
    <div id="general">
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>

        <div class="content list-columns columns">
            <div class="side-column">
                <div class="base-block opacity-box relative">
                    <div id="logo_block" class="profile-image">
                        <span class="rel">
                            <?=Candy::preview(array($this->user->logo, 'scale' => '102x102'))?>
                        </span>
                    </div>
                    <div class="profile-text"><?= $this->user->name?></div>
                    <?$types = User::getUserType();?>
                    <div class="profile-name"><?= $types[$this->user->type]?></div>
                    <?php if(true):?>
                        <?=CHtml::link(Yii::t('main','Изменить профиль'),array('user/profile'),array('class'=>'btn'))?>
                        <div>Баланс: <?=$this->getBalance()->value?> руб</div>
                        <?=CHtml::link(Yii::t('main','Пополнить'),array('money/add'),array('class'=>'btn fancy-open fancybox.ajax'))?>
                    <?php endif;?>
                </div>

                <div class="box dark user-action-box bossy">
                    <div class="box inner">
                        <h1><?= Yii::t('main','Заказать услуги портала')?></h1>
                        <?foreach(Project::model()->systemMessage as $key => $item):?>
                            <?if($item['object'] == $this->user->type || $item['object'] == 'project'):?>
                                <?= CHtml::link($item['name'],array('message/create','system'=>$key),array('class'=>'item'))?>
                            <?endif;?>
                        <?endforeach;?>
                    </div>
                </div>

                <div class="opacity-box">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'htmlOptions'=>array('id'=>'form-projects-filter')
                    )); ?>
                    <?$this->widget('crud.dropDownList',
                        array('elements'=>$filter->getProjectList($this->user),
                            'selected'=> isset($_GET['project']) ? $_GET['project'] : array(),
                            'name'=>'project',
                            'options'=>array('multiple'=>true,'useButton'=>true,'placeholder'=>Yii::t('main','Проекты'),'check_all'=>true),
                            'htmlOptions'=>array('class'=>'project-filter')
                        ));?>
                    <?php $this->endWidget(); ?>
                    <?=CHtml::hiddenField('url',serialize($_GET))?>
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
                    <div class="clear"></div>
                </div>
                <div id="chart">
                    <?php echo $this->renderPartial('../../extensions/informer/index'); ?>
                </div>
            </div>
            <div class="main-column">
                <!--div class="full-column info-column" style="height: 420px;">

                </div-->
                <!--div class="filter opacity-box">
                    <div class="pull-left condition">
                        <?$this->widget('crud.dropDownList',
                            array('attribute'=>'type','elements'=>array(0=>'Цена'),
                                'options'=>array('multiple'=>false,'placeholder'=>'Сортировать'),
                                'selected' => 0
                            ));?>
                    </div>
                    <div class="pull-right condition">
                        <?$this->widget('crud.dropDownList',
                            array('attribute'=>'type','elements'=>array(10=>10,20=>20,50=>50),
                                'options'=>array('multiple'=>false,'placeholder'=>'Сортировать по'),
                                'selected' => 20
                            ));?>
                    </div>
                </div-->
                <?$this->widget('CLinkPager', array('pages'=>$pages,));?>
                <? /*foreach($projects as $model) {
                    $this->renderPartial('projectItem/' . Project::$urlByType[$model->type], array('model' => $model));
                }*/?>
                <?foreach($data as $item):?>
                <div class="feed-item opacity-box">
                    <div class="top-stick"><?=FeedFilter::$type[$item['object_name']]?></div>
                    <div class="date"><?=Candy::formatDate($item['create_date'], 'd.m.Y H:m')?></div>
                    <a href="<?=$item['model']->createUrl()?>"><h2><?=$item['name']?></h2></a>
                    <hr>
                    <div class="feed-info">
                        <?if($item['object_name'] == 'project_comment'):?>
                            <div class="info-row">Добавлен новый комментарий</div>
                        <?endif?>
                        <?if($item['object_name'] == 'project_news'):?>
                            <div class="info-row">Добавлена новая <?=CHtml::link('новость', $item['alt_model']->createUrl())?></div>
                        <?endif?>
                    </div>
                    <div class="feed-data">
                        <?=$item['text']?>
                    </div>
                    <!--a class="comment-link" href="#"><i class="icon icon-balloon"><span>15</span></i> коммент.</a-->
                </div>
                <?endforeach?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>