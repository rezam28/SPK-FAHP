@extends('../admin.layouts.main')

@section('title',"Admin - PETA")

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
    <div class="panel-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('ad_pemetaan')}}">Pemetaan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Peta</li>
            </ol>
        </nav>
    </div>
    
    <div id="peta-panel" class="peta-panel" >
        <div id="peta" class="peta"></div>
    </div>
    <div class="form-panel-peta">
        <form action="{{url('admin/update/pemetaan/'.$data->id.'')}}" method="POST" name="form-pemetaan">
            @csrf
            <input type="hidden" name="id" value="{{$data->id}}"/>
            <label>Pilih Daerah <span class="text-danger">*</span></label>
            <select class="custom-select" name="daerah" id="daerah" required disabled>
                <option value="{{$data->daerah->id}}">{{$data->daerah->nama_daerah}}</option>
            </select>
            <div class="form-group">
                <label>Longitude <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="longitude" id="longitude" value="{{$data->daerah->lng}}" disabled/>
            </div>
            <div class="form-group">
                <label>Latitude <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="latitude" id="latitude" value="{{$data->daerah->lat}}" disabled/>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea style="width:240px" class="mce" name="keterangan">{{$data->keterangan}}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-outline-info"><span class="glyphicon glyphicon-save"></span>Edit</button>
                <a href="{{route('ad_pemetaan')}}" class="btn btn-primary" id="kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
            </div>
        </form>
    </div>
@endsection

@section('javascript')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1wZZqn8OiFRUNDR3MSMHS32NvGwknVDI&callback=initMap" async defer></script>
<script type="text/javascript">
	var data = @json($data);
    var map;
    var marks = [];
	function initMap() {
        console.log(data);
        
		map = new google.maps.Map(document.getElementById('peta'), {
		  center: {lat: -7.472613, lng: 112.667542},
		  zoom: 10,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        addMarker(data);
	}

    function addMarker(marker){
        var point = new google.maps.LatLng(parseFloat(marker.daerah.lat),parseFloat(marker.daerah.lng));
        // var html = "<span style="color:darkolivegreen;font-weight:bold">" + marker.daerah.nama_daerah + "</span> <br/>" + marker.daerah.lat + "<br/>" + marker.daerah.lng;
        // var html = "<b>Nama Kecamatan</b>: "+ marker.daerah.nama_daerah +
        //               "<hr/>"+
        //               "<br><b>Longitude</b>: "+ marker.daerah.lat +
        //               "<br><b>Latitude</b>: "+ marker.daerah.lng +
        //               "<br><b>Keterangan</b>: "+ marker.keterangan;

        var html = '<div id="iw-container">' +
                    '<div class="iw-title">Kecamatan '+marker.daerah.nama_daerah+'</div>' +
                    '<div class="iw-content">' +
                      '<div class="iw-subTitle">Longitude</div>' +
                      '<p>'+marker.daerah.lng+'</p>' +
                      '<div class="iw-subTitle">Latitude</div>' +
                      '<p>'+marker.daerah.lat+'</p>' +
                      '<div class="iw-subTitle">Keterangan</div>' +
                      '<p>Pilihan Terbaik untuk tanaman pangan Di Kecamatan '+marker.daerah.nama_daerah+' adalah :<br>'+marker.keterangan+'</p>'+
                    '</div>' +
                    '<div class="iw-bottom-gradient"></div>' +
                  '</div>';
        var icon = {
            url: "https://img.icons8.com/material-sharp/48/fa314a/marker.png", // url
            
        }
        var mark = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon
        });
        var infoWindow = new google.maps.InfoWindow;
        google.maps.event.addListener(mark, 'click', function(){
            infoWindow.setContent(html);
            infoWindow.open(map, mark);
        });
        return mark;
    }
    
    $('#daerah').on('change', function() { 
        var daerah = @json($data);
        var key = $(this).val();
        $('#latitude').val(daerah[key].lat);
        $('#longitude').val(daerah[key].lng);
    });
</script>
@endsection