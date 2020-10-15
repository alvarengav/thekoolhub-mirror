<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?= $this->lang->line("Recuperar contaseña") ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background-color: #EFEFEF;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td bgcolor="#EFEFEF">&nbsp;</td>
<td width="600" height="25" bgcolor="#EFEFEF">&nbsp;</td>
<td bgcolor="#EFEFEF">&nbsp;</td>
</tr>
<tr>
<td bgcolor="#EFEFEF">&nbsp;</td>
<td width="600" height="40" bgcolor="#474544"><img src="<?= layout() ?>logo.png" height="20" style="margin:10px; margin-left:20px; display:block" alt="<?= $this->config->item('client', 'app') ?>"/></td>
<td bgcolor="#EFEFEF">&nbsp;</td>
</tr>
<tr>
<td bgcolor="#EFEFEF">&nbsp;</td>
<td width="600" bgcolor="#EFEFEF">
<div style=" display:block; border:1px solid #BFBFBF;padding:15px 20px; background-color:#FFF; font-size:12px; color:#333333; font-family:Arial, Helvetica, sans-serif">
<p><?= $data['name'] ?> <?= $data['lastname'] ?>, <?= $this->lang->line("haz cambiado tu contraseña!") ?></p>
<p><b><?= $this->lang->line("Tu nueva contraseña es") ?>:</b> <?= $data['password'] ?><p/>
<p><?= $this->lang->line("Inicia sesión haciendo $1click aquí$2 ingresando tu cuenta de email y la contraseña temporal que te hemos enviado.", array('<a href="' . base_url() .'" style="color:#3276b1; text-decoration:underline"><b>', '</b></a>')) ?></p>
</div>
</td>
<td bgcolor="#EFEFEF">&nbsp;</td>
</tr>

<tr>
<td bgcolor="#EFEFEF">&nbsp;</td>
<td width="600" height="25" bgcolor="#EFEFEF">&nbsp;</td>
<td bgcolor="#EFEFEF">&nbsp;</td>
</tr>
</table>
</body>
</html>