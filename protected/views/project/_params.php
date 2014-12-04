<table class="all-params even">
    <tbody>
    <? foreach ($fields as $field): ?>
        <tr>
            <td><?= $project->{Project::$params[$project->type]['relation']}->getAttributeLabel($field) ?></td>
            <td class="value"><?= $project->{Project::$params[$project->type]['relation']}->{$field} ?></td>
        </tr>
    <? endforeach ?>
    </tbody>
</table>