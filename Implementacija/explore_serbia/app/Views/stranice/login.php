<!--by Miloš Brković 0599/2019-->

<div class="container">
    
    <form action="<?php echo site_url("Gost/ulogujSe"); ?>" method="POST" style="width: 60%; margin:auto;  padding-top: 30px">
               
              <div class="form-group">
                <label for="ime">Korisničko ime</label>
                <input type="text" class="form-control" id="ime" name="korisnickoIme" placeholder="Korisničko ime" required>
                <span style="color:red;">
                    <?php 
                        if(!empty($errors['korisnickoIme'])) 
                            echo $errors['korisnickoIme'];
                        
                    ?>
                </span>
                </font></td>
              </div>
              <div class="form-group">
                <label for="ime">Lozinka</label>
                <input type="password" class="form-control" id="password" name="lozinka" placeholder="Lozinka" required>
                <span style="color:red;">
                    <?php 
                        if(!empty($errors['lozinka'])) 
                            echo $errors['lozinka'];
                    ?>
                </span>
              </div>
         <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>
            <center><button type="submit" class="btn btn-primary">Uloguj se</button> </center>
          </form>
        </div>
        

</body>
</html>