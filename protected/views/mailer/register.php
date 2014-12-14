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
                                        <h2 style="color: #00acec !important"><?=Yii::t('main','Подтверждение регистрации')?></h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">
                                        <p style="margin: 1em 0;">
                                            Для активации нового аккаунта перейдите по ссылке:
                                            <?=Mail::link('user/confirm',array('id'=>$params['model']->id,'hash'=>$params['model']->hash()))?>
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