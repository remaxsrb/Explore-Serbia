<!-- by Marko Jovanovic 2018/0607 -->


<!DOCTYPE html>
<html lang="en">
<head>

    <title>Explore Serbia - Korisnici</title>

</head>
<body class="background-c">

<div class = "main-page-content">
    <h2>Tagovi Koji čekaju odobrenje</h2>
    <?php

    $tag =null;

    foreach ($tagovi as $tag)
    {
        if($tag->odobren==0)
        {
            echo '<div class="row">';
            echo '<div class="col-sm-4">';
            echo $tag->naziv;
            echo '</div>';
            echo '<div class="col-sm-4">';
            echo form_open(site_url("Admin/odobriTag"), "method=post");
            echo form_hidden('tag', $tag->naziv);
            $btnData=
                [
                    'class'=> "btn btn-success",
                    'name' => "btnAddTag",
                ];
            echo form_submit($btnData, "Odobri tag");
            echo form_close();
            echo '</div>';
            echo '<div class="col-sm-4">';
            echo form_open(site_url("Admin/odbijTag"), "method=post");
            echo form_hidden('tag', $tag->naziv);
            $btnData=
                [
                    'class'=> "btn btn-danger",
                    'name' => "btnDeleteTag",
                ];
            echo form_submit($btnData, "Odbij tag");
            echo form_close();
            echo '</div>';
            echo '</div>';
        }



    }


    ?>

</div>
</body>
</html>