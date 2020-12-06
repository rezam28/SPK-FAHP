<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Kriteria extends Model
{
    use Notifiable;
    
    protected $table = 'kriteria';

    protected $fillable = ['Kode','nama_kriteria','deskripsi'];
    
    function perbandingankriteria()
    {
        return $this->hasMany('App\Models\Perbandingankriteria');
    }

    function perbandinganalternatif()
    {
        return $this->hasMany('App\Models\Perbandinganalternatif');
    }
}
