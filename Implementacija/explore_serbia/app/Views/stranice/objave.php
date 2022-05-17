<!--by Miloš Brković 0599/2019-->

<div class="main-page-content">
    
<?php 
    
    $i = 0;
    $j = 0;
    
    foreach ($objave as $objava){
        if ($j == 0){
            echo "<div class='row'>";
        }
        echo '<div class="col-sm-12 col-md-4">
                <div class="card mb-4">
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
        
        
        // TO DO
        // Sistem za precizniji prikaz ocena
        $ocena = $objava->sumaOcena / $objava->brojOcena;
        $ocena = round($ocena);
        
        echo '<div class="rating">';
        for ($k = 1; $k <= 5; $k++){
            if ($k <= $ocena){
                echo '<span class="fa fa-star checked"></span>';
            } else {
                echo '<span class="fa fa-star"></span>';
            }
        }
        echo '</div>
                    </div>
                </div>
            </div>';
        
        
        $j++;
        if ($j == 3){
            echo "</div>";
            $j = 0;
        }
        
        $i++;
    }
    
    if ($j != 0){
        echo "</div>";
    }
    
    
?>
    
</div>
    
    
    
</body>
</html>