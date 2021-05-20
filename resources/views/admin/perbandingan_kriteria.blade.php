@extends('admin.layouts.main')

@section('title',"Admin - Perbandingan Kriteria")

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
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
        <div class="panel panel-default">
            <div id="table-perbandingan" class="table-responsive-md col-12">
                <div class="panel-header">
                    <h3 class="title-center">Data Perbandingan Kriteria</h3>
                </div>
                <hr class="hr-title">
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
                            <button type="submit" class="btn btn-outline-success" type="button" id="btn_simpan">Input</button>
                        </div>
                    </form>
                </div>
                {{-- <h1 id="pilih_daerah">Pilih Daerah</h1> --}}
                <table class="table table-bordered table-striped table-responsive-md" id="table_perbandingan_kriteria">
                    <thead>
                        <tr>
                            <th scope="row">No</th>
                            <th scope="row">Daerah</th>
                            <th scope="row">Kriteria 1</th>
                            <th scope="row">Nilai</th>
                            <th scope="row">Kriteria 2</th>
                            <th scope="row">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="nilai_perbandingan">
                        @foreach ($perbandingan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->daerah->nama_daerah}}</td>
                                <td>{{ $item->kriteria1->kode}} - {{ $item->kriteria1->nama_kriteria }}</td>
                                <td>{{ $item['nilai'] }}</td>
                                <td>{{ $item->kriteria2->kode }} - {{ $item->kriteria2->nama_kriteria }}</td>
                                <td>
                                    <button type="button" class="delete btn btn-danger" id="{{$item->id}}"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Matrik Skala AHP --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Matrik perbandingan Kriteria AHP </strong>
            </div>
            <div style="overflow-x: auto">
                <table class="table table-bordered table-stripes table-responsive-md" id="table_skala_ahp" style="display: none">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach ($kriteria as $item)
                                <th>{{$item['kode']}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody id="matrik_ahp">
                        @foreach ($kriteria as $kolom)
                            <tr>
                                <td>{{$kolom['kode']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Matrik Skala Fuzzy AHP --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Matrik perbandingan Kriteria Fuzzy AHP </strong>
            </div>
            <div style="overflow-x: auto">
                <table class="table table-bordered table-stripes table-responsive-md" id="table_skala_fahp" style="display: none">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach ($kriteria as $item)
                                <th colspan="3">{{$item['kode']}}</th>
                            @endforeach
                        </tr>
                        <tr></tr>
                    </thead>
                    <tbody id="matrik_fahp">
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
                                <td>{{$kolom['kode']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('popup')
    <!-- MULAI MODAL KONFIRMASI DELETE-->

    <div class="modal fade" tabindex="-1" role="dialog" id="hapusmodal" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PERHATIAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Apakah ingin menghapus Data ?</b></p>
                    <p>Data perbandingan kriteria tersebut hilang selamanya, apakah anda yakin?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus Data</button>
                </div>
            </div>
        </div>
    </div>

    <!-- AKHIR MODAL -->
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
        var table = $('#table_perbandingan_kriteria').DataTable({
            // "bServerSide": true,
            "pageLength": 10,
            "bPaginate": true,
            "bJQueryUI": true, // ThemeRoller-stöd
            "bLengthChange": false,
            // "bFilter": false,
            "bSort": false,
            "bInfo": true,
            "bAutoWidth": true,
            "bProcessing": true,
            "iDisplayLength": 10,
        });
    });

    $('#daerah').on('change', function() {
        let daerah = $(this).val(); //daerahID
        $('#table_perbandingan_kriteria').removeAttr('hidden');
        $('#table_skala_ahp').show();
        $('#table_skala_fahp').show();

        $('#matrik_ahp').empty();
        $('#matrik_fahp').empty();

        var table = $('#table_perbandingan_kriteria').DataTable();
        table.clear();
        
        $.get('{{url('admin/perbandingan-kriteria')}}/'+ daerah,function (data) {
            // console.log(data);
            if(!$.trim(data['post'])){
                $('#table_skala_ahp').hide();
                $('#table_skala_fahp').hide();

                $('#table_perbandingan_kriteria').DataTable().clear().draw();
            }
            //data table
            $.each(data['post'], function (indexInArray, v) {
                var tr = '<tr>';
                tr += '<td>'+(indexInArray+1)+'</td>';
                tr += '<td>'+v.daerah.nama_daerah+'</td>';
                tr += '<td>'+v.kriteria1.kode+'&nbsp'+'-'+'&nbsp'+v.kriteria1.nama_kriteria+'</td>';
                tr += '<td>'+v.nilai+'</td>';
                tr += '<td>'+v.kriteria2.kode +'&nbsp'+'-'+'&nbsp'+ v.kriteria2.nama_kriteria+'</td>';
                tr += '<td><button type="button" class="delete btn btn-danger" id="'+v.id+'"><i class="fa fa-trash"></i> Hapus</button></td>';
                tr += '</tr>';
                var table = $('#table_perbandingan_kriteria').DataTable();
                table.rows.add($(tr)).draw();
            });

            //matrik ahp
            $.each(data['kriteria'], function (no, value) { 
                var tr = '<tr>';
                tr += '<td>'+value.kode+'&nbsp'+'-'+'&nbsp'+value.nama_kriteria+'</td>';
                $.each(data['kriteria'], function (index, item) {
                    tr +='<td>';
                    $.each(data['post'], function (i, e) { 
                        if (item.kode == e.kriteria2.kode && value.kode == e.kriteria1.kode) {
                            tr += e.nilai;
                        }
                    });
                    tr +='</td>'
                });
                tr += '</tr>';
                $('#matrik_ahp').append(tr);
            });

            //matrik fuzzy ahp
            var tr = '<tr>';
                tr += '<td></td>';
                $.each(data['kriteria'], function (no, value) { 
                        tr += '<th>L</th>';
                        tr += '<th>M</th>';
                        tr += '<th>U</th>';
                });
            tr += '</tr>';
            $('#matrik_fahp').append(tr);

            $.each(data['kriteria'], function (no, value) { 
                var tr = '<tr>';
                tr += '<td>'+value.kode+'</td>';
                $.each(data['kriteria'], function (index, item) {
                    tr += '<td>';
                    $.each(data['post'], function (i, e) {
                        if (item.kode == e.kriteria2.kode && value.kode == e.kriteria1.kode) {
                            if (e.nilai == 1 || 1/e.nilai == 1){
                                tr += 1;
                            }
                            else if(e.nilai == 2){
                                tr += 1/2;
                            }
                            else if(e.nilai == 1/2){
                                tr += (2/3).toFixed(3);
                            }
                            else if(e.nilai == 3){
                                tr += 1;
                            }
                            else if(e.nilai == (1/3).toFixed(3)){
                                tr += 1/2;
                            }
                            else if(e.nilai == 4){
                                tr += 3/2;
                            }
                            else if(e.nilai == 1/4){
                                tr += 2/5;
                            }
                            else if(e.nilai == 5){
                                tr += 2;
                            }
                            else if(e.nilai == 1/5){
                                tr += (1/3).toFixed(3);
                            }
                            else if(e.nilai == 6){
                                tr += 5/2;
                            }
                            else if(e.nilai == (1/6).toFixed(3)){
                                tr += (2/7).toFixed(3);
                            }else{}
                        }
                    });
                    tr += '</td>';

                    tr += '<td>';
                    $.each(data['post'], function (i, e) {
                        if (item.kode == e.kriteria2.kode && value.kode == e.kriteria1.kode) {
                            if (e.nilai == 1 || 1/e.nilai == 1){
                                tr += 1;
                            }
                            else if(e.nilai == 2){
                                tr += 1;
                            }
                            else if(e.nilai == 1/2){
                                tr += 1;
                            }
                            else if(e.nilai == 3){
                                tr += 3/2;
                            }
                            else if(e.nilai == (1/3).toFixed(3)){
                                tr += (2/3).toFixed(3);
                            }
                            else if(e.nilai == 4){
                                tr += 2;
                            }
                            else if(e.nilai == 1/4){
                                tr += 1/2;
                            }
                            else if(e.nilai == 5){
                                tr += 5/2;
                            }
                            else if(e.nilai == 1/5){
                                tr += 2/5;
                            }
                            else if(e.nilai == 6){
                                tr += 3;
                            }
                            else if(e.nilai == (1/6).toFixed(3)){
                                tr += (1/3).toFixed(3);
                            }else{}
                        }
                    });
                    tr += '</td>';

                    tr += '<td>';
                    $.each(data['post'], function (i, e) {
                        if (item.kode == e.kriteria2.kode && value.kode == e.kriteria1.kode) {
                            if (e.nilai == 1 || 1/e.nilai == 1){
                                tr += 1;
                            }
                            else if(e.nilai == 2){
                                tr += 3/2;
                            }
                            else if(e.nilai == 1/2){
                                tr += 2;
                            }
                            else if(e.nilai == 3){
                                tr += 2;
                            }
                            else if(e.nilai == (1/3).toFixed(3)){
                                tr += 1;
                            }
                            else if(e.nilai == 4){
                                tr += 5/2;
                            }
                            else if(e.nilai == 1/4){
                                tr += (2/3).toFixed(3);
                            }
                            else if(e.nilai == 5){
                                tr += 3;
                            }
                            else if(e.nilai == 1/5){
                                tr += 1/2;
                            }
                            else if(e.nilai == 6){
                                tr += 7/2;
                            }
                            else if(e.nilai == (1/6).toFixed(3)){
                                tr += 2/5;
                            }else{}
                        }
                    });
                    tr += '</td>';
                });
                tr += '</tr>';
                $('#matrik_fahp').append(tr);
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
                        $('#form_perbandingan_kriteria').trigger("reset");
                        $('#btn_simpan').html('Input');
                        location.reload();
                    },
                    error: function(response){
                        alert(response.responseText);
                        console.log(response);
                        $('#btn_simpan').html('error');
                    }
                });
            }
        })
    }

    $(document).on('click', '.delete', function () {
        dataId = $(this).attr('id');
        $('#hapusmodal').modal('show');
        //console.log(dataId);
    });

    $('#tombol-hapus').click(function () {
        $.ajax({
            type: 'DELETE',
            url: "{{url('/admin/perbandingan-kriteria')}}" + dataId, //eksekusi ajax ke url ini
            beforeSend: function () {
                $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
            },
            success: function (data) { //jika sukses
                setTimeout(function () {
                    $('#hapusmodal').modal('hide'); //sembunyikan konfirmasi hapus modal
                    // var Table = $('#table_perbandingan_kriteria').dataTable();
                    // Table.ajax.reload();
                    // Table.fnDraw(false); //reset datatable
                    location.reload();
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        })
    });
    </script>
@endsection