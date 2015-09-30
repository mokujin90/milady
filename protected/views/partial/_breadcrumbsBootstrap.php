<?$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'htmlOptions' => array('class'=>'breadcrumb'),
    'homeLink'=> '<li><a href="/"> <i class="fa fa-home"></i> Главная</a></li>',
    'separator'=>'',
    'activeLinkTemplate' => '<li><a href="{url}"> {label}</a></li>',
    'inactiveLinkTemplate' => '<li class="active">{label}</li>'
)); ?>