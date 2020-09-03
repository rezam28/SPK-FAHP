@extends('layout.main')

@section('title',"Hasil")

@section('css')

@endsection

@section('content')
<div class="hasil">
    @if(\Session::has('alert'))
    <div class="alert alert-danger" role="alert" style="width:1170px">
      <div>{{Session::get('alert')}}</div>
    </div>
    @endif
  <div class="table-hasil table-striped">
      <h3>Perhitungan</h3>
      <hr style="width:1150px;">
      <div class="panel">
          <form action="{{route('hasil')}}" method="POST" class="form-hasil">
            @csrf
            <div class="panel-header">
              <h3>Pilih Alternatif</h3>
            </div>
              <div class="row">
                  <div class="col-12">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Alternatif</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="alternatif[]" value="Padi sawah" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1"></label>
                            </div>
                          </td>
                          <td>Padi Sawah</td>
                        </tr>
                        <tr>
                          <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="alternatif[]" value="Jagung" id="customCheck2">
                                <label class="custom-control-label" for="customCheck2"></label>
                            </div>
                          </td>
                          <td>Jagung</td>
                        </tr>
                        <tr>
                          <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="alternatif[]" value="Kacang Hijau" id="customCheck3">
                                <label class="custom-control-label" for="customCheck3"></label>
                            </div>
                          </td>
                          <td>Kacang Hijau</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <button type="sumbit" name="pilih" class="btn-hasil">Pilih</button>
          </form>
      </div>
      @if ($data != null)
      @php
          $no = 1;
          //$alternatif = [];
      @endphp
          <div class="panel2">
            <div>
              <h3>Hasil Perankingan</h3>
            </div>
              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Ranking</th>
                      <th scope="col">Alternatif</th>
                      <th scope="col">Bobot Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      @foreach ($data as $alternatif)
                        <tr>
                          <td>{!! $no++ !!}</td>
                          <td>{!! $alternatif !!}</td>
                          <td>{!! rand(1,10) !!}</td>
                        </tr>
                      @endforeach
                    </tr>
                  </tbody>
                </table>
          </div>
      @endif
  </div>
</div>
@endsection

@section('javascript')

@endsection