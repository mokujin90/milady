<style>
    .investors-wrap a img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin: 0 3px;
    }
</style>
<div class="padding-md">
    <div class="row">
        <?if($this->user->profileCompletion() < 100):?>
        <div class="col-sm-6 col-md-3">
            <div class="panel-stat3 bg-danger">
                <h2 class="m-top-none" id="userCount"><?=$this->user->profileCompletion()?>%</h2>
                <h5>Профиль</h5>
                <i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">Заполните профиль, чтобы получать больше предложений</span>
                <div class="stat-icon">
                    <i class="fa fa-user fa-3x"></i>
                </div>
                <div class="refresh-button">
                    <i class="fa fa-close"></i>
                </div>
            </div>
        </div><!-- /.col -->
        <?endif?>
        <div class="col-sm-6 col-md-3">
            <div class="panel-stat3 bg-info">
                <h2 class="m-top-none">121</h2>
                <h5>Просмотры ваших проектов</h5>
                <i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">На 1% больше за неделю</span>
                <div class="stat-icon">
                    <i class="fa fa-eye fa-3x"></i>
                </div>
                <div class="refresh-button">
                    <i class="fa fa-close"></i>
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col-sm-6 col-md-3">
            <div class="panel-stat3 bg-warning">
                <h2 class="m-top-none" id="orderCount">123</h2>
                <h5>Отклики на ваши проекты</h5>
                <i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">На 1% больше за неделю</span>
                <div class="stat-icon">
                    <i class="fa fa-comment fa-3x"></i>
                </div>
                <div class="refresh-button">
                    <i class="fa fa-close"></i>
                </div>
            </div>
        </div><!-- /.col -->
        <div class="col-sm-6 col-md-3">
            <div class="panel-stat3 bg-success">
                <h2 class="m-top-none" id="visitorCount">7389</h2>
                <h5>Уникальных поситителей</h5>
                <i class="fa fa-user fa-lg"></i><span class="m-left-xs">Просмотреть список</span>
                <div class="stat-icon">
                    <i class="fa fa-bar-chart-o fa-3x"></i>
                </div>
                <div class="refresh-button">
                    <i class="fa fa-close"></i>
                </div>
                <div class="loading-overlay">
                    <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
                </div>
            </div>
        </div><!-- /.col -->
    </div>
</div>
<div class="grey-container shortcut-wrapper">
    <p>Вами интересуются:</p>
    <div class="investors-wrap">
        <a href="#"><img src="http://lorempixel.com/40/40/"/></a>
        <a href="#"><img src="http://lorempixel.com/50/50/"/></a>
        <a href="#"><img src="http://lorempixel.com/60/60/"/></a>
        <a href="#"><img src="http://lorempixel.com/70/70/"/></a>
        <a href="#"><img src="http://lorempixel.com/80/80/"/></a>
        <a href="#"><img src="http://lorempixel.com/90/90/"/></a>
        <a href="#"><img src="http://lorempixel.com/100/100/"/></a>
        <a href="#"><img src="/images/assets/avatar.png"/></a>
    </div>
</div>
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
        <div class="timeline-item timeline-start">
            <div class="timeline-info">
                <div class="timeline-icon bg-danger">
                    <i class="fa fa-star"></i>
                </div>
            </div>
            <div class="panel panel-default timeline-panel">
                <div class="panel-heading">
                    <span class="label label-danger m-right-xs">Реклама</span>
                    <a href="#">Forex Club в вашем регионе</a>
                </div>
                <div class="panel-body">
                    <p>
                        <img src="http://st2.fxclub.org/sites/fxclub.org/themes/fxorg/images/landings/taran/logo.png" style="width: auto; float: left; margin: 10px;">
                        Преимущества демо-счета:
                        Никаких рисков. Вам предоставлено 5000 виртуальных долларов, которые можно использовать для учебной торговли на рынке форекс. После окончания обучения на демо-счете вам не нужно будет возвращать деньги – они созданы специально для тренировки в торговой платформе.
                        Открытие счета и все операции на нем – абсолютно бесплатны.
                        Полная безопасность. Для регистрации понадобятся только имя и контакты.
                        Финансовые инструменты на демо-счете полностью аналогичны реальному счету. Торгуя на демо, вы учитесь зарабатывать на реальном счете.
                        Источник: ГК Forex Club - "Научитесь зарабатывать на свои мечты"
                    </p>
                    <a class="btn btn-xs btn-default" href="#">Ссылка</a>
                </div>
            </div><!-- /panel -->
        </div>
        <?
            $first = true;
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
                        <?=Candy::formatDate($item['create_date'], 'H:m')?>
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