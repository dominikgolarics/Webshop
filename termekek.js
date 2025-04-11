// 1. betölt oldal -> minden cipo-t lekér és betölt
// 2. filter opció kiválasztása
// 3. cipok filter által lekérdez és betölt


//let cipo_cont = document.getElementById("cipo-container");
//let cipo_term = document.getElementById("cipo-termek");
//let cipo_kep = document.getElementById("cipo-kep"); //img
//let cipo_leir = document.getElementById("cipo-leiras"); //h3(név),span(teljes név),h5(ár)

$(document).ready(function () {
    function loadDoc(params) {
        let term_lista = document.getElementById("termekek-lista");
        let div_cipo_cont=document.createElement("div");
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            let obj = JSON.parse(this.responseText)
            //console.log(obj);
            //console.log(obj.length)
            //console.log(obj[0].nev)
            //console.log(obj.length/4)
            console.log("Termékek betöltése...")
            
            div_cipo_cont.innerHTML="";
            for (let i = 0; i < obj.adat.length; i++) {
                //console.log("container elkezdve")
                
                //console.log("termek elkezdve")
                let img = document.createElement("img")
                let h3 = document.createElement("h3")
                let span = document.createElement("span")
                let h5 = document.createElement("h5")

                img.src="img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-2.jpg"
                h3.innerHTML=obj.adat[i].marka
                span.innerHTML=obj.adat[i].nev
                h5.innerHTML=obj.adat[i].ar

                let div_cipo_kep=document.createElement("div");
                div_cipo_kep.appendChild(img)
                div_cipo_kep.className="cipo-kep"

                let div_cipo_leiras=document.createElement("div");
                div_cipo_leiras.appendChild(h3)
                div_cipo_leiras.appendChild(span)
                div_cipo_leiras.appendChild(h5)
                div_cipo_leiras.className="cipo-leiras"

                let div_cipo_termek=document.createElement("div");
                div_cipo_termek.appendChild(div_cipo_kep)
                div_cipo_termek.appendChild(div_cipo_leiras)
                div_cipo_termek.className="cipo-termek"
                div_cipo_termek.id="cipoId-"+obj.adat[i].id
                
                div_cipo_cont.id="cipo-container"
                div_cipo_cont.appendChild(div_cipo_termek)
                    
                //console.log("termek létrehozva és containerhez adva")
                
                //console.log("container listához adva")
                
                
            }
            //term_lista.append(div_cipo_cont)
            term_lista.append(div_cipo_cont)
            console.log("Termékek betölte!")
          }
        };
        xhttp.open("GET", "testapi.php?"+params,false);
        xhttp.send();
    }
    loadDoc("all") 

    const keres_gomb = document.getElementById("keres-gomb")

    function TermekLekerFilter(szuresiFeltetelek) {
        $.ajax({
            type: "POST",
            url: "tests.php",
            contentType : 'application/json',
            async: false,
            data: JSON.stringify(szuresiFeltetelek),
            success: function(data) {
                console.log("Termekfilter success: ",data);
                let term_lista = document.getElementById("termekek-lista");
                let div_cipo_cont=document.createElement("div");
                term_lista.innerHTML="";
                div_cipo_cont.innerHTML="";
                for (let i = 0; i < data.adat.length; i++) {
                    //console.log("container elkezdve")
                    
                    //console.log("termek elkezdve")
                    let img = document.createElement("img")
                    let h3 = document.createElement("h3")
                    let span = document.createElement("span")
                    let h5 = document.createElement("h5")

                    img.src="img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-2.jpg"
                    h3.innerHTML=data.adat[i].marka
                    span.innerHTML=data.adat[i].nev
                    h5.innerHTML=data.adat[i].ar

                    let div_cipo_kep=document.createElement("div");
                    div_cipo_kep.appendChild(img)
                    div_cipo_kep.className="cipo-kep"

                    let div_cipo_leiras=document.createElement("div");
                    div_cipo_leiras.appendChild(h3)
                    div_cipo_leiras.appendChild(span)
                    div_cipo_leiras.appendChild(h5)
                    div_cipo_leiras.className="cipo-leiras"

                    let div_cipo_termek=document.createElement("div");
                    div_cipo_termek.appendChild(div_cipo_kep)
                    div_cipo_termek.appendChild(div_cipo_leiras)
                    div_cipo_termek.className="cipo-termek"
                    div_cipo_termek.id="cipoId-"+data.adat[i].id
                    
                    div_cipo_cont.id="cipo-container"
                    div_cipo_cont.appendChild(div_cipo_termek)
                        
                    //console.log("termek létrehozva és containerhez adva")
                    
                    //console.log("container listához adva")
                    
                    
                }
                //term_lista.append(div_cipo_cont)
                term_lista.append(div_cipo_cont)
                console.log("Termékek betölte!")

            },
            error: function(xhr, status, error) {
                console.error("Hiba történt: ", error);
                console.log("Full response text:", xhr.responseText);
            }
        });
    }

    keres_gomb.addEventListener("click", function() {
        let checked = [];

        $(".szures").each(function() {
            if (this.checked) {
                let hova = this.id.split("-")[0]
                test[hova].push(this.value)
                
                checked.push(this.value);
            }
        });
        console.log("TEST tomb kiírása:",test)
        console.log("keres gomb checked: ",checked);
        TermekLekerFilter(checked);
    });

    const test_gomb = document.getElementById("kuldTest")
    test_gomb.addEventListener("click",function(){
        let test={
            'ar':[],
            'meret':[],
            'rend':[],
            'marka':[]
        }
        $(".szures").each(function() {
            if (this.checked) {
                let hova = this.id.split("-")[0]
                test[hova].push(this.value)
            }
        });
        FilterTombTest(test)
        //console.log("TEST tomb kiírása:",test)
    }) 
        
    function FilterTombTest(szuresiFeltetelek) {
        $.ajax({
            type: "POST",
            url: "test2.php",
            // contentType : 'application/json',
            async: false,
            data: szuresiFeltetelek,
            success: function(data) {
                console.log(data)
                let term_lista = document.getElementById("termekek-lista");
                let div_cipo_cont=document.createElement("div");
                term_lista.innerHTML="";
                div_cipo_cont.innerHTML="";
                for (let i = 0; i < data.adat.length; i++) {
                    //console.log("container elkezdve")
                    
                    //console.log("termek elkezdve")
                    let img = document.createElement("img")
                    let h3 = document.createElement("h3")
                    let span = document.createElement("span")
                    let h5 = document.createElement("h5")

                    img.src="img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-2.jpg"
                    h3.innerHTML=data.adat[i].marka
                    span.innerHTML=data.adat[i].nev
                    h5.innerHTML=data.adat[i].ar

                    let div_cipo_kep=document.createElement("div");
                    div_cipo_kep.appendChild(img)
                    div_cipo_kep.className="cipo-kep"

                    let div_cipo_leiras=document.createElement("div");
                    div_cipo_leiras.appendChild(h3)
                    div_cipo_leiras.appendChild(span)
                    div_cipo_leiras.appendChild(h5)
                    div_cipo_leiras.className="cipo-leiras"

                    let div_cipo_termek=document.createElement("div");
                    div_cipo_termek.appendChild(div_cipo_kep)
                    div_cipo_termek.appendChild(div_cipo_leiras)
                    div_cipo_termek.className="cipo-termek"
                    div_cipo_termek.id="cipoId-"+data.adat[i].id
                    
                    div_cipo_cont.id="cipo-container"
                    div_cipo_cont.appendChild(div_cipo_termek)
                        
                    //console.log("termek létrehozva és containerhez adva")
                    
                    //console.log("container listához adva")
                    
                    
                }
                //term_lista.append(div_cipo_cont)
                term_lista.append(div_cipo_cont)
                console.log("Termékek betölte!")
            },
            error: function(xhr, status, error) {
                console.error("Hiba történt: ", error);
                console.log("Full response text:", xhr.responseText);
            }
        });
    }

    $(".cipo-termek").on('click',  function() {
        let cipo_id = this.id.split('-');
        window.location.href = 'termek.php?id=' + cipo_id[1];
    });
    
});

function TEST() {
    fetch("tests.php")
    .then(response => response.json())
    .then(adat => {
        console.log(adat);
    })
    .catch(error => {
        console.error('Hiba történt:', error);
    });
}

//TEST()


