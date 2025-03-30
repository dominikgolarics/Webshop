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
            for (let i = 0; i < obj.length; i++) {
                //console.log("container elkezdve")
                
                //console.log("termek elkezdve")
                let img = document.createElement("img")
                let h3 = document.createElement("h3")
                let span = document.createElement("span")
                let h5 = document.createElement("h5")

                img.src="img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-2.jpg"
                h3.innerHTML=obj[i].marka
                span.innerHTML=obj[i].nev
                h5.innerHTML=obj[i].ar

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
                
                div_cipo_cont.id="cipo-container"
                div_cipo_cont.appendChild(div_cipo_termek)
                    
                //console.log("termek létrehozva és containerhez adva")
                
                //console.log("container listához adva")
                
                
            }
            term_lista.append(div_cipo_cont)
            console.log("Termékek betölte!")
          }
        };
        xhttp.open("GET", "testapi.php?"+params,false);
        xhttp.send();
    }
    loadDoc("all") 

    const keres_gomb = document.getElementById("keres-gomb")

    function TermekLekerFilter(arak=[], markak=[]) {
        let url = "testapi.php";
        let leker="";

        if (arak.length > 0 || markak.length > 0) {
            url += "?arak=" +JSON.stringify(arak) + "&markak=" + JSON.stringify(markak);
            leker = "arak=" +JSON.stringify(arak) + "&markak=" + JSON.stringify(markak);
        } else {
            url += "?all"; //Mindne ha semmit nincs kiválasztva és rányomott a Keres gombra
        }
        console.log("Lekérés GET: "+url)
        fetch(url)
            .then(response=> response.json())
            .then(adat=>{
                loadDoc(leker)
                console.log(adat)
            })
    }

    keres_gomb.addEventListener("click", function () {
        const checkedArak=[];
        if (document.getElementById("ar-checkbox1").checked) checkedArak.push("under_20000");
        if (document.getElementById("ar-checkbox2").checked) checkedArak.push("between_20000_40000");
        if (document.getElementById("ar-checkbox3").checked) checkedArak.push("between_40000_80000");
        if (document.getElementById("ar-checkbox4").checked) checkedArak.push("between_80000_100000");
        if (document.getElementById("ar-checkbox5").checked) checkedArak.push("between_100000_140000");
        if (document.getElementById("ar-checkbox6").checked) checkedArak.push("above_140000");

        const checkedMarkak = [];
        if (document.getElementById("marka-Nike").checked) checkedMarkak.push("Nike");
        if (document.getElementById("marka-Adidas").checked) checkedMarkak.push("Adidas");
        if (document.getElementById("marka-Puma").checked) checkedMarkak.push("Puma");
        if (document.getElementById("marka-Vans").checked) checkedMarkak.push("Vans");

        TermekLekerFilter(checkedArak,checkedMarkak)
      })

    
});



