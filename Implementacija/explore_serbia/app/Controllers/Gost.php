<?php

// by Miloš Brković 0599/2019

namespace App\Controllers;

use App\Models\ObjavaModel;
use App\Models\KorisnikModel;
use App\Models\ReklamaModel;
use App\Models\LokacijaModel;
use App\Models\ObjavaTagModel;
use App\Models\TagModel;


/**
 * Gost – klasa kontroler koja je odgovorna za funkcionalnosti gosta
 *
 * @version 1.0
 */

class Gost extends BaseController
{
    /**
     * @var int $adminTip AdminTip
     */
    private $adminTip = 1;
    /**
     * @var int $pisacTip PisacTip
     */
    private $pisacTip = 2;
    /**
     * @var int $zanatlijaTip ZanatlijaTip
     */
    private $zanatlijaTip = 3;
    
    /**
     * Prikazuje zadati header i stranicu
     * @param string $header Header 
     * @param string $stranica Stranica
     * @param array $podaci Podaci
     *
     * @return void
     */
    protected function prikaz($header, $stranica, $podaci){
        echo view("stranice/$header.php");
        echo view("stranice/$stranica.php", $podaci);
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
        
        $this->prikaz("headerGost", "objave", ["kontroler" => "Gost", "objave" => $objave, "autori" => $autori, "tagoviCssKlase" => $tagoviCssKlase]);
    }
    
    /**
     * Prikazuje sve objave koje odgovaraju trazenom pojmu
     *
     * @return void
     */
    public function pretraga(){
        $pretraga = $this->request->getVar("pretraga");
        if ($pretraga == "") return redirect()->to("Gost/");
        
        $objavaModel = new ObjavaModel();
        $korisnikModel = new KorisnikModel();
        $objavaTagModel = new ObjavaTagModel();
        $tagModel = new TagModel();
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
        
        $this->prikaz("headerGost", "objave", ["kontroler" => "Gost", "objave" => $objave, "autori" => $autori, "tagoviCssKlase" => $tagoviCssKlase]);
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
        
        $this->prikaz("headerGostBezPretrage", "objava", ["objava" => $objava, "autor" => $autor, "reklame" => $reklame, "autoriReklama" => $autoriReklama]);
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
        $autor = $korisnikModel->find($reklama->autor);
        
        $this->prikaz("headerGostBezPretrage", "reklama", ["reklama" => $reklama, "autor" => $autor]);
    }
    
    /**
     * Prikazuje stranicu za registraciju korisnika
     *
     * @return void
     */
    public function registracija($poruka=null){
        $lokacijaModel = new LokacijaModel();
        $lokacije = $lokacijaModel->findAll();
        
        $this->prikaz("headerGostBezPretrage", "registracija", ["lokacije" => $lokacije, "poruka" => $poruka]);
    }
    
    /**
     * Funkcija koja obavlja registraciju korisnika
     *
     * @return void
     */
    public function registrujSe(){
        if (!$this->validate(["ime"=>"required|max_length[20]", "prezime"=>"required|max_length[20]",
                              "pol"=>"required", "email"=>"required|max_length[320]", "lozinka"=>"required",
                              "potvrdaLozinke"=>"required", "tipKorisnika"=>"required", "opstina"=>"required"])){
            return $this->prikaz("headerGostBezPretrage", "registracija", ["errors"=>$this->validator->getErrors()]);
        }
        
        $ime = $this->request->getVar("ime");
        $prezime = $this->request->getVar("prezime");
        $pol = $this->request->getVar("pol");
        $opstina = $this->request->getVar("opstina");
        $korisnickoIme = $this->request->getVar("korisnickoIme");
        $email = $this->request->getVar("email");
        $lozinka = $this->request->getVar("lozinka");
        $potvrdaLozinke = $this->request->getVar("potvrdaLozinke");
        $tipKorisnika = $this->request->getVar("tipKorisnika");
        
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($korisnickoIme);
        
        if($korisnik != null){
            return $this->registracija("Korisnik $korisnickoIme vec postoji");
        }
        
        if ($lozinka != $potvrdaLozinke){
            return $this->registracija("Potvrda lozinke nije ista kao lozinak");
        }
        
        if ($tipKorisnika == "pisac"){
            $tipKorisnika = 2;
        } else if ($tipKorisnika == "zanatlija"){
            $tipKorisnika = 3;
        }
        
        $lozinka = password_hash($lozinka, PASSWORD_DEFAULT);
        
        $korisnikModel->insert([
            "korisnickoIme" => $korisnickoIme,
            "ime" => $ime,
            "prezime" => $prezime,
            "pol" => $pol,
            "email" => $email,
            "lozinka" => $lozinka,
            "slikaURL" => null,
            "tip" => $tipKorisnika,
            "lokacija" => $opstina
        ]);
        
        return redirect()->to(site_url('Gost/'));
    }
    
    /**
     * Prikazuje stranicu za logovanje korisnika
     *
     * @return void
     */
    public function login($poruka = null){
        $this->prikaz("headerGostBezPretrage", "login", ["poruka" => $poruka]);
    }
    
    /**
     * Funkcija koja obavlja logovanje korisnika
     *
     * @return void
     */
    public function ulogujSe(){
        if (!$this->validate(["korisnickoIme"=>"required|max_length[20]", "lozinka"=>"required"])){
            return $this->prikaz("headerGostBezPretrage", "login", ["errors"=>$this->validator->getErrors()]);
        }
        
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($this->request->getVar("korisnickoIme"));
        
        if($korisnik == null){
            return $this->login("Korisnik ne postoji");
        }
        if (!password_verify($this->request->getVar("lozinka"), $korisnik->lozinka)){
            return $this->login("Pogresna lozinka");
        }
        
        $this->session->set("korisnik", $korisnik);
        if ($korisnik->tip == $this->adminTip){
            return redirect()->to(site_url('Admin'));
        } else if ($korisnik->tip == $this->pisacTip){
            return redirect()->to(site_url('Pisac'));
        } else if ($korisnik->tip == $this->zanatlijaTip){
            return redirect()->to(site_url('Zanatlija'));
        }
    }
}
