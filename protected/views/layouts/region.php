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
                            <h1 class="big">Красноярский край</h1>
                            <div class="wiki-info chain">
                                <div class="item chain">
                                    <?=CHtml::image('/images/assets/slider-1.png','',array('class'=>'logo'))?>
                                    <div class="params">
                                        <div class="param">
                                            <div class="key"><?= Yii::t('main','Статус')?>:</div>
                                            <div class="value">субъект Российской Федерации, входит в состав Сибирского округа</div>
                                        </div>
                                        <div class="param">
                                            <div class="key"><?= Yii::t('main','Дата образования')?>:</div>
                                            <div class="value">13 августа 1944 года</div>
                                        </div>
                                        <div class="param">
                                            <div class="key"><?= Yii::t('main','Поддержка инвестора')?>:</div>
                                            <div class="value">Министерство инвестиций и инноваций Красноярского края</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item mayor chain">
                                    <?=CHtml::image('/images/assets/slider-1.png','',array('class'=>'photo'))?>
                                    <div class="notice">
                                        <div class="info-post"><?= Yii::t('main','Руководство региона')?></div>
                                        <div class="post">Губернатор Красноярского Края</div>
                                        <div class="fio">ТОЛОКОНСКИЙ Виктор Александрович</div>
                                    </div>
                                </div>
                            </div>
                        <?else:?>
                            <h1>Красноярский край</h1>
                            <h2><?=$data[$section]['name']?></h2>
                        <? endif;?>
                        <div class="region-notice">
                            <p><span class="r r-quote-up"></span>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad culpa doloribus, eaque, harum impedit laborum nam odio perferendis porro quod, reiciendis soluta vel voluptas? Laudantium nam necessitatibus perspiciatis sed voluptates?
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid dolor in nostrum rem voluptatibus. Accusamus ad blanditiis dignissimos laboriosam magni necessitatibus obcaecati suscipit vel voluptate voluptates! A optio quaerat voluptas.<span class="r r-quote-down"></span>
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
                                <a href="<?=$this->createUrl("region/{$key}",array('id'=>$id))?>">
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
                        $this->footerContent.= CHtml::openTag('a',array('class'=>"link $class",'href'=>$this->createUrl("region/$key",array('id'=>$id))));
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