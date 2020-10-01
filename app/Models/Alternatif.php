<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Alternatif extends Model
{
    use Notifiable;
    
    protected $table = 'alternatif';

    protected $fillable = ['Kode','nama_alternatif','deskripsi'];
}
