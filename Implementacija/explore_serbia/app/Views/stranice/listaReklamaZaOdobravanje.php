<!-- byMarko Jovanović 2018/0607-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Explore Serbia - Reklame</title>
</head>
<body class="background-c">




<div class = main-page-content>
    <h2>Reklame u sistemu koje čekaju odobrenje</h2>
    <?php

    $col=0;
    $reklama =null;

    if($col==0)
    {
        echo '<div class="row">';
    }

    foreach ($reklame as $reklama)
    {
        if($reklama->odobrena==0)
        {
            echo '<div class="col-md-4 col-sm-12">';
            echo '<div class="card"  style="width: 18rem">';
            if ($reklama->slikaURL ?? null != null) {
                echo '<img src="' . $reklama->slikaURL . ' "class="card-img-top">';
            } else {
                echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="card-img-top">';
            }

            echo '<div class="card-body">';
            echo '<a href="'.site_url("Admin/reklama/$reklama->id").'" class="card-title"><h5>'.$reklama->nazivRadnje.'</h5></a>';
            echo '<p class="card-date">'.date("d.m.Y", strtotime($reklama->vremeKreiranja)).'</p>';
            echo '<p class="card-text">'.$reklama->opis.'</p>';
            echo '<ul class="nav flex-column flex-sm-row justify-content-center">';
            echo '<li>';
            echo form_open(site_url("Admin/odbijReklamu"), "method=post");
            echo form_hidden('reklama', $reklama->nazivRadnje);
            $btnData=
                [
                    'class'=> "btn btn-danger",
                    'name' => "btnDeclineAdd",
                ];
            echo form_submit($btnData, "Odbij reklamu");
            echo form_close();
            echo '</li>';
            echo '<li>';
            echo form_open(site_url("Admin/odobriReklamu"), "method=post");
            echo form_hidden('reklama', $reklama->nazivRadnje);
            $btnData=
                [
                    'class'=> "btn btn-success",
                    'name' => "btnAproveAdd",
                ];
            echo form_submit($btnData, "Odobri reklamu");
            echo form_close();
            echo '</li>';
            echo '</ul>';
            echo '</div>';
            echo '</div>';


            $col++;
        }


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