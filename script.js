$(document).ready(function () {
    
	//Link átirányítások
    
        $("#profilicon").click(function (e) { 
            var userId = document.getElementById('userId').value;
            if(!userId){
                e.preventDefault();
                $("#login").fadeIn();
                document.body.style.overflowY = 'hidden';
            }
            else{
                window.location.href = '/profil/beallitasok';
            }
        });
   
   
    
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

    //RewriteRule ^product/([0-9]+)/?$ product_page.php?id=$1 [L,QSA]
    
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


// 1. betölt oldal -> minden cipo-t lekér és betölt
// 2. filter opció kiválasztása
// 3. cipok filter által lekérdez és betölt