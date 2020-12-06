<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Perbandinganalternatif extends Model
{
    use Notifiable;

    protected $fillable = ['nama_kriteria', 'alternatif1_id', 'nilai', 'alternatif2_id','daerah_id'];

    protected $table = 'perbandingan_alternatif';

    protected $with = ['alternatif1', 'alternatif2', 'daerah','kriteria'];

    public function alternatif1()
    {
        return $this->belongsTo('App\Models\alternatif','alternatif1_id', 'id');
    }

    public function alternatif2()
    {
        return $this->belongsTo('App\Models\alternatif','alternatif2_id', 'id');
    }

    public function daerah()
    {       
        return $this->belongsTo('App\Models\daerah', 'daerah_id','id');
    }

    public function kriteria()
    {       
        return $this->belongsTo('App\Models\kriteria', 'nama_kriteria','id');
    }
}
