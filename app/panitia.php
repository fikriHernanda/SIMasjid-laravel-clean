<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class panitia extends Model
{
    protected $table = 'panitia';
  
    protected $guarded = ['id'];
    public $timestamps = false;
    public function anggota(){

        return $this->belongsTo('App\Models\Anggota\Anggota');
    }

}
