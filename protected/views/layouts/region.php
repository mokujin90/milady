<?
/**
 * @var $this RegionController
 */
$id = Yii::app()->request->getParam('id',false);
$section = $this->getActionName();
Yii::app()->clientScript->registerCssFile('/css/regions.css');
$data = array(
    'social'=>array( 'name'=>Yii::t('main','Социально-экономическая информация')),
    'analytic'=>array('name'=>Yii::t('main','Региональная аналитика')),
    'infrastructure'=>array( 'name'=>Yii::t('main','Инфраструктурный паспорт')),
    'innovative'=>array( 'name'=>Yii::t('main','Инновационный паспорт')),
    'invest'=>array( 'name'=>Yii::t('main','Инвестиционный паспорт')),
    'law'=>array( 'name'=>Yii::t('main','Региональное законодательство')),
);
Yii::app()->clientScript->registerScript('region', 'regionsPart.init();', CClientScript::POS_READY);
?>
<?php $this->beginContent('//layouts/main'); ?>
    <div class="region-page <?=$section?>">
        <div id="general">

            <div class="main bread-block">
                <?$this->renderPartial('/partial/_breadcrumbs')?>
            </div>
            <?if(array_key_exists($section, $data)):?>
                <div class="main-info trans-block">
                    <div class="main chain-block">
                        <?if($section == 'social'): //здесь другая информация?>
                            <h1 class="big"><?=$this->model->region->name?></h1>
                            <div class="wiki-info chain">
                                <div class="item chain">
                                    <?=Candy::preview(array($this->model->logo->media,'scale'=>'160x180','class'=>'logo', 'scaleMode' => 'in'))?>

                                    <div class="params">
                                        <div class="param">
                                            <div class="key"><?= Yii::t('main','Статус')?>:</div>
                                            <div class="value"><?=$this->model->status?></div>
                                        </div>
                                        <div class="param">
                                            <div class="key"><?= Yii::t('main','Дата образования')?>:</div>
                                            <div class="value"><?=$this->model->date_creation?></div>
                                        </div>
                                        <div class="param">
                                            <div class="key"><?= Yii::t('main','Поддержка инвестора')?>:</div>
                                            <div class="value"><?=$this->model->investor_support?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item mayor chain">
                                    <?=Candy::preview(array($this->model->mayorLogo->media,'scale'=>'160x180','class'=>'photo', 'scaleMode' => 'in'))?>
                                    <div class="notice">
                                        <div class="info-post"><?= Yii::t('main','Руководство региона')?></div>
                                        <div class="post"><?=$this->model->mayor_post?></div>
                                        <div class="fio"><?=$this->model->mayor?></div>
                                    </div>
                                </div>
                            </div>
                        <?else:?>
                            <h1><?=$this->model->region->name?></h1>
                            <h2><?=$data[$section]['name']?></h2>
                        <? endif;?>
                        <div class="region-notice">
                            <p>
                                <span class="r r-quote-up"></span>
                                    <?=$this->model->info?>
                                <span class="r r-quote-down"></span>
                            </p>
                        </div>
                    </div>
                    <?if($section == 'social'):?>
                        <div class="gradient-line toggled-block">
                            <div class="main">
                                <table>
                                    <tr>
                                        <td class="white"></td>
                                        <td class="frontier"></td>
                                        <td class="stroke">
                                            <div class="toggle">
                                                <span class="text"><?= Yii::t('main','Скрыть описание')?></span>
                                                <span class="r r-slide-up-blue"></span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    <?endif;?>
                </div>
                <div class="link-panel">
                    <div class="main chain-block">
                        <?$i=0;?>
                        <?foreach($data as $key=>$items):?>
                            <div class="item num-<?=++$i?> <?=($section==$key ? "active":"")?>">
                                <?$params = $id ? array('id'=>$id): array();?>
                                <a href="<?=$this->createUrl("region/{$key}",$params)?>">
                                    <span class="r r-item-<?=$key?><?=($section==$key ? "-active":"")?>"></span>
                                    <span class="text"><?=$items['name']?></span>
                                </a>
                            </div>



                        <?endforeach;?>
                    </div>
                </div>
            <?endif;?>

            <?=$content; ?>
            <?
                if(array_key_exists($section, $data)){
                    $this->footerContent = '<div class="region-footer">';
                    $this->footerContent .= '<div class="main chain-block">';
                    $i=0;
                    foreach($data as $key=>$items){
                        $icon = "r-f-item-{$key}";
                        $class="";
                        if($section==$key){
                            $icon.='-active';
                            $class="active";
                        }

                        $i++;
                        $params = $id ? array('id'=>$id): array();
                        $this->footerContent.= CHtml::openTag('a',array('class'=>"link $class",'href'=>$this->createUrl("region/$key",$params)));
                        $this->footerContent.= "<span class=\"r $icon\"></span>";
                        $this->footerContent.= "<span class='text'>".$data[$key]['name']."</span>";
                        $this->footerContent.= CHtml::closeTag('a');
                        $this->footerContent.= (count($data)!=$i ? "<span class='separator'>/</span>" : "");
                    }
                    $this->footerContent .= '</div>';
                    $this->footerContent .= '</div>';
                }
            ?>

        </div>
    </div>
<? $this->endContent(); ?>