<?
/**
 * @var $title string
 */
$url = urlencode(Candy::getCurrentUrl());
$summary = isset($summary) ? $summary : '';
$source = isset($source) ? urlencode($source) : '';
$img = isset($img) ? $img : '';
$summaryEncode = urlencode($summary);
$titleEncode = urlencode($title);
$urlVk = "http://vk.com/share.php?url={$url}";
$urlFb = "http://www.facebook.com/sharer/sharer.php?u={$url}&t={$titleEncode}&src=sp";
$urlLinked = "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title={$titleEncode}&summary={$summaryEncode}&source={$source}";
?>
<?
Yii::app()->clientScript->registerMetaTag($title, 'title');
Yii::app()->clientScript->registerMetaTag($summary, 'description');
Yii::app()->clientScript->registerMetaTag($title,null,null,array('property'=>'og:title'));
Yii::app()->clientScript->registerMetaTag($summary,null,null,array('property'=>'og:description'));
Yii::app()->clientScript->registerMetaTag($img,null,null,array('property'=>'og:image'));
?>

<div class="page-social">
    <a rel="nofollow" target="_blank" class="page-social__link page-social__link_vk" href="<?=$urlVk?>">
        <i class="page-social__icon page-social__icon_vk"></i>
        <span class="page-social__count">0</span>
    </a>

    <a rel="nofollow" target="_blank" class="page-social__link page-social__link_fb" href="<?=$urlFb?>">
        <i class="page-social__icon page-social__icon_fb"></i>
        <span class="page-social__count">0</span>
    </a>

    <a rel="nofollow" target="_blank" class="page-social__link page-social__link_in" href="<?=$urlLinked?>">
        <i class="page-social__icon page-social__icon_in"></i>
        <span class="page-social__count">0</span>
    </a>

</div><!--page-social-->