<?php

// by Miloš Brković 0599/2019

namespace App\Models;

use CodeIgniter\Model;

/**
 * KorisnikModel - klasa koja predstavlja model korisnika u bazi podataka
 */
class KorisnikModel extends Model
{
    protected $table      = 'korisnik';
    protected $primaryKey = 'korisnickoIme';

    protected $returnType     = 'object';
    protected $allowedFields = ['korisnickoIme', 'ime', 'prezime', 'pol', 'email',
        'lozinka', 'slikaURL', 'tip', 'lokacija'];


    public function izbrisiKorinsika($korisnickoIme)
    {
        //by Marko Jovanovic 2018/0607
        return $this->delete($korisnickoIme);

    }
    public function dodajAdministratorskaPrava($korisnickoIme)
    {
        //by Marko Jovanovic 2018/0607
        $data=
            [
                'tip' => '1',
            ];
        return $this->update($korisnickoIme,$data);
    }

}