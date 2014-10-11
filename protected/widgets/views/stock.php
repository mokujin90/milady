<div class="linked top">
    <?php echo CHtml::link(Yii::t('main','Валюты'),'#',array('class'=>'tab active'))?>
    <?php echo CHtml::link(Yii::t('main','Товары'),'#',array('class'=>'tab'))?>
    <?php echo CHtml::link(Yii::t('main','Индексы'),'#',array('class'=>'tab'))?>
</div>
<div class="linked middle">
    <?php echo CHtml::link(Yii::t('main','ЦБ РФ'),'#',array('class'=>'tab'))?>
    <?php echo CHtml::link(Yii::t('main','Forex'),'#',array('class'=>'tab active'))?>
</div>
<div class="chart">
    <?php echo CHtml::image('/images/assets/chart.png')?>
</div>