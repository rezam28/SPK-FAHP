@extends('layout.main')

@section('title',"PETA")

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
<style type="text/css">
    
</style>
@endsection

@section('content')
<div id="peta-panel" class="peta-panel" >
    <div id="peta" class="peta"></div>
</div>
@endsection

@section('javascript')
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1wZZqn8OiFRUNDR3MSMHS32NvGwknVDI&callback=initMap" async defer></script>
<script type="text/javascript">
    var data = @json($peta);
    var map;
    var marks = [];
	function initMap() {
        console.log(data);
        
		map = new google.maps.Map(document.getElementById('peta'), {
		  center: {lat: -7.472613, lng: 112.667542},
		  zoom: 10,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        for(var i = 0; i < data.length; i++){
            marks[i] = addMarker(data[i]);
        }
	}

    function addMarker(marker){
        var point = new google.maps.LatLng(parseFloat(marker.daerah.lat),parseFloat(marker.daerah.lng));
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
</script>
@endsection