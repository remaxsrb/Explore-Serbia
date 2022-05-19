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
     * Funkcija koja obavlja lodjavljivanje korisnika
     *
     * @return void
     */
    public function izlogujSe() {
        $this->session->destroy();
        return redirect()->to(site_url('Gost'));
    }
}
