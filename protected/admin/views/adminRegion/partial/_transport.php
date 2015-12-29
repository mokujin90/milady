<div class="company-table panel padding-md">
    <table class="table" style="font-size: 12px;text-align: center;">
        <thead>
        <tr class="row">
            <td class="cell col-xs-6">Название</td>
            <td class="cell col-xs-5">URL</td>
            <td class="cell col-xs-1"></td>
        </tr>
        </thead>
        <tbody>
        <?foreach($models as $model){?>
            <tr class="row">
                <td class="cell">
                    <?=CHtml::hiddenField("{$name}[]", $model->transport_id)?>
                    <?=$model->transport->name?></td>
                <td class="cell"><?=$model->transport->url?></td>
                <td class="min">
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
            <td class="cell col-xs-11" colspan="2" style="max-width: 100px; text-align: left;">
                <?=CHtml::dropDownList("{$name}[]",'', CHtml::listData(ReferenceTransport::getList($name), 'id', 'name'), array('class' => 'select-transport form-control', 'disabled' => true))?>
            </td>
            <td class="min col-xs-1">
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