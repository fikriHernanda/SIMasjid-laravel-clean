<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pekurban extends Model
{
    protected $table = 'pekurban';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function kurban(){
        return $this->belongsTo(kurban::Class);
    }
    public function status_kurban(){
        return $this->belongsTo(status_kurban::Class);
    }
    public function bagian_kurban(){
        return $this->belongsTo(bagian_kurban::Class);
    }
}

