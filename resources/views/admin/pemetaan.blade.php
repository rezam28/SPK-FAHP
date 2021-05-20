@extends('admin.layouts.main')

@section('title',"Admin - PEMETAAN")

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
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
<div class="table-hasil">
    <div class="panel panel-default">
          <h3 class="title-center">Data Pemetaan</h3>
          <hr class="hr-title">
          <a class="btn btn-success" href="javascript:void(0)" id="tambahpemetaan"> Tambah</a>
          <div class="row" id="table-data">
              <div class="col-12">
              <table id="table" class="table table-bordered table-striped">
                  @csrf
                  <thead>
                      <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama Daerah</th>
                          <th scope="col">latitude</th>
                          <th scope="col">longitude</th>
                          <th scope="col">Keterangan</th>
                          <th scope="col">Aksi</th>
                      </tr>
                  </thead>
                  </table>
              </div>
          </div>
    </div>
</div>
@endsection

@section('popup')
{{-- Modal Tambah - Edit --}}
<div id="modal-tambah" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        {{-- modal content --}}
        <div class="modal-content">
            <div class="modal-header text-center">
              <h4 id="modal-title" class="modal-title w-100 font-weight-bold"></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form-pemetaan" class="form-horizontal" name="form-pemetaan">
                    @csrf
                    <input type="hidden" name="pemetaan_id" id="pemetaan_id" value="">
                    <label>Pilih Daerah <span class="text-danger">*</span></label>
                    <select class="custom-select" name="daerah" id="daerah" required>
                        <option value="" selected disabled>Pilih Daerah</option>
                        @foreach ($daerah as $key => $item)
                            <option value="{{$item['id']}}">{{$item['nama_daerah']}}</option>
                            {{-- <input type="hidden" name="key" id="key" value="{{$key}}"> --}}
                        @endforeach
                    </select>
                    <div class="form-group">
                        <label>Longitude <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="longitude" id="longitude" value="" disabled/>
                    </div>
                    <div class="form-group">
                        <label>Latitude <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="latitude" id="latitude" value="" disabled/>
                    </div>
                    <label>Keterangan</label>
                    <div class="form-group">
                        <textarea style="width:465px" class="mce" name="keterangan"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn_simpan" class="btn btn-outline-success" value="tambah">Simpan</button>
                        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
                    </div>
              </form>
          </div>
        </div>
    </div>
</div>
{{-- end modal --}}

    <!-- MULAI MODAL KONFIRMASI DELETE-->

    <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PERHATIAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Apakah ingin menghapus Data Pemetaan ?</b></p>
                    <p>Data Pemetaan tersebut hilang selamanya, apakah anda yakin?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                        Data</button>
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

    $(document).ready(function() {
        var table = $('#table').DataTable({
            processing : true,
            serverSide : true,
            scrollY: true,
            scrollX: true,
            scrollCollapse: true,
            ajax : {
                url: "{{route('ad_pemetaan')}}",
            },
            columns: [
                {data:null},
                {data: 'daerah.nama_daerah'},
                {data: 'daerah.lat'},
                {data: 'daerah.lng'},
                {data: 'keterangan'},
                {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
            ],
            columnDefs: [      
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },
                { "width": "50%", "targets": [4] },
                { "width": "20%", "targets": [5] }
            ]
        });
        table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, { search: 'applied', order: 'applied', page: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });
    });

    $('#tambahpemetaan').click(function () {
        $('#btn_simpan').val("tambah-pemetaan");
        $('#pemetaan_id').val('');
        $('#form-pemetaan').trigger("reset");
        $('#modal-title').html("Tambah Data Pemetaan");
        $('#modal-tambah').modal('show');

        $('#daerah').on('change', function() { 
            var daerah = @json($daerah);
            var key = $(this).val();
            var test = $('#key').val();
            console.log(daerah);
            $('#latitude').val(daerah[key].lat);
            $('#longitude').val(daerah[key].lng);
        });
    });
    

    //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
    //jika id = form-kriteria panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
    //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
    if ($("#form-pemetaan").length > 0) {
        $("#form-pemetaan").validate({
            submitHandler: function (form) {
                var actionType = $('#btn_simpan').val();
                $('#btn_simpan').html('Sending..');
                $.ajax({
                    data: $('#form-pemetaan')
                        .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                    url: "{{ route('ad_pemetaan') }}", //url simpan data
                    type: "POST", //karena simpan kita pakai method POST
                    dataType: 'json', //data tipe kita kirim berupa JSON
                    success: function (data) { //jika berhasil 
                        $('#form-pemetaan').trigger("reset"); //form reset
                        $('#modal-tambah').modal('hide'); //modal hide
                        $('#btn_simpan').html('Simpan'); //tombol simpan
                        var Table = $('#table').dataTable(); //inialisasi datatable
                        Table.fnDraw(false); //reset datatable
                        /* iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                            title: 'Data Berhasil Disimpan',
                            message: '{{ Session('
                            success ')}}',
                            position: 'bottomRight'
                        }); */
                    },
                    error: function (data, error) { //jika error tampilkan error pada console
                        console.log('Error:', error);
                        $('#btn_simpan').html('Simpan');
                    }
                });
            }
        })
    }

    $(document).on('click', '.delete', function () {
        dataId = $(this).attr('id');
        $('#konfirmasi-modal').modal('show');
    });

    $('#tombol-hapus').click(function () {
        $.ajax({
            type: 'DELETE',
            url: "{{url('/admin/pemetaan')}}" + dataId, //eksekusi ajax ke url ini
            beforeSend: function () {
                $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
            },
            success: function (data) { //jika sukses
                setTimeout(function () {
                    $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                    var Table = $('#table').dataTable();
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