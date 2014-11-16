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
    <div style="height: 312px;width: 100%;" id="stock-graph"></div>
</div>