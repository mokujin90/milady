<style>
    .page-size-wrap{text-align: right;}
</style>
<?php
$pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
$pageSizeDropDown = CHtml::dropDownList(
    'pageSize',
    $pageSize,
    array(10 => 10, 25 => 25, 50 => 50, 100 => 100),
    array(
        'class' => 'change-pagesize',
        'onchange' => "$.fn.yiiGridView.update('grid-view',{data:{pageSize:$(this).val()}});",
    )
);
?>
<div class="page-size-wrap">
    <span>Элементов на страницу: </span><?= $pageSizeDropDown; ?>
</div>