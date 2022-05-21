<!DOCTYPE html>
<!-- by Marko Jovanovic 2018/0607 -->
<!--by Miloš Brković 0599/2019-->
<html>
<head>
    <?php include("include.php"); ?>

</head>
<body class="background-c">
<div class="main_nav">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
        <a href="<?= site_url("Admin/index") ?>" class="navbar-brand" >
            <img src="/assets/images/logo/PSI-ES-Logo-Transparent.png" width="30" height="30" alt="">
        </a>

        <a href="<?= site_url("Admin/index") ?>" class="navbar-brand">Explore Serbia</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#pcNavigation" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="pcNavigation">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Kateogrije
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                        <span class="dropdown-item">Istorijska ličnost</span>
                        <span class="dropdown-item">Spomenik</span>
                        <span class="dropdown-item">Crkva/manastir</span>
                        <span class="dropdown-item">Tvrđava</span>
                        <span class="dropdown-item">Arheološko nalazište</span>
                        <span class="dropdown-item">Park prirode</span>
                    </div>

                </li>

                <li>
                    <form method="GET" action="<?php echo site_url("Admin/pretraga"); ?>" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" name="pretraga" placeholder="Pretraži" aria-label="Search">
                        <button class="btn btn-outline-secondary my-2 my-sm-0 form-control mr-sm-2" type="submit">Pretraži</button>
                    </form>
                </li>
            </ul>


            <ul class="nav flex-column flex-sm-row justify-content-end">
                <li>
                    <a href="<?= site_url("Admin/napisiTekst") ?>" class="btn btn-outline-secondary my-2 my-sm-0 d-flex flex-sm-fill" style="justify-content: center" type="button" > Napiši tekst </a>
                </li>

                <li>
                    <a href="<?= site_url("Admin/listaKorisnika") ?>" class="btn btn-outline-secondary my-2 my-sm-0 d-flex flex-sm-fill" style="justify-content: center"> Korisnici </a>
                </li>
                <li>
                    <a href="<?= site_url("Admin/index") ?>" class="btn btn-outline-secondary my-2 my-sm-0 d-flex flex-sm-fill" style="justify-content: center"> Objave </a>
                </li>
                <li>
                    <a href="<?= site_url("Admin/listaReklama") ?>" class="btn btn-outline-secondary my-2 my-sm-0 d-flex flex-sm-fill" style="justify-content: center" type="button"> Reklame </a>
                </li>
                <li>
                    <a href="<?= site_url("Admin/tekstoviZaOdobravanje") ?>" class="btn btn-outline-secondary my-2 my-sm-0 d-flex flex-sm-fill" style="justify-content: center" type="button"> Odobri objave </a>
                </li>
                <li>
                    <a href="<?= site_url("Admin/reklameZaOdobravanje") ?>" class="btn btn-outline-secondary my-2 my-sm-0 d-flex flex-sm-fill"  style="justify-content: center" type="button"> Odobri reklame </a>
                </li>
                <li>
                    <a href="<?= site_url("Admin/tagoviZaOdobravanje") ?>" class="btn btn-outline-secondary my-2 my-sm-0 d-flex flex-sm-fill" style="justify-content: center" type="button"> Odobri tagove </a>
                </li>
                <li>
                    <a href="<?= site_url("Admin/podesavanjeProfila") ?>" class="btn btn-outline-secondary my-2 my-sm-0 d-flex flex-sm-fill" style="justify-content: center" type="button"> Podešavanja </a>
                </li>

                <li>
                    <a href="<?= site_url("Admin/izlogujSe") ?>" class="btn btn-outline-secondary my-2 my-sm-0 d-flex flex-sm-fill" style="justify-content: center" type="button"> Odjavi se </a>
                </li>
            </ul>

        </div>
    </nav>
</div>
</body>
</html>


