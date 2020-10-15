<?php
$lang = $this->config->item('lang', 'app');
$v = '161';
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= $lang ?>" lang="<?= $lang ?>">
<?php $this->load->view('common/metatags') ?>
<link rel="icon" href="/files/ico.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?= layout('favicon.png') ?>" type="image/x-icon" />
<meta name="theme-color" content="#1aa6b7">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,700">
<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="<?= layout('main.css?v1.'.$v) ?>">
<link rel="stylesheet" href="<?= layout() ?>vendor/animate.css">
<script src="<?= layout('vendor.js') ?>"></script>
<script src="<?= layout('main.js?v1.'.$v) ?>"></script>


<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/js/tether.min.js'></script>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/tether-drop/1.4.2/js/drop.min.js'></script>
<script type='text/javascript' src='<?= layout() ?>vendor/imagesloaded.min.js?ver=3.2.0'></script>
<script type='text/javascript' src='<?= layout() ?>vendor/wow.min.js?ver=1.0.0'></script>
<script type='text/javascript' src='<?= layout() ?>vendor/jquery.waypoints.min.js?ver=1.0.0'></script>

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif7]-->
<?php $this->load->view('common/analytics'); ?>
<style>
body {
    font-family: "Raleway",sans-serif !important;
}
.image-presentation {
    font-family: "Raleway",sans-serif !important;
}
</style>
<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/06db20708c0634f21dd9424bc/b85baa711a13ded3b7c0c45d6.js");</script>
</head>
<body id="app-body" class="app-body lang-<?= $lang ?>  <?= isset($this->data['header-white']) ? 'header-white' : '' ?>">
    <script>
        $(document).ready(function() {
            App.Init({url: '<?= base_url() ?>', url_lang: '<?= base_url().$lang.'/' ?>', layout: '<?= layout() ?>', routes: <?
$routes = array();
foreach ($this->routes as $key => $route)
{
    if(isset($route['pager']))
    {
        array_push($routes, $route['pager']);
    }
}
echo json_encode($routes); ?>});
            // $('title').html('<?= addslashes($this->config->item('client', 'app')) ?>');
        });
    </script>
