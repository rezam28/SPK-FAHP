@extends('admin.layouts.main')

@section('title',"Admin - Perbandingan Kriteria")

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <style>
        select:required:invalid {
            color: gray;
        }
        option[value=""][disabled] {
            display: none;
        }
        option {
            color: black;
        }
    </style>
@endsection

@section('content')
    <div id="perbandingan">
        <h3>Perbandingan Kriteria</h3>
        <hr>
        <div id="table-perbandingan" class="table-responsive-md col-12">
            <div class="panel-header">
                <h3 class="title-center">Data Perbandingan Kriteria</h3>
            </div>
            <div class="input-group">
                
                <form id="form_perbandingan_kriteria" name="form_perbandingan_kriteria" name="form-horizontal">
                    @csrf
                    <input type="hidden" name="perbandingan_id" id="perbandingan_id" value="" required>
                    <select class="custom-select" name="daerah" id="daerah" required>
                        <option value="" selected disabled>Pilih Daerah</option>
                        @foreach ($daerah as $item)
                            <option value="{{$item['id']}}">{{$item['nama_daerah']}}</option>
                        @endforeach
                    </select>
                    
                    <select class="custom-select" id="kriteria1" name="kriteria1" required>
                        <option value="" selected disabled>Pilih Kriteria</option>
                        @foreach ($kriteria as $item)
                            <option value="{{$item['id']}}">{{$item['kode']}} - {{$item['nama_kriteria']}}</option>
                        @endforeach
                    </select>
                    <select class="custom-select" id="nilai" name="nilai" required>
                        <option value="" selected disabled>Pilih Nilai Bobot</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
                    <select class="custom-select" id="kriteria2" name="kriteria2" required>
                        <option value="" selected disabled>Pilih Kriteria</option>
                        @foreach ($kriteria as $item)
                            <option value="{{$item['id']}}">{{$item['kode']}} - {{$item['nama_kriteria']}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-success" type="button" id="btn_simpan">Input</button>
                    </div>
                </form>
            </div>
            <h1 id="pilih_daerah">Pilih Daerah</h1>
            <table class="table table-bordered table-striped table-responsive-md" id="table_perbandingan_kriteria" hidden>
                <thead>
                    <tr>
                        <th scope="row">Kriteria 1</th>
                        <th scope="row">Nilai</th>
                        <th scope="row">Kriteria 2</th>
                    </tr>
                </thead>
                <tbody id="nilai_perbandingan">
                    {{-- @foreach ($perbandingan as $item)
                        <tr>
                            <td>{{ $item->kriteria1->kode}} - {{ $item->kriteria1->nama_kriteria }}</td>
                            <td>{{ $item['nilai'] }}</td>
                            <td>{{ $item->kriteria2->kode }} - {{ $item->kriteria2->nama_kriteria }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('popup')
    
@endsection

@section('javascript')
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $(document).ready(function () {
        var table = $('#table_perbandingan_kriteria').DataTable();
    });

    $('#daerah').on('change', function() {
        let daerah = $(this).val(); //daerahID
        $('#table_perbandingan_kriteria').removeAttr('hidden');
        $('#pilih_daerah').attr('hidden',true);
        $('#nilai_perbandingan').empty();
        
        $.get('{{url('admin/perbandingan-kriteria')}}/'+ daerah,function (data) {
            //console.log(data);
            $.each(data, function (indexInArray, v) {
                $('#nilai_perbandingan').append("<tr><td>"+v.kriteria1.kode+'&nbsp'+'-'+'&nbsp'+v.kriteria1.nama_kriteria+ "</td><td>"+v.nilai+"</td><td>"+v.kriteria2.kode +'&nbsp'+'-'+'&nbsp'+ v.kriteria2.nama_kriteria+"</td> </tr>");
            });
        });
    });

    if($('#form_perbandingan_kriteria').length > 0) {
        $('#form_perbandingan_kriteria').validate({
            submitHandler: function(data){
                $('#btn_simpan').html('Sending..');
                $.ajax({
                    type: "POST",
                    url: "{{ route('ad_pk') }}",
                    data: $('#form_perbandingan_kriteria').serialize(),
                    dataType: "json",
                    success: function (response) {
                        $('#form_perbandingan_kriteria').trigger('reset');
                        $('#btn_simpan').html('Input');
                        var Table = $('#table_perbandingan_kriteria').dataTable(); //inialisasi datatable
                        Table.fnDraw(false); //reset datatable
                        console.log(response);
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            }
        })
    }
    </script>
@endsection