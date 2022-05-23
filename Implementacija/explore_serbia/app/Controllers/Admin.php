<?php

namespace App\Controllers;

//by Marko Jovanovic 2018/0607
//by Antonija Vasiljević 2019/0501
//by Nikola Bjelobaba 2019/0442
use App\Models\KorisnikModel;
use App\Models\ObjavaModel;
use App\Models\ObjavaTagModel;
use App\Models\ReklamaModel;
use App\Models\TagModel;
use App\Models\LokacijaModel;
use App\Models\OcenaKorisnikObjavaModel;
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

        $this->prikazi("objave", "headerAdmin", ["kontroler" => "Admin", "objave" => $objave, "autori" => $autori, "tagoviCssKlase" => $tagoviCssKlase, "korisnikOcene" => $korisnikOcene]);
    }

    public function napisiTekst()
    {
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

        $this->prikazi("kreiranjeObjave", "headerAdmin", ["greske" => []]);

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

        $this->prikazi("objava", "headerAdmin", ["objava" => $objava, "autor" => $autor, "reklame" => $reklame, "autoriReklama" => $autoriReklama, "korisnikOcene" => $korisnikOcene, "kontroler"=>"Admin"]);
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
            return redirect()->to(site_url("/Admin")); }
        else {
         
        $autor = $korisnikModel->find($reklama->autor);
        
        $this->prikazi("reklama","headerAdmin" , ["reklama" => $reklama, "autor" => $autor,"kontroler"=>"Admin"]);
        }
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

        $this->prikazi("objave", "headerAdmin", ["kontroler" => "Admin", "objave" => $objave, "autori" => $autori, "tagoviCssKlase" => $tagoviCssKlase, "korisnikOcene" => $korisnikOcene]);
    }
    public function brisiBiloKojuReklamu($id) {
        $reklamaModel=new ReklamaModel();
    $reklamaModel->delete($id);
       return redirect()->to(site_url("/Admin/listaReklama"));
  }
  
    /**
     * Ova funkcija prikazuje meni za podesavanje profila adminu
     * 
     * @param type $poruka
     */
    public function podesavanjeProfila($poruka=null){
        $lokacijaModel = new LokacijaModel();
        $lokacije = $lokacijaModel->findAll();
        
        $this->prikazi("podesavanjeProfila", "headerAdmin", ["korisnik"=>$this->session->get('korisnik'),"lokacije"=>$lokacije,"poruka"=>$poruka,"kontroler"=>"Admin"]);
        
    }
    public function profilAdmina(){

        $this->prikazi("profilAdmina", "headerAdmin", ["korisnik" => $this->session->get('korisnik')]);
       
    
    }
    
    /**
     * Ova funkcija brise reklamu sa zadatim id iz baze i azurira stranicu sa izlistanim reklamama
     * 
     * @param string $id
     */
      public function brisiReklamu($id) {
        $reklamaModel=new ReklamaModel();
    $reklamaModel->delete($id);
       return redirect()->to(site_url("/Admin"));
        
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

        
        $this->prikazi("profilZanatlije", "headerAdmin", ["kontroler"=>"Admin","korisnik" => $this->session->get('korisnik'), "reklame" => $reklame,"autor"=>$autor]);
       
    }
    
    /**
     * Ova funkcija brise objavu ciji je id dodeljen,
     * i birse sve veze ObjavaTag kojima je ta objava pripadala
     * 
     * 
     * @param int $idObjava
     */
    public function brisanjeBiloKojeObjave($idObjava) {
        $objavaModel = new ObjavaModel();
        $objavaTagModel = new ObjavaTagModel();
        
        if ($idObjava == null)
            return;
        
        $tagoviObjave = $objavaTagModel->where("objavaID", $idObjava)->findAll();
        
        foreach($tagoviObjave as $tagObjave) {
            $objavaTagModel->delete($idObjava);
        }
        
        $objavaModel->izbrisi ($idObjava);
        $this->index();
        
        
        
    }
    
      /**
     * Ova funkcija sluzi za ocenjivanje objave sa datim id od strane korisnika sa datim id 
     * 
     * @param string $idObjave, string $imeKorisnika, string $ocena
     */
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
        
        $this->prikazi("profilPisac", "headerAdmin", ["kontroler" => "Admin", "korisnik" => $this->session->get("korisnik"), "lokacija" => $lokacija, "objave" => $objave, "autor" => $autor]);
    }

}
