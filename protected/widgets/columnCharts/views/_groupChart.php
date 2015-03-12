<div class="chart" style="width: <?=$this->width?>px;">
    <div id="figure">
        <div class="graph" style="height: <?=$this->height?>px;">
            <ul class="y-axis <?=($this->showYAxisLines)? '' : 'hide-lines'?>">
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
            </ul>
            <div class="bars">
                <?=$this->getColumns()?>
            </div>
            <div class="chart-clear"></div>
            <ul class="x-axis">
                <?=$this->getXAxisHtml()?>
            </ul>
        </div>
        <?if($this->showLegend):?>
        <ul class="legend">
            <?=$this->getLegendHtml()?>
        </ul>
        <?endif?>
    </div>
</div>