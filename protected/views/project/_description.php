<?php
/**
 *
 * @var ProjectController $this
 * @var Project $model
 */
?>
<?php if($model->type == Project::T_INVEST):?>
    <div class="row">
        <?php echo $model->investment->short_description; ?>
    </div>

<?php endif;?>
