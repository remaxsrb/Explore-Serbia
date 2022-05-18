<!-- by Marko Jovanovic 2018/0607 -->

<html>
<head>
    <?php include('include.php');?>
</head>
<body>
<div class="main_nav">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="../stranice/index.php">
            <img src="/assets/images/logo/PSI-ES-Logo-Transparent.png" width="30" height="30" alt="">
        </a>

        <a class="navbar-brand" href="../stranice/index.php">Explore Serbia</a>

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
                        <a class="dropdown-item" href="#">Istorijske ličnosti</a>
                        <a class="dropdown-item" href="#">Spomenici</a>
                        <a class="dropdown-item" href="#">Crkve i manastiri</a>
                        <a class="dropdown-item" href="#">Tvrđave</a>
                        <a class="dropdown-item" href="#">Arheološka nalazišta</a>
                        <a class="dropdown-item" href="#">Legende</a>
                        <a class="dropdown-item" href="#">Parkovi prirode</a>
                    </div>

                </li>

                <li>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="" aria-label="Search">
                        <button class="btn btn-outline-secondary my-2 my-sm-0 form-control mr-sm-2" type="submit">Pretraži</button>
                    </form>
                </li>



            </ul>

            <ul class="nav flex-column flex-sm-row justify-content-end">
                <li>
                    <form method="get" action="<?php echo site_url("/Gost/registracija"); ?>"><button class="btn btn-outline-secondary my-2 my-sm-0 d-flex flex-sm-fill"type="submit">Registruj se</button></form>
                </li>

                <li>
                    <form method="get" action="<?php echo site_url("/Gost/login"); ?>"><button class="btn btn-outline-secondary my-2 my-sm-0 d-flex flex-sm-fill"" type="submit">Uloguj se</button></form>
                </li>
            </ul>

        </div>
    </nav>
</div>
</body>
</html>




