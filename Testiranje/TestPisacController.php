<?php
namespace CodeIgniter;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Config\Factories;
use App\Models\ObjavaModel;
use App\Models\ObjavaTagModel;

class TestPisacController extends CIUnitTestCase {
use ControllerTestTrait;
    use DatabaseTestTrait;
    
     // For Migrations
    protected $migrate = true;
    protected $migrateOnce = false;
    protected $refresh     = true;
    protected $namespace   = 'Tests\Support';
   protected function setUp(): void {
        parent::setUp();
        
        
    }
    public function testOcenjivanjeObjave() {
  
        $model=new \App\Models\KorisnikModel();
        $_SESSION['korisnik']=$model->find('stefan123');
        $this->controller(\App\Controllers\Pisac::class)
                ->execute('index');
   $rez=$this->controller(\App\Controllers\Pisac::class)
                ->execute('kreiranjeObjave');
 
  $_REQUEST['naslovObjave']='test';
    $_REQUEST['objavaTextArea']='textObjave';
    $_REQUEST['mainTagTip']='Istorijska ličnost';
    $_REQUEST['mainTag']='Dusan Silni';
     $_REQUEST['regionObjave']='Aleksandrovac';
     
  $exe=$this->controller(\App\Controllers\Pisac::class)
                ->execute('slanjeObjave');

  $objavaModel=new ObjavaModel();
  $objavaTagModel=new ObjavaTagModel();
$objava=$objavaModel->where('naslov','test')->find();
$oce=$this->controller(\App\Controllers\Pisac::class)
                ->execute('ocenjivanje',13,'stefan123',5);
$objavica=$this->controller(\App\Controllers\Pisac::class)
                ->execute('objava',13);
$this->assertTrue($objavica->see("Vasa ocena: 5","span"));
    
 
   $objavaTagModel->delete(13);
$objavaModel->delete(13);
$_REQUEST['naslovObjave']=null;
   $_REQUEST['objavaTextArea']=null;
    $_REQUEST['mainTagTip']=null;
    $_REQUEST['mainTag']=null;
     $_REQUEST['regionObjave']=null;

    } 
    
  
     public function testBrisanjeBiloKojeObjave() {
  
 
              $model=new \App\Models\KorisnikModel();
        $_SESSION['korisnik']=$model->find('stefan123');
        $this->controller(\App\Controllers\Pisac::class)
                ->execute('index');
   $rez=$this->controller(\App\Controllers\Pisac::class)
                ->execute('kreiranjeObjave');
 
    $_REQUEST['naslovObjave']='naslovO';
    $_REQUEST['objavaTextArea']='text';
    $_REQUEST['mainTagTip']='Istorijska ličnost';
    $_REQUEST['mainTag']='Dusan Silni';
     $_REQUEST['regionObjave']='Aleksandrovac';
  $exe=$this->controller(\App\Controllers\Pisac::class)
                ->execute('slanjeObjave');
    
$objavaModel=new ObjavaModel();
$objavaTagModel=new ObjavaTagModel();


 $_SESSION['korisnik']=$model->find('remax');
 $this->controller(\App\Controllers\Admin::class)
                ->execute('brisanjeBiloKojeObjave',13);
 $obj=$objavaModel->find(13);
 $this->assertNull($obj);
 //izbrisana!
 $_REQUEST['naslovObjave']=null;
    $_REQUEST['objavaTextArea']=null;
    $_REQUEST['mainTagTip']=null;
    $_REQUEST['mainTag']=null;
     $_REQUEST['regionObjave']=null;
   }
    
    public function testUspesnoKreiranjeObjave() {
  
        $model=new \App\Models\KorisnikModel();
        $_SESSION['korisnik']=$model->find('stefan123');
        $this->controller(\App\Controllers\Pisac::class)
                ->execute('index');
   $rez=$this->controller(\App\Controllers\Pisac::class)
                ->execute('kreiranjeObjave');
 
    $_REQUEST['naslovObjave']='naslovO';
    $_REQUEST['objavaTextArea']='text';
    $_REQUEST['mainTagTip']='Istorijska ličnost';
    $_REQUEST['mainTag']='Dusan Silni';
     $_REQUEST['regionObjave']='Aleksandrovac';
  $exe=$this->controller(\App\Controllers\Pisac::class)
                ->execute('slanjeObjave');
    
$objavaModel=new ObjavaModel();
$objavaTagModel=new ObjavaTagModel();

$obj=$objavaModel->find(13);

$this->assertNotNull($obj);
$objavaTagModel->delete(13);
$objavaModel->delete(13);
  $_REQUEST['naslovObjave']=null;
    $_REQUEST['objavaTextArea']=null;
    $_REQUEST['mainTagTip']=null;
    $_REQUEST['mainTag']=null;
     $_REQUEST['regionObjave']=null;

    }
    
 public function testNeuspesnoKreiranjeObjaveNemaNaslov() {
  
        $model=new \App\Models\KorisnikModel();
        $_SESSION['korisnik']=$model->find('stefan123');
        $this->controller(\App\Controllers\Pisac::class)
                ->execute('index');
   $rez=$this->controller(\App\Controllers\Pisac::class)
                ->execute('kreiranjeObjave');
 
 
    $_REQUEST['objavaTextArea']='text';
    $_REQUEST['mainTagTip']='Istorijska ličnost';
    $_REQUEST['mainTag']='Dusan Silni';
     $_REQUEST['regionObjave']='Aleksandrovac';
  $exe=$this->controller(\App\Controllers\Pisac::class)
                ->execute('slanjeObjave');
    $this->assertTrue($exe->see("The naslovObjave field is required.","div"));
   $_REQUEST['objavaTextArea']=null;
    $_REQUEST['mainTagTip']=null;
    $_REQUEST['mainTag']=null;
     $_REQUEST['regionObjave']=null;

    }
    
 public function testNeuspesnoKreiranjeObjaveNemaSadrzaj() {
  
        $model=new \App\Models\KorisnikModel();
        $_SESSION['korisnik']=$model->find('stefan123');
        $this->controller(\App\Controllers\Pisac::class)
                ->execute('index');
   $rez=$this->controller(\App\Controllers\Pisac::class)
                ->execute('kreiranjeObjave');
 
    $_REQUEST['naslovObjave']='naslovO';
    $_REQUEST['mainTagTip']='Istorijska ličnost';
    $_REQUEST['mainTag']='Dusan Silni';
     $_REQUEST['regionObjave']='Aleksandrovac';
  $exe=$this->controller(\App\Controllers\Pisac::class)
                ->execute('slanjeObjave');
    $this->assertTrue($exe->see("The objavaTextArea field is required.","div"));
              $_REQUEST['naslovObjave']=null;
    $_REQUEST['mainTagTip']=null;
    $_REQUEST['mainTag']=null;
     $_REQUEST['regionObjave']=null;

    }
    
public function testBrisanjeSvojeObjave() {
  
    $model=new \App\Models\KorisnikModel();
        $_SESSION['korisnik']=$model->find('stefan123');
        $this->controller(\App\Controllers\Pisac::class)
                ->execute('index');
   $rez=$this->controller(\App\Controllers\Pisac::class)
                ->execute('kreiranjeObjave');
 
    $_REQUEST['naslovObjave']='naslovO';
    $_REQUEST['objavaTextArea']='text';
    $_REQUEST['mainTagTip']='Istorijska ličnost';
    $_REQUEST['mainTag']='Dusan Silni';
     $_REQUEST['regionObjave']='Aleksandrovac';
  $exe=$this->controller(\App\Controllers\Pisac::class)
                ->execute('slanjeObjave');
      $exe=$this->controller(\App\Controllers\Pisac::class)
                ->execute('brisiObjavu',13);

  //trazimo sad tu objavu
$objavaModel=new ObjavaModel();
      $obj=$objavaModel->find(13);
       $this->assertNull($obj);
  $_REQUEST['naslovObjave']=null;
    $_REQUEST['objavaTextArea']=null;
    $_REQUEST['mainTagTip']=null;
    $_REQUEST['mainTag']=null;
     $_REQUEST['regionObjave']=null;

    }
  
 
    
}

