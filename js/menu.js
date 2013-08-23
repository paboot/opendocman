$(document).ready(function() {
	// Change active menu
	var url = document.URL;
	var min = url.lastIndexOf("/");
	var max = url.lastIndexOf(".php");
	var loc = url.substring(min+1,max);
	
	if (loc == "out") {
		$(".navbar .nav li:first-child").addClass("active");
	} else if (loc == "in") {
		$(".navbar .nav li:nth-child(2)").addClass("active");
	} else if (loc == "search") {
		$(".navbar .nav li:nth-child(3)").addClass("active");
	} else if (loc == "add") {
		$(".navbar .nav li:nth-child(4)").addClass("active");
	} else {
		$(".navbar .nav li:nth-child(5)").addClass("active");
	}
	
});