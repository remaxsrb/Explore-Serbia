<!-- byMarko Jovanović 2018/0607-->
<!--by Antonija Vasiljević 0501/2019 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Explore Serbia - Reklame</title>
</head>
<body>

    


    <div class = main-page-content>
        <h2>Reklame u sistemu</h2>
        <?php

        $col=0;
        $reklama =null;
        
        if($col==0)
        {
            echo '<div class="row">';
        }

        foreach ($reklame as $reklama)
        {
            echo '<div class="col-md-4 col-sm-12">';
            echo '<div class="card"  style="width: 18rem; margin-bottom:18px;">';
            if ($reklama->slikaURL ?? null != null) {
                echo '<img src="' . $reklama->slikaURL . ' "class="card-img-top">';
            } else {
                echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="card-img-top">';
            }

            echo '<div class="card-body">';
              echo '<form method="get" action="';
                           echo site_url("/Admin/brisiBiloKojuReklamu/".$reklama->id);
                           echo'" style="float:right">
                                   
                             
                                <button class="btnAdm"><i class="fa fa-trash" ></i></button>

                            </form>';
            echo '<a href="'.site_url("Admin/reklama/$reklama->id").'" class="card-title"><h5>'.$reklama->nazivRadnje.'</h5></a>';
            echo '<p class="card-date">'.date("d.m.Y", strtotime($reklama->vremeKreiranja)).'</p>';
            echo '<p class="card-text">'.$reklama->opis.'</p>';

            echo '</div>';
            echo '</div>';


            $col++;

            if($col==3)
            {
                echo "</div>";
                $col=0;
            }
            if($col!=0)
            {
                echo '</div>';
            }
        }

        ?>

    </div>


    </body>
    
    
</body>
</html>