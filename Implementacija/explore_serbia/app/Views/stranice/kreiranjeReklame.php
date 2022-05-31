<!--by Antonija Vasiljević 0501/2019 -->
<div class="kreiranjeReklame-page-content">
    <script>
    function proveriTelefon() {
      
        let reg=/^\+[0-9]{3}\s[0-9]{7}$/;
    
        if(!reg.test(document.getElementById("fon").value)) {
            if (document.getElementById("fon").value!="") {
             alert("Telefon nije u ispravnom formatu!");
           document.getElementById("okaci").disabled=true;
            }
            else {
                 document.getElementById("okaci").disabled=false;
            }
        }

     else {
       document.getElementById("okaci").disabled=false;
       

    }
  
    }
      function proveriOpis(){
          if (document.getElementById("opis").value.length>1000) {
               alert("Opis ne sme biti duži od 1000 karaktera!");
           document.getElementById("okaci").disabled=true;
          }
          else {
                 document.getElementById("okaci").disabled=false;
            }
      }
    </script>
    <form action="<?php echo site_url("/Zanatlija/kreirajReklamu"); ?>" method="post">
<div class="title-space">
    <div class="title-space-text">
        <h4>Naziv radnje<span style="color: red;">*</span></h4>
    </div>
    <input type="text" size="30" placeholder="Naziv radnje" name="nazivRadnje" required>
</div>

<div class="region-space">
    <div class="region-space-text">
        <h4>Region<span style="color: red;">*</span></h4>
    </div>
   <select class="form-control1" id="municiplaity1" name="region">
              <?php
              $lokacijaModel=new App\Models\LokacijaModel;
               $lokacije = $lokacijaModel->findAll();
              foreach($lokacije as $lokacija){
                  echo '<option value="'.$lokacija->id.'">'.$lokacija->naziv.'</option>';
              }
              
              ?>
                
              </select> 

</div>

<div class="picture-space">
    <div clas="piscture-space-text">
        <h4>Slika radnje</h4>
    </div>
    <input type="text" size="46" placeholder="Slika (URL)" name="slikaURL">
</div>

<div class="description-space">
    <div class="description-space-text">
        <h4>Opis vaše radnje</h4>
    </div>
    <textarea rows="10" cols="150" name="opis" id="opis" onchange="proveriOpis()"></textarea>
</div>

<div class="address-space">
    <div class="address-space-text">
        <h4>Adresa vaše radnje<span style="color: red;">*</span></h4>
    </div>
    <input type="text" size="30" placeholder="Vasa adresa" name="adresa" required>
</div>


<div class="phone-space">
    <div class="phone-space-text">
        <h4>Kontakt telefon</h4>
    </div>
    <input type="text" size="30" placeholder="+061 1234567" name="telefon" id="fon" onchange="proveriTelefon()">
</div>

<div class="email-space">
    <div class="email-space-text">
       
        <h4>Kontakt e-mail</h4>
    </div>
    <input type="email" size="30" placeholder="primer@gmail.com" name="mejl">
</div>

<div class="personal-site-space">
    <div class="personal-site-space-text">
        <h4>Link ka vašem sajtu</h4>
    </div>
    <input type="text" size="30" placeholder="Link ka vašem sajtu" name="link">
</div>
  <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>
     
<div class="submit-button-space">
    <button class="btn btn-primary btn-lg button-submit-objava" type="submit" id="okaci">Okači reklamu</button>
</div>


        <button class="btn btn-secondary btn-lg button-cancel-objava" onclick='window.location="/Zanatlija"' type="button">Odustani</button>
</form>
</div>