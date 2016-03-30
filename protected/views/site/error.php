<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<div id="general">
    <div class="content list-columns columns">
        <div class="profile-block">
            <div class="full-column opacity-box" style="text-align: center; padding: 20px;">
                <h2 class="profile-block__title">Error <?php echo $code; ?></h2>
                <div class="error">
                <?php echo CHtml::encode($message); ?>
                </div>
            </div>
        </div>
    </div>
</div>