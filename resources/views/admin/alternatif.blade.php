@extends('admin.layouts.main')

@section('title',"Admin - Alternatif")

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

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
              <button type="button" id="btn-tambah" class="btn btn-info btn-lg fa fa-plus" data-toggle="modal" data-target="#modal-tambah">&nbsp Tambah</button>
            </div>
              <div class="row">
                <div class="col-12">
                <table id="table" class="table table-bordered table-striped">
                    @csrf
                    <thead>
                        <tr>
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
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                      <form>
                          @csrf
                          <div class="form-group">
                              <label for="exampleInputEmail1">Fullname</label>
                              <input type="text" class="form-control" id="Fullname" placeholder="Fullname">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Username">
                          </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Tambah</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
          </div>
      </div>
      {{-- end modal --}}
@endsection
@section('javascript')
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable({
                processing : true,
                serverSide : true,
                scrollY: "300px",
                scrollX: true,
                scrollCollapse: true,
                ajax : {
                    url: "{{route('ad_alternatif')}}",
                },
                columns: [
                    {data: 'nama_alternatif' , nama:'nama_alternatif'},
                    {data: 'deskripsi', nama:'deskripsi'},
                    {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
                ],
                // columnDefs: [      
                //     { "width": "200px", "targets": [2] }
                // ]
                // order:[[0,'asc']]
            });

        });
    </script>
@endsection