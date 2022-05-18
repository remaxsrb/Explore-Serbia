<?php

// by Miloš Brković 0599/2019
// by Marko Jovanović 0607/2018
namespace App\Controllers;

use App\Models\ObjavaModel;
use App\Models\KorisnikModel;
use App\Models\ReklamaModel;
use App\Models\LokacijaModel;

class Gost extends BaseController
{
    private $adminTip = 1;
    private $pisacTip = 2;
    private $zanatlijaTip = 3;
    
    protected function prikaz($header, $stranica, $podaci){
        echo view("stranice/$header.php");
        echo view("stranice/$stranica.php", $podaci);
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
        
        $this->prikaz("headerGost", "objave", ["kontroler" => "Gost", "objave" => $objave, "autori" => $autori]);
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
        
        $this->prikaz("headerGostBezPretrage", "objava", ["objava" => $objava, "autor" => $autor, "reklame" => $reklame, "autoriReklama" => $autoriReklama]);
    }
    
    public function reklama($idReklame){
        $reklamaModel = new ReklamaModel();
        $korisnikModel = new KorisnikModel();
        
        $reklama = $reklamaModel->find($idReklame);
        $autor = $korisnikModel->find($reklama->autor);
        
        $this->prikaz("headerGostBezPretrage", "reklama", ["reklama" => $reklama, "autor" => $autor]);
    }
    
    public function registracija($poruka=null){
        $lokacijaModel = new LokacijaModel();
        $lokacije = $lokacijaModel->findAll();
        
        $this->prikaz("headerGostBezPretrage", "registracija", ["lokacije" => $lokacije, "poruka" => $poruka]);
    }
    
    public function registrujSe(){
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
    
    public function login($poruka = null){
        $this->prikaz("headerGostBezPretrage", "login", ["poruka" => $poruka]);
    }
    
    public function ulogujSe(){
        if (!$this->validate(["korisnickoIme"=>"required|max_length[20]", "lozinka"=>"required"])){
            return $this->prikaz("headerGostBezPretrage", "login", ["errors"=>$this->validator->getErrors()]);
        }
        
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($this->request->getVar("korisnickoIme"));
        
        if($korisnik == null){
            return $this->login("Korisnik ne postoji");
        }
        if ($korisnik->lozinka != $this->request->getVar("lozinka")){
            return $this->login("Pogresna lozinka");
        }
        
        $this->session->set("korisnik", $korisnik);
        if ($korisnik->tip == $this->adminTip){
            return redirect()->to(site_url('Admin/index'));
        } else if ($korisnik->tip == $this->pisacTip){
            return redirect()->to(site_url('Pisac'));
        } else if ($korisnik->tip == $this->zanatlijaTip){
            return redirect()->to(site_url('Zanatlija'));
        }
    }
}
