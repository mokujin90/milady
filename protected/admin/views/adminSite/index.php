<div class="padding-md">
    <?foreach($models as $key => $items){?>
    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <span class="pull-left"><?=$this->widgets[$key]['name']?></span>
                <ul class="tool-bar">
                    <li><a href="#" class="refresh-widget" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Refresh"><i class="fa fa-remove"></i></a></li>
                </ul>
            </div>
            <ul class="list-group collapse in" id="feedList">
                <?if($key == 'adv'){?>
                    <li class="list-group-item clearfix">
                        <div class="activity-icon small <?=$items['moderation']?'bg-success':''?>">
                            <i class="fa fa-<?=$this->widgets[$key]['icon']?>"></i>
                        </div>
                        <div class="pull-left m-left-sm">
                            <span><?=$items['moderation']?></span><br>
                            <small class="text-muted"><i class="fa fa-calendar"></i> На модерации</small>
                        </div>
                    </li>
                    <li class="list-group-item clearfix">
                        <div class="activity-icon small <?=$items['approved']?'bg-success':''?>">
                            <i class="fa fa-<?=$this->widgets[$key]['icon']?>"></i>
                        </div>
                        <div class="pull-left m-left-sm">
                            <span><?=$items['approved']?></span><br>
                            <small class="text-muted"><i class="fa fa-calendar"></i> Прошли модерацию</small>
                        </div>
                    </li>
                <?} else {?>
                <li class="list-group-item clearfix">
                    <div class="activity-icon small <?=$items['today']?'bg-success':''?>">
                        <i class="fa fa-<?=$this->widgets[$key]['icon']?>"></i>
                    </div>
                    <div class="pull-left m-left-sm">
                        <span><?=$items['today']?></span><br>
                        <small class="text-muted"><i class="fa fa-calendar"></i> Сегодня</small>
                    </div>
                </li>
                <li class="list-group-item clearfix">
                    <div class="activity-icon small <?=$items['yesterday']?'bg-success':''?>">
                        <i class="fa fa-<?=$this->widgets[$key]['icon']?>"></i>
                    </div>
                    <div class="pull-left m-left-sm">
                        <span><?=$items['yesterday']?></span><br>
                        <small class="text-muted"><i class="fa fa-calendar"></i> Вчера</small>
                    </div>
                </li>
                <li class="list-group-item clearfix">
                    <div class="activity-icon small <?=$items['7days']?'bg-success':''?>">
                        <i class="fa fa-<?=$this->widgets[$key]['icon']?>"></i>
                    </div>
                    <div class="pull-left m-left-sm">
                        <span><?=$items['7days']?></span><br>
                        <small class="text-muted"><i class="fa fa-calendar"></i> 7 дней</small>
                    </div>
                </li>
                <li class="list-group-item clearfix">
                    <div class="activity-icon small <?=$items['30days']?'bg-success':''?>">
                        <i class="fa fa-<?=$this->widgets[$key]['icon']?>"></i>
                    </div>
                    <div class="pull-left m-left-sm">
                        <span><?=$items['30days']?></span><br>
                        <small class="text-muted"><i class="fa fa-calendar"></i> 30 дней</small>
                    </div>
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