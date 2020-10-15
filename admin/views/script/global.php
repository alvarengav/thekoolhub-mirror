<?php /*
<script src="<?= layout() ?>js/plugin/pace/pace.min.js"></script>
<script>Pace.options = { ajax: { ignoreURLs: [/$manager\/chat\/.*\/] } };</script>
<script src="<?= layout() ?>js/libs/jquery-2.0.2.min.js"></script>
<script src="<?= layout() ?>js/libs/jquery-ui-1.10.3.min.js"></script>
<script src="<?= layout() ?>js/bootstrap/bootstrap.min.js"></script>
<script src="<?= layout() ?>js/notification/SmartNotification.js"></script>
<script src="<?= layout() ?>js/plugin/jquery-validate/jquery.validate.min.js"></script>
<script src="<?= layout() ?>js/plugin/masked-input/jquery.maskedinput.min.js"></script>
<script src="<?= layout() ?>js/plugin/select2/select2.min.js"></script>
<script src="<?= layout() ?>js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
<script src="<?= layout() ?>js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<script src="<?= layout() ?>js/plugin/fastclick/fastclick.js"></script>
<script src="<?= layout() ?>js/plugin/jarvismenu/jarvismenu.js"></script>
<script src="<?= layout() ?>js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
*/
$paceOptions = (object) [
  'ajax' 								=> ['trackMethods' => ['GET']],
  'ghostTime' 					=> 300,
  'eventLag' 						=> false,
  'restartOnPushState' 	=> true,
];

$vendor = 'vendor'.(ENVIRONMENT == 'development' ? '-dev' : '');
 ?>
<script>window.paceOptions = <?= json_encode($paceOptions) ?></script>
<script src="<?= layout() ?>assets/<?= $vendor ?>.js"></script>
