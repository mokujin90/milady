<?php
/**
 *
 * @var ProjectController $this
 */
?>
<? $this->widget('Map', array(
    'projects'=>array($model),
    'htmlOptions'=>array(
        'style'=>'height: 230px;width:100%;'
    )
)); ?>