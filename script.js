$(document).ready(function () {

	//Link átirányítások
    $("#profil").click(function (e) { 
        e.preventDefault();
        window.location.href="login.html"
    });
	
    $(".mozgo_logo").click(function (e) { 
        e.preventDefault();
        window.location.href="termekek.html"
    });
});
