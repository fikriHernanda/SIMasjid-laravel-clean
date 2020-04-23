<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peralatan extends Model
{
    protected $table = 'peralatan_kurban';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

  
}
