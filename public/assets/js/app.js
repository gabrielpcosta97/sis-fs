function excluir(url, btn_excluir)
{

	if(confirm("Um item será removido!")){

		$.ajax({

			headers: {

    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		},
			url: convertUrl(url, btn_excluir.attr('data-id')),
			type: 'post',
			dataType: 'json',
			beforeSend: function(){

				btn_excluir.hide();
				$("#load-nav").show();
			}
		}).done(function(response){

			if(btn_excluir.closest('tr').html() != undefined)
				btn_excluir.closest('tr').remove();
			else
				btn_excluir.closest('li').remove();

			$("#load-nav").hide();

		}).fail(function(error){
			btn_excluir.show();
			$("#load-nav").hide();
			console.log(error);
			alert("Falha durante a requisição");
		});
	}

	
}

function convertUrl(url, id)
{

	return url.replace("\/0", "/"+id);

}

function exception(error)
{
	
	if(error.responseJSON != null && error.responseJSON != undefined){

		if(error.status == 401 || error.status == 403){
			M.toast({html: "<span>"+error.responseJSON.message+"</span>", classes: 'rounded red'});
			return 0;
		}
	}
	

	alert("Falha durante a requisição!");

	console.log(error);
}
