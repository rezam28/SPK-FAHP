@extends('admin.layouts.main')

@section('title',"Admin - Perbandingan Alternatif")

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" langukriteria="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
        <h3>Perbandingan alternatif</h3>
        <hr>
        <div class="panel panel-deafult">
            <div id="table-perbandingan" class="table-responsive-md col-12">
                <div class="panel-header">
                    <h3 class="title-center">Data Perbandingan alternatif</h3>
                </div>
                <div class="input-group">
                    <form id="form_perbandingan_alternatif" name="form_perbandingan_alternatif">
                        @csrf
                        <input type="hidden" name="perbandingan_id" id="perbandingan_id" value="" required>
                        <select class="custom-select" id="daerah" name="daerah" required>
                            <option value="" selected disabled>Pilih Daerah</option>
                            @foreach ($daerah as $item)
                                <option value="{{$item->id}}">{{$item->nama_daerah}}</option>
                            @endforeach
                        </select>
                        <select class="custom-select" id="kriteria" name="kriteria" required>
                            <option value="" selected disabled>Pilih Kriteria</option>
                            @foreach ($kriteria as $item)               
                                <option value="{{$item->id}}">{{$item->nama_kriteria}}</option>
                            @endforeach
                        </select>
                        <select class="custom-select" id="alternatif1" name="alternatif1" required>
                            <option value="" selected disabled>Pilih Alternatif</option>
                            @foreach ($alternatif as $item)
                                <option value="{{$item->id}}">{{$item->nama_alternatif}}</option>
                            @endforeach
                        </select>
                        <select class="custom-select" id="nilai" name="nilai" required>
                            <option value="" selected disabled>Pilih Nilai</option>
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
                        <select class="custom-select" id="alternatif2" name="alternatif2" required>
                            <option value="" selected disabled>Plih Alternatif</option>
                            @foreach ($alternatif as $item)
                                <option value="{{$item->id}}">{{$item->nama_alternatif}}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success" type="button" id="btn_simpan">Input</button>
                        </div>
                    </form>
                </div>
                <div class="table-responsive-md">
                    <table class="table table-bordered table-striped" id="table_perbandingan_alternatif">
                        <thead>
                            <tr>
                                <th scope="row">No</th>
                                <th scope="row">Daerah</th>
                                <th scope="row">Kriteria</th>
                                <th scope="row">Alternatif 1</th>
                                <th scope="row">Nilai</th>
                                <th scope="row">Alternatif 2</th>
                                <th scope="row">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="nilai_perbandingan">
                            @foreach ($perbandingan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->daerah->nama_daerah}}</td>
                                    <td>{{ $item->kriteria->nama_kriteria}}</td>
                                    <td>{{ $item->alternatif1->kode}} - {{ $item->alternatif1->nama_alternatif }}</td>
                                    <td>{{ $item['nilai'] }}</td>
                                    <td>{{ $item->alternatif2->kode }} - {{ $item->alternatif2->nama_alternatif }}</td>
                                    <td>
                                        <button type="button" class="delete btn btn-danger" id="{{$item->id}}"><i class="fa fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Matrik Skala AHP --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Matrik perbandingan alternatif AHP </strong>
            </div>
            <div class="table-responsive-md col-12">
                <table class="table table-bordered table-stripes table-responsive-md" id="table_skala_ahp">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach ($alternatif as $item)
                                <th>{{$item['kode']}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatif as $kolom)
                            <tr>
                                <td>{{$kolom['kode']}}</td>
                                @foreach ($alternatif as $baris)
                                <td>
                                    @foreach ($perbandingan as $value)
                                        @if ($baris->kode == $value->alternatif2->kode && $kolom->kode == $value->alternatif1->kode)
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
                    <p>Data perbandingan alternatif tersebut hilang selamanya, apakah anda yakin?</p>
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


    <script type="text/javascript" langukriteria="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" langukriteria="javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
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
        var table = $('#table_perbandingan_alternatif').DataTable({
            // "bServerSide": true,
            "bPaginate": true,
            "bJQueryUI": true, // ThemeRoller-stöd
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "bInfo": true,
            "bAutoWidth": true,
            "bProcessing": true,
            "iDisplayLength": 10,
            // ajax : {
            //     url: "{{route('ad_pk')}}",
            // },
            // columns: [
            //     {data: 'kode' , nama: 'kode'},
            //     {data: 'nama_kriteria' , nama:'nama_kriteria'},
            //     {data: 'deskripsi', nama:'deskripsi',orderable: false},
            //     {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
            // ]
        });
    });

    // $('#daerah').on('change', function() {
    //     let daerah = $(this).val(); //daerahID
    //     $('#nilai_perbandingan').empty();        
    // });

    $(document).ready(function () {
        $("#daerah,#kriteria").on("change", function () {
            let kriteria = $('#kriteria').val(); //kriteriaID
            let daerah = $('#daerah').val(); //daerahID
            SearchData(daerah, kriteria)
            // console.log(kriteria);
            // console.log(daerah);
            $('#nilai_perbandingan').empty();
        });
    });

    function SearchData(daerah, kriteria) {
        if (daerah == 0 && kriteria == 0) {
            //$('#table11 tbody tr').show();
            $.get('{{url('admin/perbandingan-alternatif')}}/'+ kriteria,{daerah : daerah, kriteria : kriteria},function (data) {
            console.log(data);
                $.each(data, function (indexInArray, v) {
                    var tr = '<tr>';
                    tr += '<td>'+(indexInArray+1)+'</td>';
                    tr += '<td>'+v.daerah.nama_daerah+'</td>';
                    tr += '<td>'+v.kriteria.nama_kriteria+'</td>';
                    tr += '<td>'+v.alternatif1.kode+'&nbsp'+'-'+'&nbsp'+v.alternatif1.nama_alternatif+'</td>';
                    tr += '<td>'+v.nilai+'</td>';
                    tr += '<td>'+v.alternatif2.kode +'&nbsp'+'-'+'&nbsp'+ v.alternatif2.nama_alternatif+'</td>';
                    tr += '<td><button type="button" class="delete btn btn-danger" id="'+v.id+'"><i class="fa fa-trash"></i> Hapus</button></td>';
                    tr += '</tr>';
                    $('#nilai_perbandingan').append(tr);
                });
            });
        } else {
            $.get('{{url('admin/perbandingan-alternatif')}}/'+ kriteria,{daerah : daerah, kriteria : kriteria},function (data) {
                //console.log(data);
                $.each(data, function (indexInArray, v) {
                    if (daerah != 0 && kriteria != 0) {
                        var tr = '<tr>';
                        tr += '<td>'+(indexInArray+1)+'</td>';
                        tr += '<td>'+v.daerah.nama_daerah+'</td>';
                        tr += '<td>'+v.kriteria.nama_kriteria+'</td>';
                        tr += '<td>'+v.alternatif1.kode+'&nbsp'+'-'+'&nbsp'+v.alternatif1.nama_alternatif+'</td>';
                        tr += '<td>'+v.nilai+'</td>';
                        tr += '<td>'+v.alternatif2.kode +'&nbsp'+'-'+'&nbsp'+ v.alternatif2.nama_alternatif+'</td>';
                        tr += '<td><button type="button" class="delete btn btn-danger" id="'+v.id+'"><i class="fa fa-trash"></i> Hapus</button></td>';
                        tr += '</tr>';
                        $('#nilai_perbandingan').append(tr);
                        // if (rowdaerah.toUpperCase() == daerah && rowkriteria == kriteria) {
                        //     $(this).show();
                        // } else {
                        //     $(this).hide();
                        // }
                    } else if (daerah != 0 || kriteria != 0) {
                        var tr = '<tr>';
                        tr += '<td>'+(indexInArray+1)+'</td>';
                        tr += '<td>'+v.daerah.nama_daerah+'</td>';
                        tr += '<td>'+v.kriteria.nama_kriteria+'</td>';
                        tr += '<td>'+v.alternatif1.kode+'&nbsp'+'-'+'&nbsp'+v.alternatif1.nama_alternatif+'</td>';
                        tr += '<td>'+v.nilai+'</td>';
                        tr += '<td>'+v.alternatif2.kode +'&nbsp'+'-'+'&nbsp'+ v.alternatif2.nama_alternatif+'</td>';
                        tr += '<td><button type="button" class="delete btn btn-danger" id="'+v.id+'"><i class="fa fa-trash"></i> Hapus</button></td>';
                        tr += '</tr>';
                        $('#nilai_perbandingan').append(tr);
                    }
                });
            });
        }
    }

    if($('#form_perbandingan_alternatif').length > 0) {
        $('#form_perbandingan_alternatif').validate({
            submitHandler: function(data){
                $('#btn_simpan').html('Sending..');
                $.ajax({
                    type: "POST",
                    url: "{{ route('ad_pa') }}",
                    data: $('#form_perbandingan_alternatif').serialize(),
                    dataType: "json",
                    success: function (response) {
                        $('#form_perbandingan_alternatif').trigger('reset');
                        $('#btn_simpan').html('Input');
                        var table = $('#table_perbandingan_alternatif').dataTable(); //inialisasi datatable
                        // table.fnDraw(false); //reset datatable
                        table.reload();
                    },
                    error: function(response){
                        console.log(response);
                        $('#btn_simpan').html('Input');
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
            url: "{{url('/admin/perbandingan-alternatif')}}" + dataId, //eksekusi ajax ke url ini
            beforeSend: function () {
                $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
            },
            success: function (data) { //jika sukses
                setTimeout(function () {
                    $('#hapusmodal').modal('hide'); //sembunyikan konfirmasi hapus modal
                    var Table = $('#table_perbandingan_alternatif').dataTable();
                    Table.fnDraw(false); //reset datatable
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        })
    });
    </script>
@endsection