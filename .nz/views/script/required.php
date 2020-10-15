<? if(AJAX): ?>
<script>
App.requiredScript([<?
  $first = true; 
  foreach($scripts as $s):
    echo ($first ? "" : ", ") . "'{$s}'";
    $first = false; 
  endforeach ?>]);
</script>
<? else: ?>
<? foreach($scripts as $s):?>
<script class="js-no-garbage" src="<?= $s ?>"></script>
<? endforeach ?>
<? endif ?>
