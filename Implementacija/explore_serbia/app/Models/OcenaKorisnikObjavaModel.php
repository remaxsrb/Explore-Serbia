<?php

// by Nikola Bjelobaba 0442/2019

namespace App\Models;

use CodeIgniter\Model;

/**
 * ObjavaTagModel - Ova klasa je model veze objava i korisnika u bazi podataka, osnovana na oceni koju je korisnik dao objavi
 */

class OcenaKorisnikObjavaModel extends Model
{
    protected $table      = 'ocenakorisnikobjava';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $allowedFields = ['id', 'korisnickoIme', 'objava', 'ocena'];
}