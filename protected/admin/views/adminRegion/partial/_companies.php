<div class="company-table panel padding-md">
    <table class="table" style="font-size: 12px;text-align: center;">
        <thead>
        <tr class="row">
            <td class="cell  col-xs-2">Лого</td>
            <td class="cell  col-xs-5">Название</td>
            <td class="cell  col-xs-4">URL</td>
            <td class="cell  col-xs-1"></td>
        </tr>
        </thead>
        <tbody>
        <?foreach($models as $model){?>
            <tr class="row">
                <td class="cell">
                    <?=CHtml::hiddenField("{$name}[]", $model->company_id)?>
                    <div class="media-preview"><?= $model->company->media ? Candy::preview(array($model->company->media, 'scaleMode' => 'in', 'scale' => '100x100')) : ''?></div>
                </td>
                <td class="cell"><?=$model->company->name?></td>
                <td class="cell"><?=$model->company->url?></td>
                <td class=" min">
                    <label class="label-checkbox inline">
                        <input class="remove-line" type="checkbox" value="1" name="" id="">
                        <span class="custom-checkbox"></span>
                    </label>
                </td>
            </tr>
        <?}?>
        </tbody>
        <tfoot>
        <tr class="row hidden">
            <td class="cell col-xs-2">
                <?=CHtml::dropDownList('','', array('' => '---') + CHtml::listData(ReferenceRegionCompanyType::model()->findAll(array('order' => 'name')), 'id', 'name'), array('class' => 'select-company-type form-control'));?>
            </td>
            <td class="cell " colspan="2">
            <?=CHtml::dropDownList("{$name}[]",'', array(), array('class' => 'select-company-id form-control', 'disabled' => true))?>
            </td>
            <td class=" min col-xs-1">
                <label class="label-checkbox inline">
                    <input class="remove-line" type="checkbox" value="1" name="" id="">
                    <span class="custom-checkbox"></span>
                </label>
            </td>
        </tr>
        </tfoot>
    </table>
    <br>
    <input class="btn btn-success btn-xs blue new-company-line" type="button" value="Создать строку">
    <input class="btn btn-danger btn-xs blue remove-company-line" type="button" value="Удалить строки">
</div>