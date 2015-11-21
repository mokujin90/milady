<div class="grey-container shortcut-wrapper hidden">
    <a href="#" class="shortcut-link">
					<span class="shortcut-icon">
						<i class="fa fa-bar-chart-o"></i>
					</span>
        <span class="text">Statistic</span>
    </a>
    <a href="#" class="shortcut-link">
					<span class="shortcut-icon">
						<i class="fa fa-envelope-o"></i>
						<span class="shortcut-alert">
							5
						</span>
					</span>
        <span class="text">Messages</span>
    </a>
    <a href="#" class="shortcut-link">
					<span class="shortcut-icon">
						<i class="fa fa-user"></i>
					</span>
        <span class="text">New Users</span>
    </a>
    <a href="#" class="shortcut-link">
					<span class="shortcut-icon">
						<i class="fa fa-globe"></i>
						<span class="shortcut-alert">
							7
						</span>
					</span>
        <span class="text">Notification</span>
    </a>
    <a href="#" class="shortcut-link">
					<span class="shortcut-icon">
						<i class="fa fa-list"></i>
					</span>
        <span class="text">Activity</span>
    </a>
    <a href="#" class="shortcut-link">
					<span class="shortcut-icon">
						<i class="fa fa-cog"></i></span>
        <span class="text">Setting</span>
    </a>
</div>
<div class="panel-tab clearfix" style="border-bottom: 1px solid #eee;">
    <ul class="tab-bar">
        <li class="<?=$type=='index'?'active':''?>"><a href="<?=$this->createUrl('user/index')?>"><i class="fa fa-home"></i> Общая</a></li>
        <li class="<?=$type=='comment'?'active':''?>"><a href="<?=$this->createUrl('user/index', array('type' => 'comment'))?>"><i class="fa fa-pencil"></i> Комментарии</a></li>
        <li class="<?=$type=='favorite'?'active':''?>"><a href="<?=$this->createUrl('user/index', array('type' => 'favorite'))?>"><i class="fa fa-star"></i> Избранное</a></li>
        <li class="<?=$type=='region'?'active':''?>"><a href="<?=$this->createUrl('user/index', array('type' => 'region'))?>"><i class="fa fa-map"></i> Регион</a></li>
        <li class="<?=$type=='group'?'active':''?>"><a href="<?=$this->createUrl('user/index', array('type' => 'group'))?>"><i class="fa fa-group"></i> Группы</a></li>
        <li class="<?=$type=='project'?'active':''?>"><a href="<?=$this->createUrl('user/index', array('type' => 'project'))?>"><i class="fa fa-file"></i> Проекты</a></li>
    </ul>
</div>
<div class="padding-md">
    <?if($type=='favorite'):?>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'enableAjaxValidation'=>false,
        'method' => 'get',
        'action' => '/user/index?type=favorite'
    )); ?>
    <div class="panel panel-default">
        <div class="panel-heading">Фильтр по избранному
            <?=CHtml::submitButton('Применить',array('name' => '', 'class'=>'btn btn-success btn-xs pull-right'))?>
        </div>
        <div class="panel-body">
            <div class="col-lg-6">
                <label class="col-lg-12 control-label">Тип площадок</label>
                <div class="col-lg-6">
                    <label class="label-checkbox">
                        <?php echo $form->checkBox($favoriteFilter,'project_infrastruct'); ?>
                        <span class="custom-checkbox"></span>
                        Инфраструктурные
                    </label>
                    <label class="label-checkbox">
                        <?php echo $form->checkBox($favoriteFilter,'project_innovate'); ?>
                        <span class="custom-checkbox"></span>
                        Инновационные
                    </label>
                    <label class="label-checkbox">
                        <?php echo $form->checkBox($favoriteFilter,'project_invest'); ?>
                        <span class="custom-checkbox"></span>
                        Инвестиционные
                    </label>
                </div>
                <div class="col-lg-6">
                    <label class="label-checkbox">
                        <?php echo $form->checkBox($favoriteFilter,'project_site'); ?>
                        <span class="custom-checkbox"></span>
                        Продажа бизнеса
                    </label>
                    <label class="label-checkbox">
                        <?php echo $form->checkBox($favoriteFilter,'project_business'); ?>
                        <span class="custom-checkbox"></span>
                        Инвестиционная площадка
                    </label>
                </div>
            </div>
            <div class="col-lg-6">
                <label class="col-lg-12 control-label">События</label>
                <div class="col-lg-6">
                    <label class="label-checkbox">
                        <?php echo $form->checkBox($favoriteFilter,'object_news'); ?>
                        <span class="custom-checkbox"></span>
                        Новости
                    </label>
                    <label class="label-checkbox">
                        <?php echo $form->checkBox($favoriteFilter,'object_analytics'); ?>
                        <span class="custom-checkbox"></span>
                        Аналитика
                    </label>
                </div>
                <div class="col-lg-6">
                    <label class="label-checkbox">
                        <?php echo $form->checkBox($favoriteFilter,'object_project_news'); ?>
                        <span class="custom-checkbox"></span>
                        Новости проектов
                    </label>
                    <label class="label-checkbox">
                        <?php echo $form->checkBox($favoriteFilter,'object_comment_project'); ?>
                        <span class="custom-checkbox"></span>
                        Комментиарии проектов
                    </label>
                </div>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>
<?php endif?>

<!--div class="jcarousel-wrapper">
    <div class="jcarousel movie-jcarousel" id="popularMovie">
        <ul>
            <li>
                <a href="#">
                    <img src="http://iip.loc:81/data/mediadb/d5a0/0000/0013/1313/200x1002_out__.jpeg" alt="Image 1">
                    <div class="quick-detail text-white">
                        <h5>Freddy Krueker</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros nibh, viverra a dui a, gravida varius velit.</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="http://iip.loc:81/data/mediadb/d5a0/0000/0013/1313/200x1002_out__.jpeg" alt="Image 2">
                    <div class="quick-detail text-white">
                        <h5>Toy Story</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros nibh, viverra a dui a, gravida varius velit.</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="http://iip.loc:81/data/mediadb/d5a0/0000/0013/1313/200x1002_out__.jpeg" alt="Image 3">
                    <div class="quick-detail text-white">
                        <h5>Walking Dead</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros nibh, viverra a dui a, gravida varius velit.</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="http://iip.loc:81/data/mediadb/d5a0/0000/0013/1313/200x1002_out__.jpeg" alt="Image 4">
                    <div class="quick-detail text-white">
                        <h5>Splice</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros nibh, viverra a dui a, gravida varius velit.</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="http://iip.loc:81/data/mediadb/d5a0/0000/0013/1313/200x1002_out__.jpeg" alt="Image 5">
                    <div class="quick-detail text-white">
                        <h5>The Hunger game</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros nibh, viverra a dui a, gravida varius velit.</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="http://iip.loc:81/data/mediadb/d5a0/0000/0013/1313/200x1002_out__.jpeg" alt="Image 6">
                    <div class="quick-detail text-white">
                        <h5>The Other Guys</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros nibh, viverra a dui a, gravida varius velit.</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>

    <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
    <a href="#" class="jcarousel-control-next">&rsaquo;</a>
</div-->
    <div class="timeline-wrapper">
        <?
            $first = false;
            $date = date('Y-m-d');
        ?>

        <?foreach($data as $item):?>
            <?if($date != Candy::formatDate($item['create_date'], 'Y-m-d')){
                $date = Candy::formatDate($item['create_date'], 'Y-m-d');
                $dateFormat = Candy::formatDate($item['create_date'], 'd ') . Candy::$monthShort[(int)Candy::formatDate($item['create_date'], 'm')] . Candy::formatDate($item['create_date'], ' Y');
                echo '<div class="timeline-date ' . ($first ? 'timeline-start' : '') .'">' . $dateFormat . '</div>';
                $first = false;

            }?>
            <div class="timeline-item <?= $first ? 'timeline-start' : '' ?>">
                <div class="timeline-info">
                    <div class="timeline-icon <?=FeedFilter::$typeTimelineColor[$item['object_name']]?>">
                        <i class="fa fa-<?=FeedFilter::$typeTimelineIcon[$item['object_name']]?>"></i>
                    </div>
                    <div class="time">
                        <?=Candy::formatDate($item['create_date'], 'H:i')?>
                    </div>
                </div>
                <div class="panel panel-default timeline-panel">
                    <div class="panel-heading">
                        <span class="label label-danger m-right-xs"><?=FeedFilter::$type[$item['object_name']]?></span>
                        <a href="<?=$item['model']->createUrl()?>"><?=$item['name']?></a>
                    </div>
                    <div class="panel-body">
                        <?if($item['object_name'] == 'project_comment'):?>
                            <p>Добавлен новый комментарий</p>
                        <?endif?>
                        <?if($item['object_name'] == 'project_news'):?>
                            <?=$item['alt_model']->media?Candy::preview(array($item['alt_model']->media, 'scale' => '200x100', 'class' => 'image')):''?>
                            <p>Добавлена новая <?=CHtml::link('новость', $item['alt_model']->createUrl())?></p>
                        <?endif?>
                        <?if($item['object_name'] == 'region_news' || $item['object_name'] == 'analytics'):?>
                            <?=$item['model']->media?Candy::preview(array($item['model']->media, 'scale' => '200x100', 'class' => 'image')):''?>
                        <?endif?>
                        <p>
                            <?if($item['object_name'] == 'banner'):?>
                                <?=$item['model']->media?Candy::preview(array($item['model']->media, 'scale' => '140x80', 'style'=>"width: auto; float: left; margin:5px 10px 0 0; ")):''?>
                            <?endif?>
                            <?=$item['text']?>
                        </p>
                        <?if(in_array($item['object_name'] ,array('project_news', 'region_news', 'analytics'))):?>
                            <a class="btn btn-xs btn-default" href="<?=$item['model']->createUrl()?>">Оставить комментарий</a>
                        <?else:?>
                            <a class="btn btn-xs btn-default" href="<?=$item['model']->createUrl()?>">Ссылка</a>
                        <?endif?>
                    </div>
                </div><!-- /panel -->
            </div><!-- /timeline-item -->
            <? $first = false;?>
        <?endforeach?>
        <div class="timeline-item clearfix">
            <div class="timeline-info">
                <div class="timeline-icon bg-grey">
                    <i class="fa fa-home"></i>
                </div>
            </div>
        </div><!-- /timeline-item -->
    </div><!-- /timeline-wrapper -->
    <div class="text-center">
        <?
        $this->widget('CLinkPager', array(
            'pages'=>$pages,
            'htmlOptions' => array('class' => 'pagination pagination-split pagination-sm'),
            'selectedPageCssClass' => 'active',
            'nextPageLabel' => '»',
            'prevPageLabel' => '«',
            'lastPageCssClass' => 'hidden',
            'firstPageCssClass' => 'hidden'
        ));?>
    </div>
</div><!-- /.padding -->