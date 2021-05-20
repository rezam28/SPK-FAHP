@extends('layout.main')

@section('title',"Hasil")

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="hasil">
    <div class="table-hasil table-striped">
        <div class="panel">
            <div class="panel-header">
                <h3>Pilih Alternatif Dan Daerah</h3>
            </div>
            <form action="{{ route('hasil') }}" method="POST" class="form-hasil" id="form-hasil">
                @csrf
                <div class="panel-content">
                    <div class="daerah">
                        <label for="daerah">Pilih Daerah :</label>
                        @if ($errors->has('daerah'))
                            <span class="text-danger">{{ $errors->first('daerah') }}</span>
                        @endif
                        <select class="custom-select" name="daerah" id="daerah">
                            <option value="" selected disabled>Pilih Daerah</option>
                            @foreach ($daerah as $item)
                                <option value="{{$item['id']}}">{{$item['nama_daerah']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="daerah" id="label_alternatif">Pilih Alternatif :</label>
                            @if ($errors->has('alternatif'))
                                <span class="text-danger">{{ $errors->first('alternatif') }}</span>
                            @endif
                            <div id="checkboxGroup"></div>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Alternatif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alternatif as $item)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="alternatif[]" value="{{$item->id}}" id="{{$item->id}}">
                                                    <label class="custom-control-label" for="{{$item->id}}"></label>
                                                </div>
                                            </td>
                                            <td>{{$item->nama_alternatif}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="submit" id="btn_pilih" class="btn btn-success" value="tambah">Pilih</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        // $('#btn_pilih').click(function () { 
        //     $('#hasil-ranking').removeAttr('hidden');
        // });

        // function validateform() {
        //     $('#form-hasil').validate({
        //         rules : {
        //             daerah: "required",
        //             alternatif : {
        //                 required : true,
        //                 minlength: 2  // at least two checkboxes are required
        //                 // maxlength: 4 // less than 5 checkboxes are required
        //                 // rangelength: [2,4] // must select 2, 3, or 4 checkboxes
        //             }
        //         },
        //         messages : {
        //             daerah : "Mohon Dipilih !",
        //             alternatif : {
        //                 required : "Mohon Dipilih !",
        //                 minlength : "Harus Memilih Lebih dari Satu"
        //             }
        //         },
        //         highlight: function(element, errorClass) {
        //             $(element).closest("#form-hasil").addClass("has-error");
        //         },
        //         unhighlight: function(element, errorClass) {
        //             $(element).closest("#form-hasil").removeClass("has-error");
        //         },
        //         errorPlacement: function (error, element) {
        //             if (element.attr("type") == "checkbox") {
        //                 error.insertAfter("#checkboxGroup");
        //             } else {
        //                 error.insertAfter(element);
        //             }
        //         },
        //         submitHandler: function (form) {
        //             var actionType = $('#btn_pilih').val();
        //             $('#btn_pilih').html('Sending..');
        //             $.ajax({
        //                 data: $('#form-hasil')
        //                     .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
        //                 url: "{{ route('hasil') }}", //url simpan data
        //                 type: "POST", //karena simpan kita pakai method POST
        //                 dataType: 'json', //data tipe kita kirim berupa JSON
        //                 success: function (data) { //jika berhasil 
        //                 console.log(data);
        //                     $('#form-hasil').trigger("reset"); //form reset
        //                     $('#btn_pilih').html('Simpan'); //tombol simpan
        //                     //var Table = $('#table').dataTable(); //inialisasi datatable
        //                     //Table.fnDraw(false); //reset datatable
        //                     /* iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
        //                         title: 'Data Berhasil Disimpan',
        //                         message: '{{ Session('
        //                         success ')}}',
        //                         position: 'bottomRight'
        //                     }); */
        //                 },
        //                 error: function (data) { //jika error tampilkan error pada console
        //                     console.log('Error:', data);
        //                     $('#btn_pilih').html('Simpan');
        //                 }
        //             });
        //         }
        //     });
        // }
    </script>
@endsection