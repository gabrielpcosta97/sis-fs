@extends("template.layout")

@section('head')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" integrity="sha512-07I2e+7D8p6he1SIM+1twR5TIrhUQn9+I6yjqD53JQjFiMf8EtC93ty0/5vJTZGF8aAocvHYNEDJajGdNx1IsQ==" crossorigin=""/>

@endsection

@section('content')

<div class="row">
	<div class="row m12">
		<div class="card-panel">
			<div id="map" class="map" tabindex="0" style="height: 100vh;"></div>
		</div>
	</div>
</div>

@modalInfra

@endsection

@section('scripts')

<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js" integrity="sha512-A7vV8IFfih/D732iSSKi20u/ooOfj/AGehOKq0f4vLT1Zr2Y+RX7C+w8A1gaSasGtRUZpF/NZgzSAu4/Gc41Lg==" crossorigin=""></script>


<script type="text/javascript">
	$(document).ready(function(){

		var url_listar = "{{ route('infraestrutura/listar') }}";

		var modalInfra = M.Modal.getInstance($("#modal-infra"));

		var map = L.map('map').setView([-15.768455372582029, -47.866735705275616], 19);
		mapLink = '<a href="https://openstreetmap.org">OpenStreetMap</a>';

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	    	attribution: 'Map data &copy; ' + mapLink,
	    	maxZoom: 30,
	    }).addTo(map);

	    

	    let iconMarker = L.icon({

	    	iconUrl: "{{ asset('assets/images/iconmap/marker-green.png') }}",
	    	iconSize: [38, 38]

	    });
	  
		var marker;

		$.ajax({

			url: url_listar,
			type: 'get',
			dataType: 'json',
			beforeSend: function(){

				$("#load-nav").show();
			}

		}).done(function(response){

			for(x in response.dados){

				let infraestrutura = response.dados[x];

				let iconUrl = '';

				switch(infraestrutura.classificacao){

					case 'A':
						iconUrl = "{{ asset('assets/images/iconmap/marker-green.png') }}";
					break;

					case 'B':
						iconUrl = "{{ asset('assets/images/iconmap/marker-yellow.png') }}";
					break;

					case 'C':
						iconUrl = "{{ asset('assets/images/iconmap/marker-red.png') }}";
					break;
				}

				let iconMarker = L.icon({

			    	iconUrl: iconUrl,
			    	iconSize: [38, 38]

			    });
			  
				let marker = L.marker([infraestrutura.latitude, infraestrutura.longitude]).setIcon(iconMarker).addTo(map);

				marker.on('click', function(event){

					let htmlPopup = "<p><b>Classificação: "+infraestrutura.classificacao+"</b></p>";
					htmlPopup += "<p>Andar: "+infraestrutura.andar.nome+"</p>";
					htmlPopup += "<p>Departamento: "+infraestrutura.departamento+"</p>";
					htmlPopup += "<p>Uso principal: "+infraestrutura.uso_principal+"</p>";
					htmlPopup += "<p>Ocupação máxima: "+infraestrutura.ocupacao_maxima+"</p>";
					htmlPopup += "<p>Área: "+infraestrutura.area+"</p>";

					let popup = L.popup({}, this)
							    .setLatLng([infraestrutura.latitude, infraestrutura.longitude])
							    .setContent(htmlPopup)
							    .openOn(map);
				});
			}

			$("#load-nav").hide();


		}).fail(function(error){

			alert('Falha durante a requisição');
			console.log(error);
			$("#load-nav").hide()

		});

		@if(Auth::check())
			clickMap(map, $("#latitude"), $("#longitude"));
		@endif
	});



	function clickMap(map, input_latitude, input_longitude)
	{

		map.on("click", function(event){

			L.popup({}, this)
			    .setLatLng(event.latlng)
			    .setContent("<a href=\"#modal-infra\" id=\"btn-adicionar\" class=\"waves-effect waves-light btn modal-trigger\" style=\"color: white\">Adicionar</a>")
			    .openOn(map);

			//modalInfra.open();
	    	input_latitude.val(event.latlng.lat);
	    	input_longitude.val(event.latlng.lng);
	    });
	}

</script>

@endsection