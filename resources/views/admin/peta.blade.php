@extends('admin.layouts.main')

@section('title',"Admin - PETA")

@section('css')

@endsection

@section('content')
    <div id="peta-panel" class="peta-panel" >
        <div id="peta" class="peta"></div>
    </div>
    <div class="form-panel-peta">
        <div class="form-group">
            <label>Nama Tempat <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="nama_tempat" value=""/>
        </div>
        <div class="form-group">
            <label>Longitude <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="nama_tempat" value=""/>
        </div>
        <div class="form-group">
            <label>Latitude <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="nama_tempat" value=""/>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea style="width:240px" class="mce" name="keterangan"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
        </div>
    </div>
@endsection

@section('javascript')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1wZZqn8OiFRUNDR3MSMHS32NvGwknVDI&callback=initMap" async defer></script>
<script type="text/javascript">
	function initMap() {
        var marker;
		var map = new google.maps.Map(document.getElementById('peta'), {
		  center: {lat: -7.472613, lng: 112.667542},
		  zoom: 10,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var icon = {
            url: "https://img.icons8.com/material-sharp/48/fa314a/marker.png", // url
            
        }
        google.maps.event.addListener(map, 'click', function(event) {
            console.log(marker);
            latLng = event.latLng;

            console.log(event.latLng.lat());
            console.log(event.latLng.lng());
            if (marker && marker.setMap) {
                marker.setMap(null);
            }

            marker = new google.maps.Marker({
                position: latLng, 
                map: map,
                title: 'Click to zoom',
                icon: icon,
                draggable: true,
            });
        });
	}
</script>
@endsection