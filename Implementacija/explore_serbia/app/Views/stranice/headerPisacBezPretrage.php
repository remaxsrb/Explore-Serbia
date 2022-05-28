<!--by Nikola Bjelobaba 0442/2019-->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("include.php"); ?>
</head>
<body class="background-c">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="#">
            <img src="/assets/images/logo/PSI-ES-Logo-Transparent.png" width="30" height="30" alt="">
        </a>
        <a class="navbar-brand" href="/">Explore Serbia</a>
        
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav mr-auto">
                 
            </ul>

            
            <form method="get" action="<?php echo site_url("/Pisac/kreiranjeObjave"); ?>">
                <button class="btnAdm" ><i class="fa fa-plus" aria-hidden="true"></i></button>
           </form>
           <form method="get" action="<?php echo site_url("/Pisac/profil"); ?>">
            <button  class="btnAdm"><i class="fa fa-user" aria-hidden="true"></i></button>
            </form>    
            <!-- <form method="get" action="<?php echo site_url("/Pisac/podesavanjeProfila"); ?>"><button class="btnAdm"><i class="fa fa-cogs"></i></button> </form> -->
            <a href="<?php echo site_url("/Pisac/izlogujSe"); ?>" style="margin-left: 10px;">Izloguj se</a>
        </div>
    </nav>