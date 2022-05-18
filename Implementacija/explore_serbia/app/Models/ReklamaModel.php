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


    public function dodajReklamu($nazivRadnje)
    {
        //by Marko Jovanovic 2018/0607
        $reklame=$this->findAll();
        $reklama=null;
        $id=null;
        foreach ($reklame as $reklama)
        {
            if($reklama->nazivRadnje==$nazivRadnje)
                $id=$reklama->id;
        }
        $data =
            [
                'odobrena' => '1',
            ];
        $this->update($id, $data);

    }
    public function izbrisiReklamu($nazivRadnje)
    {
        //by Marko Jovanovic 2018/0607
        $reklame=$this->findAll();
        $reklama=null;
        $id=null;
        foreach ($reklame as $reklama)
        {
            if($reklama->nazivRadnje==$nazivRadnje)
                $id=$reklama->id;
        }

        $this->delete($id);
    }
}