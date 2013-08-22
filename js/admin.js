$(document).ready(function() {			
	// Left menu = terdiri dari 3 level
	$('.Level1 li').on('click', function(){				// Selector untuk level pertama
		var id = $(this).attr('id');
		var child = $('#Level-2-'+id);					// Mencari submenu
		
		if (child.is(':hidden'))
			child.slideDown(400);						// Memunculkan submenu
		else {
			child.slideUp(400);							// Menghilangkan submenu
		}
	});
	
	$('.Level3 li').on('click', function(){
		if ($(this).hasClass('selected_left_menu')) {	// Kondisi apakah menu sudah terpilih atau belum
			//$(this).removeClass('selected_left_menu');
		} else {
			$('#left_menu li').removeClass('selected_left_menu');
			$(this).addClass('selected_left_menu');
		}
	});
});