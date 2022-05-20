<!--by Antonija Vasiljević 0501/2019 --> 
<div class="container">
     <?php
     use App\Models\LokacijaModel;
?>
   
     </style>
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-2">
                <?php   if ($korisnik->slikaURL??null != null){
                    echo '<img src="'.$korisnik->slikaURL.'" alt="Profile picture" class="imgclass" float="left" style=" display:inline-block;
                        height: 150px;
                        width: 200px;
                        object-fit: fill;
                        vertical-align:top;"> ';
                } else { 
                    
                    echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="imgclass" 
                        style=" display:inline-block;
                        height: 150px;
                        width: 200px;
                        object-fit: fill;
                        vertical-align:top;">';
                }
                ?>
            
            </div>
            <div class="col-md-10">
      
                <h5>Korisničko ime: <?php echo ($korisnik->korisnickoIme) ?></h5>
                <h5>Ime: <?php echo($korisnik->ime); ?> </h5>
                <h5>Prezime:   <?php echo($korisnik->prezime); ?></h5>
                <h5>Opština:  <?php 
                $lokacijaModel=new LokacijaModel();
                $lokacija=$lokacijaModel->find($korisnik->lokacija)->naziv;
                echo ($lokacija);
                ?></h5>
               
            </div>
            
                
            
        </div>