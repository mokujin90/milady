<h2 class="page-title page-title_pt">Контакты</h2>

<div class="contacts">
    <?=$content->content?>
    <div id="contacts-map">
        <? $this->widget('Map', array(
            'target' => false,
            'sideModel' =>$content->contacts,
            'htmlOptions'=>array(
                'style'=>'height: 364px;width:100%;',
            ),
            'zoom' => 18
        )); ?>
    </div>

    <!--p class="contacts__info">
        Более подробную информацию о работе портала Вы
        можете получить в разделе Обратная связь
    </p>

    <a class="contacts__callback" href="#">Обратная связь</a-->

</div><!--contacts-->