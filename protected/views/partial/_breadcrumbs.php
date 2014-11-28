<?$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'htmlOptions' => array('class'=>'breadcrumb'),
    'homeLink'=>CHtml::link('Главная','/',array('class'=>'normal')),
    'separator'=>''
)); ?>