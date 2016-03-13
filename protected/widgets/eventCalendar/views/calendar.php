<div class="calendar-widget">
    <div class="loader"></div>
    <div class="record calendar-block ">
        <p class="events__title"><?= Yii::t('main','Мероприятия')?></p>
        <div class="calendar-listing">
            <span class="calendar-listing__prev" data-date="<?=$this->prevMonth->format('Y-m-d')?>"></span>
            <span class="calendar-listing__month"><?=Candy::$monthShort[(int)$this->date->format('m')]?> <?=$this->date->format('Y')?></span>
            <span class="calendar-listing__next" data-date="<?=$this->nextMonth->format('Y-m-d')?>"></span>
        </div><!--calendar-listing-->
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
    <a class="blue-btn event__link" href="<?=$this->controller->createUrl('news/index/type/event')?>"><?=Yii::t('main','Архив мероприятий')?></a>
</div>