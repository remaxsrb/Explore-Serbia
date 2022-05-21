<!--by Miloš Brković 0599/2019-->
<!--by Antonija Vasiljević 0501/2019-->
<div class="container">
<style>
    body {
        background-color: #f1ebeb;;
    }
</style>
    
    <div class="row">
        <div class="col-md-8 col-sm-12 objava">

            <?php 
                if ($autor->slikaURL??null != null){
                    echo '<img src="'.$autor->slikaURL.'" alt="Profile picture" class="imgclass">';
                } else {
                    echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="imgclass">';
                }
            
                if ($objava->autor??null != null){
                    echo '<a href="#" class="card-link author-link">'.$autor->korisnickoIme.'</a>';
                } else {
                    echo '<p>[deleted]</p>';
                }
            ?>
            
                    
                    <p class="card-date"><?php echo date("d.m.Y", strtotime($objava->vremeKreiranja)); ?></p>
            <h1><?php echo $objava->naslov ?></h1>

            <p>
            <?php 
            
            $slikaRegex = "/(\[img\])(.+)(\[\/img\])/";
          if (preg_match($slikaRegex, $objava->tekst, $matches)) {
            echo preg_replace($slikaRegex, "<img src='".$matches[2]."'></img>" , $objava->tekst);
         } else {
             echo $objava->tekst;
         }
                    
            ?>
            </p>
         

        <?php
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
        echo '</div>';
            
        ?>
        </div>
        <div class="col-md-4 col-sm-12 reklame">
            <div class="row">
            <?php
                
                $i = 0;
                foreach($reklame as $reklama){
                    echo '<div class="col-sm-12 col-md-12">
                            <div class="card mb-4">
                                <div class="card-body">';
                    echo '<a href="'.site_url("/$kontroler/reklama/$reklama->id").'" class="card-title"><h3>'.$reklama->nazivRadnje.'</h3></a>';
                    echo '<p class="card-date">'.date("d.m.Y", strtotime($objava->vremeKreiranja)).'</p>';
                    echo '<p class="card-text">'.$reklama->opis.'</p>';
                    if ($autoriReklama[$i]->slikaURL??null != null){
                        echo '<img src="'.$autoriReklama[$i]->slikaURL.'" alt="Profile picture" class="imgclass">';
                    } else {
                        echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="imgclass">';
                    }
                    
                    if ($reklama->autor??null != null){
                        echo '<a href="/'.$kontroler.'/profilZanatlije/'.$reklama->autor.'" class="card-link author-link">'.$reklama->autor.'</a>';
                    } else {
                        echo '<p class="card-link author-link">[deleted]</p>';
                    }
                    
                    
                    echo '</div>
                            </div>
                        </div>';
                    
                    $i++;
                }


            ?>
                
            </div>
        </div>
    </div>
</div>