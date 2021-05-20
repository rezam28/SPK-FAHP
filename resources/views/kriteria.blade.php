@extends('layout.main')

@section('title',"Kriteria")

@section('css')

@endsection

@section('content')
<div class="table-hasil">
    <div class="panel">
          <div class="panel-header">
            <h3 class="title-center">Macam - Macam Kriteria</h3>
          </div>
            <div class="row">
              <div class="col-12">
              <table id="table" class="table table-bordered table-striped">
                  @csrf
                  <thead>
                      <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama Kriteria</th>
                          <th scope="col">Deskripsi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($kriteria as $item)
                          <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$item->nama_kriteria}}</td>
                              <td>{{$item->deskripsi}}</td>
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