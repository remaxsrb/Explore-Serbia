// by Nikola Bjelobaba 0442/2019

// Poziv funkcije koja namesta glavni tag
setTag(-1,1);


/**
 * Ova funkcija dodaje jos jedno polje za unos taga pri kreiranju objave
 * 
 * @return void
 */

function addTag() {
            //brTaga pocinje od 0
            let brTaga = document.getElementById("numOftags").getAttribute("value");
            document.getElementById("numOftags").setAttribute("value", parseInt(brTaga)+1);
        
            let tagDiv = document.getElementById("secTagSpace");
            
            let tagSpace = document.createElement("div");
            tagSpace.setAttribute("Class", "seconadry-tag");
            tagSpace.setAttribute("id", "secTagDiv" + brTaga);
            tagDiv.appendChild(tagSpace);
            
            // Kreiranje liste tipova tagova
            let selTagType = document.createElement("Select");
            selTagType.setAttribute("Class", "tag-type-dropdown-bar");
            selTagType.setAttribute("id", "secTagType" + brTaga);
            selTagType.setAttribute("name", "secTagType" + brTaga);
            selTagType.setAttribute("onchange", "updateTags(" + brTaga + ")");
            selTagType.setAttribute("form", "mainForm");
            tagSpace.appendChild(selTagType);
          
            let tagType = document.createElement("option");
            tagType.innerHTML = "Istorijska ličnost";
            selTagType.appendChild(tagType);
            
            tagType = document.createElement("option");
            tagType.innerHTML = "Spomenik";
            selTagType.appendChild(tagType);
            
            tagType = document.createElement("option");
            tagType.innerHTML = "Crkva/manastir";
            selTagType.appendChild(tagType);
            
            tagType = document.createElement("option");
            tagType.innerHTML = "Tvrdjava";
            selTagType.appendChild(tagType);
            
            tagType = document.createElement("option");
            tagType.innerHTML = "Arheološko nalazište";
            selTagType.appendChild(tagType);
            
            tagType = document.createElement("option");
            tagType.innerHTML = "Park prirode";
            selTagType.appendChild(tagType);
          
          // Kreiranje liste tagova 
          
            let selTag = document.createElement("Select");
            selTag.setAttribute("Class", "tag-dropdown-bar");
            selTag.setAttribute("id", "secTag" + brTaga);
            selTag.setAttribute("name", "secTag" + brTaga);
            selTag.setAttribute("onchange", "updateNewTagSpace(" + brTaga + ")");
            selTag.setAttribute("form", "mainForm");
            tagSpace.appendChild(selTag);
            
            setTag(brTaga,1);
            
            // Kreiranje polja za unos novog taga
            let novTagText = document.createElement("input");
            novTagText.setAttribute("type", "text");
            novTagText.setAttribute("placeholder", "novi tag");
            novTagText.setAttribute("id", "secNovTag" + brTaga);
            novTagText.setAttribute("name", "secNovTag" + brTaga);
            novTagText.setAttribute("form", "mainForm");
            novTagText.setAttribute("hidden", true);
            tagSpace.appendChild(novTagText);
            
            
            //Kreiranje dugmeta za brisanje sekundarnog taga
            let dugmeBris = document.createElement("Button");
            dugmeBris.setAttribute("class", "btn button-remove-tag");
            dugmeBris.setAttribute("id", "dugmeBris" + brTaga);
            dugmeBris.setAttribute("value", brTaga);
            dugmeBris.setAttribute("onclick", "obrisiSecTag(" + brTaga + ")");
            dugmeBris.innerHTML = "Obrisi tag";
            tagSpace.appendChild(dugmeBris);
          
          /* Plan implementacije: 
           * Preko php-a iz baze uzeti sve tagove i opstaviti ih u posebne hidden komponente,
           * onda to pokupi value tih komponenti preko javascripta.
           * komponenta selTagType treba da ima onchange f-ju koja ce da menja izbor tagova u zavisnosti od value-a.
           * Svaki selTagType ima svoj broj. Ukupan broj se prati u hidden componenti numOftags.
           * Ne saboraviti implementovati izbor pravljenja novog taga i dugme za brisanje.
           * 
           *          
           * 
           */
        }
        
        /**
         * Ova funkcija ucitava tagove za polje glavni tag prilikom ucitavanja stranice
         * var int tagNum - broj taga u koji se ovo dodaje, -1 je za main tag, a pozitivni brojevi su za sekundarne tagove
         * var int tagType - id tipa taga
         * @return void
         */
        
function setTag(tagNum, tagType) {
    
    
    let mainTag;
    
    if (tagNum == -1) {
        mainTag = document.getElementById("mainTag");
    } else {
        mainTag = document.getElementById("secTag" + tagNum);
    }
    
    if (mainTag == null)
        return;
    
    
    mainTag.innerHTML = "";
    let tagsIL;
    
    switch(tagType) {
        case 1: tagsIL = document.getElementById("tagSpaceIL").getAttribute("value");
            break;
            
        case 2: tagsIL = document.getElementById("tagSpaceSP").getAttribute("value");
            break; 
        
        case 3: tagsIL = document.getElementById("tagSpaceCM").getAttribute("value");
            break; 
        
        case 4: tagsIL = document.getElementById("tagSpaceTV").getAttribute("value");
            break; 
        
        case 5: tagsIL = document.getElementById("tagSpaceAN").getAttribute("value");
            break; 
        
        case 6: tagsIL = document.getElementById("tagSpacePP").getAttribute("value");
            break;
        
        default: return;    
    }
    
    let tagList = tagsIL.split(",");
    let tag;
            
    for (let i = 0; i < tagList.length; i++) {
        if (tagList[i] != "") {
            tag = document.createElement("option");
            tag.innerHTML = tagList[i];
            mainTag.appendChild(tag); 
        }
    }
            
    tag = document.createElement("option");
    tag.innerHTML = "Novi tag";
    mainTag.appendChild(tag); 
            
}


        
    /**
    * Ova funkcija ucitava azurira Tagove nakon promene tipa taga
    * var int tagNum - broj taga u koji se ovo dodaje, -1 je za main tag, a pozitivni brojevi su za sekundarne tagove
    * @return void
    */
function updateTags(tagNum) {
    
    let tagTypeList;
    if (tagNum == -1) {
        tagTypeList = document.getElementById("mainTagType");
    } else {
        tagTypeList = document.getElementById("secTagType" + tagNum);
    }
    
    if (tagTypeList == null)
        return;
    
    let tagVal = tagTypeList.options[tagTypeList.selectedIndex].text;
    
    let brTag;
    
    switch(tagVal) {
        case "Istorijska ličnost": brTag = 1;
            break;
        case "Spomenik": brTag = 2;
            break;
        case "Crkva/manastir": brTag = 3;
            break;
        case "Tvrdjava": brTag = 4;
            break;
        case "Arheološko nalazište": brTag = 5;
            break;
        case "Park prirode": brTag = 6;
            break;
        default:
            return;
    }
    
    setTag(tagNum, brTag);
    updateNewTagSpace(tagNum);
}

    /**
    * Ova funkcija ucitava postavlja polje za unos novog taga, ako je ta opcija izabrana
    * var int tagNum - broj taga u koji se ovo dodaje, -1 je za main tag, a pozitivni brojevi su za sekundarne tagove
    * @return void
    */
function updateNewTagSpace(tagNum) {
    let tagList;
    let tagInput;
    
    if (tagNum == -1) {
        tagList = document.getElementById("mainTag");
        tagInput = document.getElementById("mainNovTag");
    } else {
        tagList = document.getElementById("secTag" + tagNum);
        tagInput = document.getElementById("secNovTag" + tagNum);
    }
    
    if (tagList == null || tagInput == null)
        return;
    
    if (tagList.options[tagList.selectedIndex].text == "Novi tag") {
        tagInput.removeAttribute("hidden");
    } else {
        tagInput.setAttribute("hidden", true);
    }
}

   /**
    * Ova funkcija brise odabrani tag sa stranice
    * var int tagNum - broj taga u koji se ovo dodaje, prihvata samo pozitivne vrednosti
    * @return void
    */
function obrisiSecTag(tagNum) {
    
    let secTagDiv = document.getElementById("secTagSpace");
    let currTagDiv = document.getElementById("secTagDiv" + tagNum);
    
    if (currTagDiv == null) 
        return;
    
    secTagDiv.removeChild(currTagDiv);
    
}
