<html>

<head>
    <title>Formulario contacto (Equipo Kool)</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <!-- Save for Web Slices (Formulario contacto (Equipo Kool).png) -->
    <table id="Tabla_01" width="601" height="1029" border="0" cellpadding="0" cellspacing="0" style="
            margin: 0 auto;
            font-family: Helvetica, Raleway, Roboto;
            ">
        <tbody>
            <tr>
                <td colspan="12">
                    <img src="<?= layout('img/mail2') ?>/mail2_01.jpg" width="600" height="123" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="1" height="123" alt="">
                </td>
            </tr>
            <tr>
                <td colspan="12">
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="1" height="33" alt="">
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td colspan="10" rowspan="2" style="
                        font-size: 1rem;
                        ">
                    <h1 style="
                            color: #ffab00;
                            margin-bottom: 30px;
                            font-size: 2rem;
                            "><?= $this->Data->lang('¡Hola') ?> <?= $this->input->post('name') ?>!
                        <?= $this->Data->lang('¿Qué tal?') ?></h1>
                    <p><b><?= $this->Data->lang('Gracias por suscribirte.') ?></b>
                    </p>
                    <p style="
                            margin-bottom: 20px;
                            ">
                        <?= $this->Data->lang('Por nuestra parte, tenemos registrado tus intereses: ') ?>
                    </p>
                </td>
                <td>
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="1" height="231" alt="">
                </td>
            </tr>
            <tr>
                <td rowspan="7">
                    <img src="<?= layout('img/mail2') ?>/mail2_06.jpg" width="30" height="398" alt="">
                </td>
                <td rowspan="7">
                    <img src="<?= layout('img/mail2') ?>/mail2_07.jpg" width="49" height="398" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="1" height="73" alt="">
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <img src="<?= layout('img/mail2') ?>/mail2_08.jpg" width="257" height="23" alt="">
                </td>
                <td rowspan="5">
                    <img src="<?= layout('img/mail2') ?>/mail2_09.jpg" width="22" height="170" alt="">
                </td>
                <td colspan="5">
                    <img src="<?= layout('img/mail2') ?>/mail2_10.jpg" width="242" height="23" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="1" height="23" alt="">
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <p style="
                            padding-bottom: 0;
                            margin-bottom: 0;
                            padding-left: 7px;
                            "><b>Servicio de interés:</b>
                    </p>
                    <p style="
                            margin-top: 5px;
                            "><?= $data['number_persons'] ?></p>
                    <p></p>
                </td>
                <td style="
                        padding: 5px 0 5px 7px;
                        " colspan="4">
                    <p style="
                            padding-bottom: 0;
                            margin-bottom: 0;
                            "><b>Nº de personas:</b></p>
                    <p style="
                            margin-top: 5px;
                            "><?= $data['number_persons'] ?></p>
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="1" height="54" alt="">
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <img src="<?= layout('img/mail2') ?>/mail2_13.jpg" width="257" height="22" alt="">
                </td>
                <td colspan="5" rowspan="3">
                    <img src="<?= layout('img/mail2') ?>/mail2_14.jpg" width="242" height="93" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="1" height="22" alt="">
                </td>
            </tr>
            <tr>
                <td colspan="4" style="
                        padding-left: 7px;
                        ">
                    <b>Y tus comentarios:</b>
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="1" height="47" alt="">
                </td>
            </tr>
            <tr>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="1" height="24" alt="">
                </td>
            </tr>
            <tr>
                <td style="
                        padding: 5px 0 5px 7px;
                        " colspan="10">
                    <p style="
                            margin-top: 5px;
                            "><?= nl2br($this->input->post('message')) ?> </p>
                    <p style="
                            font-weight: 600;
                            margin-top: 30px;
                            margin-bottom: 40px;
                            ">Equipo Kool Hub</p>
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="1" height="155" alt="">
                </td>
            </tr>
            <tr>
                <td colspan="12" style="
                        background: #4d4d4d;
                        >
                        <img src=" <?= layout('img/mail2') ?>/mail2_18.jpg" width="600" height="59" alt=""></td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="1" height="59" alt="">
                </td>
            </tr>
            <tr style="
                    background: #4d4d4d;
                    ">
                <td colspan="12" style="
                        text-align: center;
                        color: white;
                        background: #4d4d4d;
                        padding: 20px 0;
                        ">
                    <p>
                        <a href="https://thekoolhub.com" style="
                                font-weight: 600;
                                color: white;
                                text-decoration: none;
                                ">www.thekoolhub.com</a>
                    </p>
                    <p>
                        Calle de Silva 14, bajos 28004 Madrid<br>
                        +34 648 808 838<br>
                        <a style="
                                color: white;
                                text-decoration: none;
                                " href="mailto:hello@thekoolhub.com">hello@thekoolhub.com</a>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <img src="<?= layout('img/mail2') ?>/mail2_20.jpg" width="143" height="91" alt="">
                </td>
                <td>
                    <a href="https://link.com">
                        <img src="<?= layout('img/mail2') ?>/Formulario-contacto-(Equipo-Kool)_25.jpg" width="42"
                            height="91" border="0" alt=""></a>
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/mail2_22.jpg" width="42" height="91" alt="">
                </td>
                <td>
                    <a href="https://link.com">
                        <img src="<?= layout('img/mail2') ?>/Formulario-contacto-(Equipo-Kool)_27.jpg" width="60"
                            height="91" border="0" alt=""></a>
                </td>
                <td colspan="2">
                    <img src="<?= layout('img/mail2') ?>/mail2_24.jpg" width="33" height="91" alt="">
                </td>
                <td>
                    <a href="https://link.com">
                        <img src="<?= layout('img/mail2') ?>/Formulario-contacto-(Equipo-Kool)_29.jpg" width="52"
                            height="91" border="0" alt=""></a>
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/mail2_26.jpg" width="26" height="91" alt="">
                </td>
                <td>
                    <a href="https://link.com">
                        <img src="<?= layout('img/mail2') ?>/Formulario-contacto-(Equipo-Kool)_31.jpg" width="66"
                            height="91" border="0" alt=""></a>
                </td>
                <td colspan="2">
                    <img src="<?= layout('img/mail2') ?>/mail2_28.jpg" width="136" height="91" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="1" height="91" alt="">
                </td>
            </tr>
            <tr>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="30" height="1" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="113" height="1" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="42" height="1" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="42" height="1" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="60" height="1" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="22" height="1" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="11" height="1" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="52" height="1" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="26" height="1" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="66" height="1" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="87" height="1" alt="">
                </td>
                <td>
                    <img src="<?= layout('img/mail2') ?>/espacio.gif" width="49" height="1" alt="">
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <!-- End Save for Web Slices -->
</body>

</html>