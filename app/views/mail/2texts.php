<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table id="Tabla_01" width="600" height="828" border="0" cellpadding="0" cellspacing="0" style="
    margin: 0 auto;
">
	<tbody><tr>
		<td colspan="4">
			<img src="<?= layout('img/mail-2texts') ?>/mail_01.jpg" width="600" height="107" alt=""></td>
	</tr>
	<tr>
		<td colspan="4" cellspaicing="0" style="
    padding: 50px 40px 0 50px;
    font-weight: 600;
    font-size: 20px;
    font-family: sans-serif;
    background: #71abd3;
    color: white;
    text-align: center;
">
            <p><?= $data['message'] ?></p>
        </td>
	</tr>
	<tr>
		<td colspan="4" cellspaicing="0" style="
    background: #71abd3;
">
<a href="<?= base_url() ?>">

	<img src="<?= layout('img/mail-2texts') ?>/mail_03.jpg" width="600" height="227" alt=""></td>
</a>

		</tr>
	<tr>
		<td colspan="4" style="
    padding: 0 50px;
    font-size: 14px;
    font-weight: 600;
    font-family: sans-serif;
    background: #1e87c9;
    color: white;
    text-align: center;
">

<p><?= $data['message2'] ?></p>
    
</td>
	</tr>
	<tr>
		<td style="
    background: #293f4c;
">
<a href="<?= base_url() ?>">
			<img src="<?= layout('img/mail-2texts') ?>/mail_05.jpg?v2" width="413" height="69" alt=""></td>
</a>
		<td style="
    background: #293f4c;
">
			<a href="<?= $this->data['config']->facebook ?>">
				<img src="<?= layout('img/mail-2texts') ?>/01_INFO_emailing_geniux_06.jpg" width="58" height="69" border="0" alt=""></a></td>
		<td style="
    background: #293f4c;
">
			<a href="<?= $this->data['config']->twitter ?>">
				<img src="<?= layout('img/mail-2texts') ?>/01_INFO_emailing_geniux_07.jpg" width="56" height="69" border="0" alt=""></a></td>
		<td style="
    background: #293f4c;
">
			<a href="<?= $this->data['config']->instagram ?>">
				<img src="<?= layout('img/mail-2texts') ?>/01_INFO_emailing_geniux_08.jpg" width="73" height="69" border="0" alt=""></a></td>
	</tr>
</tbody></table>
<!-- End Save for Web Slices -->

</body></html>