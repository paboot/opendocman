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
	
	$('.Level2 li a').on('click', function(){
		var url = document.URL;
		var min = url.lastIndexOf("/");
		var max = url.lastIndexOf(".php");
		var loc = url.substring(min+1,max);
		
		if (loc == "user") {
			var last_name = document.forms["add_user"]["last_name"].value;
			var first_name = document.forms["add_user"]["first_name"].value;
			var username = document.forms["add_user"]["username"].value;
			var phonenumber = document.forms["add_user"]["phonenumber"].value;
			var email = document.forms["add_user"]["Email"].value;
			
			var warning = last_name || first_name || username || phonenumber || email;
			window.onbeforeunload = function() { 
				if (warning) {
					return "There is a filled field in the form. Any unsaved change will be lost.";
				}
			}
		} else if (loc == "department") {
			var depname = document.forms["add_department"]["department"].value;
			
			var warning = depname;
			window.onbeforeunload = function() { 
				if (warning) {
					return "There is a filled field in the form. Any unsaved change will be lost.";
				}
			}
		} else if (loc == "category") {
			var catname = document.forms["add_category"]["category"].value;
			
			var warning = catname;
			window.onbeforeunload = function() { 
				if (warning) {
					return "There is a filled field in the form. Any unsaved change will be lost.";
				}
			}
		}
	});
});