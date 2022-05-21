<?php

// by Nikola Bjelobaba 0442/2019
namespace App\Controllers;

use App\Models\ObjavaModel;
use App\Models\KorisnikModel;
use App\Models\ReklamaModel;
use App\Models\LokacijaModel;
use App\Models\ObjavaTagModel;
use App\Models\TagModel;
/**
 * Pisac – klasa kontroler koja je odgovorna za funkcionalnosti pisca
 *
 * @version 1.0
 */

class Pisac extends BaseController
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
        echo view("stranice/$header.php", $podaci);
        echo view("stranice/$stranica.php", $podaci);
    }
    
    
    /**
     * Prikazuje pocetnu stranicu sa svim objavama
     *
     * @return void
     */
    
    public function index() {
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
        
        $this->prikaz("headerPisac", "objave", ["kontroler" => "Pisac", "objave" => $objave, "autori" => $autori, "tagoviCssKlase" => $tagoviCssKlase]);
    }
    
    /**
     * Prikazuje sve objave koje odgovaraju trazenom pojmu
     *
     * @return void
     */
    public function pretraga(){
        $pretraga = $this->request->getVar("pretraga");
        if ($pretraga == "") return redirect()->to("Pisac/");
        
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
        
        $this->prikaz("headerPisac", "objave", ["kontroler" => "Pisac", "objave" => $objave, "autori" => $autori, "tagoviCssKlase" => $tagoviCssKlase]);
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
        
        $this->prikaz("headerPisac", "objava", ["objava" => $objava, "autor" => $autor, "reklame" => $reklame, "autoriReklama" => $autoriReklama]);
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
        
        $this->prikaz("headerPisac", "reklama", ["reklama" => $reklama, "autor" => $autor]);
    }
    
     /**
     * Funkcija koja obavlja lodjavljivanje korisnika
     *
     * @return void
     */
    public function izlogujSe() {
        $this->session->destroy();
        return redirect()->to(site_url('Gost'));
    }
    
    /**
     * Funkcija koja vodi korisnika do strane za kreiranje objave
     *
     * @return void
     */
    
    public function kreiranjeObjave() {
        
        $tagModel = new TagModel();
        $lokacijaModel = new LokacijaModel();
        $allTags;
        $tagoviIL = $tagModel->where("kategorija", "1")->Where("odobren", "1")->findAll();
        // pocinje od 1 umesto 0 da bi se poklapao da id tagType-a
        $allTags[1] = $tagoviIL;
        
        $tagoviIL = $tagModel->where("kategorija", "2")->Where("odobren", "1")->findAll();
        $allTags[2] = $tagoviIL;
        
        $tagoviIL = $tagModel->where("kategorija", "3")->Where("odobren", "1")->findAll();
        $allTags[3] = $tagoviIL;
        
        $tagoviIL = $tagModel->where("kategorija", "4")->Where("odobren", "1")->findAll();
        $allTags[4] = $tagoviIL;
        
        $tagoviIL = $tagModel->where("kategorija", "5")->Where("odobren", "1")->findAll();
        $allTags[5] = $tagoviIL;
        
        $tagoviIL = $tagModel->where("kategorija", "6")->Where("odobren", "1")->findAll();
        $allTags[6] = $tagoviIL;
        
        $allLoks = $lokacijaModel->findAll();
        
        $this->session->set("allTags", $allTags);
        $this->session->set("allLoks", $allLoks);
        $this->prikaz("headerPisac", "kreiranjeObjave", ["greske" => []]);
        //"allTags" => $allTags]
    }
    
    /**
     * Ova funkcija vadilira se poslate podatke kod kreiranja objave i,
     * ako su svi podatci validni, salje kreira ih u bazi
     * 
     * @return void
     */
    
    public function slanjeObjave() {
        
        $objavaModel = new ObjavaModel();
        $tagModel = new TagModel();
        $objavaTagModel = new ObjavaTagModel();
        
        if (!$this->validate([ "naslovObjave" => "required|max_length[120]", "regionObjave" => "required",
            "objavaTextArea" => "required", "mainTagTip" => "required", "mainTag" => "required"
        ])) {
             if ($this->request->getVar("mainTag") == "Novi tag"){
                 $this->validate (["noviMainTag" => "required|max_lenght[120]"]);
             }
            return $this->prikaz("headerPisac", "kreiranjeObjave", ["greske" => $this->validator->getErrors()]);
        }
        
        if ($this->request->getVar("mainTag") == "Novi tag") {
            if (!$this->validate(["noviMainTag" => "required|max_length[120]"])) {
                return $this->prikaz("headerPisac", "kreiranjeObjave", ["greske" => $this->validator->getErrors()]);
            }
        }
        
        $korisnik = $this->session->get("korisnik");
        
        $naslov = $this->request->getVar("naslovObjave");
        $region = $this->request->getVar("regionObjave");
        $sadrzaj = $this->request->getVar("objavaTextArea");
        $glavniTagTip = $this->request->getVar("mainTagTip");
        $glavniTag = $this->request->getVar("mainTag");
        $glavniTagSpace = $this->request->getVar("noviMainTag");
        
        $secTagNum = $this->request->getVar("numOftags");
        
        $secTagTip = [];
        $secTag = [];
        $secTagSpace = [];
        
        for ($i = 0; $i < $secTagNum; $i++) {
            $secTagTip[$i] = $this->request->getVar("secTagType".$i);
            $secTag[$i] = $this->request->getVar("secTag".$i);
            $secTagSpace[$i] = $this->request->getVar("secNovTag".$i);
        }
        
        
        $lastObjava = $objavaModel->orderBy("id", "desc")->findAll(1);
        $id = $lastObjava[0]->id + 1;
        $lokacijaModel = new LokacijaModel();
        $lokacija = $lokacijaModel->where("naziv", $region)->findAll();
        
        $objavaModel->insert([
            "id" => $id,
            "naslov" => $naslov,
            "tekst" => $sadrzaj,
            "brojOcena" => 0,
            "sumaOcena" => 0,
            "odobrena" => 0,
            "vremeKreiranja" => date("Y-m-d"),
            "autor" => $korisnik->korisnickoIme,
            "lokacija" => $lokacija[0]->id
        ]);
        
        //Ubacivanje relacije glavnog taga i objave
        if ($glavniTag != "Novi tag") {
            $tag = $tagModel->where("naziv", $glavniTag)->findAll(1);
            $tagId = $tag[0]->id;
            
            $objavaTagModel->insert([
                "objavaID" => $id,
                "tagID" => $tagId
             
            
            ]);
        } else {
            //pravljenje novog taga
            $oldTag = $tagModel->orderBy("id", "desc")->findAll(1);
            $tagId = $oldTag[0]->id + 1;
            
            $tagTipId;
            
            switch ($glavniTagTip) {
                case "Istorijska ličnost": $tagTipId = 1;
                    break;
                case "Spomenik": $tagTipId = 2;
                    break;
                case "Crkva/manastir": $tagTipId = 3;
                    break;
                case "Tvrdjava": $tagTipId = 4;
                    break;
                case "Arheološko nalazište": $tagTipId = 5;
                    break;
                case "Park prirode": $tagTipId = 6;
                    break;
            }
            
            $tagModel->insert([
                "id" => $tagId,
                "naziv" => $glavniTagSpace,
                "odobren" => 0,
                "kategorija" => $tagTipId
            ]);
            
            $objavaTagModel->insert([
                "objavaID" => $id,
                "tagID" => $tagId
            ]);
            
        }
        
        //ubacivanje sekundarnih tagova
        for ($i = 0; $i < $secTagNum; $i++) {
            $secTagTip = $this->request->getVar("secTagType".$i);
            $secTag = $this->request->getVar("secTag".$i);
            $secTagSpace = $this->request->getVar("secNovTag".$i);
            
            if ($secTag != "Novi tag") {
                $tag = $tagModel->where("naziv", $secTag)->findAll(1);
                $tagId = $tag[0]->id;
            
                $objavaTagModel->insert([
                    "objavaID" => $id,
                    "tagID" => $tagId
                ]);
            } else {
                //pravljenje novog taga
                $oldTag = $tagModel->orderBy("id", "desc")->findAll(1);
                $tagId = $oldTag[0]->id + 1;
            
                $tagTipId;
            
                switch ($secTagTip) {
                    case "Istorijska ličnost": $tagTipId = 1;
                        break;
                    case "Spomenik": $tagTipId = 2;
                        break;
                    case "Crkva/manastir": $tagTipId = 3;
                        break;
                    case "Tvrdjava": $tagTipId = 4;
                        break;
                    case "Arheološko nalazište": $tagTipId = 5;
                        break;
                    case "Park prirode": $tagTipId = 6;
                        break;
                }
            
                $tagModel->insert([
                    "id" => $tagId,
                    "naziv" => $secTagSpace,
                    "odobren" => 0,
                    "kategorija" => $tagTipId
                ]);
            
                $objavaTagModel->insert([
                    "objavaID" => $id,
                    "tagID" => $tagId
                ]);
            
            }
            
        }
        
        return $this->index();
       
         
    }
    
    /**
     * Ova funkcija vodi do stranice profila korisnika
     * 
     * @return void
     */
    public function profil() {
        
        $lokacijaModel = new LokacijaModel();
        $objavaModel = new ObjavaModel();
        
        
        $korisnik = $this->session->get("korisnik");
        $lokacija = $lokacijaModel->find($korisnik->lokacija);
        $objave = $objavaModel->where("autor", $korisnik->korisnickoIme)->findAll();
        
        $this->prikaz("headerPisac", "profilPisac", ["kontroler" => "Pisac", "korisnik" => $korisnik, "lokacija" => $lokacija, "objave" => $objave]);
    }
    
    /**
     * Ova funkcija brise objavu iz baze i azurira stranicu korisnickog profila
     * 
     * @param int $objavaId
     * @return void
     */
    
    public function brisiObjavu($objavaId) {
        $objavaModel = new ObjavaModel();
        $objavaTagModel = new ObjavaTagModel();
        
        if ($objavaId == null)
            return;
        
        
        $tagoviObjave = $objavaTagModel->where("objavaID", $objavaId)->findAll();
        
        foreach($tagoviObjave as $tagObjave) {
            $objavaTagModel->delete($objavaId);
        }
        
        $objavaModel->izbrisi ($objavaId);
        
        $this->profil();
    }
    
}
