<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penyembelih extends Model
{
    protected $table = 'penyembelih';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
}
