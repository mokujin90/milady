<?if(count($unactive)){?>
    <br>
    <div class="col-lg-12">
        <div class="btn-group form-group">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Добавить виджет <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <?foreach($unactive as $key => $quote){?>
                    <li><a href="<?=$this->createUrl('user/addQuote', array('id' => $key));?>"><?=$quote['name']?></a></li>
                <?}?>
            </ul>
        </div>
    </div>
<?}?>
<br>
<?foreach($this->user->quotes as $quote){?>
    <div class="col-lg-6">
        <div class="panel panel-default text-center">
            <div class="panel-heading clearfix">
                <span class="pull-left"><?=User2Quote::$quotes[$quote->quote]['name']?></span>
                <ul class="tool-bar">
                    <li><a href="<?=$this->createUrl('user/disableQuote', array('id' => $quote->quote));?>" class="delete-widget" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Удалить"><i class="fa fa-remove"></i></a></li>
                </ul>
            </div>
            <img src="<?=User2Quote::$quotes[$quote->quote]['img']?>"  id="quote-graph-1" style="visibility: visible;">
        </div>
    </div>
<?}?>