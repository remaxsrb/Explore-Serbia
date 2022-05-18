<?php

// by Miloš Brković 0599/2019

namespace App\Models;

use CodeIgniter\Model;

/**
 * LokacijaModel - klasa koja predstavlja model lokacije u bazi podataka
 */
class LokacijaModel extends Model
{
    protected $table      = 'lokacija';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $allowedFields = ['id', 'naziv'];
}