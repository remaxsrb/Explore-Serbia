<!--by Miloš Brković 0599/2019-->

<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12 objava">

            <?php
                if ($autor->slikaURL??null != null){
                    echo '<img src="'.$autor->slikaURL.'" alt="Profile picture" class="imgclass">';
                } else {
                    echo '<img src="/assets/images/img_avatar.png" alt="Profile picture" class="imgclass">';
                }
            
                if ($reklama->autor != null){
                    echo '<a href="#" class="card-link author-link">'.$reklama->autor.'</a>';
                } else {
                    echo '<p>[deleted]</p>';
                }
            ?>
            
            
            <p class="card-date"><?php echo date("d.m.Y", strtotime($reklama->vremeKreiranja)); ?>.</p>
            <h1><?php echo $reklama->nazivRadnje; ?></h1>

            
            <?php
                if ($reklama->slikaURL != null){
                    echo '<img src="'.$reklama->slikaURL.'" alt="Vodenica" class="slia-reklame">';
                } 
                
                if ($reklama->opis != null){
                  echo '<p>'.$reklama->opis.'</p>';
                }
            ?>
            
            
        </div>

        <div class="col-md-4 col-sm-12 reklame">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <p><?php echo $reklama->adresa; ?></p>
                            <i class="fa fa-solid fa-phone"></i>
                            <?php if($reklama->telefon != null) echo '<p>'.$reklama->telefon.'</p>'; ?>
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <?php if($reklama->email != null) echo '<p>'.$reklama->email.'</p>'; ?>
                            <i class="fa fa-link" aria-hidden="true"></i>
                            <?php if($reklama->sajtURL != null) echo '<a href="'.prep_url($reklama->sajtURL).'" target="_blank" style="display: block;">'.$reklama->sajtURL.'</a>'; ?>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>