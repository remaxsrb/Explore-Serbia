<!-- by Nikola Bjelobaba  -->

<?php $session = session(); ?>

    <div class="container">
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-2">
                <?php 
                    if ($autor->slikaURL??null != null){
                        echo '<img src="'.$autor->slikaURL.'" alt="Profile picture" class="profile-picture">';
                    } else {
                        echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="profile-picture">';
                    }
                ?>
            </div>
            <div class="col-md-10">
                <?php 
                if ($kontroler!="Gost") {
                if ($korisnik->korisnickoIme==$autor->korisnickoIme) {
               echo' <form method="post" action="/Pisac/podesavanjeProfila">
                 <button type="submit" class="btn btn-secondary btn-lg" style="float:right">Izmeni profil</button>
                </form>'; }}  ?>
                <h5>Korisničko ime: <?php echo $autor->korisnickoIme; ?></h5>
                <h5>Ime: <?php echo $autor->ime; ?></h5>
                <h5>Prezime:  <?php echo $autor->prezime; ?></h5>
                <h5>Opština: <?php echo $lokacija->naziv; ?></h5>
            </div>
        </div>
            <div class="col-md-12">
                <br>
                <h2>Moje objave</h2>
                <br>
                <div class="list-group">
                    <?php
                    
                        if ($objave == null) {
                            echo '<h2 style="text-align: center">Nemate objave</h2>';
                        } else {
                            foreach ($objave as $objava) {
                                
                                if (!$objava->odobrena && $korisnik->korisnickoIme!=$autor->korisnickoIme) {
                                    continue;
                                }
                                
                                echo '<a href="'. site_url("/$kontroler/objava/$objava->id").'" class="list-group-item list-group-item-action flex-column align-items">'
                                        . '';
                                    echo '<div id="wrapperDiv4">';
                                    
                                        echo '<div id="div3" style="float:left ;margin-left: 10px; margin-bottom: 10px">';
                                            if ($autor->slikaURL??null != null){
                                                echo '<img src="'.$autor->slikaURL.'" alt="Profile picture" class="imgclass" float: left>';
                                            } else {
                                                echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="imgclass">';
                                            }
                                        echo '</div>';        
                                        
                                        echo '<div id="div4" style="float:left; margin-left: 10px;margin-bottom: 10px">';
                                            echo '<p float="right">'.$autor->korisnickoIme.'</p>';
                                        echo '</div>';
                                        
                                        if ($kontroler != "Gost") {
                                            if ($korisnik->korisnickoIme==$autor->korisnickoIme) {
                                                echo '<div style="float:right">';
                                                echo '<form method=post action="'.site_url("/Pisac/brisiObjavu/$objava->id").'">';
                                                echo '<button class="btnAdm"><i class="fa fa-trash" ></i></button>';
                                                //echo '<button class="btn button-add-tag">Izbrisi</button>';
                                                echo '</form>';
                                                echo '</div>';
                                            }
                                        }
                                        
                                        
                                        
                                        
                                        echo '<div class="d-flex w-100 justify-content-between">';
                                            echo '<h5 class="mb-1">'.$objava->naslov.'</h5>';
                                            echo '<small style="text-align:right">'.$objava->vremeKreiranja.'</small>';
                                            
                                        echo '</div>';
                                        
                                        echo '<div style="float:left">';
                                             $tekst = $objava->tekst;
                                             if (strlen($tekst) > 150) {
                                                 $tekst = substr($tekst, 0, 150);
                                                 $tekst .= "..."; 
                                             }
                                             echo $tekst;
                                                
                                        echo '</div>';
                                        
                                        if ($kontroler != "Gost") {
                                            if ($korisnik->korisnickoIme==$autor->korisnickoIme) {
                                                echo '<div style="float:right">';
                                                if ($objava->odobrena) {
                                                    echo '<h6 style="font-style:italic; float:right; color:green;">Odobrena</h6>';
                                                } else {
                                                    echo '<h6 style="font-style:italic; float:right; color:#A0A0A0;">Još uvek nije odobrena</h6>';
                                                    }
                                                echo '</div>';
                                            }
                                        }
                                        
                                        
                                        
                                    echo '</div>';   
                                echo '</a>';
                                
                                
                                
                                echo '<br>';
                                
                               
                            }
                                            
                        }   
                    ?>
                </div>
            </div>
        </div>
</body>

<script>
    function alt() {
        alert("test");
    }
</script>
</html>

