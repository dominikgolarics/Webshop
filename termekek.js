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
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            let obj = JSON.parse(this.responseText)
            console.log(obj);
            console.log(obj.data.length)
            console.log(obj.data[0].nev)
            console.log(obj.data.length/4)
            
            for (let i = 0; i < obj.data.length/4; i++) {
                console.log("container elkezdve")
                let div_cipo_cont=document.createElement("div");
                for (let j = 0; j < 4; j++) {
                    console.log("termek elkezdve")
                    let img = document.createElement("img")
                    let h3 = document.createElement("h3")
                    let span = document.createElement("span")
                    let h5 = document.createElement("h5")
    
                    img.src="img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-2.jpg"
                    h3.innerHTML=obj.data[j].marka
                    span.innerHTML=obj.data[j].nev
                    h5.innerHTML=obj.data[j].ar
    
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
    
                    
                    console.log("termek létrehozva és containerhez adva")
                }
                console.log("container listához adva")
                term_lista.appendChild(div_cipo_cont)
                
            }
    
          }
        };
        xhttp.open("GET", "testapi.php?"+params,false);
        xhttp.send();
    }
    loadDoc("all")
});