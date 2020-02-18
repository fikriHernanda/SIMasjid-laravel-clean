<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kurban extends Model
{
    protected $table = 'kurban';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

public function kelas_kurban(){
    return $this->belongsTo(kelas_kurban::Class);
}
public function jenis_kurban(){
    return $this->belongsTo(jenis_kurban::Class);
}
public function pekurban(){
    return $this->hasOne(pekurban::class);

}
}