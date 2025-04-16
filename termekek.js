// 1. betölt oldal -> minden cipo-t lekér és betölt
// 2. filter opció kiválasztása
// 3. cipok filter által lekérdez és betölt
$(document).ready(function () {
    const filter_gomb = document.getElementById("kuldTest")
    filter_gomb.addEventListener("click",function(){
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

                    img.src=data.adat[i].elso_kep
                    h3.innerHTML=data.adat[i].marka
                    h3.className="leiras-h3";
                    span.innerHTML=data.adat[i].nev
                    span.className="leiras-span"
                    h5.innerHTML=data.adat[i].ar+" FT"
                    h5.className="leiras-h5"

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
    //Alap mindent meghív
    FilterTombTest("")

    
});


