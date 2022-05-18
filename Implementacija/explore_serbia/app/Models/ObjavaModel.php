<?php

// by Miloš Brković 0599/2019

namespace App\Models;

use CodeIgniter\Model;

class ObjavaModel extends Model
{
    protected $table      = 'objava';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    protected $allowedFields = ['id', 'naslov', 'tekst', 'brojOcena', 'sumaOcena',
        'odobrena', 'vremeKreiranja', 'autor', 'lokacija'];

    public function ubaci($id)
    {
        // byMarko Jovanović 2018/0607
        $data =
            [
                'odobrena' => '1',
            ];
        $this->update($id, $data);
    }

    public function izbrisi($id)
    {
        // byMarko Jovanović 2018/0607
        $this->delete($id);
    }

}