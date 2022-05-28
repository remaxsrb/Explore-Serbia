<?php
// by Antonija Vasiljević 0501/2019

namespace App\Controllers;

use App\Models\ObjavaModel;
use App\Models\KorisnikModel;
use App\Models\ReklamaModel;
use App\Models\LokacijaModel;
use App\Models\ObjavaTagModel;
use App\Models\TagModel;
use App\Models\OcenaKorisnikObjavaModel;


/**
 * Zanatlija – klasa kontroler koja je odgovorna za funkcionalnosti zanatlije
 *
 * @version 1.0
 */


class Zanatlija extends BaseController
{
       /**
     * Prikazuje zadati header i stranicu
     * @param string $header Header 
     * @param string $stranica Stranica
     * @param array $podaci Podaci
     *
     * @return void
     */
     protected function prikaz($header, $stranica, $podaci){
         if ($this->session->get('korisnik')!=null){
         $podaci['kontroler']='Zanatlija';
      $podaci['korisnik']=$this->session->get('korisnik');
        echo view("stranice/$header.php");
         echo view("stranice/$stranica.php", $podaci);}
         else { echo '<h2>Morate se prijaviti!</h2> <br> <a href="/Gost">Vrati me na početnu stranu</a>';
            
         }
    }
    
     /**
     * Prikazuje pocetnu stranicu sa svim objavama
     *
     * @return void
     */
    public function index()
    {
        $objavaModel = new ObjavaModel();
        $korisnikModel = new KorisnikModel();
        $objavaTagModel = new ObjavaTagModel();
        $tagModel = new TagModel();
        $ocenaKorisniObjavaModel = new OcenaKorisnikObjavaModel();
        
        $korisnikOcene = $ocenaKorisniObjavaModel->where("korisnickoIme", $this->session->get("korisnik")->korisnickoIme)->findAll();
        
        $objave = $objavaModel->orderBy('vremeKreiranja', 'desc')->where('odobrena', 1)->findAll();
        
        $autori = [];
        $tagoviCssKlase = [];
        foreach($objave as $objava){
            $korisnickoIme = $objava->autor;
            $autor = $korisnikModel->find($korisnickoIme);
            array_push($autori, $autor);
            
            $obajaveTagovi = $objavaTagModel->where('objavaID', $objava->id)->findAll();
            $tagCssKlasa = "";
            foreach($obajaveTagovi as $objavaTag){
                $tag = $tagModel->find($objavaTag->tagID);
                switch((int)$tag->kategorija){
                    case 1:
                        $tagCssKlasa.=" istorijskaLicnost";
                        break;
                    case 2:
                        $tagCssKlasa.=" spomenik";
                        break;
                    case 3:
                        $tagCssKlasa.=" crkvaManastir";
                        break;
                    case 4:
                        $tagCssKlasa.=" tvrdjava";
                        break;
                    case 5:
                        $tagCssKlasa.=" areoloskoNalaziste";
                        break;
                    case 6:
                        $tagCssKlasa.=" parkPrirode";
                        break;
                }
            }
            array_push($tagoviCssKlase, $tagCssKlasa);
        }
        
        $this->prikaz("headerZanatlija", "objave", ["kontroler" => "Zanatlija", "objave" => $objave, "autori" => $autori, "tagoviCssKlase" => $tagoviCssKlase, "korisnikOcene" => $korisnikOcene]);
    }
        /**
     * Prikazuje objavu ciji je id zadat kao @param $idObjave
     *
     * @param int $idObjave IdObjave
     *  
     * @return void
     */
    public function objava($idObjave){
        $objavaModel = new ObjavaModel();
        $korisnikModel = new KorisnikModel();
        $reklamaModel = new ReklamaModel();
        $ocenaKorisniObjavaModel = new OcenaKorisnikObjavaModel();
        
        $korisnikOcene = $ocenaKorisniObjavaModel->where("korisnickoIme", $this->session->get("korisnik")->korisnickoIme)->findAll();
        
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
        
        $this->prikaz("headerZanatlijaBezPretrage", "objava", ["objava" => $objava, "autor" => $autor, "reklame" => $reklame, "autoriReklama" => $autoriReklama, "korisnikOcene" => $korisnikOcene]);
    }
       /**
     * Prikazuje sve objave koje odgovaraju trazenom pojmu
     *
     * @return void
     */
    public function pretraga(){
        $pretraga = $this->request->getVar("pretraga");
        if ($pretraga == "") return redirect()->to("Zanatlija/");
        
        $objavaModel = new ObjavaModel();
        $korisnikModel = new KorisnikModel();
        $objavaTagModel = new ObjavaTagModel();
        $tagModel = new TagModel();
        $ocenaKorisniObjavaModel = new OcenaKorisnikObjavaModel();
        
        $korisnikOcene = $ocenaKorisniObjavaModel->where("korisnickoIme", $this->session->get("korisnik")->korisnickoIme)->findAll();
        
        $objave = $objavaModel->orderBy('vremeKreiranja', 'desc')->where('odobrena', 1)->like('naslov', $pretraga)->orLike('tekst', $pretraga)->findAll();
        
        $autori = [];
        $tagoviCssKlase = [];
        foreach($objave as $objava){
            $korisnickoIme = $objava->autor;
            $autor = $korisnikModel->find($korisnickoIme);
            array_push($autori, $autor);
            
            $obajaveTagovi = $objavaTagModel->where('objavaID', $objava->id)->findAll();
            $tagCssKlasa = "";
            foreach($obajaveTagovi as $objavaTag){
                $tag = $tagModel->find($objavaTag->tagID);
                switch((int)$tag->kategorija){
                    case 1:
                        $tagCssKlasa.=" istorijskaLicnost";
                        break;
                    case 2:
                        $tagCssKlasa.=" spomenik";
                        break;
                    case 3:
                        $tagCssKlasa.=" crkvaManastir";
                        break;
                    case 4:
                        $tagCssKlasa.=" tvrdjava";
                        break;
                    case 5:
                        $tagCssKlasa.=" areoloskoNalaziste";
                        break;
                    case 6:
                        $tagCssKlasa.=" parkPrirode";
                        break;
                }
            }
            array_push($tagoviCssKlase, $tagCssKlasa);
        }
        
        $this->prikaz("headerZanatlija", "objave", ["kontroler" => "Zanatlija", "objave" => $objave, "autori" => $autori, "tagoviCssKlase" => $tagoviCssKlase, "korisnikOcene" => $korisnikOcene]);
    }
    
   /**
     * Prikazuje reklamu ciji je id zadat kao @param $idReklame
     *
     * @param int $idReklame IdReklame
     *  
     * @return void
     */
    public function reklama($idReklame){
     
        $reklamaModel = new ReklamaModel();
        $korisnikModel = new KorisnikModel();
    
        $reklama = $reklamaModel->find($idReklame);
       
        if ($reklama==null) { 
            return redirect()->to(site_url("/Zanatlija")); }
        else {
         
        $autor = $korisnikModel->find($reklama->autor);
        
        $this->prikaz("headerZanatlijaBezPretrage", "reklama", ["reklama" => $reklama, "autor" => $autor,"kontroler"=>"Zanatlija"]);
        }
      
    }

        /**
     * Funkcija koja vodi korisnika do strane za kreiranje reklame
     *
     * @return void
     */
    
    public function kreiranjeReklame($poruka=null) {
        $lokacijaModel = new LokacijaModel();
        $lokacije = $lokacijaModel->findAll();
        
        $this->prikaz("headerZanatlijaBezPretrage", "kreiranjeReklame",  ["lokacije" => $lokacije, "poruka" => $poruka]);
    }
       /**
     *  Ova funkcija vadilira se poslate podatke kod kreiranja reklame i,
     * ako su svi podaci validni, salje i kreira ih u bazi
     *
     * @return void
     */
    
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
    
        /**
     * Ova funkcija prikazuje stranu zanatlije cije je korisnicko ime dato
     * 
     * @param string $korIme
     */
    public function profilZanatlije($korIme){
   
   $reklamaModel = new ReklamaModel();
                    $korisnikModel=new KorisnikModel();
                    $autor=$korisnikModel->find($korIme);
       $reklame= $reklamaModel->orderBy('vremeKreiranja', 'desc')->where('autor', $korIme)->findAll();

        
        $this->prikaz("headerZanatlijaBezPretrage", "profilZanatlije", ["kontroler"=>"Zanatlija","korisnik" => $this->session->get('korisnik'), "reklame" => $reklame,"autor"=>$autor]);
       
    }
    
     /**
     * Ova funkcija brise reklamu sa zadatim id iz baze i azurira stranicu korisnickog profila
     * 
     * @param string $id
     */
    public function brisiReklamu($id) {
        $reklamaModel=new ReklamaModel();
    $reklamaModel->delete($id);
       return redirect()->to(site_url("/Zanatlija"));
        
    }
    public function logout(){
        $this->session->destroy();
         return redirect()->to(site_url("/Gost"));
    }
      /**
     * Ova funkcija prikazuje meni za podesavanje profila zanatliji
     * 
     * @param type $poruka
     */
    public function podesavanjeProfila($poruka=null){
        $lokacijaModel = new LokacijaModel();
        $lokacije = $lokacijaModel->findAll();
        
        $this->prikaz("headerZanatlijaBezPretrage", "podesavanjeProfila", ["korisnik"=>$this->session->get('korisnik'),"lokacije"=>$lokacije,"poruka"=>$poruka,"kontroler"=>"Zanatlija"]);
        
    }
      /**
     * Ova funkcija, nakon provere lozinke, azurira sve zeljene podatke ili brise nalog korisnika
     * 
     * @return void
     */
    public function podesiProfil(){
        if (isset($_POST['podesi'])){
            $korisnikModel=new KorisnikModel();
            $slika = $this->request->getVar("slika");
            $ime = $this->request->getVar("ime");
            $prezime = $this->request->getVar("prezime");
            $email = $this->request->getVar("email");
            $lokacija = $this->request->getVar("opstina");
            $trenutnaLozinka = $this->request->getVar("trenutnaLozinka");
            $novaLozinka = $this->request->getVar("novaLozinka");
            $potvrdaNoveLozinke = $this->request->getVar("potvrdaNoveLozinke");

            if (!password_verify($this->request->getVar("trenutnaLozinka"), $this->session->get('korisnik')->lozinka)) {
                return $this->podesavanjeProfila("Pogresna lozinka");
            }

            $lozinka;
            if (!$novaLozinka == ""){
                if ($potvrdaNoveLozinke == $novaLozinka){
                    $lozinka = password_hash($novaLozinka, PASSWORD_DEFAULT);
                } else {
                    return $this->podesavanjeProfila("Lozinke se ne poklapaju!");
                }
            } else {
                $lozinka = $this->session->get('korisnik')->lozinka;
            }


            echo $lozinka;

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
           return redirect()->to(site_url("/Zanatlija/profilZanatlije/$id"));
        } else if (isset($_POST['brisi'])){
            $trenutnaLozinka = $this->request->getVar("trenutnaLozinka");
        
            if (!password_verify($trenutnaLozinka, $this->session->get("korisnik")->lozinka)){
                return $this->podesavanjeProfila("Pogresna lozinka");
            } else {
                $korisnikModel=new KorisnikModel();
                $korisnikModel->izbrisiKorisnika($this->session->get('korisnik')->korisnickoIme);
                $this->session->destroy();
                return redirect()->to(site_url('/Zanatlija'));
            }
        }
    }
//     /**
//     * Ova funkcija sluzi za ocenjivanje objave sa datim id od strane korisnika sa datim id 
//     * 
//     * @param string $idObjave, string $imeKorisnika, string $ocena
//     */
    
//    public function ocenjivanje($idObjave, $imeKorisnika, $ocena) {
//        
//        $objavaModel = new ObjavaModel();
//        $korisnikModel = new KorisnikModel();
//        $ocenaKorisnikObjavaModel = new OcenaKorisnikObjavaModel();
//        
//        $lastOcena = $ocenaKorisnikObjavaModel->orderBy("id", "desc")->findAll(1);
//        if ($lastOcena == null) {
//            $ocenaId = 1;
//        } else {
//            $ocenaId = $lastOcena[0]->id + 1;
//        }
//        
//        $ocenaKorisnikObjavaModel->insert([
//            "id" => $ocenaId,
//            "korisnickoIme" => $imeKorisnika,
//            "objava" => $idObjave,
//            "ocena" => $ocena
//        ]);
//        
//        $objava = $objavaModel->find($idObjave);
//        $objava->brojOcena++;
//        $objava->sumaOcena += $ocena;
//        
//        $avgOcena = $objava->sumaOcena / $objava->brojOcena;
//        
//        $objavaModel->update($idObjave, $objava);
//        
//        
//        
//        echo $avgOcena;
//    }
    
//    /**
//     * Ova funkcija prikazuje stranu pisca cije je korisnicko ime dato
//     * 
//     * @param string $korIme
//     */
//    public function profilPisac($korIme) {
//        $lokacijaModel = new LokacijaModel();
//        $objavaModel = new ObjavaModel();
//        $korisnikModel = new KorisnikModel();
//        
//        $autor = $korisnikModel->where("tip", 2)->find($korIme);
//        
//        if ($autor == null) {
//            return;
//        }
//        $lokacija = $lokacijaModel->find($autor->lokacija);
//        $objave = $objavaModel->where("autor", $autor->korisnickoIme)->findAll();
//        
//        $this->prikaz("headerZanatlija", "profilPisac", ["kontroler" => "Zanatlija", "korisnik" => $this->session->get("korisnik"), "lokacija" => $lokacija, "objave" => $objave, "autor" => $autor]);
//    }
    
    public function ocenjivanje($idObjave, $imeKorisnika, $ocena) {
        
        $objavaModel = new ObjavaModel();
        $korisnikModel = new KorisnikModel();
        $ocenaKorisnikObjavaModel = new OcenaKorisnikObjavaModel();
        
        $lastOcena = $ocenaKorisnikObjavaModel->orderBy("id", "desc")->findAll(1);
        if ($lastOcena == null) {
            $ocenaId = 1;
        } else {
            $ocenaId = $lastOcena[0]->id + 1;
        }
        
        $ocenaKorisnikObjavaModel->insert([
            "id" => $ocenaId,
            "korisnickoIme" => $imeKorisnika,
            "objava" => $idObjave,
            "ocena" => $ocena
        ]);
        
        $objava = $objavaModel->find($idObjave);
        $objava->brojOcena++;
        $objava->sumaOcena += $ocena;
        
        $avgOcena = $objava->sumaOcena / $objava->brojOcena;
        
        $objavaModel->update($idObjave, $objava);
        
        
        
        echo $avgOcena;
    }
    
    /**
     * Ova funkcija prikazuje stranu pisca cije je korisnicko ime dato
     * 
     * @param string $korIme
     */
    public function profilPisac($korIme) {
        $lokacijaModel = new LokacijaModel();
        $objavaModel = new ObjavaModel();
        $korisnikModel = new KorisnikModel();
        
        $autor = $korisnikModel->where("tip", 2)->find($korIme);
        
        if ($autor == null) {
            return;
        }
        $lokacija = $lokacijaModel->find($autor->lokacija);
        $objave = $objavaModel->where("autor", $autor->korisnickoIme)->findAll();
        
        $this->prikaz("headerZanatlija", "profilPisac", ["kontroler" => "Zanatlija", "korisnik" => $this->session->get("korisnik"), "lokacija" => $lokacija, "objave" => $objave, "autor" => $autor]);
    }
    
}
