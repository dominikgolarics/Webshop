$(document).ready(function () {
	$.getJSON("cipok.json", function (data, textStatus, jqXHR) {
		var cipok = data;
		// console.log(cipok);

		function rendez_ar() {
			var rendez_cipok = cipok;
			rendez_cipok.sort(function (a, b) {
				return b.ar - a.ar; //Ár szereinti sorba rendezés (csökkenő)
			});
			for (let i = 0; i < rendez_cipok.length; i++) {
				console.log(rendez_cipok[i].ar);
			}
		}

		function rendez_datum() {
			const rend_cipok = cipok;

			rend_cipok.sort(function (a, b) {
				return new Date(b.datum) - new Date(a.datum);
			});
			for (let i = 0; i < rend_cipok.length; i++) {
				// console.log(JSON.stringify(rend_cipok[i].datum))
				const div = document.createElement("div");
				const img = document.createElement("img");
				const footer = document.createElement("footer");
				const div2 = document.createElement("div");

				//kép
				var srcindex = i + 1;
				img.src = rend_cipok[i].kep;
				$(img).addClass("cipo1");
				// console.log(i)

				//termék div
				$(div).addClass("col-lg-3 col-md-6 cipo");
				div.appendChild(img);

				div2.innerHTML = rend_cipok[i].nev;
				div2.appendChild(document.createElement("br"));
				div2.innerHTML += rend_cipok[i].datum;
				footer.appendChild(div2);

				div.appendChild(footer);

				//Végső hely
				const friss_div = document.getElementById("friss_term");

				friss_div.appendChild(div);
			}
		}

		//Meghívás
		rendez_ar();
		rendez_datum();
	});

    $("#profil").click(function (e) { 
        e.preventDefault();
        window.location.href="login.html"
        
    });
});
