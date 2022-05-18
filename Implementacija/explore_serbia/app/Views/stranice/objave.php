<!--by Miloš Brković 0599/2019-->
<script src="/js/filtriranjePretrage.js"></script>

<div class="main-page-content">
    
<?php 
    
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
            echo '<a href="#" class="card-link author-link">'.$objava->autor.'</a>';
        } else {
            echo '<p class="card-link author-link">[deleted]</p>';
        }
        
        $ocena = $objava->sumaOcena / $objava->brojOcena;
        $ocenaCeoDeo = floor($ocena);
        $ocenaDecimalniDeo = round($ocena - $ocenaCeoDeo, 2);
       
        echo '<div class="rating">';
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
        echo '</div>
                    </div>
                </div>
            </div>';
        
        $i++;
    }
    echo "</div>";
    
    
?>
    
</div>
    
    
    
</body>
</html>