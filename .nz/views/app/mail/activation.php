<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?= $this->lang->line("Activación de cuenta") ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background-color: #EFEFEF;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td bgcolor="#EFEFEF">&nbsp;</td>
<td width="600" height="50" bgcolor="#EFEFEF">&nbsp;</td>
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
<div style=" display:block; border:1px solid #BFBFBF; border-bottom:none; padding:15px 20px; background-color:#FFF; font-size:12px; color:#333333; font-family:Arial, Helvetica, sans-serif">
<p><?= $this->lang->line("Bienvenido $1", array($data['name'] . ' ' . $data['lastname'])) ?>,</p>
<p><?= $this->lang->line("Está a punto de completar el último paso para poder comenzar a utilizar el sistema.") ?><br>
<p><b><?= $this->lang->line("Esta es tu contraseña temporal") ?>:</b> <?= $data['password'] ?><p/>
<p><?= $this->lang->line("Inicia sesión haciendo $1click aquí$2 ingresando tu cuenta de email y la contraseña que te hemos enviado.", array('<a href="' . base_url() .'" style="color:#3276b1; text-decoration:underline"><b>', '</b></a>')) ?></p>
<p><br/><br/><?= $this->lang->line("Atentamente, Staff.") ?></p>
</div>
<div style="display:block; background-color:#4F4F4F; padding:5px 20px;font-size:12px; color:#fff; font-family:Arial, Helvetica, sans-serif">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><img src="<?= layout() ?>logo.png" height="14" style="margin:3px 0; display:block" alt="<?= $this->config->item('client', 'app') ?>"/></td>
</tr>
</table>
</div>
</td>
<td bgcolor="#EFEFEF">&nbsp;</td>
</tr>
<tr>
<td bgcolor="#EFEFEF">&nbsp;</td>
<td width="600" bgcolor="#EFEFEF">&nbsp;</td>
<td bgcolor="#EFEFEF">&nbsp;</td>
</tr>
</table>
</body>
</html>