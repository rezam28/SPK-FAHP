<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Kriteria extends Model
{
    use Notifiable;
    
    protected $table = 'kriteria';

    protected $fillable = ['Kode','nama_kriteria','deskripsi'];
}
