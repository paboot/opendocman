$(document).ready(function() {
	var sBrowser, sUsrAg = navigator.userAgent;

	if(sUsrAg.indexOf("Chrome") > -1) {
		sBrowser = "Google Chrome";
	} else if (sUsrAg.indexOf("Safari") > -1) {
		sBrowser = "Apple Safari";
	} else if (sUsrAg.indexOf("Opera") > -1) {
		sBrowser = "Opera";
	} else if (sUsrAg.indexOf("Firefox") > -1) {
		sBrowser = "Mozilla Firefox";
		$('#login-form').addClass('mozilla_login');
		$('.container').addClass('mozilla_container');
	} else if (sUsrAg.indexOf("MSIE") > -1) {
		sBrowser = "Microsoft Internet Explorer";
	}
});