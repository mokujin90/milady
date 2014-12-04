<div class="analitycs-page">
    <div id="general">
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        <div class="content list-columns columns">
            <div class="side-column opacity-box">
                <h1><?= Yii::t('main','Категория')?></h1>
                <div class="side-menu-list">
                    <?
                    foreach (Analytics::getCategoryType() as $type => $name) {
                        $params = $_GET;
                        unset($params['page']);
                        if (empty($params['hide'][$type])) {
                            $params['hide'][$type] = $type;
                        } else {
                            unset($params['hide'][$type]);
                        }
                        ?>
                        <div class="side-menu-item overflow blue-label">
                            <?=Crud::checkBox("hide[$type]",empty($_GET['hide'][$type]),array('disabled' => true)) . CHtml::link($name, $this->createUrl('', $params))?>
                        </div>
                    <?}?>
                </div>
            </div>
            <div class="main-column">
                <?foreach($models as $model):?>
                    <div class="news-item opacity-box">
                        <div class="data">
                            <div class="date"><?=Candy::formatDate($model->create_date)?></div>
                            <?=$model->media?Candy::preview(array($model->media, 'scale' => '200x100', 'class' => 'image')):''?>
                            <?=CHtml::link(CHtml::encode($model->name),$model->createUrl(), array('class' => 'name'))?>
                            <div class="announce">
                                <?=CHtml::encode($model->announce)?>
                            </div>
                        </div>
                    </div>
                <?endforeach?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>