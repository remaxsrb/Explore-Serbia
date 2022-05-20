<!-- byMarko Jovanović 2018/0607-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Explore Serbia - Reklame</title>
</head>
<body>

    


    <div class = main-page-content>
        <h2>Reklame u sistemu</h2>

        <?php

        echo "<div class='row'>";
        foreach ($reklame as $reklama){
            echo '<div class="col-sm-12 col-md-4 col-lg-3  d-flex justify-content-center align-items-center">
                    <div class="card"  style="width: 18rem">';
            if ($reklama->slikaURL ?? null != null) {
                echo '<img src="' . $reklama->slikaURL . ' "class="card-img-top">';
            } else {
                echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="card-img-top">';
            }

            echo '<div class="card-body">';
            echo '<a href="'.site_url("Admin/reklama/$reklama->id").'" class="card-title"><h5>'.$reklama->nazivRadnje.'</h5></a>';
            echo '<p class="card-date">'.date("d.m.Y", strtotime($reklama->vremeKreiranja)).'</p>';
            echo '<p class="card-text">'.$reklama->opis.'</p>';

            echo '</div>
                </div>
            </div>';

        }
        ?>
    </div>


    </body>
    
    
</body>
</html>