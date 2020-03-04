<?php

namespace App\Models\Anggota;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PasswordReset;

class Anggota extends Authenticatable
{
    use Notifiable;
    protected $table = 'anggota';

    protected $fillable = [
        'id', 'username', 'password', 'nama', 'alamat', 'telp', 'email', 'link_foto', 'id_status', 'id_jabatan'
    ];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    public function panitia(){
        return $this->hasOne(panitia::class);
    }



}
