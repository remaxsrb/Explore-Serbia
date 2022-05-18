<?php

// by Miloš Brković 0599/2019

namespace App\Models;

use CodeIgniter\Model;

/**
 * ObjavaModel - klasa koja predstavlja model objave u bazi podataka
 */
class ObjavaModel extends Model
{
    protected $table      = 'objava';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $allowedFields = ['id', 'naslov', 'tekst', 'brojOcena', 'sumaOcena',
        'odobrena', 'vremeKreiranja', 'autor', 'lokacija'];
}