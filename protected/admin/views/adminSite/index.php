<div class="padding-md">
    <?if(count($disabledWidgets)){?>
    <div class="col-lg-12">
        <div class="btn-group form-group">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Добавить виджет <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <?foreach($disabledWidgets as $key){?>
                    <li><a href="<?=$this->createUrl('adminSite/addWidget', array('id' => $key));?>"><?=Admin2Widget::$widgets[$key]['name']?></a></li>
                <?}?>
            </ul>
        </div>
    </div>
    <?}?>

    <?foreach($models as $key => $items){?>
    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <span class="pull-left"><?=Admin2Widget::$widgets[$key]['name']?></span>
                <ul class="tool-bar">
                    <li><a href="<?=$this->createUrl('adminSite/disableWidget', array('id' => $key));?>" class="delete-widget" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-remove"></i></a></li>
                </ul>
            </div>
            <ul class="list-group collapse in" id="feedList">
                <?if($key == 'adv'){?>
                    <li class="list-group-item clearfix">
                        <a href="<?=$items['moderation']['url']?>">
                            <div class="activity-icon small <?=$items['moderation']['value']?'bg-success':''?>">
                                <i class="fa fa-<?=Admin2Widget::$widgets[$key]['icon']?>"></i>
                            </div>
                            <div class="pull-left m-left-sm">
                                <span><?=$items['moderation']['value']?></span><br>
                                <small class="text-muted"><i class="fa fa-calendar"></i> На модерации</small>
                            </div>
                        </a>
                    </li>
                    <li class="list-group-item clearfix">
                        <a href="<?=$items['approved']['url']?>">
                            <div class="activity-icon small <?=$items['approved']['value']?'bg-success':''?>">
                                <i class="fa fa-<?=Admin2Widget::$widgets[$key]['icon']?>"></i>
                            </div>
                            <div class="pull-left m-left-sm">
                                <span><?=$items['approved']['value']?></span><br>
                                <small class="text-muted"><i class="fa fa-calendar"></i> Прошли модерацию</small>
                            </div>
                        </a>
                    </li>
                <?} else {?>
                <li class="list-group-item clearfix">
                    <a href="<?=$items['today']['url']?>">
                        <div class="activity-icon small <?=$items['today']['value']?'bg-success':''?>">
                            <i class="fa fa-<?=Admin2Widget::$widgets[$key]['icon']?>"></i>
                        </div>
                        <div class="pull-left m-left-sm">
                            <span><?=$items['today']['value']?></span><br>
                            <small class="text-muted"><i class="fa fa-calendar"></i> Сегодня</small>
                        </div>
                    </a>
                </li>
                <li class="list-group-item clearfix">
                    <a href="<?=$items['yesterday']['url']?>">
                        <div class="activity-icon small <?=$items['yesterday']['value']?'bg-success':''?>">
                            <i class="fa fa-<?=Admin2Widget::$widgets[$key]['icon']?>"></i>
                        </div>
                        <div class="pull-left m-left-sm">
                            <span><?=$items['yesterday']['value']?></span><br>
                            <small class="text-muted"><i class="fa fa-calendar"></i> Вчера</small>
                        </div>
                    </a>
                </li>
                <li class="list-group-item clearfix">
                    <a href="<?=$items['7days']['url']?>">
                        <div class="activity-icon small <?=$items['7days']['value']?'bg-success':''?>">
                            <i class="fa fa-<?=Admin2Widget::$widgets[$key]['icon']?>"></i>
                        </div>
                        <div class="pull-left m-left-sm">
                            <span><?=$items['7days']['value']?></span><br>
                            <small class="text-muted"><i class="fa fa-calendar"></i> 7 дней</small>
                        </div>
                    </a>
                </li>
                <li class="list-group-item clearfix">
                    <a href="<?=$items['30days']['url']?>">
                        <div class="activity-icon small <?=$items['30days']['value']?'bg-success':''?>">
                            <i class="fa fa-<?=Admin2Widget::$widgets[$key]['icon']?>"></i>
                        </div>
                        <div class="pull-left m-left-sm">
                            <span><?=$items['30days']['value']?></span><br>
                            <small class="text-muted"><i class="fa fa-calendar"></i> 30 дней</small>
                        </div>
                    </a>
                </li>
                <?}?>
            </ul><!-- /list-group -->
            <div class="loading-overlay">
                <i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
            </div>
        </div><!-- /panel -->
    </div>
    <?}?>
</div>