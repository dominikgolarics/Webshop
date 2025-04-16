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


    //Mennyiség gomb
    let db = $(".mennyiseg")
    let novel = $(".noveked")
    let csokkent = $(".csokkent")
    $(novel).on("click",function () {
        let db_szam = parseInt(db.text())
        db_szam++
        db.text(db_szam)
    })

    $(csokkent).on("click",function () {
        let db_szam = parseInt(db.text())
        db_szam--
        if (db_szam <= 1) {
            db.text("1")
            alert("1 darab termék a minimum!")
        }else{
            db.text(db_szam)
        }
    })



});

function showImage(img) {
    let previewDiv = document.getElementById("nagy-kep");
    previewDiv.innerHTML = `<img id='nagy-nezet' class="img-fluid" src="${img.src}">`;
}

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

// 1. betölt oldal -> minden cipo-t lekér és betölt
// 2. filter opció kiválasztása
// 3. cipok filter által lekérdez és betölt