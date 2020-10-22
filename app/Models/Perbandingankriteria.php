<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Perbandingankriteria extends Model
{
    protected $table = 'perbandingan_kriteria';

    protected $with = ['kriteria1', 'kriteria2', 'daerah'];

    public function kriteria1()
    {
        return $this->belongsTo('App\Models\Kriteria','kriteria1_id', 'id');
    }

    public function kriteria2()
    {
        return $this->belongsTo('App\Models\Kriteria','kriteria2_id', 'id');
    }

    public function daerah()
    {       
        return $this->belongsTo('App\Models\daerah', 'daerah_id','id');
    }
}
