<?php

// by Miloš Brković 0599/2019

namespace App\Models;

use CodeIgniter\Model;

class ReklamaModel extends Model
{
    protected $table      = 'reklama';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $allowedFields = ['id', 'nazivRadnje', 'opis', 'slikaURL', 'adresa',
        'telefon', 'email', 'sajtURL', 'vremeKreiranja', 'odobrena', 'autor', 'lokacija'];
}