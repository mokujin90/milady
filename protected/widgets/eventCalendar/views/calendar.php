<div class="calendar-widget">
    <div class="loader"></div>
    <div class="record calendar-block ">
        <p class="events__title"><?= Yii::t('main','Мероприятия')?></p>
        <div class="calendar-listing">
            <span class="calendar-listing__prev"></span>
            <span class="calendar-listing__month">Июль 2014</span>
            <span class="calendar-listing__next"></span>
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
    <a class="blue-btn event__link" href="<?=$this->controller->createUrl('event/index')?>"><?=Yii::t('main','Архив мероприятий')?></a>
</div>