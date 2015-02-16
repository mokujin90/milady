<?
/**
 * @var $this Grid
 */
?>
<div class="grid-widget">
    <?=CHtml::openTag('table',$this->htmlOptions)?>
        <?php if(count($this->header)):?>
            <thead>
                <?php foreach($this->header as $line => $tr):?>
                    <tr class="row">
                        <?=$this->drawLine($tr,false)?>
                    </tr>
                <?php endforeach;?>
            </thead>
        <?php endif;?>
        <tbody>
            <?php foreach($this->data as $line => $tr):?>
                <tr class="row">
                    <?=$this->drawLine($tr,false)?>
                </tr>
            <?php endforeach;?>

        </tbody>
    <?=CHtml::closeTag('table')?>
</div>