// by Nikola Bjelobaba 0442/2019

/**
 * Ova funkcija dodeljuje ocenu objavi kojoj se dodeljen id,
 * ocenu daje korisnik cije je korisnikco ime prosledjeno
 * 
 * @param int objavaId
 * @param string korisnikIme
 * @param string siteUrl
 * @return void
 */

function oceni(objavaId, korisnikIme, siteUrl) {
    let ocena = document.getElementById("selOcena" + objavaId).value;
    
    
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            let selDiv = document.getElementById("oceniDiv" + objavaId);
            selDiv.setAttribute("hidden", "true");
            
            let showDiv = document.getElementById("prikazOcene" + objavaId);
            showDiv.removeAttribute("hidden");
            showDiv.innerHTML = "Vasa ocena: " + ocena;
            
            let response = xmlhttp.responseText;
            let responseList = response.split("<");
            let noviAvg = responseList[0];
            
            let poljeZvezdice = document.getElementById("ratingObjava" + objavaId);
            poljeZvezdice.innerHTML = "";
            
            
            let noviAvgCeoDeo = Math.floor(noviAvg);
            let noviAvgDecDeo = Math.round(noviAvg * 100) /100;
            let polaZvezdePrikazano = false;
            let novNode;
            
            for (let i = 1; i <= 5; i++) {
                if (noviAvgCeoDeo >= i) {
                    poljeZvezdice.innerHTML += '<span class="fa fa-star checked"></span>';
                } else if (!polaZvezdePrikazano) {
                    if (noviAvgDecDeo >= 0.5) {
                        poljeZvezdice.innerHTML += '<span class="fa fa-star checked"></span>';
                    } else {
                        poljeZvezdice.innerHTML += '<span class="fa fa-star-half-alt checked"></span>';
                    }
                    polaZvezdePrikazano = true;
                } else {
                       poljeZvezdice.innerHTML += '<span class="fas fa-star"></span>';
                }
            }
            
        }
    }
    
    xmlhttp.open("GET", siteUrl + "/" + objavaId + "/" + korisnikIme + "/" + ocena, true);
    xmlhttp.send();
}


