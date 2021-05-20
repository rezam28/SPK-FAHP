@extends('layout.main')

@section('title',"Hasil Ranking")

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="hasil">
    <div class="table-hasil table-striped">
        <h3>Hasil Perhitungan Pemilihan Jenis Tanaman Pangan Terbaik Di Kecamatan {{$data['daerah'][0]}}</h3>
        <hr style="width:1150px;">

        {{-- Matrik Perbandingan Kriteria AHP --}}
        <div class="panel panel-default">
            <div class="panel-title">
                <strong>Perhitungan Kriteria </strong>
            </div>
            <div style="overflow-x: auto">
                <div class="panel-heading table-bordered table-stripes">
                    <strong>Matrik perbandingan Kriteria AHP </strong>
                </div>
                <table class="table table-bordered table-stripes table-responsive-md" id="table_skala_ahp">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach ($kriteria as $item)
                                <th>{{$item['kode']}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $kolom)
                            <tr>
                            <td>{{$kolom['kode']}} - {{$kolom->nama_kriteria}}</td>
                                @foreach ($kriteria as $baris)
                                <td>
                                    @foreach ($perkriteria as $value)
                                        @if ($baris->kode == $value->kriteria2->kode && $kolom->kode == $value->kriteria1->kode)
                                            {{$value->nilai}}
                                        @endif
                                    @endforeach
                                </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Matrik Perbandingan Kriteria Fuzzy Ahp --}}
            
            <div style="overflow-x: auto">
                <div class="panel-heading">
                    <strong>Matrik perbandingan Kriteria Fuzzy AHP </strong>
                </div>
                <table class="table table-bordered table-stripes" id="table_fuzzy_ahp">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach ($kriteria as $item)
                                <th colspan="3">{{$item['kode']}}</th>
                            @endforeach
                        </tr>
                        <tr></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            @foreach ($kriteria as $item)
                                <th>L</th>
                                <th>M</th>
                                <th>U</th>
                            @endforeach
                        </tr>
                        @foreach ($kriteria as $kolom)
                            <tr>
                                <td>{{$kolom['kode']}} - {{$kolom->nama_kriteria}}</td>
                                @foreach ($kriteria as $baris)
                                    <td>
                                        @foreach ($perkriteria as $value)
                                            @if ($baris->kode == $value->kriteria2->kode && $kolom->kode == $value->kriteria1->kode)
                                                @if ($value->nilai == 1 || 1/$value->nilai == 1)
                                                    1
                                                @elseif($value->nilai == 2)
                                                    {{1/2}}
                                                @elseif($value->nilai == 1/2)
                                                    {{round(2/3,3)}}
                                                @elseif($value->nilai == 3)
                                                    {{1}}
                                                @elseif($value->nilai == round(1/3,3))
                                                    {{1/2}}
                                                @elseif($value->nilai == 4)
                                                    {{3/2}}
                                                @elseif($value->nilai == 1/4)
                                                    {{2/5}}
                                                @elseif($value->nilai == 4)
                                                    {{1}}
                                                @elseif($value->nilai == 1/4)
                                                    {{1/2}}
                                                @elseif($value->nilai == 5)
                                                    {{2}}
                                                @elseif($value->nilai == 1/5)
                                                    {{round(1/3,3)}}
                                                @elseif($value->nilai == 6)
                                                    {{5/2}}
                                                @elseif($value->nilai == round(1/6,3))
                                                    {{round(2/7,3)}}
                                                @endif    
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($perkriteria as $value)
                                            @if ($baris->kode == $value->kriteria2->kode && $kolom->kode == $value->kriteria1->kode)
                                                @if ($value->nilai == 1 || 1/$value->nilai == 1)
                                                    1
                                                @elseif($value->nilai == 2)
                                                    {{1}}
                                                @elseif($value->nilai == 1/2)
                                                    {{1}}
                                                @elseif($value->nilai == 3)
                                                    {{3/2}}
                                                @elseif($value->nilai == round(1/3,3))
                                                    {{round(2/3,3)}}
                                                @elseif($value->nilai == 4)
                                                    {{2}}
                                                @elseif($value->nilai == 1/4)
                                                    {{1/2}}
                                                @elseif($value->nilai == 4)
                                                    {{2}}
                                                @elseif($value->nilai == 1/4)
                                                    {{1/2}}
                                                @elseif($value->nilai == 5)
                                                    {{5/2}}
                                                @elseif($value->nilai == 1/5)
                                                    {{2/5}}
                                                @elseif($value->nilai == 6)
                                                    {{3}}
                                                @elseif($value->nilai == round(1/6,3))
                                                    {{round(1/3,3)}}
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($perkriteria as $value)
                                            @if ($baris->kode == $value->kriteria2->kode && $kolom->kode == $value->kriteria1->kode)
                                                @if ($value->nilai == 1 || 1/$value->nilai == 1)
                                                    1
                                                @elseif($value->nilai == 2)
                                                    {{3/2}}
                                                @elseif($value->nilai == 1/2)
                                                    {{2}}
                                                @elseif($value->nilai == 3)
                                                    {{2}}
                                                @elseif($value->nilai == round(1/3,3))
                                                    {{1}}
                                                @elseif($value->nilai == 4)
                                                    {{5/2}}
                                                @elseif($value->nilai == 1/4)
                                                    {{round(2/3,3)}}
                                                @elseif($value->nilai == 5)
                                                    {{3}}
                                                @elseif($value->nilai == 1/5)
                                                    {{1/2}}
                                                @elseif($value->nilai == 6)
                                                    {{7/2}}
                                                @elseif($value->nilai == round(1/6,3))
                                                    {{2/5}}
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Sintetis Fuzzy --}}

            <div class="table-responsive-md col-12">
                <div class="panel-heading table-bordered table-stripes">
                    <strong>Nilai Sintetis</strong>
                </div>
                <table class="table table-bordered table-stripes table-responsive-md" id="table_si">
                    <thead>
                        <tr>
                            <th></th>
                            <th colspan="3">Jumlah baris</th>
                            <th colspan="3">Nilai SI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            @for ($i = 0; $i < 2; $i++)
                            <th>L</th>
                            <th>M</th>
                            <th>U</th>
                            @endfor
                        </tr>
                        @foreach ($data['kodekri'] as $key => $value)
                            <tr>
                                <td>{{$value}}</td>
                                <td>{{round($data['jumlahnilail'][$key],3)}}</td>
                                <td>{{round($data['jumlahnilaim'][$key],3)}}</td>
                                <td>{{round($data['jumlahnilaiu'][$key],3)}}</td>
                                <td>{{round($data['nilaisil'][$key],3)}}</td>
                                <td>{{round($data['nilaisim'][$key],3)}}</td>
                                <td>{{round($data['nilaisiu'][$key],3)}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Jumlah</td>
                            <td>{{round($data['sumnilail'],3)}}</td>
                            <td>{{round($data['sumnilaim'],3)}}</td>
                            <td>{{round($data['sumnilaiu'],3)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Nilai Vektor Dan Defuzzifikasi --}}

            <div class="table-responsive-md col-12">
                <div class="panel-heading table-bordered table-stripes">
                    <strong>Nilai Vektor Dan Defuzzifikasi</strong>
                </div>
                @foreach ($data['kodekri'] as $no => $isi)
                <div class="panel-heading table-bordered table-stripes">
                    <strong>{{$isi}} - {{$data['namakri'][$no]}}</strong>
                </div>
                <table class="table table-bordered table-stripes table-responsive-md" id="table_defuzzifikasi">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nilai Defuzzifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['defuzzy'][$no] as $key => $value)
                            <tr>
                                @if ($no != $key)
                                    <td>{{$isi}} > {{$data['kodekri'][$key]}}</td>
                                    <td>{{round($value,3)}}</td>
                                @endif
                                
                            </tr>
                        @endforeach
                        <tr>
                            <td>Min / Vektor</td>
                            <td>{{round($data['vektor'][$no],3)}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
            </div>

            <div class="table-responsive-md col-12">
                <div class="panel-heading table-bordered table-stripes">
                    <strong>Normalisasi Bobot Vektor</strong>
                </div>
                <table class="table table-bordered table-stripes table-responsive-md" id="table_si">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>W / Vektor</th>
                            <th>Wlokal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['namakri'] as $no => $item)
                            <tr>
                                <td>{{$data['kodekri'][$no]}} - {{$item}}</td>
                                <td>{{round($data['vektor'][$no],3)}}</td>
                                <td>{{round($data['bobotkri'][$no],3)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Alternatif --}}

        @foreach ($kriteria as $key => $item)
            
            <div class="panel panel-default" id="alternatif_panel">
                <div class="panel-title">
                    <a href="javascript:void(0)" id="{{$item->kode}}" value="{{$item->nama_kriteria}}">Perhitungan Alternatif Terhadap Kriteria {{$item->nama_kriteria}}</a>
                    {{-- <strong id="{{$item->nama_kriteria}}">Perhitungan Alternatif Terhadap Kriteria {{$item->nama_kriteria}} </strong> --}}
                </div>
                {{-- Matrik Perbandingan Kriteria AHP --}}
                <div class="alternatif table-responsive-md col-12" id="alternatif_ahp_{{$item->kode}}" style="display: none">
                    <div class="panel-heading table-bordered table-stripes">
                        <strong>Matrik perbandingan Alternatif Terhadap Kriteria {{$item->nama_kriteria}} AHP </strong>
                    </div>
                    <table class="table table-bordered table-stripes table-responsive-md" id="table_skala_ahp">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach ($data['kodealter'] as $value)
                                    <th>{{$value}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['selected'] as $nk => $kolom)
                                <tr>
                                    <td>{{$data['kodealter'][$nk]}} - {{$data['namaalter'][$nk]}}</td>
                                    @foreach ($data['selected'] as $nb => $baris)
                                    <td>
                                        @foreach ($peralternatif[$key] as $value)
                                            @if ($data['kodealter'][$nb] == $value->alternatif2->kode && $data['kodealter'][$nk] == $value->alternatif1->kode)
                                                {{$value->nilai}}
                                            @endif
                                        @endforeach
                                    </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Matrik Perbandingan alternatif Fuzzy Ahp --}}
                <div class="table-responsive-md col-12" id="alternatif_fahap_{{$item->kode}}" style="display: none">
                    <div class="panel-heading">
                        <strong>Matrik perbandingan Alternatif Terhadap Kriteria {{$item->nama_kriteria}} Fuzzy AHP </strong>
                    </div>
                    <table class="table table-bordered table-stripes table-responsive-md" id="table_fuzzy_ahp" style="overflow-x: auto">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach ($data['kodealter'] as $value)
                                    <th colspan="3">{{$value}}</th>
                                @endforeach
                            </tr>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                @foreach ($data['kodealter'] as $value)
                                    <td>L</td>
                                    <td>M</td>
                                    <td>U</td>
                                @endforeach
                            </tr>
                            @foreach ($data['selected'] as $nk => $kolom)
                                <tr>
                                    <td>{{$data['kodealter'][$nk]}} - {{$data['namaalter'][$nk]}}</td>
                                    @foreach ($data['selected'] as $nb => $baris)
                                    <td>
                                        @foreach ($peralternatif[$key] as $value)
                                            @if ($data['kodealter'][$nb] == $value->alternatif2->kode && $data['kodealter'][$nk] == $value->alternatif1->kode)
                                                @if ($value->nilai == 1 || 1/$value->nilai == 1)
                                                    1
                                                @elseif($value->nilai == 2)
                                                    {{1/2}}
                                                @elseif($value->nilai == 1/2)
                                                    {{round(2/3,3)}}
                                                @elseif($value->nilai == 3)
                                                    {{1}}
                                                @elseif($value->nilai == round(1/3,3))
                                                    {{1/2}}
                                                @elseif($value->nilai == 4)
                                                    {{3/2}}
                                                @elseif($value->nilai == 1/4)
                                                    {{2/5}}
                                                @elseif($value->nilai == 4)
                                                    {{1}}
                                                @elseif($value->nilai == 1/4)
                                                    {{1/2}}
                                                @elseif($value->nilai == 5)
                                                    {{2}}
                                                @elseif($value->nilai == 1/5)
                                                    {{round(1/3,3)}}
                                                @elseif($value->nilai == 6)
                                                    {{5/2}}
                                                @elseif($value->nilai == round(1/6,3))
                                                    {{round(2/7,3)}}
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($peralternatif[$key] as $value)
                                            @if ($data['kodealter'][$nb] == $value->alternatif2->kode && $data['kodealter'][$nk] == $value->alternatif1->kode)
                                                @if ($value->nilai == 1 || 1/$value->nilai == 1)
                                                    1
                                                @elseif($value->nilai == 2)
                                                    {{1}}
                                                @elseif($value->nilai == 1/2)
                                                    {{1}}
                                                @elseif($value->nilai == 3)
                                                    {{3/2}}
                                                @elseif($value->nilai == round(1/3,3))
                                                    {{round(2/3,3)}}
                                                @elseif($value->nilai == 4)
                                                    {{2}}
                                                @elseif($value->nilai == 1/4)
                                                    {{1/2}}
                                                @elseif($value->nilai == 4)
                                                    {{2}}
                                                @elseif($value->nilai == 1/4)
                                                    {{1/2}}
                                                @elseif($value->nilai == 5)
                                                    {{5/2}}
                                                @elseif($value->nilai == 1/5)
                                                    {{2/5}}
                                                @elseif($value->nilai == 6)
                                                    {{3}}
                                                @elseif($value->nilai == round(1/6,3))
                                                    {{round(1/3,3)}}
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($peralternatif[$key] as $value)
                                            @if ($data['kodealter'][$nb] == $value->alternatif2->kode && $data['kodealter'][$nk] == $value->alternatif1->kode)
                                                @if ($value->nilai == 1 || 1/$value->nilai == 1)
                                                    1
                                                @elseif($value->nilai == 2)
                                                    {{3/2}}
                                                @elseif($value->nilai == 1/2)
                                                    {{2}}
                                                @elseif($value->nilai == 3)
                                                    {{2}}
                                                @elseif($value->nilai == round(1/3,3))
                                                    {{1}}
                                                @elseif($value->nilai == 4)
                                                    {{5/2}}
                                                @elseif($value->nilai == 1/4)
                                                    {{round(2/3,3)}}
                                                @elseif($value->nilai == 5)
                                                    {{3}}
                                                @elseif($value->nilai == 1/5)
                                                    {{1/2}}
                                                @elseif($value->nilai == 6)
                                                    {{7/2}}
                                                @elseif($value->nilai == round(1/6,3))
                                                    {{2/5}}
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Sintetis Fuzzy alternatif --}}
                <div class="table-responsive-md col-12" id="alternatif_si_{{$item->kode}}" style="display: none">
                    <div class="panel-heading table-bordered table-stripes">
                        <strong>Nilai Sintetis</strong>
                    </div>
                    <table class="table table-bordered table-stripes table-responsive-md" id="table_si">
                        <thead>
                            <tr>
                                <th></th>
                                <th colspan="3">Jumlah baris</th>
                                <th colspan="3">Nilai SI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                @for ($i = 0; $i < 2; $i++)
                                <th>L</th>
                                <th>M</th>
                                <th>U</th>
                                @endfor
                            </tr>
                            @foreach ($data['kodealter'] as $no => $value)
                                <tr>
                                    <td>{{$value}}</td>
                                    <td>{{round($data['jmlbarisalterl'][$key][$no],3)}}</td>
                                    <td>{{round($data['jmlbarisalterm'][$key][$no],3)}}</td>
                                    <td>{{round($data['jmlbarisalteru'][$key][$no],3)}}</td>
                                    <td>{{round($data['nilaialtersil'][$key][$no],3)}}</td>
                                    <td>{{round($data['nilaialtersim'][$key][$no],3)}}</td>
                                    <td>{{round($data['nilaialtersiu'][$key][$no],3)}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>Jumlah</td>
                                <td>{{round($data['sumjmlalterl'][$key],3)}}</td>
                                <td>{{round($data['sumjmlalterm'][$key],3)}}</td>
                                <td>{{round($data['sumjmlalteru'][$key],3)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Nilai Vektor Dan Defuzzifikasi --}}
                <div class="table-responsive-md col-12" id="alternatif_vektor_{{$item->kode}}" style="display: none">
                    <div class="panel-heading table-bordered table-stripes">
                        <strong>Nilai Vektor Dan Defuzzifikasi Alternatif</strong>
                    </div>
                    @foreach ($data['kodealter'] as $no => $isi)
                    <div class="panel-heading table-bordered table-stripes">
                        <strong>{{$isi}} - {{$data['namaalter'][$no]}}</strong>
                    </div>
                    <table class="table table-bordered table-stripes table-responsive-md" id="table_defuzzifikasi">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nilai Defuzzifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['alterdefuzzy'][$key][$no] as $num => $value)
                                <tr>
                                    @if ($no != $num)
                                        <td>{{$isi}} > {{$data['kodealter'][$num]}}</td>
                                        <td>{{round($value,3)}}</td>
                                    @endif
                                    
                                </tr>
                            @endforeach
                            <tr>
                                <td>Min / Vektor</td>
                                <td>{{round($data['vektoralter'][$key][$no],3)}}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                </div>

                {{-- Normalisi Bobot Alternatif --}}
                <div class="table-responsive-md col-12" id="alternatif_normalisasi_{{$item->kode}}" style="display: none">
                    <div class="panel-heading table-bordered table-stripes">
                        <strong>Normalisasi Bobot Vektor Alternatif</strong>
                    </div>
                    <table class="table table-bordered table-stripes table-responsive-md" id="table_si">
                        <thead>
                            <tr>
                                <th>Alternatif</th>
                                <th>W / Vektor</th>
                                <th>Wlokal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['namaalter'] as $no => $item)
                                <tr>
                                    <td>{{$data['kodealter'][$no]}} - {{$item}}</td>
                                    <td>{{round($data['vektoralter'][$key][$no],3)}}</td>
                                    <td>{{round($data['bobotalter'][$key][$no],3)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> 
        @endforeach

        {{-- Panel Hasil --}}
        <div class="panel" id="hasil-pembobotan">

            {{-- Hasil Pembobotan --}}
            <div class="table-responsive-md col-12">
                <div class="panel-heading table-bordered table-stripes">
                    <strong>Hasil Pembobotan</strong>
                </div>
                <table class="table table-bordered table-stripes table-responsive-md" id="table_hasil_pembobotan">
                    <thead>
                        <tr>
                            <th>kriteria</th>
                            <th></th>
                            <th colspan="{{count($data['selected'])}}">Skor Alternatif yang Berhubungan Dengan Kriteria Terkait</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>W</th>
                            @foreach ($data['selected'] as $key => $item)
                                <th>{{$data['kodealter'][$key]}} - {{$data['namaalter'][$key]}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['kodekri'] as $key => $item)
                            <tr>
                                <td>{{$item}} - {{$data['namakri'][$key]}}</td>
                                <td>{{round($data['bobotkri'][$key],3)}}</td>
                                @foreach ($data['bobotalter'][$key] as $num => $item)                                
                                    <td>{{round($data['bobotalter'][$key][$num],3)}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">Total</td>
                            @foreach ($data['hasil'] as $item)
                                <td>{{round($item,3)}}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            
            <div id="hasil-ranking">
                <h3>Hasil Perankingan</h3>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Ranking</th>
                    <th scope="col">Alternatif</th>
                    <th scope="col">Bobot Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['ranking'] as $key => $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            @foreach ($data['kodealter'] as $no => $value)
                                @if ($key == $value)
                                    <td>{{$value}} - {{$data['namaalter'][$no]}}</td>
                                @endif
                            @endforeach
                            <td>{{round($item,3)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).ready(function () {
           
            $('html, body').animate({
                scrollTop: $("#hasil-ranking").offset().top
            }, 2000);
        });
        $('a').click(function () { 
            var id = $(this).attr("id");
            // console.log(id);
            $('#alternatif_ahp_'+ id).toggle(1000);
            $('#alternatif_fahap_' + id).toggle(1000);
            $('#alternatif_si_'+id).toggle(1000);
            $('#alternatif_vektor_'+id).toggle(1000);
            $('#alternatif_normalisasi_'+id).toggle(1000);            
        });
    </script>
@endsection