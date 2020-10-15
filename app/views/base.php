<?php 

if ( ! empty($html)) 
{
	$this->load->view('common/html');

}



?><main id="main" class="theme section-<?= $section ?>">
<? if($show_seo_settings && $admin): ?>
	
	<div class="settings-base">
		<? $this->load->view('components/liveadmin/settings', ['url'=>'contents/seo', 'text'=>'Encabezados SEO', 'id'=>'seo_'.$page]) ?>
	</div>
<? endif ?>
<? if($admin): ?>
	<a href="<?= base_url('logout') ?>" class="btn-logout-admin" style="position: fixed;
    z-index: 9999999;
    bottom: 0;
    right: 115px;
    background: #ff4600b5;
	color: white;
	text-decoration: none;
    padding: .3rem;">
		<i class="fa fa-sing-out"></i> Volver a web original
</a>
<? endif ?>


<?
if ( ! empty($header)) 
{
	$this->load->view('components/header/index');
}
?>
	<? $this->load->view($main_view) ?>
	<div class="arrow-up"><img src="<?= layout('img/arrow-up.png') ?>"></div>
	<div id="data" data-section="<?= $section ?>" data-page="<?= $page ?>"></div>
	<?php 
	if ( ! empty($footer)) 
	{
		$this->load->view('components/footer/index');
	}?>
</main>
<div id="loader"><div class="spin"><div class="before"></div></div></div>

<?
// echo '{"data":[';
// foreach ($this->Data->notranslate as $key => $value) {
// 	echo '{"original":"';
// 		echo $value ;
// 		echo '","replace":"';
// 		echo $value;
// 		echo '"},'. PHP_EOL;
// };
// echo ']}';


if ( ! empty($html))
{
	$this->load->view('common/html-close');
}
