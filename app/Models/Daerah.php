<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Daerah extends Model
{
    use Notifiable;
    
    protected $table = 'daerah';

    protected $fillable = ['nama_daerah'];

    function perbandingankriteria()
    {
        return $this->hasMany('App\Models\Perbandingankriteria');
    }

    function perbandinganalternatif()
    {
        return $this->hasMany('App\Models\Perbandinganalternatif');
    }
}
