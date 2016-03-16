<form class="sort-form" action="<?=$this->createUrl('project/index');?>" style="float: left;">
    <div class="sort sort-wrapper">
    <div class="select select_middle" data-name="sort">
        <?$this->widget('crud.dropDownList',
            array('name'=>'sort','selected'=>Yii::app()->request->getParam('sort',null),'elements'=>array(
                'name_up' => Yii::t('main', 'Имени')." &uarr;",
                'name_down' => Yii::t('main', 'Имени')." &darr;",
                'sum_up' => Yii::t('main', 'Сумма привлекаемых инвестиций')." &uarr;",
                'sum_down' => Yii::t('main', 'Сумма привлекаемых инвестиций')." &darr;",
                'period_up' => Yii::t('main', 'Срок окупаемости проекта')." &uarr;",
                'period_down' => Yii::t('main', 'Срок окупаемости проекта')." &darr;",
                'profit_up' => Yii::t('main', 'Чистый дисконтированный доход')." &uarr;",
                'profit_down' => Yii::t('main', 'Чистый дисконтированный доход')." &darr;",
            ),
                'options'=>array(
                    'placeholder' => Yii::t('main','Сортировать по'),
                    'multiple'=>false,
                ))
        );?>
    </div><!--select-->

    <div class="select select_small" data-name="limit">
        <?$this->widget('crud.dropDownList',
            array('name'=>'limit','selected'=>Yii::app()->request->getParam('limit',5),'elements'=>array(5=>5, 10=>10, 20=>20, 50=>50),
                'options'=>array(
                    'placeholder' => '5',
                    'multiple'=>false,
                ))
        );?>
    </div><!--select-->

    <?=CHtml::hiddenField('','',array('class'=>'current-select'));?>
    </div>
</form>