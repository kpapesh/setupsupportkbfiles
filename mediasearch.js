//jquery to replace content on page
jQuery(function($) {
    if(window.location.href.indexOf("mch") > -1) {
	    $("#content").remove();
	    $("#sidebar").before($("#content2"));
    }			  
});
