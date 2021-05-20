<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Peta extends Model
{
    use Notifiable;
    
    protected $table = 'peta';

    protected $fillable = ['daerah_id','keterangan'];

    protected $with = ['daerah'];

    function daerah()
    {
        return $this->belongsTo('App\Models\Daerah', 'daerah_id','id');
    }
}
