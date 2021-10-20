<div id="modal-infra" class="modal modal-fixed-footer">
	<form id="form-infra">
	    <div class="modal-content">
	    	
    		<div class="row">
    			<div class="col m4 input-field">
    				<input type="text" name="departamento" id="departamento" required="true">
    				<label for="departamento">Departamento</label>
    			</div>
    			<div class="col m4 input-field">
    				<input type="text" name="nome_ambiente" id="nome_ambiente" required="true">
    				<label for="nome_ambiente">Nome do Ambiente</label>
    			</div>
    			<div class="col m4 input-field">
    				<select id="andar" name="andar">
    					<option value="" disabled="">Selecione um andar</option>
    					@foreach($andares as $andar)
    						<option value="{{ $andar->id }}">{{ $andar->nome }}</option>
    					@endforeach
    				</select>
    			</div>
    			
    		</div>

    		<div class="row">
    			<div class="col m2 input-field">
    				<input type="number" name="area" id="area" required="true">
    				<label for="area">Área</label>
    			</div>
    			<div class="col m2 input-field">
    				<select id="classificacao" name="classificacao">
    					<option value="" disabled="">Classificação...</option>
    					<option value="A">A</option>
    					<option value="B">B</option>
    					<option value="C">C</option>
    				</select>
    				
    			</div>
    			<div class="col m4 input-field">
    				<input type="text" name="insumos_solicitados" id="insumos_solicitados" required="true">
    				<label for="insumos_solicitados">Insumos Solicitados</label>
    			</div>
    			<div class="col m4 input-field">
    				<input type="text" name="insumos_recebidos" id="insumos_recebidos" required="true">
    				<label for="insumos_recebidos">Insumos Recebidos</label>
    			</div>
    		</div>

    		<div class="row">
    			<div class="col m4 input-field">
    				<input type="text" name="uso_principal" id="uso_principal" required="true">
    				<label for="uso_principal">Uso principal</label>
    			</div>
    			<div class="col m4 input-field">
    				<input type="number" name="ocupacao_maxima" id="ocupacao_maxima" required="true">
    				<label for="ocupacao_maxima">Ocupação Máxima</label>
    			</div>
    			

    			<div class="col m4 input-field">
    				<input type="text" name="epi" id="epi" required="true">
    				<label for="epi">EPI</label>
    			</div>
    			
    		</div>
    		

    		<div class="row">
    			<div class="col m4 input-field">
    				<input type="text" name="saidas_ar" id="saidas_ar" required="true">
    				<label for="saidas_ar">Saídas de ar</label>
    			</div>
    			
    			@if(isset($coordenadas) && $coordenadas)
    				<div class="col m4 input-field">
    					<input type="text" name="latitude" id="latitude">
    					<label for="latitude">Latitude</label>
    				</div>
    				<div class="col m4 input-field">
    					<input type="text" name="longitude" id="longitude">
    					<label for="longitude">Loingitude</label>
    				</div>
    			@else
    				<input type="hidden" id="latitude" name="latitude" value="">
		    		<input type="hidden" id="longitude" name="longitude" value="">
    			@endif
    		</div>
	    	
	    </div>
	    <div class="modal-footer">
	    	<input type="hidden" name="id_infra" id="id_infra" value="">
	    	<div id="load" style="display: none;">
	    		
			  <div class="progress">
			      <div class="indeterminate"></div>
			  </div>
        
	    	</div>
	    	<div id="buttons">
		    	
		    	<a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
		    	<button type="submit" class="was-effet waves-green btn-flat">Salvar</button>
	    	</div>
		</div>

	</form>
</div>