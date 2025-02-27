$(document).ready(function () {

	//Link átirányítások
    $("#profil").click(function (e) { 
        e.preventDefault();
        window.location.href="login.php"
    });
	
    $(".mozgo_logo").click(function (e) { 
        e.preventDefault();
        window.location.href="termekek.html"
    });
});
