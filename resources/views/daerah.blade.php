@extends('layout.main')

@section('title',"Daerah")

@section('css')

@endsection

@section('content')
<div class="table-hasil">
    <div class="panel">
          <div class="panel-header">
            <h3 class="title-center">Macam - Macam Daerah</h3>
          </div>
            <div class="row">
              <div class="col-12">
              <table id="table" class="table table-bordered table-striped">
                  @csrf
                  <thead>
                      <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama Daerah/Kecamatan</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($daerah as $item)
                          <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$item->nama_daerah}}</td>
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

@endsection