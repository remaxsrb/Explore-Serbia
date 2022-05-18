<?php

// by Miloš Brković 0599/2019

namespace App\Models;

use CodeIgniter\Model;

/**
 * ObjavaTagModel - klasa koja predstavlja model veze objava-tag u bazi podataka
 */
class ObjavaTagModel extends Model
{
    protected $table      = 'objavatag';
    protected $primaryKey = 'objavaID';
    protected $returnType     = 'object';
    protected $allowedFields = ['objavaID', 'tagID'];
}