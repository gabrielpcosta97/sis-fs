<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ $title ?? 'Sistema de Informações da FS' }}</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset("assets/css/app.css") }}">
	@yield('head')
</head>
<body>

	<header>
		@include("includes.navbar")
	</header>

	<div class="container">
		@yield('content')
	</div>

	@modalLogin
	@modalPopulacao

<script>var logado = "{{ Auth::check() }}";</script>
<script type="text/javascript" src="{{ asset("assets/js/jquery-3.6.0.min.js") }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript" src="{{ asset("assets/js/app.js") }}"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$(".dropdown-trigger").dropdown();
		$("#sidebar-menu").sidenav();
		$("#modal-infra").modal();
		$("#modal-login").modal();
		$("#modal-populacao").modal();
		$("select").formSelect();

		var url_inserir = "{{ route("infraestrutura/inserir") }}";
		var url_populacao_inserir = "{{ route("populacao/inserir") }}";
		var url_populacao_alterar = "{{ route("populacao/alterar", 0) }}";
		var url_populacao_excluir = "{{ route("populacao/excluir", 0) }}";


		var url_logar = "{{ route('login/logar') }}";


		$("#form-login").submit(function(event){

			event.preventDefault();

			$.ajax({

				headers: {

					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: url_logar,
				type: 'post',
				dataType: 'json',
				data: $(this).serialize(),
				beforeSend: function(){

					$("#load-login").show();
				}

			}).done(function(response){

				location.reload();


			}).fail(function(error){

				exception(error);
				$("input").val('');
				$("#load-login").hide();
			});

		});

		$("#form-infra").on("submit", function(event){

	    	event.preventDefault();

	    	$.ajax({
	    		headers: {

	    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    		},
	    		url: url_inserir,
	    		type: 'post',
	    		dataType: 'json',
	    		data: $(this).serialize(),
	    		beforeSend: function(){

	    			$("#buttons").hide();
	    			$("#load").show();
	    		}
	    	}).done(function(){

	    		location.reload();

	    	}).fail(function(error){

	    		alert('Falha durante a requisição!');
	    		console.log(error);
	    		$("#buttons").show();
	    		$("#load").hide();
	    	});
	    });

	    $("#form-populacao").on("submit", function(event){

	    	event.preventDefault();

	    	let id_populacao = $("#id_populacao").val();

	    	let url = id_populacao != '' ? convertUrl(url_populacao_alterar, id_populacao) : url_populacao_inserir;

	    	$.ajax({
	    		headers: {

	    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    		},
	    		url: url,
	    		type: 'post',
	    		dataType: 'json',
	    		data: $(this).serialize(),
	    		beforeSend: function(){

	    			$("#buttons").hide();
	    			$("#load-populacao").show();
	    		}
	    	}).done(function(){

	    		location.reload();

	    	}).fail(function(error){

	    		alert('Falha durante a requisição!');
	    		console.log(error);
	    		$("#buttons").show();
	    		$("#load-populacao").hide();
	    	});
	    });
	});
</script>
@yield('scripts')
</body>
</html>