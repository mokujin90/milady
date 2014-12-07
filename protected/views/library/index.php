<div class="library-page">
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
                <?$this->widget('CLinkPager', array('pages'=>$pages));?>
                <div class="full-column opacity-box">
                <?$models = array(1,2,3,4,5,5)?>
                    <table class="file-table even">
                        <tbody>
                        <? foreach ($models as $field): ?>
                            <tr>
                                <td><a href="#">Name Name Name Name Name Name Name Name Name Name</a></td>
                                <td class="right-value">20.20.20</td>
                            </tr>
                        <? endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>