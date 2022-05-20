

<!--by Antonija Vasiljević 0501/2019 -->

 <div class="container">
     <?php
     use App\Models\LokacijaModel;
?>
   
     </style>
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-2">
                <?php   if ($autor->slikaURL??null != null){
                    echo '<img src="'.$autor->slikaURL.'" alt="Profile picture" class="imgclass" float="left" style=" display:inline-block;
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
                <form method="post" action="/Zanatlija/podesavanjeProfila">
                 <button type="submit" class="btn btn-secondary btn-lg" style='float:right'>Izmeni profil</button>
                 </form>
                <h5>Korisničko ime: <?php echo ($autor->korisnickoIme) ?></h5>
                <h5>Ime: <?php echo($autor->ime); ?> </h5>
                <h5>Prezime:   <?php echo($autor->prezime); ?></h5>
                <h5>Opština:  <?php 
                $lokacijaModel=new LokacijaModel();
                $lokacija=$lokacijaModel->find($autor->lokacija)->naziv;
                echo ($lokacija);
                ?></h5>
               
            </div>
            
                
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <br>
                <h2>Moje reklame</h2>
                <br>

                <div class="list-group">
                    <?php
    foreach ($reklame as $reklama) {
       
                  echo  '<a href="/Zanatlija/reklama/'.$reklama->id.'" class="list-group-item list-group-item-action flex-column align-items">
            
                        <div id="wrapperDiv4" >
                            <div id="div3" style="float:left ;margin-left: 10px;
                            margin-bottom: 10px" >';
                            
        if ($autor->slikaURL??null != null){
                    echo '<img src="'.$autor->slikaURL.'" alt="Profile picture" class="imgclass" float="left"> ';
                } else {
                    
                    echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="imgclass">';
                }
                           
                           echo '
                               
                            </div>
                            <div>
                            <div id="div4" style="float:left; margin-left: 10px;
                            margin-bottom: 10px">
                            <p float="right">'.$autor->korisnickoIme.'
                 </p>
                            </div>
                          
                              <form method="get" action="';
                           echo site_url("/Zanatlija/brisiReklamu/".$reklama->id);
                           echo'" style="float:right">
                                   
                             
                                <button class="btnAdm"><i class="fa fa-trash" ></i></button>

                            </form>
                         
                            </div>
    
  
                  
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">'.$reklama->nazivRadnje.'</h5>
                    <small>'.$reklama->vremeKreiranja.'</small>
                  </div>
                  <div>
                  <p class="mb-1">'.$reklama->opis.'</p>
                 
                  </div>
                     </div>     
                        
                </a>
                           <br>';
    }
                    ?>
                <br>
                
            </div>
        </div>
    </div>