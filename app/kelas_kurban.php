<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kelas_kurban extends Model
{
    protected $table = 'kelas_kurban';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];


   
    
    public function kurban(){
        return $this->hasOne(kurban::class);
     
    }
}

