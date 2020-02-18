<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_kurban extends Model
{
    protected $table = 'status_kurban';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function pekurban(){
        return $this->hasOne(pekurban::Class);
    }
}
