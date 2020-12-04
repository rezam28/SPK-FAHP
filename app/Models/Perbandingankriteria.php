<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Perbandingankriteria extends Model
{
    use Notifiable;

    protected $fillable = ['kriteria1_id', 'nilai', 'kriteria2_id','daerah_id'];

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

    // public function nilai()
    // {
    //     return $this->belongsTo('App\Models\Nilai','nilai_id');
    // }
}
