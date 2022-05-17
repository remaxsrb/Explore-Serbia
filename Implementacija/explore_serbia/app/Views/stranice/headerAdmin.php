<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("include.php"); ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="./index.html">
            <img src="./assets/images/logo/PSI-ES-Logo-Transparent.png" width="30" height="30" alt="">
        </a>
        <a class="navbar-brand" href="./index.html">Explore Serbia</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- <li class="nav-item active">
                    <a class="nav-link" href="#">Pocetna<span class="sr-only">(current)</span></a>
                </li> -->

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filteri
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Istorijska licnost</a>
                      <a class="dropdown-item" href="#">Spomenik</a>
                      <a class="dropdown-item" href="#">Crkva/manastir</a>
                      <a class="dropdown-item" href="#">Tvrdjava</a>
                      <a class="dropdown-item" href="#">Arheolosko nalaziste</a>
                      <a class="dropdown-item" href="#">Park prirode</a>
                    </div>
                </li>
                <li>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pretrazi</button>
                    </form>
                </li>
                
            </ul>
            
            <form method="get" action="listaKorisnikaUSistemu.html">
                <button  class="btnAdm"><i class="fa fa-user" aria-hidden="true"> lista u sistemu</i></button>
            </form>
            <form method="get" action="listaObjavaUSistemu.html">
                <button class="btnAdm" ><i class="fa fa-file-text-o"> lista u sistemu</i></button>
           </form>
           <form method="get" action="listaReklamaUSistemu.html">
            <button  class="btnAdm"><i class="fa fa-handshake-o"> lista u sistemu</i></button>
        </form>
            
            <form method="get" action="listaObjava.html">
                <button class="btnAdm" ><i class="fa fa-file-text-o"> odobravanje</i></button>
           </form>
           <form method="get" action="listaReklama.html">
            <button class="btnAdm"><i class="fa fa-handshake-o"> odobravanje</i></button>
        </form>
        <form method="get" action="podesavanje.html">
        <button class="btnAdm" disabled><i class="fa fa-cogs"></i></button>
       
    </form>
    <a href="index.html" style="margin-left: 10px;">Izloguj se</a>
        </div>
    </nav>