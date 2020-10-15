<script>
$(document).ready(function() {
	$('.app-tabs').each(function(index, el) {
		if($(el).hasClass('rendered')) return;
		$(el).addClass('rendered');
		var itemsX = $('.app-tab.' + $(el).attr('data-tab'));
		$('span', el).click(function(event) {
			var id = $(this).attr('data-id');
			$('span', el).removeClass('active');
			$(this).addClass('active');
			itemsX.each(function(index, tt) {
				$(tt).css('display', (id == $(this).attr('data-id')) ? 'block' : 'none');
			});
		});
		var active = $('.app-tabs').attr('data-active');
		if(isNaN(active)) active = 0;
			$('span', el).eq(active).click();
	});
});
</script>