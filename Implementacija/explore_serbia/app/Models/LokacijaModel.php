<?php

// by Miloš Brković 0599/2019

namespace App\Models;

use CodeIgniter\Model;

class LokacijaModel extends Model
{
    protected $table      = 'lokacija';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $allowedFields = ['id', 'naziv'];
}