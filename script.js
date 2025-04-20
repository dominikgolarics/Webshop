$(document).ready(function () {
    
	//Link átirányítások
    var userId = document.getElementById('userId').value;
    const profilIcon = document.getElementById('profilicon');
    
    if(userId){
        const profilContainer = document.getElementById('profil-container');
        const dropdown = document.getElementById('dropdown');
        let timeoutId;

        profilContainer.addEventListener('mouseenter', () => {
            clearTimeout(timeoutId);
            dropdown.style.display = 'block';
        });

        profilContainer.addEventListener('mouseleave', () => {
            timeoutId = setTimeout(() => {
                dropdown.style.display = 'none';
            }, 300);
        });
      
    } else {
        profilIcon.addEventListener('click', () => {
            $("#login").fadeIn();
            document.body.style.overflowY = 'hidden';
        });

        $("#kosar-login").on('click', function() {
            console.log("xd")
            $("#login").fadeIn();
            document.body.style.overflowY = 'hidden';
        });

        $("#kosar-fizet-gomb").on('click', function() {
            console.log("xd")
            $("#login").fadeIn();
            document.body.style.overflowY = 'hidden';
        });
    }

    $("#gomb").click(function (e) {
        e.preventDefault();
    
        let hibas = false;
    
        $("#uname, #psw").removeClass("hibas");
        $("#uname_hiba, #psw_hiba").hide();
    
        const felhasznalo = $("#uname").val().trim();
        const jelszo = $("#psw").val().trim();
    
        if (felhasznalo === "") {
            $("#uname").addClass("hibas");
            $("#uname_hiba").show();
            hibas = true;
        }
    
        if (jelszo === "") {
            $("#psw").addClass("hibas");
            $("#psw_hiba").show();
            hibas = true;
        }
    
        if (!hibas) {
            $.ajax({
                url: "/ajax_login.php",
                method: "POST",
                data: {
                    felhasznalo: felhasznalo,
                    jelszo: jelszo
                },
                success: function (valasz) {
                    if (valasz === "ok") {
                        $("#hiba_uzenet").removeClass("megjelenik");
                        $("#login_form form").submit();
                    } else {
                        $("#uname, #psw").addClass("hibas");
                        $("#uname_hiba, #psw_hiba").show();
                        $("#hiba_uzenet").addClass("megjelenik");
                    }
                }
            });
        }
    });

    if (sikeresBelepes) {
        $("body").append(`
            <div id="popup-bejelentkezes" style="
                position: fixed;
                top: 70px;
                left: 50%;
                transform: translateX(-50%);
                background-color: rgba(76, 175, 80, 0.95);
                color: white;
                padding: 15px 30px;
                border-radius: 12px;
                box-shadow: 0 0 15px rgba(0,0,0,0.3);
                z-index: 10000;
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                display: none;
            ">
                ✅ Sikeres bejelentkezés!
            </div>
        `);
        
        $("#popup-bejelentkezes").fadeIn(300, function () {
            setTimeout(function () {
                $("#popup-bejelentkezes").fadeOut(600, function () {
                    $(this).remove();
                });
            }, 2500);
        });
    }
            
    
    if(sikeresKijelentkezes){
        $("body").append(`
            <div id="popup-kijelentkezes" style="
                position: fixed;
                top: 70px;
                left: 50%;
                transform: translateX(-50%);
                background-color:rgba(244, 67, 54, 0.9);
                color: white;
                padding: 15px 30px;
                border-radius: 12px;
                box-shadow: 0 0 15px rgba(0,0,0,0.3);
                z-index: 10000;
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                display: none;
            ">
                👋 Sikeres kijelentkezés!
            </div>
        `);       
        $("#popup-kijelentkezes").fadeIn(300, function () {
            setTimeout(function () {
                $("#popup-kijelentkezes").fadeOut(600, function () {
                    $(this).remove();
                });
            }, 2500);
        });
    }

    
    $("#close").click(function (e) { 
        e.preventDefault();
        $("#login").fadeOut();
        document.body.style.overflowY = 'visible';
    });
	
    $(".mozgo_logo").click(function (e) { 
        e.preventDefault();
        window.location.href="/termekek";
    });

    $("#asd-asd").click(function (e) { 
        e.preventDefault();
        $(this).toggle(function () {
            
        });
    });


    $(document).on("click",".cipo-termek" ,function() {
        let productId = this.id.split('-')[1];
        window.location.href = 'termek/'+ productId;

    });

    let cartDropdownVisible = false;
    $('#cart-icon-wrapper').on('click', function (e) {
        e.stopPropagation();
        if (!cartDropdownVisible) {
            $('#cart-dropdown').fadeIn(200);
            cartDropdownVisible = true;
        } else {
            $('#cart-dropdown').fadeOut(200);
            cartDropdownVisible = false;
        }
    });

    $('#cart-dropdown').on('click', function (e) {
        e.stopPropagation();
    });

    $(document).on('click', function () {
        if (cartDropdownVisible) {
            $('#cart-dropdown').fadeOut(200);
            cartDropdownVisible = false;
        }
    });

    $('.remove-item').on('click', function () {
        const item = $(this).closest('li');
        const termekId = item.data('termek-id'); // <li data-termek-id="...">
        $.ajax({
            url: '/kosar_torol.php',
            type: 'POST',
            data: {
                termek_id: termekId
            },
            success: function (res) {
                const json = JSON.parse(res);
                if (json.status === "ok") {
                    item.fadeOut(200, function () {
                        $(this).remove();
                        const count = $('.cart-items li').length;
                        $('#cart-count').text(count);
                    });
                } else {
                    alert("Hiba történt a törlés során.");
                }
            },
            error: function () {
                alert("AJAX hiba történt.");
            }
        });
    });

    $('.btn-remove').on('click', function () {
        const item = $(this).closest('.cart-item');
        console.log(item)
        const termekId = item.data('termek-kosar-id');
        console.log(termekId)
        $.ajax({
            url: '/kosar_torol.php',
            type: 'POST',
            data: {
                termek_id: termekId
            },
            success: function (res) {
                const json = JSON.parse(res);
                if (json.status === "ok") {
                    item.fadeOut(200, function () {
                        $(this).remove();
                    });
                    window.location.href = "/kosar";
                } else {
                    alert("Hiba történt a törlés során.");
                }
            },
            error: function () {
                alert("AJAX hiba történt.");
            }
        });
    });

    //Kosárba gomb
    let quantity = 1;

    $('.noveked').click(function () {
        quantity++;
        $('.mennyiseg').text(quantity);
        $('#mennyiseg').val(quantity);
    });

    $('.csokkent').click(function () {
        if (quantity > 1) {
            quantity--;
            $('.mennyiseg').text(quantity);
            $('#mennyiseg').val(quantity);
        }
    });

    $('#kosar-gomb').click(function (e) {
        e.preventDefault();

        if(userId){
            const termekId = $('#termek-id').val();
            const mennyiseg = $('#mennyiseg').val();
            console.log("Termek id: "+termekId+" Mennyiseg: "+mennyiseg)
            $.ajax({
                url: '/kosarba_tesz.php',
                method: 'POST',
                data: {
                    termek_id: termekId,
                    mennyiseg: mennyiseg
                },
                success: function (res) {
                    $("#kosar-feedback").fadeIn(200, function () {
                        setTimeout(function () {
                            $("#kosar-feedback").fadeOut(500, function () {
                                // ✅ Csak ezután frissítsen
                                window.location.reload();
                            });
                        }, 500);
                    });
                },
                error: function () {
                    $('#kosar-feedback').text("Hiba történt!").css("color", "red");
                    console.log("Error: "+data)
                }
            });
        }else{
            alert("Kérlek jelentkezz be!")
        }
    });
 
    // Adatok mentése
    $(document).on('click', '#mentes', function(){
        const nev = document.getElementById('nev').value;
        const irszam = document.getElementById('irszam').value;
        const cim = document.getElementById('cim').value;
        const varos = document.getElementById('varos').value;
        const email = document.getElementById('email').value;
        const telszam = document.getElementById('telefon').value;
        $.ajax({
            type: "POST",
            url: "/mentes.php",
            data:{
                nev:nev,
                iranyitoszam:irszam,
                cim:cim,
                varos:varos,
                email:email,
                telefonszam:telszam
            },
            success: function(){
                $("body").append(`
                    <div id="popup-mentes" style="
                        position: fixed;
                        top: 70px;
                        left: 50%;
                        transform: translateX(-50%);
                        background-color: rgba(76, 175, 80, 0.95);
                        color: white;
                        padding: 15px 30px;
                        border-radius: 12px;
                        box-shadow: 0 0 15px rgba(0,0,0,0.3);
                        z-index: 10000;
                        font-size: 20px;
                        font-weight: bold;
                        text-align: center;
                        display: none;
                    ">
                        ✅ Adatok mentve!
                    </div>
                `);
                
                $("#popup-mentes").fadeIn(300, function () {
                    setTimeout(function () {
                        $("#popup-mentes").fadeOut(600, function () {
                            $(this).remove();
                        });
                    }, 2500);
                });
            }
        })
    });

    $("#popup-reg").fadeIn(300, function () {
        setTimeout(function () {
            $("#popup-reg").fadeOut(600, function () {
                $(this).remove();
            });
        }, 2500);
    });

    //Új jelszó mentése
    $(document).on('click', '#ujjelszomentes', function(){
        const regijelszo = $('#regijelszo').val();
        const ujjelszo = $('#ujjelszo').val();
        const ujjelszoujra = $('#ujjelszoujra').val();
    
        $.ajax({
            type: "POST",
            url: "/ujjelszomentes.php",
            data: {
                regijelszo: regijelszo,
                ujjelszo: ujjelszo,
                ujjelszoujra: ujjelszoujra,
            },
            dataType: "json",
            success: function(valasz) {
                console.log(valasz);
                const szin = valasz.success ? 'rgba(76, 175, 80, 0.9)' : 'rgba(244, 67, 54, 0.9)';
                $("body").append(`
                    <div id="popup-jelszovalasz" style="
                        position: fixed;
                        top: 70px;
                        left: 50%;
                        transform: translateX(-50%);
                        background-color:${szin};
                        color: white;
                        padding: 15px 30px;
                        border-radius: 12px;
                        box-shadow: 0 0 15px rgba(0,0,0,0.3);
                        z-index: 10000;
                        font-size: 20px;
                        font-weight: bold;
                        text-align: center;
                        display: none;
                    ">
                    ${valasz.message}
                    </div>
                `);
                $("#popup-jelszovalasz").fadeIn(300, function () {
                    setTimeout(function () {
                        $("#popup-jelszovalasz").fadeOut(600, function () {
                            $(this).remove();
                            if (valasz.success) {
                                window.location.href = "/logout.php";
                            }
                        });
                    }, 2000);
                });
            }
        });
    });


    //Fizetés
    // Cím választó script
    document.querySelectorAll('.address-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.address-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            this.classList.add('selected');
            document.getElementById('other-address-fields').style.display = 
                this.id === 'other-address' ? 'block' : 'none';
        });
    });
    
    // Fizetési mód választó script
    document.querySelectorAll('.payment-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.payment-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            this.classList.add('selected');
        });
    });

    $('#fizetes').click(function (e) {
        e.preventDefault();

        const termekId = $('#termek-id').val();
        const mennyiseg = $('#mennyiseg').val();
        console.log("Termek id: "+termekId+" Mennyiseg: "+mennyiseg)
        $.ajax({
            url: '/kosarba_tesz.php',
            method: 'POST',
            data: {
                termek_id: termekId,
                mennyiseg: mennyiseg
            },
            success: function (res) {
                $('#kosar-feedback').text("Sikeresen hozzáadva a kosárhoz!").css("color", "green");
                // opcionálisan frissíthetsz egy kosár ikont is pl.
                //console.log("Success: "+data)
                console.log(res)
            },
            error: function () {
                $('#kosar-feedback').text("Hiba történt!").css("color", "red");
                console.log("Error: "+data)
            }
        });
    });

    $('#megrendeles').click(function () {
        const nev = $('#fizetes-name').val();
        const email = $('#fizetes-email').val();
        const telefonszam = $('#fizetes-phone').val();
        const cim = $('#fizetes-cim').val();
        const varos = $('#fizetes-varos').val();
        const iranyitoszam = $('#fizetes-iranyitoszam').val();
        const fizetes_tipus = $(".payment-option.selected input").attr('id');
        $.ajax({
            url: '/megrendeles_mentese.php',
            method: 'POST',
            data: {
                rendeles_nev: nev,
                rendeles_email: email,
                rendeles_telefonszam: telefonszam,
                rendeles_cim: cim,
                rendeles_varos: varos,
                rendeles_iranyitoszam: iranyitoszam,
                fizetes_tipus: fizetes_tipus
            },
            success: function (valasz) {
                console.log(valasz);
                window.location.href = "/megrendeles";
            },
            error: function () {
                console.log("hiba")
            }
        });
    });

    setTimeout(function () {
        $('#reg-success').fadeOut(500);
    }, 3000);
});

function showImage(img) {
    let previewDiv = document.getElementById("nagy-kep");
    previewDiv.innerHTML = `<img id='nagy-nezet' class="img-fluid" src="${img.src}">`;
}

$("#torlesGomb").click(function(e) {
    e.preventDefault();
    $("#torles-popup").fadeIn();
});

$("#megsemGomb").click(function() {
    $("#torles-popup").fadeOut();
});

$("#igenGomb").click(function() {
    window.location.href = "/profiltorlese.php";
});

// 1. betölt oldal -> minden cipo-t lekér és betölt
// 2. filter opció kiválasztása
// 3. cipok filter által lekérdez és betölt