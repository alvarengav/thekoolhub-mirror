<?php
$lang = $this->config->item('lang', 'app');
$layoutversion = $this->config->item('layout-version', 'app');
$title = prep_app_title($appTitle, false);
$title = $title ? $title . ' | ' . $this->config->item('client', 'app') : $this->config->item('client', 'app');

$dataSess = $this->session->all_userdata();
if(!isset($dataSess['udata-chat-active']))
  $this->session->set_userdata('udata-chat-active', 1);
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang ?>" lang="<?php echo $lang ?>">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="author" content="<?= $this->config->item('copyright', 'app') ?>" />
<meta name="copyright" content="<?= $this->config->item('copyright', 'app') ?> - <?= date('Y') ?>" />
<meta name="year" content="<?= date('Y') ?>" />
<meta name="robots" content="noindex,nofollow,noarchive" />
<? $this->load->view("common/viewport") ?>
<title><?= $title ?></title>
<link rel="stylesheet" type="text/css" href="<?= layout() ?>bootstrap.css<?= $layoutversion ?>">
<link rel="stylesheet" type="text/css" href="<?= layout() ?>styles.css<?= $layoutversion ?>">
<link rel="stylesheet" type="text/css" href="<?= layout() ?>custom.css<?= $layoutversion ?>">
<?php if ($this->config->item('admin-responsive', 'app')): ?>
<link rel="stylesheet" type="text/css" href="<?= layout() ?>responsive.css<?= $layoutversion ?>">  
<?php endif ?>
<link rel="shortcut icon" href="<?= layout() ?>favicon.png<?= $layoutversion ?>" type="image/x-icon">
<link rel="icon" href="<?= layout() ?>favicon.png<?= $layoutversion ?>" type="image/x-icon">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,600,700">
<link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<? $this->load->view("script/global") ?>
</head>
<body class="<?= $bodyClass ?><? if(!(isset($quickOpen) && $quickOpen)): ?><?= round($this->session->userdata('udata-body-minified')) ? " minified" : "" ?><?= (round($this->session->userdata('udata-chat-active')) && $this->MApp->user && $this->MApp->user->valid != 2 && !$this->config->item('chat-inactive', 'app')) ? " chat-active" : "" ?><?= round($this->session->userdata('udata-hidden-menu')) ? " hidden-menu" : "" ?><? endif?>">
<script src="<?= base_url() ?>script/app.js"></script>
<? if($this->config->item('chat-inactive', 'app')): ?>
<script>App.Chat.disabled = true;</script>
<? else: ?>
<script>App.Chat.disabled = <?= round($this->session->userdata('udata-chat-disabled') || (isset($quickOpen) && $quickOpen)) ? "true" : "false" ?>;</script>
<? endif ?>
