
<!--by Antonija Vasiljević 0501/2019 -->
<div class="container">
    <form action="<?php echo site_url("/$kontroler/podesiProfil"); ?>" method="POST" style="width: 60%; margin:auto; padding-top: 30px">
         <div class="form-group">
                <label for="slika">Profilna slika</label>
                <input type="text" class="form-control" id="slika" name="slika" placeholder="URL slike"  value="<?php echo $korisnik->slikaURL;?>" >
              </div>    
        <div class="form-group">
              <label for="ime" required>Ime</label>
              <input type="text" class="form-control" id="ime" name="ime" placeholder="Ime" value="<?php echo $korisnik->ime;?>"required >
            </div>
            <div class="form-group">
                <label for="prezime">Prezime</label>
                <input type="text" class="form-control" id="prezime" name="prezime" placeholder="Prezime" value="<?php echo $korisnik->prezime;?>" required>
              </div>

         

              <label>Opština</label>
              <p>Ako ste iz centralnih opština u Beogradu - izaberite Beograd</p>
              <select class="form-control" id="municiplaity" name="opstina" >
              <?php
              
              foreach($lokacije as $lokacija){
                  echo '<option value="'.$lokacija->id.'">'.$lokacija->naziv.'</option>';
                  if ($lokacija->id==$korisnik->lokacija) {
                   echo '<option value="'.$lokacija->id.'" selected>'.$lokacija->naziv.'</option>';
                  }
              }
              
              ?>
                
              </select> 
            
              <div class="form-group">
                <label for="ime">Adresa e-pošte</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Adresa e-pošte"  value="<?php echo $korisnik->email;?>" required>
              </div>
              <div class="form-group">
                <label for="ime">Nova lozinka</label>
                <input type="password" class="form-control" id="passwrod" name="novaLozinka" placeholder="Nova lozinka">
              </div>
              <div class="form-group">
                <label for="ime">Potvrda nove lozinke</label>
                <input type="password" class="form-control" id="passwrod" name="potvrdaNoveLozinke" placeholder="Potvrda nove lozinke">
              </div>
              <div class="form-group">
                <label for="ime">Lozinka</label>
                <input type="password" class="form-control" id="password" name="trenutnaLozinka" placeholder="Stara lozinka" value=""required>
              </div>
            <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>

            <div id="odobri0" style="text-align: center;">
                  
                <button type="submit" class="btn btn-primary btn-lg " name="podesi" style="margin-bottom: 10px">Potvrdi izmene</button>
                 
    </div>
              
   
    <div id="obrisi0" style="text-align: center;">
       <button stype="submit" class="btn btn-danger btn-lg" name="brisi" type="submit" style="margin-bottom: 10px">Obriši nalog</button>'
    </div>
           </div>
</form>
 
