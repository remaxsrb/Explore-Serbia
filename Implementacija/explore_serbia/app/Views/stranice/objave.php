<!--by Miloš Brković 0599/2019-->
<!--by Nikola Bjelobaba 0442/2019-->
<script src="/js/filtriranjePretrage.js"></script>

<div class="main-page-content">
    
<?php 
    $session = session();
    $i = 0;
    
    echo "<div class='row'>";
    foreach ($objave as $objava){
        echo '<div class="col-sm-12 col-md-4">
                <div class="card mb-4 '.$tagoviCssKlase[$i].'">
                    <div class="card-body">';
        echo '<a href="'. site_url("/$kontroler/objava/$objava->id").'" class="card-title"><h3>'.$objava->naslov.'</h3></a>';
        echo '<p class="card-date">'.date("d.m.Y", strtotime($objava->vremeKreiranja)).'</p>';
        echo '<p class="card-text">'.substr($objava->tekst, 0, 300).'...</p>';
        if ($autori[$i]->slikaURL??null != null){
            echo '<img src="'.$autori[$i]->slikaURL.'" alt="Profile picture" class="imgclass">';
        } else {
            echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="imgclass">';
        }
        
        if ($objava->autor != null){
            echo '<a href="/'.$kontroler.'/profilPisac/'.$objava->autor.'" class="card-link author-link">'.$objava->autor.'</a>';
        } else {
            echo '<p class="card-link author-link">[deleted]</p>';
        }
        
        if ($objava->brojOcena != 0) {
        $ocena = $objava->sumaOcena / $objava->brojOcena;
        } else {
            $ocena = 0;
        }
        $ocenaCeoDeo = floor($ocena);
        $ocenaDecimalniDeo = round($ocena - $ocenaCeoDeo, 2);
       
        echo '<div id="ratingObjava'.$objava->id.'" class="rating">';
        $polaZvezdePrikazano = false;
        for ($k = 1; $k <= 5; $k++){
            if ($ocenaCeoDeo >= $k){
                echo '<span class="fa fa-star checked"></span>';
            } else if (!$polaZvezdePrikazano){
                if ($ocenaDecimalniDeo >= 0.5){
                    echo '<span class="fa fa-star checked"></span>';
                } else {
                    echo '<span class="fa fa-star-half-alt checked"></span>';
                }
                $polaZvezdePrikazano = true;
            }
            else {
                echo '<span class="fas fa-star"></span>';
            }
        }
        echo '</div>';
        
        if ($kontroler != "Gost") {
            
            $ocenaObjave = -1;
            foreach($korisnikOcene as $korOcena) {
                if ($korOcena->objava == $objava->id) {
                    $ocenaObjave = $korOcena->ocena;
                    break;
                }
            }
            
            $hidden1 = "";
            $hidden2 = "";
            if ($ocenaObjave == -1) {
                $hidden2 = 'hidden="true"';
            } else {
                $hidden1 = 'hidden="true"';
            }
            
            
        echo '<div id="oceniDiv'.$objava->id.'" '.$hidden1.'>';
                echo '<select id="selOcena'.$objava->id.'" style="float:left">';
                    echo '<option value=0>0</option>';
                    echo '<option value=1>1</option>';
                    echo '<option value=2>2</option>';
                    echo '<option value=3>3</option>';
                    echo '<option value=4>4</option>';
                    echo '<option value=5>5</option>';
                echo '</select>';
                
                $siteUrl = site_url("$kontroler/ocenjivanje");
                echo '<button class="btn  button-add-tag" style="float:left" onclick="oceni('; echo $objava->id.", '".$session->get("korisnik")->korisnickoIme."', '".$siteUrl."')"; echo '">Oceni</button>';
        echo '</div>';
            
        echo '<div id="prikazOcene'.$objava->id.'" '.$hidden2.'>';
            echo '<span style="float:left">Vasa ocena: '.$ocenaObjave.'</span>';
        echo '</div>';
            
        }
        
        if ($kontroler == "Admin") {
        echo '
               <div>
                <a href="'.site_url("/Admin/brisanjeBiloKojeObjave/$objava->id").'" style="float:right">
                    <button class="btnAdm"><i class="fa fa-trash" ></i></button>
                
              </div>
                    </div>
                </div>
            </div>';
        } else {
            echo '
                    </div>
                </div>
            </div>';
        }
        
        $i++;
    }
    echo "</div>";
    
    
?>
    
</div>
    
<script type="text/javascript" src="/js/ocenaObjave.js"></script>   
    
</body>
</html>