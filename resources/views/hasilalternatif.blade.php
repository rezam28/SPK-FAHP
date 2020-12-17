@extends('../hasilranking')

@section('alternatif')


<div>
    <h1>TeST</h1>
</div>
{{-- <div class="table-responsive-md col-12">
    <div class="panel-heading table-bordered table-stripes">
        <strong>Nilai Alternatif</strong>
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
</div> --}}
@endsection