<?php
namespace App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTester;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Config\Factories;



class GostControllerTest extends CIUnitTestCase {
    
    use ControllerTester;
    use DatabaseTestTrait;
    
    
    // For Migrations
    protected $migrate = true;
    protected $migrateOnce = false;
    protected $refresh     = true;
    protected $namespace   = 'Tests\Support';
    
    
    protected function setUp(): void {
        parent::setUp();
    }
    
    protected function tearDown(): void {
        parent::tearDown();
        
    }

     public function testIndexBezObjava() {
        
        
        $ObjavaModel = new \App\Models\ObjavaModel();
        $objave = $ObjavaModel->findAll();
        
        foreach ($objave as $obj) {
            $ObjavaModel->update($obj->id, ["odobrena" => 0]);
        }
        
        $result = $this->controller("App\Controllers\Gost")->execute("index");
        
        $objavaModel = new \App\Models\ObjavaModel();
        
        foreach ($objave as $obj) {
            if ($obj->id != 11)
            $ObjavaModel->update($obj->id, ["odobrena" => 1]);
        }
        
        $this->assertTrue($result->see('Explore Serbia', 'a'));
        $result->assertEmpty("objave");
        
    }
    
    
    public function testIndexSaObjavama() {
        
        $result = $this->controller("App\Controllers\Gost")->execute("index");
        
        $objavaModel = new \App\Models\ObjavaModel();
        
        $objave = $objavaModel->where("odobrena", 1)->findAll();
        
        $this->assertTrue($result->see('Explore Serbia', 'a'));
        $result->assertNotEmpty('objave');
        foreach ($objave as $obj) {
            $this->assertTrue($result->see($obj->naslov, 'h3'));
            if ($obj->autor != null) {
                $this->assertTrue($result->see($obj->autor), 'a');
            } else {
                $this->assertTrue($result->see("[deleted]"));
            }
        }
        
        
        
    }
    
    public function testUspesnoLogovanje() {
        
        
        $result = $this->withUri('http://localhost:8080/Gost/login')->
              controller("App\Controllers\Gost")->execute("login");
        
        
        $_REQUEST['korisnickoIme']='nikola';
        $_REQUEST['lozinka']='nikola123';
        
        $result = $this->withUri('http://localhost:8080/Gost/ulogujSe')->
              controller("App\Controllers\Gost")->execute("ulogujSe");
        
        $result->assertRedirectTo("http://localhost:8080/Pisac");
         
        
        
        
    }
     
    public function testLogovanjeBezKorImena() {
        
        
        $result = $this->withUri('http://localhost:8080/Gost/login')->
              controller("App\Controllers\Gost")->execute("login");
        
        
        $_REQUEST['korisnickoIme']='';
        $_REQUEST['lozinka']='nikola123';
        
        $result = $this->withUri('http://localhost:8080/Gost/ulogujSe')->
              controller("App\Controllers\Gost")->execute("ulogujSe");
        
        $result->assertNotRedirect();
    }
    
    public function testLogovanjeBezLozinke() {
        
        
        $result = $this->withUri('http://localhost:8080/Gost/login')->
              controller("App\Controllers\Gost")->execute("login");
        
        
        $_REQUEST['korisnickoIme']='nikola';
        $_REQUEST['lozinka']='';
        
        $result = $this->withUri('http://localhost:8080/Gost/ulogujSe')->
              controller("App\Controllers\Gost")->execute("ulogujSe");
        
        $result->assertNotRedirect();
    }
    
    public function testLogovanjePogresnoKorIme() {
        
        
        $result = $this->withUri('http://localhost:8080/Gost/login')->
              controller("App\Controllers\Gost")->execute("login");
        
        
        $_REQUEST['korisnickoIme']='nikkoollaa';
        $_REQUEST['lozinka']='nikola123';
        
        $result = $this->withUri('http://localhost:8080/Gost/ulogujSe')->
              controller("App\Controllers\Gost")->execute("ulogujSe");
        
        
        $result->assertNotRedirect();
        
    }
    
    public function testLogovanjePogresnaLoznika() {
        
        
        $result = $this->withUri('http://localhost:8080/Gost/login')->
              controller("App\Controllers\Gost")->execute("login");
        
        
        $_REQUEST['korisnickoIme']='nikola';
        $_REQUEST['lozinka']='nikola321';
        
        $result = $this->withUri('http://localhost:8080/Gost/ulogujSe')->
              controller("App\Controllers\Gost")->execute("ulogujSe");
        
        
        $result->assertNotRedirect();
        
    }
    
    public function testObjava() {
        
        $objavaModel = new \App\Models\ObjavaModel();
        
        $objave = $objavaModel->where("odobrena", 1)->findAll();
        
        
        foreach ($objave as $objava) {
            $result = $this->withUri('http://localhost:8080/Gost/objava')->
                controller("App\Controllers\Gost")->execute("objava", $objava->id);
        
        
        
            $this->assertTrue($result->see($objava->naslov, 'h1'));
            if ($objava->autor != null) {
                $this->assertTrue($result->see($objava->autor), 'a');
            } else {
                $this->assertTrue($result->see('deleted'));
            }
            $this->assertTrue(true);
        }
        
    }
    
    public function testPretragaBezTeksta() {
        
        $_REQUEST["pretraga"] = '';
       
        $result = $this->withUri('http://localhost:8080/Gost/pretraga')->
              controller("App\Controllers\Gost")->execute("pretraga");
        
        // Ne znam zasto redirect vodi to ove adrese, ali u projektu ovo radi kako treba
        $this->assertEquals('http://example.com/Gost/', $result->getRedirectUrl());
        
    }
     
    public function testPretragaSaTekstom() {
        $_REQUEST["pretraga"] = 'Dusan Silni';
       
        $result = $this->withUri('http://localhost:8080/Gost/pretraga')->
              controller("App\Controllers\Gost")->execute("pretraga");
        
        $result->assertNotEmpty('objave');
        $this->assertTrue($result->see('Car Dusan Silni', 'a'));
        $this->assertFalse($result->see('Tara', 'a'));
    }
    
    public function testUspesnoRegistrovanje() {
        
        $LokacijaModel = new \App\Models\LokacijaModel();
        $lokacije = $LokacijaModel->findAll();
        
        $result = $this->controller("App\Controllers\Gost")->execute("index");
        
        $result = $this->withUri('http://localhost:8080/Gost/registracija/')->
              controller("App\Controllers\Gost")->execute("registracija");
        
        $_REQUEST['ime'] = 'Mile';
        $_REQUEST['prezime'] = "Milicevic";
        $_REQUEST['pol'] = "musko";
        $_REQUEST['email'] = 'mile@gmail.com';
        $_REQUEST['lozinka'] = 'mile123';
        $_REQUEST['potvrdaLozinke'] = 'mile123';
        $_REQUEST['tipKorisnika'] = 'pisac';
        $_REQUEST['opstina'] = 144;
        $_REQUEST['korisnickoIme'] = 'mile';
        
        
        
        $result = $this->withUri('http://localhost:8080/Gost/registrujSe/')->withBody([])->
              controller("App\Controllers\Gost")->execute('registrujSe');
        
        
        
        $result->assertRedirect();
       
        $korisnikModel = new \App\Models\KorisnikModel();
        $korisnikModel->delete('mile');
         
    }
    
    public function testRegistrovanjeBezImena() {
        $result = $this->controller("App\Controllers\Gost")->execute("index");
        
        $result = $this->withUri('http://localhost:8080/Gost/registracija/')->
              controller("App\Controllers\Gost")->execute("registracija");
        
        $_REQUEST['ime'] = '';
        $_REQUEST['prezime'] = "Milicevic";
        $_REQUEST['pol'] = "musko";
        $_REQUEST['email'] = 'mile@gmail.com';
        $_REQUEST['lozinka'] = 'mile123';
        $_REQUEST['potvrdaLozinke'] = 'mile123';
        $_REQUEST['tipKorisnika'] = 'pisac';
        $_REQUEST['opstina'] = 144;
        $_REQUEST['korisnickoIme'] = 'mile';
        
        $result = $this->withUri('http://localhost:8080/Gost/registrujSe/')->
              controller("App\Controllers\Gost")->execute('registrujSe');
        
        
        $result->assertNotRedirect();
        $this->dontSeeInDatabase("korisnik", ['korisnickoIme' => 'mile']);
        
        $korisnikModel = new \App\Models\KorisnikModel();
        $korisnikModel->delete('mile');
    }
    
    public function testRegistrovanjeBezPrezimena() {
        $result = $this->controller("App\Controllers\Gost")->execute("index");
        
        $result = $this->withUri('http://localhost:8080/Gost/registracija/')->
              controller("App\Controllers\Gost")->execute("registracija");
        
        $_REQUEST['ime'] = 'Mile';
        $_REQUEST['prezime'] = "";
        $_REQUEST['pol'] = "musko";
        $_REQUEST['email'] = 'mile@gmail.com';
        $_REQUEST['lozinka'] = 'mile123';
        $_REQUEST['potvrdaLozinke'] = 'mile123';
        $_REQUEST['tipKorisnika'] = 'pisac';
        $_REQUEST['opstina'] = 144;
        $_REQUEST['korisnickoIme'] = 'mile';
        
        $result = $this->withUri('http://localhost:8080/Gost/registrujSe/')->
              controller("App\Controllers\Gost")->execute('registrujSe');
        
        
        $result->assertNotRedirect();
        $this->dontSeeInDatabase("korisnik", ['korisnickoIme' => 'mile']);
        
        $korisnikModel = new \App\Models\KorisnikModel();
        $korisnikModel->delete('mile');
    }
    
    public function testRegistrovanjeBezKorisnickogImena() {
        $result = $this->controller("App\Controllers\Gost")->execute("index");
        
        $result = $this->withUri('http://localhost:8080/Gost/registracija/')->
              controller("App\Controllers\Gost")->execute("registracija");
        
        $_REQUEST['ime'] = 'Mile';
        $_REQUEST['prezime'] = "Milicevic";
        $_REQUEST['pol'] = "musko";
        $_REQUEST['email'] = 'mile@gmail.com';
        $_REQUEST['lozinka'] = 'mile123';
        $_REQUEST['potvrdaLozinke'] = 'mile123';
        $_REQUEST['tipKorisnika'] = 'pisac';
        $_REQUEST['opstina'] = 144;
        $_REQUEST['korisnickoIme'] = '';
        
        $result = $this->withUri('http://localhost:8080/Gost/registrujSe/')->
              controller("App\Controllers\Gost")->execute('registrujSe');
        
        
        $result->assertNotRedirect();
        $this->dontSeeInDatabase("korisnik", ['korisnickoIme' => 'mile']);
        
        $korisnikModel = new \App\Models\KorisnikModel();
        $korisnikModel->delete('mile');
    }
    
    public function testRegistrovanjeBezEmaila() {
        $result = $this->controller("App\Controllers\Gost")->execute("index");
        
        $result = $this->withUri('http://localhost:8080/Gost/registracija/')->
              controller("App\Controllers\Gost")->execute("registracija");
        
        $_REQUEST['ime'] = 'Mile';
        $_REQUEST['prezime'] = "Milicevic";
        $_REQUEST['pol'] = "musko";
        $_REQUEST['email'] = '';
        $_REQUEST['lozinka'] = 'mile123';
        $_REQUEST['potvrdaLozinke'] = 'mile123';
        $_REQUEST['tipKorisnika'] = 'pisac';
        $_REQUEST['opstina'] = 144;
        $_REQUEST['korisnickoIme'] = 'mile';
        
        $result = $this->withUri('http://localhost:8080/Gost/registrujSe/')->
              controller("App\Controllers\Gost")->execute('registrujSe');
        
        
        $result->assertNotRedirect();
        $this->dontSeeInDatabase("korisnik", ['korisnickoIme' => 'mile']);
        
        $korisnikModel = new \App\Models\KorisnikModel();
        $korisnikModel->delete('mile');
    }
    
    public function testRegistrovanjeBezLozinke() {
        $result = $this->controller("App\Controllers\Gost")->execute("index");
        
        $result = $this->withUri('http://localhost:8080/Gost/registracija/')->
              controller("App\Controllers\Gost")->execute("registracija");
        
        $_REQUEST['ime'] = 'Mile';
        $_REQUEST['prezime'] = "Milicevic";
        $_REQUEST['pol'] = "musko";
        $_REQUEST['email'] = 'mile@gmail.com';
        $_REQUEST['lozinka'] = '';
        $_REQUEST['potvrdaLozinke'] = 'mile123';
        $_REQUEST['tipKorisnika'] = 'pisac';
        $_REQUEST['opstina'] = 144;
        $_REQUEST['korisnickoIme'] = 'mile';
        
        $result = $this->withUri('http://localhost:8080/Gost/registrujSe/')->
              controller("App\Controllers\Gost")->execute('registrujSe');
        
        
        $result->assertNotRedirect();
        $this->dontSeeInDatabase("korisnik", ['korisnickoIme' => 'mile']);
        
        $korisnikModel = new \App\Models\KorisnikModel();
        $korisnikModel->delete('mile');
    }
    
    public function testRegistrovanjeBezPotvrdeLozinke() {
        $result = $this->controller("App\Controllers\Gost")->execute("index");
        
        $result = $this->withUri('http://localhost:8080/Gost/registracija/')->
              controller("App\Controllers\Gost")->execute("registracija");
        
        $_REQUEST['ime'] = 'Mile';
        $_REQUEST['prezime'] = "Milicevic";
        $_REQUEST['pol'] = "musko";
        $_REQUEST['email'] = 'mile@gmail.com';
        $_REQUEST['lozinka'] = 'mile123';
        $_REQUEST['potvrdaLozinke'] = '';
        $_REQUEST['tipKorisnika'] = 'pisac';
        $_REQUEST['opstina'] = 144;
        $_REQUEST['korisnickoIme'] = 'mile';
        
        $result = $this->withUri('http://localhost:8080/Gost/registrujSe/')->
              controller("App\Controllers\Gost")->execute('registrujSe');
        
        
        $result->assertNotRedirect();
        $this->dontSeeInDatabase("korisnik", ['korisnickoIme' => 'mile']);
        
        $korisnikModel = new \App\Models\KorisnikModel();
        $korisnikModel->delete('mile');
    }
    
    public function testRegistrovanjeKorisnickoImeUBazi() {
        $result = $this->controller("App\Controllers\Gost")->execute("index");
        
        $result = $this->withUri('http://localhost:8080/Gost/registracija/')->
              controller("App\Controllers\Gost")->execute("registracija");
        
        $_REQUEST['ime'] = 'Mile';
        $_REQUEST['prezime'] = "Milicevic";
        $_REQUEST['pol'] = "musko";
        $_REQUEST['email'] = 'mile@gmail.com';
        $_REQUEST['lozinka'] = 'mile123';
        $_REQUEST['potvrdaLozinke'] = 'mile123';
        $_REQUEST['tipKorisnika'] = 'pisac';
        $_REQUEST['opstina'] = 144;
        $_REQUEST['korisnickoIme'] = 'nikola';
        
        $result = $this->withUri('http://localhost:8080/Gost/registrujSe')->
              controller("App\Controllers\Gost")->execute('registrujSe');
        
        
        
        
        
        $result->assertNotRedirect();
        
        
        
        $korisnikModel = new \App\Models\KorisnikModel();
        $korisnikModel->delete('mile');
        
    }
    
    public function testRegistrovanjeNepoklapanjePotvrdeLozinke() {
        $result = $this->controller("App\Controllers\Gost")->execute("index");
        
        $result = $this->withUri('http://localhost:8080/Gost/registracija/')->
              controller("App\Controllers\Gost")->execute("registracija");
        
        $_REQUEST['ime'] = 'Mile';
        $_REQUEST['prezime'] = "Milicevic";
        $_REQUEST['pol'] = "musko";
        $_REQUEST['email'] = 'mile@gmail.com';
        $_REQUEST['lozinka'] = 'mile123';
        $_REQUEST['potvrdaLozinke'] = 'mile321';
        $_REQUEST['tipKorisnika'] = 'pisac';
        $_REQUEST['opstina'] = 144;
        $_REQUEST['korisnickoIme'] = 'nikola';
        
        $result = $this->withUri('http://localhost:8080/Gost/registrujSe')->
              controller("App\Controllers\Gost")->execute('registrujSe');
        
        
        
        
        
        $result->assertNotRedirect();
        
        
        
        $korisnikModel = new \App\Models\KorisnikModel();
        $korisnikModel->delete('mile');
        
    }
    
    public function testReklama() {
        
        $reklamaModel = new \App\Models\ReklamaModel();
        
        $reklame = $reklamaModel->where("odobrena", 1)->findAll();
        
        
        foreach ($reklame as $reklama) {
            $result = $this->withUri('http://localhost:8080/Gost/reklama')->
                controller("App\Controllers\Gost")->execute("reklama", $reklama->id);
        
        
        
            $this->assertTrue($result->see($reklama->nazivRadnje, 'h1'));
            if ($reklama->autor != null) {
                $this->assertTrue($result->see($reklama->autor), 'a');
            } else {
                $this->assertTrue($result->see('deleted'));
            }
            $this->assertTrue(true);
        }
        
    }
    
    
   
}