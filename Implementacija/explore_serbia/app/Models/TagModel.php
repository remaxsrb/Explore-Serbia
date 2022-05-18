<?php

// by Miloš Brković 0599/2019

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table      = 'tag';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $allowedFields = ['id', 'naziv', 'odobren', 'kategorija'];
}