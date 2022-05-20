<!--by Antonija Vasiljević 0501/2019 -->
<?php

namespace App\Controllers;

use App\Models\ObjavaModel;
use App\Models\KorisnikModel;
use App\Models\ReklamaModel;
use App\Models\LokacijaModel;

class Zanatlija extends BaseController
{
     protected function prikaz($header, $stranica, $podaci){
         if ($this->session->get('korisnik')!=null){
         $podaci['kontroler']='Zanatlija';
      $podaci['korisnik']=$this->session->get('korisnik');
        echo view("stranice/$header.php");
         echo view("stranice/$stranica.php", $podaci);}
         else { echo '<h2>Morate se prijaviti!</h2> <br> <a href="/Gost">Vrati me na početnu stranu</a>';
            
         }
    }
    
    public function index()
    {
       $objavaModel = new ObjavaModel();
        $korisnikModel = new KorisnikModel();
        $objave = $objavaModel->orderBy('vremeKreiranja', 'desc')->where('odobrena', 1)->findAll();
        
        $autori = [];
        foreach($objave as $objava){
            $korisnickoIme = $objava->autor;
            $autor = $korisnikModel->find($korisnickoIme);
            array_push($autori, $autor);
        }
        
        $this->prikaz("headerZanatlija", "objave", ["kontroler" => "Zanatlija", "objave" => $objave, "autori" => $autori]);
    }
    
    public function objava($idObjave){
        $objavaModel = new ObjavaModel();
        $korisnikModel = new KorisnikModel();
        $reklamaModel = new ReklamaModel();
        
        $objava = $objavaModel->find($idObjave);
        $autor = $korisnikModel->find($objava->autor);
        $reklame = $reklamaModel->where('odobrena', 1)->where('lokacija', $objava->lokacija)->findAll();
        if (!empty($reklame)){
            shuffle($reklame);
            $reklame = array_chunk($reklame, 3)[0];
        }
        
        
        $autoriReklama = [];
        foreach($reklame as $reklama){
            $korisnickoIme = $reklama->autor;
            $autorReklame = $korisnikModel->find($korisnickoIme);
            array_push($autoriReklama, $autorReklame);
        }
        
        $this->prikaz("headerZanatlijaBezPretrage", "objava", ["objava" => $objava, "autor" => $autor, "reklame" => $reklame, "autoriReklama" => $autoriReklama]);
    }
    
 
    
    public function reklama($idReklame){
     
        $reklamaModel = new ReklamaModel();
        $korisnikModel = new KorisnikModel();
    
        $reklama = $reklamaModel->find($idReklame);
        if ($reklama!=null){
        $autor = $korisnikModel->find($reklama->autor);
        
        $this->prikaz("headerZanatlijaBezPretrage", "reklama", ["reklama" => $reklama, "autor" => $autor]);
        
        }
        else {
            return redirect()->to(site_url("/Zanatlija"));
        }
    }

    
    public function kreiranjeReklame() {
        $lokacijaModel = new LokacijaModel();
        $lokacije = $lokacijaModel->findAll();
        
        $this->prikaz("headerZanatlijaBezPretrage", "kreiranjeReklame",  ["lokacije" => $lokacije, "poruka" => $poruka]);
    }
   
    public function kreirajReklamu() {

        
         $reklamaModel=new ReklamaModel();
        $naziv = $this->request->getVar("nazivRadnje");
        $region = $this->request->getVar("region");
        $slika = $this->request->getVar("slikaURL");
        $opis = $this->request->getVar("opis");
        $adresa = $this->request->getVar("adresa");
        $telefon= $this->request->getVar("telefon");
        $email = $this->request->getVar("mejl");
        $link = $this->request->getVar("link");
         $datumKreiranja=date('Y-m-d');
         $autor=$this->session->get('korisnik');

         
         $reklamaModel->save([
            "nazivRadnje" => $naziv,
            "opis" => $opis,
            "slikaURL" => $slika,
            "adresa" => $adresa,
            "telefon" => $telefon,
            "email" => $email,
            "sajtURL" => $link,
            "vremeKreiranja" => $datumKreiranja,
            "odobrena" => 0,
            "autor" => $autor->korisnickoIme,
            "lokacija"=>$region
                 
        ]);
        
        return redirect()->to(site_url("/Zanatlija/reklama/{$reklamaModel->getInsertID()}"));
         
     
    }
    
    
    public function profilZanatlije(){
   
   $reklamaModel = new ReklamaModel();
 
       $reklame= $reklamaModel->orderBy('vremeKreiranja', 'desc')->where('autor', $this->session->get('korisnik')->korisnickoIme)->findAll();

        
        $this->prikaz("headerZanatlijaBezPretrage", "profilZanatlije", ["autor" => $this->session->get('korisnik'), "reklame" => $reklame]);
       
    }
    public function brisiReklamu($id) {
        $reklamaModel=new ReklamaModel();
    $reklamaModel->delete($id);
       return redirect()->to(site_url("/Zanatlija"));
        
    }
    public function logout(){
        $this->session->destroy();
         return redirect()->to(site_url("/Gost"));
    }
    public function podesavanjeProfila($poruka=null){
        $lokacijaModel = new LokacijaModel();
        $lokacije = $lokacijaModel->findAll();
        
        $this->prikaz("headerZanatlijaBezPretrage", "podesavanjeProfila", ["korisnik"=>$this->session->get('korisnik'),"lokacije"=>$lokacije,"poruka"=>$poruka,"kontroler"=>"Zanatlija"]);
        
    }
    public function podesiProfil(){
      
    if (isset($_POST['podesi'])) {
      $korisnikModel=new KorisnikModel();
        $slika = $this->request->getVar("slika");
        $ime = $this->request->getVar("ime");
        $prezime = $this->request->getVar("prezime");
        $email = $this->request->getVar("email");
        $lozinka = $this->request->getVar("lozinka");
        $lokacija = $this->request->getVar("opstina");
        if ($this->request->getVar("potvrdaLozinke")!=$lozinka) {
            return $this->podesavanjeProfila("Lozinke se ne poklapaju!");
        }
          $id=$this->session->get('korisnik')->korisnickoIme;
         $data=[
             'korisnickoIme'=>$id,
            'ime' => $ime,
            "prezime" => $prezime,
            "slikaURL" => $slika,
           "lokacija" => $lokacija,
            "lozinka" => $lozinka,
            "email" => $email,
           
                 
        ];
        
        
        $korisnikModel->save($data);
        $this->session->set('korisnik',$korisnikModel->find($id));
       return redirect()->to(site_url("/Zanatlija/profilZanatlije"));
    }
    elseif (isset($_POST['brisi'])) {
         if ($this->request->getVar("potvrdaLozinke")!=$this->request->getVar("lozinka")) {
            return $this->podesavanjeProfila("Lozinke se ne poklapaju!");
        }
            $korisnikModel=new KorisnikModel();
            $korisnikModel->izbrisiKorisnika($this->session->get('korisnik')->korisnickoIme);
            $this->session->destroy();
            return redirect()->to(site_url('/'));
        }
    }

       
    
        
        }
