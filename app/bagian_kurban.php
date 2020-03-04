<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bagian_kurban extends Model
{
    protected $table = 'bagian_kurban';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

   
    public function pekurban(){
        return $this->hasOne(pekurban::Class);
    }
    public function jenis_kurban(){
        return $this->belongsTo(jenis_kurban::Class);
    }

}
