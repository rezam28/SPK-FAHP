@extends('admin.layouts.main')

@section('title',"Admin - Alternatif")

@section('css')
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
      <hr style="width:1150px;">
      <div class="panel">
            <div class="panel-header">
              <h3>Pilih Alternatif</h3>
            </div>
              <div class="row">
                <div class="col-12">
                <table id="tabledit" class="table table-bordered table-striped">
                    @csrf
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Alternatif</th>
                            <th scope="col">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatif as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->nama_alternatif}}</td>
                                <td>{{$data->deskripsi}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
      </div>
  </div>
@endsection

@section('javascript')
    <script src="../js/jquery.tabledit.min.js"></script>
    <script src="../js/jquery.tabledit.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token' : $("input[name=_token]").val()
                }
            });

            $('#tabledit').Tabledit({
                url: "{{route('alternatif_action')}}",
                datatype:"json",
                restoreButton: false,
                hideIdentifier: true,

                buttons: {
                    edit: {
                        class: 'btn btn-sm btn-secondary',
                        html: '<span class="fa fa-pencil"></span>',
                        action: 'edit'
                    },
                    delete: {
                        class: 'btn btn-sm btn-danger',
                        html: '<span class="fa fa-trash"></span>',
                        action: 'delete'
                    },
                    confirm: {
                        class: 'btn btn-sm btn-default',
                        html: 'Are you sure?'
                    }
                },
                columns: {
                    identifier: [0, 'id'],
                    editable: [[1, 'nama_alternatif'], [2, 'deskripsi']]
                },
            });
        });
    </script>
@endsection