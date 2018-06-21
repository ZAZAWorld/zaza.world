var DOCUMENT_ROOT = 'http://' + document.location.hostname;
function isEmptyObject(obj) {
	for(var prop in obj) {
		if(obj.hasOwnProperty(prop))
			return false;
	}

	return true;
}

jQuery( document ).ready( function( $ ) {
    $("form").validate();
});

$.validator.addClassRules({
    'normalValidate': {
        required: true
    },
    'digitValidate': {
        digits:true,
        required: true
    },
    'digitValidateS':{
        required: true
    },
    'emailValidate': {
        email:true,
        required: true
    },
    'emailValidateS':{
        email:true,
    },
    'dateValidate': {
        required: true
    },
    'rePasswordValidate': {
        equalTo: "#password",
        required: true
    }
});



function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

//очистка формы
$("#resetFilter").click(function () {
	window.location.replace(getPathFromUrl(window.location.href));
});

function getPathFromUrl(url) {
  return url.split("?")[0];
}
