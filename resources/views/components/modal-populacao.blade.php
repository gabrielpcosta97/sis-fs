<div id="modal-populacao" class="modal modal-fixed-footer mini-modal">
	<form id="form-populacao">
	    <div class="modal-content">
	    	<div class="row">
	    		<div class="col m8 input-field">
	    			<input type="text" name="topico" id="topico" required="true">
	    			<label for="topico">Tópico</label>
	    		</div>

	    		<div class="col m4 input-field">
	    			<input type="number" name="valor" id="valor" required="true">
	    			<label for="valor">Valor</label>
	    		</div>
	    	</div>


	    </div>
	    
	    <div class="modal-footer">
	    	<div id="load-populacao" style="display: none;">
	    		
			  <div class="progress">
			      <div class="indeterminate"></div>
			  </div>
        
	    	</div>
	    	<div id="buttons">
	    		<input type="hidden" name="id_populacao" id="id_populacao" value="">
		    	<a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
		    	<button type="submit" class="was-effet waves-green btn-flat">Salvar</button>
	    	</div>
		</div>

	</form>
</div>