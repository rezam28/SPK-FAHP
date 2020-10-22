<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Daerah extends Model
{
    use Notifiable;
    
    protected $table = 'daerah';

    // protected $fillable = ['Kode','nama_alternatif','deskripsi'];
}
