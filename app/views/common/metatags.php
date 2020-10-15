<?php if( isset($headers) && $headers ):?>
<?= isset($headers['head']) ? $headers['head'] : "<head>" ?>

<meta charset="utf-8">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-language" content="en" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="index,follow">
<title id="head-title"><?= $headers['head-title'] ?></title>
<meta name="twitter:title" content="<?= $headers['title'] ?>" />
<meta property="og:title" name="og:title" content="<?= $headers['title'] ?>" />
<meta id="head-description" name="description" content="<?= $headers['description'] ?>" />
<meta property="og:description" name="og:description" content="<?= $headers['description'] ?>" />
<meta name="twitter:description" content="<?= $headers['description'] ?>">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-language" content="en" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="robots" content="index,follow">
<title id="head-title"><?= $this->config->item('client', 'app') ?></title>
<meta property="og:title" name="og:title" content="<?= $this->config->item('client', 'app') ?>" />
<meta id="head-description" name="description" content="" />
<meta property="og:description" name="og:description" content="" />
<meta id="head-keywords" name="keywords" content="" /><?php endif ?>
<?php if( ! empty($headers['share-image']) ):?>
<meta name="twitter:image" content="<?= $headers['share-image'] ?>" />
<meta property="og:image" name="og:image" content="<?= $headers['share-image'] ?>" />
<?php else: ?>
<meta name="twitter:image" content="<?= layout('default-share.png') ?>" />
<meta property="og:image" name="og:image" content="<?= layout('default-share.jpg') ?>" />
<?php endif ?>
<?php if( isset($headers['og:url']) ):?>
<meta property="og:url" name="og:url" content="<?= $headers['og:url'] ?>" />
<?php else: ?>
<meta property="og:url" name="og:url" content="<?= current_url() ?>" />
<?php endif ?>
<?php if( isset($headers['og:type']) ):?>
<meta property="og:type" name="og:type" content="<?= $headers['og:type'] ?>" />
<?php else: ?>
<meta property="og:type" name="og:type" content="website" />
<?php endif ?>
