$(document).ready(function () {

    let adat=[];

    $('#php').click(function () { 
        //alert("php gomb")
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            //adat = this.responseText;
            adat = JSON.parse(this.responseText);
            console.log(adat);
            markaFilterOpciok();
            meretFilterOpciok();
            arCheckboxEllenorzes();
            }
        };
        xhttp.open("GET", "nile_api.php", true);
        xhttp.send();
    });


    const tesztAdat=[
        {
            marka:"Nike",
            ar:35000,
            meret:34
        },
        {
            marka:"Adidas",
            ar:35000,
            meret:35
        },
        {
            marka:"Puma",
            ar:35000,
            meret:36
        },
        {
            marka:"Converse",
            ar:35000,
            meret:38
        },
        {
            marka:"NewBalance",
            ar:35000,
            meret:39
        },
        {
            marka:"Vans",
            ar:35000,
            meret:40
        },
    ]

	//Link átirányítások
    $("#profil").click(function (e) { 
        e.preventDefault();
        window.location.href="login.php"
    });
	
    $(".mozgo_logo").click(function (e) { 
        e.preventDefault();
        window.location.href="termekek.php"
    });

    $("#asd-asd").click(function (e) { 
        e.preventDefault();
        $(this).toggle(function () {
            
        });
    });

    //* VLASZEG ÁT KELL ÍRNI, lehet hogy haszontalan
    function markaFilterOpciok(){
        var rend_div=document.getElementById("rendezes-markak")
    
        for (let i = 0; i < adat.length; i++) {
            
            var div = document.createElement("div")
            var input = document.createElement("input")
            var label = document.createElement("label")
            
            
    
            //Annyit generál amennyi egyedi márka van az adatbázisba
    
            input.id="marka"+i+"-checkbox" //betöltött index
            input.type="checkbox"
            input.name="filter-marka-checkbox"
            input.value=adat[i].marka_id//betöltött adatokból
    
            label.setAttribute("for","marka"+i+"-checkbox")
            label.innerHTML=adat[i].marka_id//adatbázisból
            label.setAttribute("class","marka-label")
    
            div.appendChild(input)
            div.appendChild(label)
            div.id="marka"+i
            
    
            rend_div.appendChild(div)
            $("#marka"+i).hide();
            $("#marka-span").click(function () { 
                $("#marka"+i).slideToggle(function () {
                });
            });
            
        }
    
    }

    function meretFilterOpciok(){
        var szam=1
        var szam2=1
        var meret_div=document.getElementById("rendezes-meret")
        for (let i = 0; i < (tesztAdat.length/3); i++) {
    
            var div = document.createElement("div")
    
            for (let j = i * 3; j < (i + 1) * 3; j++) {
                var input = document.createElement("input")
    
                var label = document.createElement("label")

                input.type="checkbox"
                input.name=tesztAdat[j].meret
                input.id="meret"+szam

                label.setAttribute("for","meret"+szam)
                label.innerHTML=tesztAdat[j].meret
                label.setAttribute("class","meret-label")

                szam++

                div.appendChild(input)
                div.appendChild(label)
                
            }
            div.id="meret"+szam2+"-checkbox"
            
            meret_div.appendChild(div)

            //TODO Valamiért nem működik?
            // $("#meret"+szam2+"-checkbox").hide();
            // $("#meret-span").click(function () { 
            //     $("#meret"+szam2+"-checkbox").slideToggle(function () {
            //     });
            // });
            szam2++
    
        }
    
    }

    // function termekekDarab() { 
    //     let selectedValue
    
    //     let selectElement = document.getElementById("mennyiseg");
    //     selectedValue = selectElement.value;
    //     const termekek_lista_div = document.getElementById("termekek-lista")
    //     termekek_lista_div.innerHTML="";
    //     for (let i = 0; i < (selectedValue/4); i++) {
            
    //         const div_cipo_container=document.createElement("div")
    
    //         for (let j = i * 4; j < (i + 1) * 4; j++) {
    //             const div_cipo_termek=document.createElement("div")
    //             const div_cipo_kep=document.createElement("div")
    //             const img=document.createElement("img")
    
    //             let src ="img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-2.jpg" 
    
    //             const div_cipo_leiras=document.createElement("div")
    //             const h3=document.createElement("h3")
    //             const span=document.createElement("span")
    //             const h5=document.createElement("h5")
    
    //             img.src=src //ideiglenes, majd adatbázisból
    //             div_cipo_kep.setAttribute("class","cipo-kep") //* stílus
    //             div_cipo_kep.appendChild(img)
                
    //             h3.innerHTML="Cipő márkája"+j //adatbázisból
    //             span.innerHTML="Teljes termék név" //adatbázisból
    //             h5.innerHTML="696969" //adatbázisból
    //             div_cipo_leiras.setAttribute("class","cipo-leiras") //* stílus
    //             div_cipo_leiras.appendChild(h3)
    //             div_cipo_leiras.appendChild(span)
    //             div_cipo_leiras.appendChild(h5)
    
    //             div_cipo_termek.setAttribute("class","cipo-termek") //* stílus
    //             div_cipo_termek.appendChild(div_cipo_kep)
    //             div_cipo_termek.appendChild(div_cipo_leiras)
    
    //             div_cipo_container.id="cipo-container"  //* stílus
    //             div_cipo_container.appendChild(div_cipo_termek)
    //         }
            
    //         termekek_lista_div.append(div_cipo_container)
    //     }
    // }

    function arCheckboxEllenorzes() { 
        const ar_checkbox1 = document.getElementById("ar-checkbox1");
        const ar_checkbox2 = document.getElementById("ar-checkbox2");
        const ar_checkbox3 = document.getElementById("ar-checkbox3");
        const ar_checkbox4 = document.getElementById("ar-checkbox4");
        const ar_checkbox5 = document.getElementById("ar-checkbox5");
        const ar_checkbox6 = document.getElementById("ar-checkbox6");
    
        ar_checkbox1.addEventListener("change", function() {
            if (ar_checkbox1.checked) {
                console.log("Checkbox1 is checked");
                //Aminek történnie kell be X-elés után vagy GLOBÁLIS változó megváltoztatása
            } else {
                console.log("Checkbox1 is not checked");
            }
        });
    
        ar_checkbox2.addEventListener("change", function() {
            if (ar_checkbox2.checked) {
                
                console.log("Checkbox2 is checked");
                //Aminek történnie kell be X-elés után vagy GLOBÁLIS változó megváltoztatása
            } else {
                console.log("Checkbox2 is not checked");
            }
        });
    
        ar_checkbox3.addEventListener("change", function() {
            if (ar_checkbox3.checked) {
                console.log("Checkbox3 is checked");
                //Aminek történnie kell be X-elés után vagy GLOBÁLIS változó megváltoztatása
            } else {
                console.log("Checkbox3 is not checked");
            }
        });
    
        ar_checkbox4.addEventListener("change", function() {
            if (ar_checkbox4.checked) {
                console.log("Checkbox4 is checked");
                //Aminek történnie kell be X-elés után vagy GLOBÁLIS változó megváltoztatása
            } else {
                console.log("Checkbox4 is not checked");
            }
        });
    
        ar_checkbox5.addEventListener("change", function() {
            if (ar_checkbox5.checked) {
                console.log("Checkbox5 is checked");
                //Aminek történnie kell be X-elés után vagy GLOBÁLIS változó megváltoztatása
            } else {
                console.log("Checkbox5 is not checked");
            }
        });
    
        ar_checkbox6.addEventListener("change", function() {
            if (ar_checkbox6.checked) {
                console.log("Checkbox6 is checked");
                //Aminek történnie kell be X-elés után vagy GLOBÁLIS változó megváltoztatása
            } else {
                console.log("Checkbox6 is not checked");
            }
        });
    }
        
    //Meghívás
    markaFilterOpciok();
    meretFilterOpciok();
    arCheckboxEllenorzes();
    //termekekDarab();
    //* VLASZEG ÁT KELL ÍRNI, lehet hogy haszontalan 
    

    //TESZT ZÓNA 
    console.log(tesztAdat);
    var xd = document.getElementById("ar-checkbox1");
    console.log(xd.checked);
    
    
    //BETÖLT 40 CIPŐT
    window.teszt = function(){
        //alert("teszt")
        // let selectedValue=""
    
        // let selectElement = document.getElementById("mennyiseg");
        // selectedValue = selectElement.value;
        const termekek_lista_div = document.getElementById("termekek-lista")
        termekek_lista_div.innerHTML="";
        for (let i = 0; i < (10/4); i++) {
            
            const div_cipo_container=document.createElement("div")
    
            for (let j = i * 4; j < (i + 1) * 4; j++) {
                const div_cipo_termek=document.createElement("div")
                const div_cipo_kep=document.createElement("div")
                const img=document.createElement("img")
    
                // ? ideiglenes
                let src ="img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-2.jpg" 
    
                const div_cipo_leiras=document.createElement("div")
                const h3=document.createElement("h3")
                const span=document.createElement("span")
                const h5=document.createElement("h5")
    
                img.src=src //ideiglenes, majd adatbázisból
                div_cipo_kep.setAttribute("class","cipo-kep") //* stílus
                div_cipo_kep.appendChild(img)
                
                h3.innerHTML="Cipő márkája"+j //adatbázisból
                span.innerHTML="Teljes termék név" //adatbázisból
                h5.innerHTML="696969" //adatbázisból
                div_cipo_leiras.setAttribute("class","cipo-leiras") //* stílus
                div_cipo_leiras.appendChild(h3)
                div_cipo_leiras.appendChild(span)
                div_cipo_leiras.appendChild(h5)
    
                div_cipo_termek.setAttribute("class","cipo-termek") //* stílus
                div_cipo_termek.appendChild(div_cipo_kep)
                div_cipo_termek.appendChild(div_cipo_leiras)
    
                div_cipo_container.id="cipo-container"  //* stílus
                div_cipo_container.appendChild(div_cipo_termek)
            }
            
            termekek_lista_div.append(div_cipo_container)
        }
        
    }

    

    // $.ajax({
    //     type: "POST",
    //     url: "termekek.php",  // Adjust the path if necessary
    //     contentType: "application/json",  // Tell server we're sending JSON
    //     data: JSON.stringify({
    //         nev: "Sample Product",
    //         marka_id: 1,
    //         ar: 1000,
    //         megjelenes: "2025-03-01",
    //         raktaron: 10,
    //         meret_id: 2,
    //         kep: "image.jpg",
    //         tipus_id: 3
    //     }),
    //     success: function (data) {
    //         console.log("Success:", data);
    //     },
    //     error: function (xhr, status, error) {
    //         console.error("Error:", xhr.responseText);
    //     }
    // });
    
    window.ures = function(){
        alert("PLS WORK");
        var lol = document.getElementById("termekek-lista");
        lol.innerHTML="";
    }

    //TERMEK
;
});

function showImage(img) {
    let previewDiv = document.getElementById("nagy-kep");
    previewDiv.innerHTML = `<img id='nagy-nezet' class="img-fluid" src="${img.src}">`;
}


// 1. betölt oldal -> minden cipo-t lekér és betölt
// 2. filter opció kiválasztása
// 3. cipok filter által lekérdez és betölt