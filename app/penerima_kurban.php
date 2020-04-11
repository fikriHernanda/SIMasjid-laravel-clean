<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penerima_kurban extends Model
{
    protected $table = 'penerima_kurban';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
}
