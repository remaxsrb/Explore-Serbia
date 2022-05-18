<!-- by Marko Jovanovic 2018/0607 -->


<!DOCTYPE html>
<html lang="en">
<head>

    <title>Explore Serbia - Korisnici</title>

</head>
<body>

    <div class = "main-page-content">
        <h2>Korisnici u sistemu</h2>
    <?php

    $col=0;
    $korisnik =null;

    if($col==0)
    {
        echo '<div class="row">';
    }

    foreach ($korisnici as $korisnik)
    {
        echo '<div class="col-md-4 col-sm-12">';
        echo '<div class="card"  style="width: 18rem">';
        if ($korisnik->slikaURL ?? null != null) {
            echo '<img src="' . $korisnik->slikaURL . ' class="card-img-top">';
        } else {
            echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="card-img-top">';
        }

        echo '<div class="card-body">';
        echo '<h5 class ="card-title">' . $korisnik->korisnickoIme . '</h5>';
        echo '<ul class="nav flex-column flex-sm-row justify-content-center">';
        if ($korisnik->tip != 1)
        {
            echo '<li>';
            echo form_open(site_url("Admin/izbrisiKorisnika"), "method=post");
            echo form_hidden('korisnik', $korisnik->korisnickoIme);
            $btnData=
                [
                    'class'=> "btn btn-danger",
                    'name' => "btnDelteUser",
                ];
            echo form_submit($btnData, "Izbriši korisnika");
            echo form_close();
            echo '</li>';
        }


        if ($korisnik->tip != 1 && $korisnik->tip != 3) {
            echo '<li>';
            echo form_open(site_url("Admin/dodajAdmina"), "method=post");
            echo form_hidden('korisnik', $korisnik->korisnickoIme);
            $btnData=
                [
                    'class'=> "btn btn-primary",
                    'name' => "btnAddAdmin",
                ];
            echo form_submit($btnData, "Dodaj admina");
            echo form_close();
            echo '</li>';
        }
        echo '</ul>';

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
</html>