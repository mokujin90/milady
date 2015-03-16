<?php
/**
 * @var $name
 * @var $icon
 * @var $toggleText
 */
$toggleText = Candy::get($toggleText,'');
?>
<div class="header">
    <div class="main chain">
        <div class="caption min"><?=$name?></div>
        <span class="r r-block-<?=$icon?> logo"></span>
        <div class="toggle">
            <span class="text"><span class="toggle-text"><?= Yii::t('main','Скрыть')?></span> <?=$toggleText?></span>
            <span class="r r-slide-up-black"></span>
        </div>
    </div>
    <div class="back"></div>
</div>