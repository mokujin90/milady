<?
$project = Project::model()->findByPk($params['model']->project_id);
?>
<table align="center" border="0" cellpadding="0" cellspacing="0" id="backgroundTable" width="100%">
    <tbody>
    <tr>
        <td align="center">
            <center>
                <table border="0" cellpadding="30" cellspacing="0" style="margin-left: auto;margin-right: auto;width:600px;text-align:center;" width="600">
                    <tbody><tr>
                        <td align="left" style="background: #ffffff; border: 1px solid #dce1e5;" valign="top" width="">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody><tr>
                                    <td align="center" valign="top">
                                        <h2 style="color: #00acec !important"><?=Yii::t('main','Новая новость')?></h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">
                                        <p style="margin: 1em 0;">
                                            Новая новость у проекта, на который вы подписаны "<?php echo $project->name?>":<br/>
                                            <?php echo $params['model']->name?><br/>
                                            <?php echo $params['model']->announce?><br/>

                                            <?=Mail::link('project/detail',array('id'=>$params['model']->project_id))?>
                                        </p>
                                    </td>
                                </tr>
                                </tbody></table>
                        </td>
                    </tr>
                    </tbody></table>
            </center>
        </td>
    </tr>
    </tbody>
</table>