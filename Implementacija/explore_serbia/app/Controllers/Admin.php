<?php

namespace App\Controllers;

//by Marko Jovanovic 2018/0607
use App\Models\KorisnikModel;
use App\Models\ObjavaModel;
use App\Models\ObjavaTagModel;
use App\Models\ReklamaModel;
use App\Models\TagModel;

class Admin extends BaseController
{
    protected function prikazi($stranica, $header,$podaci)
    {
        echo view("stranice/$header");
        echo view("stranice/$stranica", $podaci);
    }

    public function pretraga(){
        $pretraga = $this->request->getVar("pretraga");
        if ($pretraga == "") return redirect()->to("Admin/");

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

        $this->prikazi("objave", "headerAdmin", ["kontroler" => "Admin", "objave" => $objave, "autori" => $autori, "tagoviCssKlase" => $tagoviCssKlase]);
    }

    public function napisiTekst()
    {
        $this->prikazi("kreiranjeObjave", "headerAdmin",[]);

    }

    public function listaKorisnika()
    {
        $korisnikModel = new KorisnikModel();
        $korisnici = $korisnikModel->orderBy('korisnickoIme', 'asc')->findAll();



        $this->prikazi("listaKorisnikaUSistemu", "headerAdmin",['korisnici'=>$korisnici, 'pager'=>$korisnikModel->pager]);
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

        $this->prikazi("objava", "headerAdmin", ["objava" => $objava, "autor" => $autor, "reklame" => $reklame, "autoriReklama" => $autoriReklama]);
    }

    public function reklama($idReklame){
        $reklamaModel = new ReklamaModel();
        $korisnikModel = new KorisnikModel();

        $reklama = $reklamaModel->find($idReklame);
        $autor = $korisnikModel->find($reklama->autor);

        $this->prikazi("reklama", "headerAdmin", ["reklama" => $reklama, "autor" => $autor]);
    }

    public function listaReklama()
    {
        $reklamaModel = new ReklamaModel();
        $reklame= $reklamaModel->findAll();
        $this->prikazi("listaReklamaUSistemu", "headerAdmin",['reklame'=>$reklame]);
    }
    public function tekstoviZaOdobravanje()
    {
        $objavaModel = new ObjavaModel();
        $objave= $objavaModel->findAll();
        $this->prikazi("listaObjavaZaOdobravanje", "headerAdmin",['objave'=>$objave]);
    }
    public function odobriTekst()
    {
        $objavaModel = new ObjavaModel();
        $objavaModel->ubaci($this->request->getVar("id"));
        return redirect()->to(site_url("Admin/tekstoviZaOdobravanje"));
    }
    public function odbijTekst()
    {
        $objavaModel = new ObjavaModel();
        $objavaModel->izbrisi($this->request->getVar("id"));
        return redirect()->to(site_url("Admin/tekstoviZaOdobravanje"));
    }
    public function tagoviZaOdobravanje()
    {
        $tagModel = new TagModel();
        $tagovi = $tagModel->findAll();
        $this->prikazi("listaTagovaZaOdobravanje", "headerAdmin",['tagovi'=>$tagovi]);
    }
    public function odobriTag()
    {
        $tagModel = new TagModel();
        $tagModel->ubaciTag($this->request->getVar("tag"));
        return redirect()->to(site_url("Admin/tagoviZaOdobravanje"));
    }
    public function odbijTag()
    {
        $tagModel = new TagModel();
        $tagModel->izbrisiTag($this->request->getVar("tag"));
        return redirect()->to(site_url("Admin/tagoviZaOdobravanje"));
    }
    public function reklameZaOdobravanje()
    {
        $reklamaModel = new ReklamaModel();
        $reklame= $reklamaModel->findAll();
        $this->prikazi("listaReklamaZaOdobravanje", "headerAdmin",['reklame'=>$reklame]);
    }
    public function odobriReklamu()
    {
        $reklamaModel = new ReklamaModel();
        $reklamaModel->dodajReklamu($this->request->getVar("reklama"));
        return redirect()->to(site_url("Admin/reklameZaOdobravanje"));
    }
    public function odbijReklamu()
    {
        $reklamaModel = new ReklamaModel();
        $reklamaModel->izbrisiReklamu($this->request->getVar("reklama"));
        return redirect()->to(site_url("Admin/reklameZaOdobravanje"));
    }


    public function izbrisiKorisnika()
    {
        $korisnikModel = new KorisnikModel();
        $korisnikModel->izbrisiKorinsika($this->request->getVar('korisnik'));
        return redirect()->to(site_url("Admin/listaKorisnika"));
    }

    public function dodajAdmina()
    {
        $korisnikModel = new KorisnikModel();
        $korisnikModel->dodajAdministratorskaPrava($this->request->getVar('korisnik'));
        return redirect()->to(site_url("Admin/listaKorisnika"));
    }

    public function podseavanja()
    {
        $this->prikazi("podesavanje", "headerAdmin",[]);
    }
    public function izlogujSe()
    {
        $this->session->destroy();
        return redirect()->to(site_url('/')); //logaut na podrazumevanu stranicu

    }

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

        $this->prikazi("objave", "headerAdmin", ["kontroler" => "Admin", "objave" => $objave, "autori" => $autori, "tagoviCssKlase" => $tagoviCssKlase]);
    }

}
