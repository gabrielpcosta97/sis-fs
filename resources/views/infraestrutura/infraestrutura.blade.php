@extends('template.layout', ["title" => " SisFS - Infraestrutura"])

@section('content')

<h3>Infraestrutura</h3>
<hr>

<div class="row">
	<div class="col m12">
		<table id="table-infra" class="responsive-table">
			<thead>
				<tr>
					<th>Departamento</th>
					<th>Andar</th>
					<th>Classificação</th>
					<th>Nome do Ambiente</th>
					<th>Uso Principal</th>
					<th>Ocupação Máxima</th>
					<th>Área</th>
					<th>#</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

	</div>
</div>

<div id="pagination"></div>

@modalInfra(['coordenadas' => true])

<div class="fixed-action-btn direction-top">
	<a href="#modal-infra" class="btn btn-large btn-floating waves-effect waves-light blue darken-1 modal-trigger" title="Adicionar Infraestrutura">
		<i class="material-icons">add</i>
	</a>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){

		var url_listar = "{{ route('infraestrutura/listar') }}";

		var url_excluir = "{{ route('infraestrutura/excluir', 0) }}";

		let row_clone = $("#row-clone");

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

				let row = row_clone.clone();

				let color_classificacao = 'green-text text-darken-4';

				switch(infraestrutura.classificacao){

					case 'A':
						color_classificacao = "green-text text-darken-4";
					break;

					case 'B':
						color_classificacao = "yellow-text text-darken-3";
					break;

					case 'C':
						color_classificacao = "red-text text-darken-4";
					break;
				}

				let html = "<tr>"+
								"<td>"+infraestrutura.departamento+"</td>"+
								"<td>"+infraestrutura.andar.nome+"</td>"+
								"<td style=\"text-align: center\">"+
									"<b class=\""+color_classificacao+"\">"+infraestrutura.classificacao+"</b>"+
								"</td>"+
								"<td>"+infraestrutura.nome_ambiente+"</td>"+
								"<td>"+infraestrutura.uso_principal+"</td>"+
								"<td>"+infraestrutura.ocupacao_maxima+"</td>"+
								"<td>"+infraestrutura.area+"</td>"+
								"<td style=\"text-align: center\">"+
									"<a id=\"btn-editar\" class=\"green-text text-darken-4\" data-id=\""+infraestrutura.id+"\" href=\"#\" title=\"Editar\">"+
										"<i class=\"material-icons\">mode_edit</i>"+
									"</a>"+
									"<a id=\"btn-excluir\" class=\"red-text text-darken-4\" data-id=\""+infraestrutura.id+"\" href=\"#\" title=\"Excluir\">"+
										"<i class=\"material-icons\">delete</i>"+
									"</a>"+

								"</td>"+
							"</tr>";

				$("#table-infra tbody").append(html);

				$("#pagination").html(infraestrutura.link);
			}

			$("#load-nav").hide();


		}).fail(function(error){

			alert('Falha durante a requisição');
			console.log(error);
			$("#load-nav").hide();
		});


		$("tbody").on("click", "#btn-excluir", function(event){

			event.preventDefault();

			excluir(url_excluir, $(this));
		});


	});
</script>
@endsection