

<!--by Antonija Vasiljević 0501/2019 -->

 <div class="container">
     <?php
     use App\Models\LokacijaModel;
?>
   <style>
    body {
        background-color: #f1ebeb;;
    }
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
                <?php 
                if ($kontroler!="Gost") {
                if ($korisnik->korisnickoIme==$autor->korisnickoIme) {
               echo' <form method="post" action="/Zanatlija/podesavanjeProfila">
                 <button type="submit" class="btn btn-secondary btn-lg" style="float:right">Izmeni profil</button>
                </form>'; }}  ?>
                <h5>Korisničko ime: <?php echo ($autor->korisnickoIme); ?></h5>
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
                <?php 
                if ($kontroler!="Gost") {
                if ($korisnik->korisnickoIme==$autor->korisnickoIme) {
                   
                echo '<h2>Moje reklame</h2>'; }
                else { echo '<h2>Reklame zanatlije</h2>'; }}
                else {echo '<h2>Reklame zanatlije</h2>';}
                ?>
                <br>

                <div class="list-group">
                    <?php
    foreach ($reklame as $reklama) {
         if ($kontroler!="Gost") {
         if ($reklama->odobrena==0 && $korisnik->korisnickoIme!=$autor->korisnickoIme) continue;}
         else { if ($reklama->odobrena==0) continue;}
                  echo  '<a href="/'.$kontroler.'/reklama/'.$reklama->id.'" class="list-group-item list-group-item-action flex-column align-items">
            
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
                          ';
                            if ($kontroler!="Gost") {
                           if ($autor->korisnickoIme==$korisnik->korisnickoIme) {
                             echo '<form method="get" action="';
                           echo site_url("/Zanatlija/brisiReklamu/".$reklama->id);
                           echo'" style="float:right">
                                   
                             
                                <button class="btnAdm"><i class="fa fa-trash" ></i></button>

                            </form>';
                            }} 
                           echo '</div>';
                               
    
  
                  
                 echo ' <div class="d-flex w-100 justify-content-between">
                 
                  <h5 class="mb-1">'.$reklama->nazivRadnje.'</h5>
                    <small>'.$reklama->vremeKreiranja.'</small>
                        
                  </div>
                  <div>
                  '; if ($kontroler!="Gost") {
                    if ($autor->korisnickoIme==$korisnik->korisnickoIme)     {       
                        
                    if ($reklama->odobrena==1) {
                    echo '<h6 style="font-style:italic; float:right; color:green;">Odobrena</h6>'; }
                    else {echo '<h6 style="font-style:italic; float:right; color:#A0A0A0;">Još uvek nije odobrena</h6>';}
                    echo '
                  <p class="mb-1">'.$reklama->opis.'</p>';
                  }
                  else { echo '<p class="mb-1">'.$reklama->opis.'</p>';}
                    } else { echo '
                  <p class="mb-1">'.$reklama->opis.'</p>'; }
                  echo '</div>
                     </div>     
                        
                </a>
                           <br>';
    }
                    ?>
                <br>
                
            </div>
        </div>
         </div>
