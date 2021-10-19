@extends("template.layout")

@section('head')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" integrity="sha512-07I2e+7D8p6he1SIM+1twR5TIrhUQn9+I6yjqD53JQjFiMf8EtC93ty0/5vJTZGF8aAocvHYNEDJajGdNx1IsQ==" crossorigin=""/>

@endsection

@section('content')

<div class="row">
	<div class="col s12 m8">
		<div class="card-panel">
			<div id="map" class="map" tabindex="0"></div>
		</div>

		
	</div>

	<div class="col s12 m4">
		<div class="card">
			<div class="card-content">

				<span class="card-title">População</span>

				<ul id="lista-populacao"></ul>
				
				@if(Auth::check())
					<div style="width: 100%; text-align: right;">
						<a href="#modal-populacao" id="abrir-modal-populacao" class="btn btn-large btn-floating waves-effect waves-light blue darken-1 modal-trigger" title="Adicinar um tópio de População">
							<i class="material-icons">add</i>
						</a>
					</div>
				@endif
				

				
			</div>
		</div>
	</div>

	<!--
	<div class="row">
		<div class="col m12">
			<div class="card">
				<div class="card-content">

					<span class="card-title">População</span>

					<ul id="lista-populacao"></ul>
					

					<div style="width: 100%; text-align: right;">
						<a href="#modal-populacao" class="btn btn-large btn-floating waves-effect waves-light blue darken-1 modal-trigger" title="Adicinar um tópio de População">
							<i class="material-icons">add</i>
						</a>
					</div>

					
				</div>
			</div>
		</div>
	</div>
-->

</div>

@modalInfra

@endsection

@section('scripts')

<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js" integrity="sha512-A7vV8IFfih/D732iSSKi20u/ooOfj/AGehOKq0f4vLT1Zr2Y+RX7C+w8A1gaSasGtRUZpF/NZgzSAu4/Gc41Lg==" crossorigin=""></script>


<script type="text/javascript">
	$(document).ready(function(){

		var url_listar = "{{ route('infraestrutura/listar') }}";
		var url_populacao_listar = "{{ route("populacao/listar") }}";
		var url_populacao_recuperar = "{{ route("populacao/recuperar", 0) }}";
		var url_populacao_excluir = "{{ route("populacao/excluir", 0) }}";

		var modalInfra = M.Modal.getInstance($("#modal-infra"));

		var map = L.map('map').setView([-15.768455372582029, -47.866735705275616], 18); //19
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

		setTimeout(function(){

			$.ajax({

				url: url_populacao_listar,
				type: 'get',
				dataType: 'json',
				beforeSend: function(){

					$("#load-nav").show();
				}

			}).done(function(response){

				if(response.dados.length > 0){

					for(x in response.dados){

						let populacao = response.dados[x];

						let btnAcao = '';

						if(logado){

							btnAcao = "<span id=\"btn-acao-populacao\" style=\"margin-left: 1rem\">"+	
											"<a id=\"btn-editar-populacao\" class=\"green-text text-darken-4\" data-id=\""+populacao.id+"\" href=\"#\" title=\"Editar\">"+
												"<i class=\"material-icons\" style=\"font-size: 15pt\">mode_edit</i>"+
											"</a>"+
											"<a id=\"btn-excluir-populacao\" class=\"red-text text-darken-4\" data-id=\""+populacao.id+"\" href=\"#\" title=\"Excluir\">"+
												"<i class=\"material-icons\" style=\"font-size: 15pt\">delete</i>"+
											"</a>"+
										"</span>";
						}
						

						let li = "<li id=\"li-populacao\">"+
									populacao.topico+": "+populacao.valor+btnAcao+
								"</li>";

						$("#lista-populacao").append(li);
					}
				}
				else{

					$("#lista-populacao").html("<i>Não há informações.</>");
				}
				
				$("#load-nav").hide();


			}).fail(function(error){

				alert('Falha durante a requisição');
				console.log(error);
				$("#load-nav").hide();

			});
		}, 500);

		$("body").on("click", "#btn-editar-populacao", function(){

			let btnThis = $(this);

			$.ajax({

				url: convertUrl(url_populacao_recuperar, btnThis.attr('data-id')),
				type: 'get',
				dataType: 'json',
				beforeSend: function(){

					btnThis.hide();
					$("#load-nav").show();
				}
			}).done(function(response){

				let populacao = response.dados;

				let topico = $('#form-populacao').find('#topico');
				let valor = $('#form-populacao').find('#valor');

				topico.val(populacao.topico);
				topico.next().addClass("active");
				valor.val(populacao.valor);
				valor.next().addClass("active");

				$("#id_populacao").val(populacao.id);

				let modal = M.Modal.getInstance($("#modal-populacao"));

				modal.open();

				btnThis.show();
				$("#load-nav").hide();


			}).fail(function(error){

				alert('Falha durante a requisição');
				console.log(error);
				btnThis.show();
				$("#load-nav").hide();

			});
		});

		$("body").on("click", "#btn-excluir-populacao", function(event){

			event.preventDefault();

			excluir(url_populacao_excluir, $(this));

		});

		$("#abrir-modal-populacao").on("click", function(){

			$('#form-populacao').trigger('reset');
			$("#form-populacao").find('#id_populacao').val('');
		});

		

		if(logado)
			clickMap(map, $("#latitude"), $("#longitude"));
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