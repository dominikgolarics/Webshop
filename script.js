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

$(document).ready(function () {

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

    //Alapa elrejt
    $("#kiem-div").hide();
    $("#alacsony-div").hide();
    $("#magas-div").hide();
    //


    $("#sorrend-span").click(function (e) { 
        e.preventDefault();
        $("#kiem-div").slideToggle(function () {
        });
        $("#alacsony-div").slideToggle(function () {
        });
        $("#magas-div").slideToggle(function () {
        });
    });



    function markaFilterOpciok(){
        var rend_div=document.getElementById("rendezes-markak")
    
        for (let i = 0; i < tesztAdat.length; i++) {
            
            var div = document.createElement("div")
            var input = document.createElement("input")
            var label = document.createElement("label")
            
            
    
            //Annyit generál amennyi egyedi márka van az adatbázisba
    
            input.id="marka"+i+"-checkbox" //betöltött index
            input.type="checkbox"
            input.name="filter-marka-checkbox"
            input.value=tesztAdat[i].marka //betöltött adatokból
    
            label.setAttribute("for","marka"+i+"-checkbox")
            label.innerHTML=tesztAdat[i].marka //adatbázisból
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
    markaFilterOpciok()

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
    meretFilterOpciok()


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
    
    function termekekDarab() { 
        let selectedValue
    
        let selectElement = document.getElementById("mennyiseg");
        selectedValue = selectElement.value;
        const termekek_lista_div = document.getElementById("termekek-lista")
        termekek_lista_div.innerHTML="";
        for (let i = 0; i < (selectedValue/4); i++) {
            
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
    
    //Meghívás
    termekekDarab()
    arCheckboxEllenorzes()
    //Meghívás
    
    
    //TESZT ZÓNA 
    console.log(tesztAdat)
    var xd = document.getElementById("ar-checkbox1");
    console.log(xd.checked)
    
    
    
    function teszt(){
        alert("teszt")
        let selectedValue
    
        let selectElement = document.getElementById("mennyiseg");
        selectedValue = selectElement.value;
        const termekek_lista_div = document.getElementById("termekek-lista")
        termekek_lista_div.innerHTML="";
        for (let i = 0; i < (selectedValue/4); i++) {
            
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
    
});

