$("#email").bind("keypress", function (e) {

	
    var keyCode = e.which ? e.which : e.keyCode
    if (!(keyCode==46) && !(keyCode >= 48 && keyCode <= 57) && !(keyCode >= 64 && keyCode <= 90) && !(keyCode >= 97 && keyCode <= 122)) {
        //console.log(keycode);
        return false;
    }

	
	
});