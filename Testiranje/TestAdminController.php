<?php

namespace CodeIgniter;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Config\Factories;

class TestAdminController extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;
    
     // For Migrations
    protected $migrate = true;
    protected $migrateOnce = false;
    protected $refresh     = true;
    protected $namespace   = 'Tests\Support';

    public function testOdobravanjeNoveObjave()
    {
        $objava = [
            'id' => 13,
            'naslov'  => 'Naslov',
            'tekst'  => 'Tekst',
            'brojOcena'  => 0,
            'sumaOcena'  => 0,
            'odobrena'  => 0,
            'vremeKreiranja'  => '2022-06-07',
            'autor' => 'milos',
            'lokacija'  => 144,
        ];
        $this->hasInDatabase('objava', $objava);
        
        $_REQUEST['id']='13';
        $result = $this->withURI('http://localhost:8080/Admin/odobriTekst/')
            ->controller(\App\Controllers\Admin::class)
            ->execute('odobriTekst');
        
        $objavaNakonOdobravanja = [
            'id' => 13,
            'naslov'  => 'Naslov',
            'tekst'  => 'Tekst',
            'brojOcena'  => 0,
            'sumaOcena'  => 0,
            'odobrena'  => 1,
            'vremeKreiranja'  => '2022-06-07',
            'autor' => 'milos',
            'lokacija'  => 144,
        ];
        
        $this->seeInDatabase('objava', $objavaNakonOdobravanja);
        
        $objavaModel = new \App\Models\ObjavaModel();
        $objavaModel->izbrisi(13);
    }
    
    public function testObjavaModelUbaci(){
        $objava = [
            'id' => 13,
            'naslov'  => 'Naslov',
            'tekst'  => 'Tekst',
            'brojOcena'  => 0,
            'sumaOcena'  => 0,
            'odobrena'  => 0,
            'vremeKreiranja'  => '2022-06-07',
            'autor' => 'milos',
            'lokacija'  => 144,
        ];
        $this->hasInDatabase('objava', $objava);
        
        $objavaModel = new \App\Models\ObjavaModel();
        $objavaModel->ubaci(13);
        
        $ubacenaObjava = $objavaModel->find(13);
        $this->assertEquals(1, $ubacenaObjava->odobrena);
        
        $objavaModel->delete(13);
    }
    
    public function testObjavaModelIzbrisi(){
        $objava = [
            'id' => 13,
            'naslov'  => 'Naslov',
            'tekst'  => 'Tekst',
            'brojOcena'  => 0,
            'sumaOcena'  => 0,
            'odobrena'  => 0,
            'vremeKreiranja'  => '2022-06-07',
            'autor' => 'milos',
            'lokacija'  => 144,
        ];
        $this->hasInDatabase('objava', $objava);
        
        $objavaModel = new \App\Models\ObjavaModel();
        $objavaModel->izbrisi(13);
        
        $ubacenaObjava = $objavaModel->find(13);
        $this->assertEquals(null, $ubacenaObjava);
    }
    
    public function testOdobriReklamuSaJedinstvenimNazivom(){
        $reklama = [
            'id' => 16,
            'nazivRadnje'  => 'Naziv',
            'opis'  => 'Opis',
            'slikaURL'  => null,
            'adresa'  => 'Adresa 123',
            'telefon'  => null,
            'email'  => null,
            'sajtURL' => null,
            'vremeKreiranja'  => '2022-06-07',
            'odobrena'  => 0,
            'autor' => 'angie',
            'lokacija'  => 144,
        ];
        $this->hasInDatabase('reklama', $reklama);
        
        $reklamaModel = new \App\Models\ReklamaModel();
        $reklamaModel->dodajReklamu('Naziv');
        
        $odobrenaReklama = $reklamaModel->find(16);
        $this->assertEquals(1, $odobrenaReklama->odobrena);
        $reklamaModel->delete(16);
    }
    
    public function testOdobriReklamuCijiNazivNijeJedinstven(){
        $reklama1 = [
            'id' => 16,
            'nazivRadnje'  => 'IstiNaziv',
            'opis'  => 'Opis',
            'slikaURL'  => null,
            'adresa'  => 'Adresa 123',
            'telefon'  => null,
            'email'  => null,
            'sajtURL' => null,
            'vremeKreiranja'  => '2022-06-07',
            'odobrena'  => 0,
            'autor' => 'angie',
            'lokacija'  => 144,
        ];
        $this->hasInDatabase('reklama', $reklama1);
        
        $reklama2 = [
            'id' => 17,
            'nazivRadnje'  => 'IstiNaziv',
            'opis'  => 'Opis',
            'slikaURL'  => null,
            'adresa'  => 'Adresa 123',
            'telefon'  => null,
            'email'  => null,
            'sajtURL' => null,
            'vremeKreiranja'  => '2022-06-07',
            'odobrena'  => 0,
            'autor' => 'angie',
            'lokacija'  => 144,
        ];
        $this->hasInDatabase('reklama', $reklama2);
        
        $reklamaModel = new \App\Models\ReklamaModel();
        
        $reklamaModel->dodajReklamu($reklama1['nazivRadnje']);
        
        $odobrenaReklama = $reklamaModel->find($reklama1['id']);
        
        $reklamaModel->delete($reklama1['id']);
        $reklamaModel->delete($reklama2['id']);
        
        $this->assertEquals(1, $odobrenaReklama->odobrena);
    }
    
    public function testIzbrisiReklamuSaJedinstvenimNazivom(){
        $reklama = [
            'id' => 16,
            'nazivRadnje'  => 'Naziv',
            'opis'  => 'Opis',
            'slikaURL'  => null,
            'adresa'  => 'Adresa 123',
            'telefon'  => null,
            'email'  => null,
            'sajtURL' => null,
            'vremeKreiranja'  => '2022-06-07',
            'odobrena'  => 0,
            'autor' => 'angie',
            'lokacija'  => 144,
        ];
        $this->hasInDatabase('reklama', $reklama);
        
        $reklamaModel = new \App\Models\ReklamaModel();
        $reklamaModel->izbrisiReklamu($reklama['nazivRadnje']);
        
        $this->dontSeeInDatabase("reklama", $reklama);
    }
    
    public function testIzbrisiReklamuCijiNazivNijeJedinstven(){
        $reklama1 = [
            'id' => 16,
            'nazivRadnje'  => 'IstiNaziv',
            'opis'  => 'Opis',
            'slikaURL'  => null,
            'adresa'  => 'Adresa 123',
            'telefon'  => null,
            'email'  => null,
            'sajtURL' => null,
            'vremeKreiranja'  => '2022-06-07',
            'odobrena'  => 0,
            'autor' => 'angie',
            'lokacija'  => 144,
        ];
        $this->hasInDatabase('reklama', $reklama1);
        
        $reklama2 = [
            'id' => 17,
            'nazivRadnje'  => 'IstiNaziv',
            'opis'  => 'Opis',
            'slikaURL'  => null,
            'adresa'  => 'Adresa 123',
            'telefon'  => null,
            'email'  => null,
            'sajtURL' => null,
            'vremeKreiranja'  => '2022-06-07',
            'odobrena'  => 0,
            'autor' => 'angie',
            'lokacija'  => 144,
        ];
        $this->hasInDatabase('reklama', $reklama2);
        
        $reklamaModel = new \App\Models\ReklamaModel();
        
        $reklamaModel->izbrisiReklamu($reklama1['nazivRadnje']);
        
        $izbrisanaReklama = $reklamaModel->find($reklama1['id']);
        
        $reklamaModel->delete($reklama1['id']);
        $reklamaModel->delete($reklama2['id']);
        
        $this->assertEquals(null, $izbrisanaReklama);
    }
    
    public function testOdobriTagSaJedinstvenimNazivom(){
        $tag = [
            'id' => 8,
            'naziv' => 'JedinstvenNaziv',
            'odobren' => 0,
            'kategorija' => 1
        ];
        $this->hasInDatabase('tag', $tag);
        
        $tagModel = new \App\Models\TagModel();
        $tagModel->ubaciTag($tag['naziv']);
        
        $odobrenTag = $tagModel->find($tag['id']);
        
        $tagModel->delete($tag['id']);
        
        $this->assertEquals(1, $odobrenTag->odobren);
    }
    
    public function testOdobriTagCijiNazivNijeJedinstven(){
        $tag1 = [
            'id' => 8,
            'naziv' => 'IstiNaziv',
            'odobren' => 0,
            'kategorija' => 1
        ];
        $this->hasInDatabase('tag', $tag1);
        
        $tag2 = [
            'id' => 9,
            'naziv' => 'IstiNaziv',
            'odobren' => 0,
            'kategorija' => 2
        ];
        $this->hasInDatabase('tag', $tag2);
        
        $tagModel = new \App\Models\TagModel();
        $tagModel->ubaciTag($tag1['naziv']);
        
        $odobrenTag = $tagModel->find($tag1['id']);
        
        $tagModel->delete($tag1['id']);
        $tagModel->delete($tag2['id']);
        
        $this->assertEquals(1, $odobrenTag->odobren);
    }
    
    public function testIzbrisiTagCijiJeNazivJedinstven(){
        $tag = [
            'id' => 8,
            'naziv' => 'JedinstvenNaziv',
            'odobren' => 0,
            'kategorija' => 1
        ];
        $this->hasInDatabase('tag', $tag);
        
        $tagModel = new \App\Models\TagModel();
        $tagModel->izbrisiTag($tag['naziv']);
        
        $izbrisanTag = $tagModel->find($tag['id']);
        
        $tagModel->delete($tag['id']);
        
        $this->assertEquals(null, $izbrisanTag);
    }
    
    public function testIzbrisiTagCijiNazivNijeJedinstven(){
        $tag1 = [
            'id' => 8,
            'naziv' => 'IstiNaziv',
            'odobren' => 0,
            'kategorija' => 1
        ];
        $this->hasInDatabase('tag', $tag1);
        
        $tag2 = [
            'id' => 9,
            'naziv' => 'IstiNaziv',
            'odobren' => 0,
            'kategorija' => 2
        ];
        $this->hasInDatabase('tag', $tag2);
        
        $tagModel = new \App\Models\TagModel();
        $tagModel->izbrisiTag($tag2['naziv']);
        
        $izbrisanTag = $tagModel->find($tag2['id']);
        
        $tagModel->delete($tag1['id']);
        $tagModel->delete($tag2['id']);
        
        $this->assertEquals(null, $izbrisanTag);
    }
    
    public function testBrisanjeKorisnika(){
        $korisnik = [
            'korisnickoIme' => 'korisnikZaBrisanje',
            'ime' => 'Korisnik',
            'prezime' => 'Brisanje',
            'pol' => 'musko',
            'email' => 'korisnikZaBrisanje@gmail.com',
            'lozinka' => 'Sifra123',
            'slikaURL' => null,
            'tip' => 2,
            'lokacija' => 144,
        ];
        $this->hasInDatabase('korisnik', $korisnik);
        
        $korisnikModel = new \App\Models\KorisnikModel();
        $korisnikModel->izbrisiKorinsika($korisnik['korisnickoIme']);
        
        $obrisaniKorisnik = $korisnikModel->find($korisnik['korisnickoIme']);
        
        $korisnikModel->delete($korisnik['korisnickoIme']);
        
        $this->assertEquals(null, $obrisaniKorisnik);
    }
    
    public function testDodavanjeAdministratorskihPrava(){
        $korisnik = [
            'korisnickoIme' => 'korisnikZaBrisanje',
            'ime' => 'Korisnik',
            'prezime' => 'Brisanje',
            'pol' => 'musko',
            'email' => 'korisnikZaBrisanje@gmail.com',
            'lozinka' => 'Sifra123',
            'slikaURL' => null,
            'tip' => 2,
            'lokacija' => 144,
        ];
        $this->hasInDatabase('korisnik', $korisnik);
        
        $korisnikModel = new \App\Models\KorisnikModel();
        $korisnikModel->dodajAdministratorskaPrava($korisnik['korisnickoIme']);
        
        $admin = $korisnikModel->find($korisnik['korisnickoIme']);
        
        $korisnikModel->delete($korisnik['korisnickoIme']);
        
        $this->assertEquals(1, $admin->tip);
    }
    
    public function testNapisiTekstPrikaz(){
        $result = $this->withURI('http://localhost:8080/Admin/napisiTekst/')
            ->controller(\App\Controllers\Admin::class)
            ->execute('napisiTekst');
        
        $this->assertTrue($result->see("Naslov objave", "h4"));
    }
    
    public function testListaKorisnikaPrikaz(){
        $result = $this->withURI('http://localhost:8080/Admin/listaKorisnika/')
            ->controller(\App\Controllers\Admin::class)
            ->execute('listaKorisnika');
        
        $this->assertTrue($result->see("Korisnici u sistemu", "h2"));
    }
    
    public function testListaReklamaPrikaz(){
        $result = $this->withURI('http://localhost:8080/Admin/listaReklama/')
            ->controller(\App\Controllers\Admin::class)
            ->execute('listaReklama');
        
        $this->assertTrue($result->see("Reklame u sistemu", "h2"));
    }
    
    public function testTekstoviZaOdobravanjePrikaz(){
        $result = $this->withURI('http://localhost:8080/Admin/tekstoviZaOdobravanje/')
            ->controller(\App\Controllers\Admin::class)
            ->execute('tekstoviZaOdobravanje');
        
        $this->assertTrue($result->see("Objave koje čekaju odobrenje", "h2"));
    }
    
    public function testTagoviZaOdobravanjePrikaz(){
        $result = $this->withURI('http://localhost:8080/Admin/tagoviZaOdobravanje/')
            ->controller(\App\Controllers\Admin::class)
            ->execute('tagoviZaOdobravanje');
        
        $this->assertTrue($result->see("Tagovi Koji čekaju odobrenje", "h2"));
    }
    
    public function testReklameZaOdobravanjePrikaz(){
        $result = $this->withURI('http://localhost:8080/Admin/reklameZaOdobravanje/')
            ->controller(\App\Controllers\Admin::class)
            ->execute('reklameZaOdobravanje');
        
        $this->assertTrue($result->see("Reklame u sistemu koje čekaju odobrenje", "h2"));
    }
    
    public function testPretraga(){
        $_REQUEST['pretraga'] = 'Kalemegdan';
        
        $korisnikModel = new \App\Models\KorisnikModel();
        $_SESSION['korisnik'] = $korisnikModel->find('oliverM');
        
        $result = $this->withURI('http://localhost:8080/Admin/pretraga/')
            ->controller(\App\Controllers\Admin::class)
            ->execute('pretraga');
        
        $this->assertTrue($result->see("Kalemegdan", "h3"));
        $this->assertFalse($result->see("Pećina Risovača", "h3"));
        $this->assertFalse($result->see("Hram Svetog Save", "h3"));
        $this->assertFalse($result->see("Smederevska tvrdjava", "h3"));
        $this->assertFalse($result->see("Soko Banja", "h3"));
        $this->assertFalse($result->see("Tara", "h3"));
        $this->assertFalse($result->see("Soko Grad", "h3"));
        $this->assertFalse($result->see("Car Dusan Silni", "h3"));
    }
    
    public function testPretragaPrazanUnos(){
        $_REQUEST['pretraga'] = '';
        
        $korisnikModel = new \App\Models\KorisnikModel();
        $_SESSION['korisnik'] = $korisnikModel->find('oliverM');
        
        $result = $this->withURI('http://localhost:8080/Admin/pretraga/')
            ->controller(\App\Controllers\Admin::class)
            ->execute('pretraga');
        
       $result->assertRedirectTo('Admin/');
    }
    
    public function testOdbijanjeNoveObjave(){
        $objava = [
            'id' => 13,
            'naslov'  => 'Naslov',
            'tekst'  => 'Tekst',
            'brojOcena'  => 0,
            'sumaOcena'  => 0,
            'odobrena'  => 0,
            'vremeKreiranja'  => '2022-06-07',
            'autor' => 'milos',
            'lokacija'  => 144,
        ];
        $this->hasInDatabase('objava', $objava);
        
        $_REQUEST['id'] = $objava['id'];
        $result = $this->withURI('http://localhost:8080/Admin/odbijTekst/')
            ->controller(\App\Controllers\Admin::class)
            ->execute('odbijTekst');
        
        $this->dontSeeInDatabase('objava', $objava);
        
        $objavaModel = new \App\Models\ObjavaModel();
        $objavaModel->izbrisi($objava['id']);
    }
    
    public function testIzlogujSe(){
        $korisnikModel = new \App\Models\KorisnikModel();
        $_SESSION['korisnik'] = $korisnikModel->find('oliverM');
        
        $result = $this->withURI('http://localhost:8080/Admin/izlogujSe/')
            ->controller(\App\Controllers\Admin::class)
            ->execute('izlogujSe');
        
        $result->assertRedirectTo('/');
    }
    
    public function testBrisiBiloKojuReklamu(){
        
        $reklama = [
            'id' => 16,
            'nazivRadnje'  => 'Reklama za brisanje',
            'opis'  => 'Opis',
            'slikaURL'  => null,
            'adresa'  => 'Adresa 123',
            'telefon'  => null,
            'email'  => null,
            'sajtURL' => null,
            'vremeKreiranja'  => '2022-06-07',
            'odobrena'  => 0,
            'autor' => 'angie',
            'lokacija'  => 144,
        ];
        $this->hasInDatabase('reklama', $reklama);
        
        $result = $this->withURI('http://localhost:8080/Admin/brisiBiloKojuReklamu/')
            ->controller(\App\Controllers\Admin::class)
            ->execute('brisiBiloKojuReklamu', $reklama['id']);
        
        $this->dontSeeInDatabase('reklama', $reklama);
    }
}