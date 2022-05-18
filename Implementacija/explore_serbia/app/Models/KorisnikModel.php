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
}