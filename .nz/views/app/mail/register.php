<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?= $this->lang->line("Registro de cuenta") ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background-color:#EFEFEF;">
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
<div style="display:block; border:1px solid #BFBFBF; padding:15px 20px; background-color:#FFF; font-size:12px; color:#333333; font-family:Arial, Helvetica, sans-serif">
<p style="margin-bottom:6px"><?= $this->lang->line("Se ha registrado un nuevo usuario con los siguientes datos:") ?></p>
<p style="margin:3px 0"><b><?= $this->lang->line("Empresa") ?>:</b> <?= $data['companyname'] ?></p>
<p style="margin:3px 0"><b><?= $this->lang->line("Nombre") ?>:</b> <?= $data['name'] ?></p>
<p style="margin:3px 0"><b><?= $this->lang->line("Apellido") ?>:</b> <?= $data['lastname'] ?></p>
<p style="margin:3px 0"><b><?= $this->lang->line("E-mail") ?>:</b> <?= $data['mail'] ?></p>
<p><?= $this->lang->line("Puede revisar la información y realizar la validación correspondiente $1click aquí$2.", array('<a href="' . base_url() .'operators/operator/'. $data['id'] .'" style="color:#3276b1; text-decoration:underline"><b>', '</b></a>')) ?></p>
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