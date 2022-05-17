<!--by Miloš Brković 0599/2019-->

<div class="container">
    <form action="<?php echo site_url("/Gost/registrujSe"); ?>" method="POST" style="width: 60%; margin:auto; padding-top: 30px">
            <div class="form-group">
              <label for="ime" required>Ime</label>
              <input type="text" class="form-control" id="ime" name="ime" placeholder="Ime" required>
            </div>
            <div class="form-group">
                <label for="prezime">Prezime</label>
                <input type="text" class="form-control" id="prezime" name="prezime" placeholder="Prezime" required>
              </div>

              <label>Pol</label>
              <div class="form-check">
                <input class="form-check-input" checked type="radio" name="pol" id="musko" name="pol" value="musko" >
                <label class="form-check-label" for="musko">
                  Muško
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input"  type="radio" name="pol" id="zensko" name="pol" value="zensko">
                <label class="form-check-label" for="zensko">
                  Žensko
                </label>
              </div>

              <label>Opština</label>
              <p>Ako ste iz centralnih opština u Beogradu - izaberite Beograd</p>
              <select class="form-control" id="municiplaity" name="opstina">
              <?php
              
              foreach($lokacije as $lokacija){
                  echo '<option value="'.$lokacija->id.'">'.$lokacija->naziv.'</option>';
              }
              
              ?>
                
              </select> 
              <div class="form-group">
                <label for="ime">Korisničko ime</label>
                <input type="text" class="form-control" id="korisnickoime" name="korisnickoIme" maxlength="20" placeholder="Korisničko ime" required>
              </div>
              <div class="form-group">
                <label for="ime">Adresa e-pošte</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Adresa e-pošte" required>
              </div>
              <div class="form-group">
                <label for="ime">Lozinka</label>
                <input type="password" class="form-control" id="password" name="lozinka" placeholder="Lozinka" required>
              </div>
              <div class="form-group">
                <label for="ime">Potvrda lozinke</label>
                <input type="password" class="form-control" id="passwrod" name="potvrdaLozinke" placeholder="Potvrda lozinke" required>
              </div>
              <label>Tip korisnika</label>
              <div class="form-check">
                <input class="form-check-input" checked type="radio"id="pisac" name="tipKorisnika" value="pisac" >
                <label class="form-check-label" for="pisac">
                  Pisac
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio"  id="zanatlija" name="tipKorisnika" value="zanatlija">
                <label class="form-check-label" for="zanatlija">
                  Zanatlija
                </label>
              </div>
               <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>
            <center><button type="submit" class="btn btn-primary">Registruj se</button> </center>
          </form> </div>>
    </div>
</body>
</html>