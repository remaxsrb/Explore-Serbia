$("document").ready(function() {
    
    let objave = $(".card");
    let filteri = [];
    
    function filtriraj(tagKategorija){
        if (!filteri.includes(tagKategorija))
            filteri.push(tagKategorija);
        else 
            filteri.splice(filteri.indexOf(tagKategorija), 1);
        
        if (filteri.length === 0){
            for (let i = 0; i < objave.length; i++){
               objave.eq(i).parent().show();
            }
        } else {
            for (let i = 0; i < objave.length; i++){
            let klase = objave[i].className.split(/\s+/);
            let sadrziTag = false;
                for (let j = 0; j < klase.length; j++){
                    for (let k = 0; k < filteri.length; k++){
                        if (klase[j] == filteri[k]){
                            sadrziTag = true;
                            break;
                        }
                    }
                    if (sadrziTag) break;
                }

                if (!sadrziTag){
                    objave.eq(i).parent().hide();
                } else {
                    objave.eq(i).parent().show();
                }

            }
        }
    }
    
    $("span.dropdown-item").click(function(){
        $(this).toggleClass("filterSelected");
        switch($(this).text()){
            case "Istorijska ličnost":
                filtriraj("istorijskaLicnost");
                break;
            case "Spomenik":
                filtriraj("spomenik");
                break;
            case "Crkva/manastir":
                filtriraj("crkvaManastir");
                break;
            case "Tvrdjava":
                filtriraj("tvrdjava");
                break;
            case "Arheološko nalazište":
                filtriraj("areoloskoNalaziste");
                break;
            case "Park prirode":
                filtriraj("parkPrirode");
                break;
        }
    });
});


