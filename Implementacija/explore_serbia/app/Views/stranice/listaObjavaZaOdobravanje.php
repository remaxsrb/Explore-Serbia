<!-- by Marko Jovanovic 2018/0607 -->


<!DOCTYPE html>
<html lang="en">
<head>

    <title>Explore Serbia - Korisnici</title>

</head>
<body class="background-c">

<div class = "main-page-content">
    <h2>Objave koje čekaju odobrenje</h2>
    <?php

    $objava =null;

    foreach ($objave as $objava)
    {
        if($objava->odobrena==0)
        {
            echo '<div class="row">';
            echo '<div class="col-sm-4">';
            echo '<a href="'. site_url("/Admin/objava/$objava->id").'" class="card-title"><h3>'.$objava->naslov.'</h3></a>';
            echo '</div>';
            echo '<div class="col-sm-4">';
            echo form_open(site_url("Admin/odobriTekst"), "method=post");
            echo form_hidden('id', $objava->id);
            $btnData=
                [
                    'class'=> "btn btn-success",
                    'name' => "btnAddText",
                ];
            echo form_submit($btnData, "Odobri objavu");
            echo form_close();
            echo '</div>';
            echo '<div class="col-sm-4">';
            echo form_open(site_url("Admin/odbijTekst"), "method=post");
            echo form_hidden('id', $objava->id);
            $btnData=
                [
                    'class'=> "btn btn-danger",
                    'name' => "btnDeleteText",
                ];
            echo form_submit($btnData, "Odbij objavu");
            echo form_close();
            echo '</div>';
            echo '</div>';
        }



    }


    ?>



</div>
</body>
</html>