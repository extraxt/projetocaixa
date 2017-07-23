<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

		{BLOCO_DADOS}
		
		<div class="container">
			<h1>Edição de Saída</h1>
			<br>
			<br>
			<form action="<?php echo base_url();?>lancamentos/salvar_editar_debitos_clinica" method="POST">
				<div class="form-group row">
					<input type="hidden" name="iddebitosclinica" value="{iddebitosclinica}">
					<div class="col-xs-2">
				    	<label for="data">Data:</label>
				    	<input class="form-control" id="data" type="text" name="datadaficha" value="{datadaficha}">
					</div>
					<div class="col-xs-4">
				    	<label for="observacoes">Observações:</label>
				    	<input class="form-control" id="observacoes" type="text" name="observacoes" value="{observacoes}">
					</div>
					<div class="col-xs-2">
				    	<label for="valordebito">Valor do Débito:</label>
						<div class="input-group">
				    		<span class="input-group-addon">R$</span>
				    		<input class="form-control" id="valordebito" type="text" name="valor" value="{valor}">
				    	</div>
					</div>				
				</div> <!-- Fim DIV Form-Group Row 1 -->
				<div class="form-group row">
					<div class="col-xs-3">
				    	<label for="quem">Quem lançou:</label>
				    	<input class="form-control" id="quem" type="text" name="quemlancou" value="{quemlancou}">
					</div>
					<div class="col-xs-3">
				    	<span id="mutreta"></span>
				    	<input type="submit" class="btn btn-success" value="Salvar Edição">
					</div>
				</div> <!-- Fim DIV Form-Group Row 2 -->
			</form>
		</div> <!-- Fim DIV Container Geral-->

	    {/BLOCO_DADOS}

	    {BLOCO_SEMDADOS}
	    <div class="text-center">
	    	<h2>Esta Saída não existe para edição.</h2>
	    </div>
	    {/BLOCO_SEMDADOS}