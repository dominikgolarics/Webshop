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
    }

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


    

    //Kosár
    $('#cart-icon-wrapper').on('click', function() {
		$('#cart-dropdown').fadeToggle();
	});

	$(document).on('click', function(e) {
		if (!$(e.target).closest('#cart-icon-wrapper, #cart-dropdown').length) {
			$('#cart-dropdown').fadeOut();
		}
	});

    $(document).on('click', '.remove-item', function () {
        const item = $(this).closest('li');
        const termekId = item.data('termek-id'); // <li data-termek-id="...">
    
        $.ajax({
            url: 'kosar_torol.php',
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
                console.log("Success: "+data)
                console.log(res)
            },
            error: function () {
                $('#kosar-feedback').text("Hiba történt!").css("color", "red");
                console.log("Error: "+data)
            }
        });
    });
 

    document.getElementById("mentes").addEventListener("click", function(){
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
            success: function(valasz){
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
});

function showImage(img) {
    let previewDiv = document.getElementById("nagy-kep");
    previewDiv.innerHTML = `<img id='nagy-nezet' class="img-fluid" src="${img.src}">`;
}



// 1. betölt oldal -> minden cipo-t lekér és betölt
// 2. filter opció kiválasztása
// 3. cipok filter által lekérdez és betölt