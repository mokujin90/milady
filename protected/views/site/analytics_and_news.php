<div class="analitycs-page">
    <div id="general">
        <div class="main bread-block">
            <?$this->renderPartial('/partial/_breadcrumbs')?>
        </div>
        <div class="content list-columns columns">
            <div class="full-column opacity-box" style="padding: 10px 20px; margin-top: 10px; color: #364F8C;">
                <h1><?=CHtml::link('Новости', $this->createUrl('news/index'), array('style'=>'color: #364F8C;'))?></h1>
                <h1><?=CHtml::link('Аналитика', $this->createUrl('analytics/index'), array('style'=>'color: #364F8C;'))?></h1>
                <h1><?=CHtml::link('Проф. мнение', $this->createUrl('profOpinion/index'), array('style'=>'color: #364F8C;'))?></h1>
            </div>
        </div>
    </div>
</div>