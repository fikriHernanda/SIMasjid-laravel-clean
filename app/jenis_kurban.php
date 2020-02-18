<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenis_kurban extends Model
{
    protected $table = 'jenis_kurban';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];



    //1 jenis mempunyai 3 kelas
    public function kurban(){
        return $this->hasOne(kurban::class);
    }


}
