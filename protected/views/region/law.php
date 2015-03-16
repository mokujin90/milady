<div class="tab law">
    <?$this->renderPartial('_header-tab',array('name'=>Yii::t('main','Инвестиционный климат'),'icon'=>'law'))?>
    <div class="data toggled-block">
        <div class="content columns list-columns">
            <div class="side-column opacity-box">
                <h1><?= Yii::t('main','Категория')?></h1>
                <div class="side-menu-list">
                    <?
                    $sideMenu = array(
                        Project::T_INFRASTRUCT => Yii::t('main', 'Инфраструктурные'),
                        Project::T_INNOVATE => Yii::t('main', 'Иновационные'),
                        Project::T_INVEST => Yii::t('main', 'Инвестиционные'),
                    );
                    foreach ($sideMenu as $type => $name) {
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
                <div class="right-column">
                    <div class="full-column opacity-box overflow document-list" style=" padding: 31px 35px 31px 25px;">
                        <?foreach($files as $file):?>
                            <div class="item">
                                <span class="r r-file-pdf"></span>
                                <?= CHtml::link($file->title,$file->media->makeWebPath(),array('class'=>'link'));?>
                            </div>
                        <?endforeach;?>
                    </div>
                </div>
            </div>

        </div>
        <div class="clear"></div>
    </div>
</div>