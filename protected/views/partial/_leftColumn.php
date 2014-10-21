<?
/**
 * @var $model User|Project
 * @var $types array
 * @var $content str "user" | 1 | 2 | 3 | 4| 5
 */
$params = array();
//определим какие связи нужны
$content = Candy::get($content,'user');
$params['attributes']['name'] = $content == 'user' ? 'company_name' : 'name';
?>
<div class="side-column opacity-box">
    <div id="logo_block" class="profile-image">
                <span class="rel">
                    <?=Candy::preview(array($model->logo, 'scale' => '102x102'))?>
                    <?php echo CHtml::hiddenField('logo_id',$model->logo_id)?>
                </span>
    </div>

    <?php
    $this->widget('application.components.MediaEditor.MediaEditor',
        array('data' => array(
            'items' => null,
            'field' => 'logo_id',
            'item_container_id' => 'logo_block',
            'button_image_url' => '/images/markup/logo.png',
            'button_width' => 28,
            'button_height' => 28,
        ),
            'scale' => '102x102',
            'scaleMode' => 'in',
            'needfields' => 'false'));
    ?>
    <div class="profile-text"><?= $model->$params['attributes']['name']?></div>

    <?if(!empty($types)):?>
        <div class="profile-name"><?= $types[$model->type]?></div>
    <?endif;?>

    <div class="open-dialog load-action"><?= Yii::t('main','Загрузить логотип')?></div>

</div>