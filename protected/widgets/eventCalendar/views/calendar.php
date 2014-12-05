<div class="calendar-widget">
    <div class="loader"></div>
    <div class="record calendar-block ">
        <div class="category"><?= Yii::t('main','Мероприятия')?></div>
        <div class="calendar">
            <table>
                <thead>
                <?=$this->getTableHead()?>
                </thead>
                <tbody>
                <?=$this->getTableBody()?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="calendar-event">
        <?=$this->getCalendarEvent()?>
    </div>
    <div class="button-panel event-panel">
        <a class="more" href="<?=$this->controller->createUrl('event/index')?>"><?= CHtml::button(Yii::t('main','Архив мероприятий'),array('class'=>'btn blue'))?></a>
    </div>
</div>