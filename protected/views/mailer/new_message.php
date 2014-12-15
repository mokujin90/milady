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
                                        <h2 style="color: #00acec !important"><?=Yii::t('main','Новое сообщение')?></h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">
                                        <p style="margin: 1em 0;">
                                           Вам пришло новое сообщение от <?=$params['model']->userFrom->name?><br/>
                                            Тема: <?php echo $params['model']->subject?>"<br/>
                                            Текст: <?php echo $params['model']->text?>"<br/>
                                            <?=Mail::link('message/detail',array('id'=>$params['model']->id))?>
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