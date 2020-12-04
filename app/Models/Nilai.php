<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Nilai extends Model
{
    use Notifiable;
    
    protected $table = 'nilai';

    protected $fillable = ['nilai','l', 'm', 'u'];
    
    function perbandingankriteria()
    {
        return $this->hasMany('App\Models\Perbandingankriteria');
    }
}
