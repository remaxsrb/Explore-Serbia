<!-- by Nikola Bjelobaba  -->

<?php $session = session(); ?>

    <div class="container">
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-2">
                <?php 
                    if ($korisnik->slikaURL??null != null){
                        echo '<img src="'.$korisnik->slikaURL.'" alt="Profile picture" class="profile-picture">';
                    } else {
                        echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="profile-picture">';
                    }
                ?>
            </div>
            <div class="col-md-10">
                <h5>Korisničko ime: <?php echo $korisnik->korisnickoIme; ?></h5>
                <h5>Ime: <?php echo $korisnik->ime; ?></h5>
                <h5>Prezime:  <?php echo $korisnik->prezime; ?></h5>
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
                                
                                
                                
                                echo '<a href="'. site_url("/$kontroler/objava/$objava->id").'" class="list-group-item list-group-item-action flex-column align-items">'
                                        . '';
                                    echo '<div id="wrapperDiv4">';
                                    
                                        echo '<div id="div3" style="float:left ;margin-left: 10px; margin-bottom: 10px">';
                                            if ($korisnik->slikaURL??null != null){
                                                echo '<img src="'.$korisnik->slikaURL.'" alt="Profile picture" class="imgclass" float: left>';
                                            } else {
                                                echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="imgclass">';
                                            }
                                        echo '</div>';        
                                        
                                        echo '<div id="div4" style="float:left; margin-left: 10px;margin-bottom: 10px">';
                                            echo '<p float="right">'.$korisnik->korisnickoIme.'</p>';
                                        echo '</div>';
                                        
                                        echo '<div class="d-flex w-100 justify-content-between">';
                                            echo '<h5 class="mb-1">'.$objava->naslov.'</h5>';
                                            echo '<small style="text-align:right">'.$objava->vremeKreiranja.'</small>';
                                            echo '<form method=post action="'.site_url("/Pisac/brisiObjavu/$objava->id").'">';
                                            echo '<button class="btn button-add-tag">Izbrisi</button>';
                                            echo '</form>';
                                        echo '</div>';
                                        
                                        echo '<div>';
                                             $tekst = $objava->tekst;
                                             if (strlen($tekst) > 150) {
                                                 $tekst = substr($tekst, 0, 150);
                                                 $tekst .= "..."; 
                                             }
                                             echo $tekst;
                                                
                                        echo '</div>';
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

