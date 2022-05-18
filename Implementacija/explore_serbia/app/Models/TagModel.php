<?php

// by Miloš Brković 0599/2019

namespace App\Models;

use CodeIgniter\Model;

/**
 * ReklamaModel - klasa koja predstavlja model taga u bazi podataka
 */
class TagModel extends Model
{
    protected $table      = 'tag';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $allowedFields = ['id', 'naziv', 'odobren', 'kategorija'];
}