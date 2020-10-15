<?php $uniqid = uniqid(); ?>
<div class="col-md-<?= $columns ?> col" id="mm_<?= $uniqid ?>">
    <label><?= $label ?> <!-- <a href=""><i class="fa fa-info-circle"></i></a> --></label>
    <div id="mm_tabs_<?= $uniqid ?>" class="ui-tabs">
		<ul>
			<?php foreach ($options as $i => $option): ?>
			<li><a href="#mm_tab_<?= $uniqid ?>_<?= $i ?>" data-value=""><?= $option['label'] ?></a></li>
			<?php endforeach; ?>
		</ul>
	    <?php foreach ($options as $i => $option):
	    	$option['item']['columns'] = isset($option['item']['columns']) ? $option['item']['columns'] : 12;
	    ?>
    	<div id="mm_tab_<?= $uniqid ?>_<?= $i ?>" data-index="<?= $i ?>">
    		<div class="row">
	    		<?php $select = $this->load->view($option['view'], array( 'item' => $option['item'] )); ?>
			    <div class="clearfix"></div>
				<?php if (isset($option['after'])): ?>
			    <div class="col col-12">
				    <?= $option['after'] ?>
			    </div>
			    <div class="clearfix"></div>
				<?php endif ?>
    		</div>
    	</div>
	    <?php endforeach ?>
	</div>

	<script>
	  (function() {
	    $(document).ready(function() {

			$( "#mm_tabs_<?= $uniqid ?>" ).tabs({
				collapsible: <?= isset($collapsible) ? $collapsible : 'false' ?>,
				<?
				foreach ($options as $i => $option) :
				if (isset( $option['item']['value'] ) && $option['item']['value'] ):
				 ?>
				active: <?= $i ?>,
				<?php endif; endforeach; ?>
				activate: function() {
				  $('select', $(this)).prop('selectedIndex',0).change();
				  $('input', $(this)).val('').change();
				  $('textarea', $(this)).val('').change();
				}
			});
	    });
	  }());
	</script>
</div>