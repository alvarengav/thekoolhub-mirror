$.fn.header = function() {
	
	// En caso de querer modificar el header cuando se hace scroll
	var h = $(this);
	var b = $('body');
	// var hh = h.outerHeight();
	var hh = 80;

	var scroll = $(this).scrollTop();
		
	
	$(window).scroll(function() {
		var scroll = $(this).scrollTop();
		var enter = 0;

		// En caso de querer modificar el header cuando se hace scroll

		if(scroll>=hh/4) {
			$('body').addClass('header-scroll');
		} else {
			$('body').removeClass('header-scroll');
		}
		$('.requiere-header-color').each(function(i,el) {
			var top = $(el).position().top;
			var bottom = $(el).position().top + $(el).height() - 5;
			
			if(scroll >= top && scroll <= bottom ) enter++;
		})
		
		if( enter ) {
			$('body').addClass('header-color');
			// $('body').attr('header-color', '1');
		} else {
			$('body').removeClass('header-color');
			// $('body').attr('header-color', '0');
		}
	});

	
		


  	$(window).scroll(function() {
		var scroll = $(this).scrollTop();
		
		// En caso de querer modificar el header cuando se hace scroll
		if(scroll>=hh/4) {
			b.addClass('header-scroll');
		} else {
			b.removeClass('header-scroll');
		}
	
	});


};

$('#header').header();