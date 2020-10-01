@extends('admin.layouts.main')

@section('title',"Admin - Alternatif")

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

@endsection

@section('content')
    {{-- @if(\Session::has('alert'))
    <div class="alert alert-danger" role="alert" style="width:1170px">
      <div>{{Session::get('alert')}}</div>
    </div>
    @endif --}}
  <div class="table-hasil">
      <h3>Alternatif</h3>
      <hr>
      <div class="panel">
            <div class="panel-header">
              <h3 class="title-center">Data Alternatif</h3>
              <a class="btn btn-success" href="javascript:void(0)" id="tambah-alternatif"> Tambah</a>
            </div>
              <div class="row">
                <div class="col-12">
                <table id="table" class="table table-bordered table-striped">
                    @csrf
                    <thead>
                        <tr>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama Alternatif</th>
                            <th scope="col">Deskripsi</th>
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
    {{-- Modal Tambah --}}
      <div id="modal-tambah" class="modal fade" role="dialog">
          <div class="modal-dialog">
              {{-- modal content --}}
              <div class="modal-content">
                  <div class="modal-header">
                    <h4 id="modal-title" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                      <form class="form-alternatif" id="form-alternatif" name="form-alternatif">
                          @csrf
                          <input type="hidden" id="alternatif_id" name="alternatif_id" value="" required>
                          <div class="form-group">
                              <label for="nama">Kode</label>
                              <div class="col-sm-12">
                                <input type="text" class="form-control" id="kode" name="kode" value="" required>
                              </div>
                          </div>
                          <div class="form-group">
                            <label for="nama">Nama Alternatif</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif" value="" required>
                            </div>
                          </div>
                          <div class="form-grup">
                              <label for="nama">Deskripsi</label>
                              <div class="col-sm-12">
                                <textarea name="deskripsi" id="deskripsi" cols="55" rows="10" value="" required></textarea>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="sumbit" id="btn-simpan" class="btn btn-success" value="tambah">Tambah</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                      <p><b>Apakah ingin menghapus alternatif ?</b></p>
                      <p>*data alternatif tersebut hilang selamanya, apakah anda yakin?</p>
                   </div>
                   <div class="modal-footer bg-whitesmoke br">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        });
        
        $(document).ready(function() {
            $('#table').DataTable({
                processing : true,
                serverSide : true,
                scrollY: true,
                scrollX: true,
                scrollCollapse: true,
                ajax : {
                    url: "{{route('ad_alternatif')}}",
                },
                columns: [
                    {data: 'kode' , nama: 'kode'},
                    {data: 'nama_alternatif' , nama:'nama_alternatif'},
                    {data: 'deskripsi', nama:'deskripsi',orderable: false},
                    {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
                ],
                columnDefs: [      
                    { "width": "140px", "targets": [3] }
                ]
                // order:[[0,'asc']]
            });
        });

        $('#tambah-alternatif').click(function () {
            $('#btn-simpan').val("tambah-alternatif");
            $('#alternatif_id').val('');
            $('#form-alternatif').trigger("reset");
            $('#modal-title').html("Tambah alternatif");
            $('#modal-tambah').modal('show');
        });

        //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
        //jika id = form-alternatif panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
        //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
        if ($("#form-alternatif").length > 0) {
            $("#form-alternatif").validate({
                submitHandler: function (form) {
                    var actionType = $('#btn-simpan').val();
                    $('#btn-simpan').html('Sending..');
                    $.ajax({
                        data: $('#form-alternatif')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route('ad_alternatif') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON
                        success: function (data) { //jika berhasil 
                            $('#form-alternatif').trigger("reset"); //form reset
                            $('#modal-tambah').modal('hide'); //modal hide
                            $('#btn-simpan').html('Simpan'); //tombol simpan
                            var Table = $('#table').dataTable(); //inialisasi datatable
                            Table.fnDraw(false); //reset datatable
                            /* iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data Berhasil Disimpan',
                                message: '{{ Session('
                                success ')}}',
                                position: 'bottomRight'
                            }); */
                        },
                        error: function (data) { //jika error tampilkan error pada console
                            console.log('Error:', data);
                            $('#btn-simpan').html('Simpan');
                        }
                    });
                }
            })
        }

        $('body').on('click', '.edit-alternatif', function () {
            var alternatif_id = $(this).data('id');
            $.get('{{ url('/admin/alternatif') }}' +'/' + alternatif_id + '/edit', function (data) {
                $('#modal-title').html("Edit alternatif");
                $('#btn-simpan').val("edit-alternatif");
                $('#modal-tambah').modal('show');

                $('#alternatif_id').val(data.id);
                $('#kode').val(data.kode);
                $('#nama_alternatif').val(data.nama_alternatif);
                $('#deskripsi').val(data.deskripsi);
            })
        });

        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });

        $('#tombol-hapus').click(function () {
            $.ajax({
                type: 'DELETE',
                url: "{{url('/admin/alternatif')}}" + dataId, //eksekusi ajax ke url ini
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