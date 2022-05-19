<?php


// byMarko Jovanović 2018/0607




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


    public function ubaciTag($naziv)
    {
        $tagovi=$this->findAll();
        $tag=null;
        $id=null;
        foreach ($tagovi as $tag)
        {
            if($tag->naziv==$naziv)
                $id=$tag->id;
        }
        $data =
            [
                'odobren' => '1',
            ];
        $this->update($id, $data);
    }
    public function izbrisiTag($naziv)
    {
        $tagovi=$this->findAll();
        $tag=null;
        $id=null;
        foreach ($tagovi as $tag)
        {
            if($tag->nazivRadnje==$naziv)
                $id=$tag->id;
        }

        $this->delete($id);
    }


}