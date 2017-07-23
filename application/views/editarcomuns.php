<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

		{BLOCO_DADOS}
		
		<div class="container">
			<h1>Edição de Lançamento</h1>
			<br>
			<br>
			<form action="<?php echo base_url();?>lancamentos/salvar_editar_comuns" method="POST">
				<div class="form-group row">
					<input type="hidden" name="idlancamentos" value="{idlancamentos}">
					<div class="col-xs-2">
				    	<label for="data">Data Recebimento:</label>
				    	<input class="form-control" id="data" type="text" name="datadaficha" value="{datadaficha}">
					</div>
					<div class="col-xs-4">
				    	<label for="nome">Nome do Paciente:</label>
				    	<input class="form-control" id="nome" type="text" name="nomepac" value="{nomepac}">
					</div>
					<div class="col-xs-2">
				    	<label for="valor">Valor Recebido:</label>
						<div class="input-group">
				    		<span class="input-group-addon">R$</span>
				    		<input class="form-control" id="valor" type="text" name="valor" value="{valor}">
				    	</div>
					</div>
					<div class="col-xs-2">
				    	<label for="forma">Forma Pag.:</label>
				    	<select class="form-control" id="forma" name="forma">
							<option value="Dinheiro" {selectdinheiro}>Dinheiro</option>
							<option value="Cheque" {selectcheque}>Cheque</option>
							<option value="C.Crédito" {selectccredito}>C. Crédito</option>
							<option value="C.Débito" {selectcdebito}>C. Débito</option>
				    	</select>
					</div>
					<div class="col-xs-2">
				    	<label for="taxa">Taxa Cartão:</label>
				    	<div class="input-group">
				    		<input class="form-control" id="taxa" type="text" name="taxacartao" value="{taxacartao}">
				    		<span class="input-group-addon">%</span>
				    	</div>
					</div>					
				</div> <!-- Fim DIV Form-Group Row 1 -->
				<div class="form-group row">
					<div class="col-xs-2">
				    	<label for="comissao">Taxa Comissão:</label>
				    	<div class="input-group">
				    		<input class="form-control" id="comissao" type="text" name="taxacomissao" value="{taxacomissao}">
				    		<span class="input-group-addon">%</span>
				    	</div>
					</div>
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
	    	<h2>Este Lançamento não existe para edição.</h2>
	    </div>
	    {/BLOCO_SEMDADOS}