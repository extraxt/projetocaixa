<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

		<div class="container botoes">
			<button class="btn" id="botaoCinza">Lançamento Comum</button>
			<button class="btn btn-success" id="botaoVerde">Crédito Integral Dentista</button>
			<button class="btn btn-danger" id="botaoVermelho">Saída Antecipada Dentista</button>
			<button class="btn btn-danger" id="botaoVermelhoClinica">Saída Antecipada Clínica</button>
		</div> <!-- Fim DIV Botôes-->



		<div class="container lancamento-comum">
			<h1>Lançamento Comum</h1>
			<form action="<?php echo base_url("lancamentos/salvar_comum");?>" method="POST">
				<div class="form-group row">
					<input type="hidden" name="tipolancamento" value="comum">
					<div class="col-xs-2">
				    	<label for="data">Data Recebimento:</label>
				    	<input class="form-control" id="data" name="datadaficha" type="text" required>
					</div>
					<div class="col-xs-4">
				    	<label for="nome">Nome do Paciente:</label>
				    	<input class="form-control" id="nome" name="nomepac" type="text" required>
					</div>
					<div class="col-xs-2">
				    	<label for="valor">Valor Recebido:</label>
						<div class="input-group">
				    		<span class="input-group-addon">R$</span>
				    		<input class="form-control" id="valor" name="valor" type="text" required>
				    	</div>
					</div>
					<div class="col-xs-2">
				    	<label for="forma">Forma Pag.:</label>
				    	<select class="form-control" id="forma" name="forma" required>
				    		<option value="">Selecione</option>
							<option value="Dinheiro">Dinheiro</option>
							<option value="Cheque">Cheque</option>
							<option value="C.Crédito">C. Crédito</option>
							<option value="C.Débito">C. Débito</option>
				    	</select>
					</div>
					<div class="col-xs-2">
				    	<label for="taxa">Taxa Cartão:</label>
				    	<div class="input-group">
				    		<input class="form-control" id="taxa" name="taxacartao" type="text">
				    		<span class="input-group-addon">%</span>
				    	</div>
					</div>					
				</div> <!-- Fim DIV Form-Group Row 1 -->
				<div class="form-group row">
					<div class="col-xs-2">
				    	<label for="comissao">Taxa Comissão:</label>
				    	<div class="input-group">
				    		<input class="form-control" id="comissao" name="taxacomissao" type="text" required>
				    		<span class="input-group-addon">%</span>
				    	</div>
					</div>
					<div class="col-xs-3">
				    	<label for="quem">Quem lançou:</label>
				    	<input class="form-control" id="quem" name="quemlancou" type="text" required>
					</div>
					<div class="col-xs-3">
				    	<span id="mutreta"></span>
				    	<input type="submit" class="btn btn-success" value="Lançar">
				    	<input type="button" class="btn botaoFechar" value="Fechar">
					</div>
				</div> <!-- Fim DIV Form-Group Row 2 -->
			</form>
		</div> <!-- Fim DIV Lançamento Comum-->

		<div class="container lancamento-credito">
			<h1>Crédito Integral para o Dentista</h1>
			<form action="<?php echo base_url("lancamentos/salvar_creditos");?>" method="POST">
				<div class="form-group row">
					<input type="hidden" name="tipolancamento" value="credito">
					<div class="col-xs-2">
				    	<label for="datacredito">Data do Crédito:</label>
				    	<input class="form-control" id="datacredito" name="datacredito" type="text" required>
					</div>
					<div class="col-xs-4">
				    	<label for="observacoescredito">Observações sobre o Crédito:</label>
				    	<input class="form-control" id="observacoescredito" name="observacoescredito" type="text" required>
					</div>
					<div class="col-xs-2">
				    	<label for="valorcredito">Valor:</label>
				    	<div class="input-group">
				    		<span class="input-group-addon">R$</span>
				    		<input class="form-control" id="valorcredito" name="valorcredito" type="text" required>
				    	</div>
					</div>					
				</div> <!-- Fim DIV Form-Group Row 1 -->
				<div class="form-group row">
					<div class="col-xs-3">
				    	<label for="quemlancoucredito">Quem lançou:</label>
				    	<input class="form-control" id="quemlancoucredito" name="quemlancoucredito" type="text" required>
					</div>
					<div class="col-xs-3">
				    	<span id="mutreta"></span>
				    	<input type="submit" class="btn btn-success" value="Lançar">
				    	<input type="button" class="btn botaoFechar" value="Fechar">
					</div>
				</div> <!-- Fim DIV Form-Group Row 2 -->
			</form>
		</div> <!-- Fim DIV Lançamento Entrada-->

		<div class="container lancamento-saida">
			<h1>Lançamento - Saída Antecipada Dentista</h1>
			<form action="<?php echo base_url();?>lancamentos/salvar_debitos" method="POST">
				<div class="form-group row">
					<input type="hidden" name="tipolancamento" value="debito">
					<div class="col-xs-2">
				    	<label for="datadebito">Data da Saída:</label>
				    	<input class="form-control" id="datadebito" name="datadebito" type="text" required>
					</div>
					<div class="col-xs-4">
				    	<label for="observacoesdebito">Observações:</label>
				    	<input class="form-control" id="observacoesdebito" name="observacoesdebito" type="text" required>
					</div>
					<div class="col-xs-2">
				    	<label for="valordebito">Valor:</label>
				    	<div class="input-group">
				    		<span class="input-group-addon">R$</span>
				    		<input id="valordebito" class="form-control" name="valordebito" type="text" required>
				    	</div>
					</div>					
				</div> <!-- Fim DIV Form-Group Row 1 -->
				<div class="form-group row">
					<div class="col-xs-3">
				    	<label for="quemlancoudebito">Quem lançou:</label>
				    	<input class="form-control" id="quemlancoudebito" name="quemlancoudebito" type="text" required>
					</div>
					<div class="col-xs-3">
				    	<span id="mutreta"></span>
				    	<input type="submit" class="btn btn-danger" value="Lançar">
				    	<input type="button" class="btn botaoFechar" value="Fechar">
					</div>
				</div> <!-- Fim DIV Form-Group Row 2 -->
			</form>
		</div> <!-- Fim DIV Lançamento Saida-->

		<div class="container lancamento-saida-clinica">
			<h1>Lançamento - Saída Antecipada Clínica</h1>
			<form action="<?php echo base_url();?>lancamentos/salvar_debitos_clinica" method="POST">
				<div class="form-group row">
					<input type="hidden" name="tipolancamento" value="debito">
					<div class="col-xs-2">
				    	<label for="datadebitoclinica">Data da Saída:</label>
				    	<input class="form-control" id="datadebitoclinica" name="datadebito" type="text" required>
					</div>
					<div class="col-xs-4">
				    	<label for="observacoesdebito">Observações:</label>
				    	<input class="form-control" id="observacoesdebito" name="observacoesdebito" type="text" required>
					</div>
					<div class="col-xs-2">
				    	<label for="valordebito">Valor:</label>
				    	<div class="input-group">
				    		<span class="input-group-addon">R$</span>
				    		<input id="valordebitoclinica" class="form-control" name="valordebito" type="text" required>
				    	</div>
					</div>					
				</div> <!-- Fim DIV Form-Group Row 1 -->
				<div class="form-group row">
					<div class="col-xs-3">
				    	<label for="quemlancoudebito">Quem lançou:</label>
				    	<input class="form-control" id="quemlancoudebito" name="quemlancoudebito" type="text" required>
					</div>
					<div class="col-xs-3">
				    	<span id="mutreta"></span>
				    	<input type="submit" class="btn btn-danger" value="Lançar">
				    	<input type="button" class="btn botaoFechar" value="Fechar">
					</div>
				</div> <!-- Fim DIV Form-Group Row 2 -->
			</form>
		</div> <!-- Fim DIV Lançamento Saida Clínica-->



		<br>
		<div class="container tabela">
			<h3>Saldo Anterior</h1>
			<div class="panel panel-default col-xs-6 col-xs-offset-3">
				<table class="table table-bordered">
	    			<thead>
	      				<tr>
	        				<th>Saldo Dentista</th>
	        				<th>Saldo Clínica</th>
	      				</tr>
	    			</thead>
	    			<tbody>
	    			{BLOCO_SALDOS}
	      				<tr>
	        				<td>{saldodentista}</td>
	        				<td>{saldoclinica}</td>
	      				</tr>
	      			{/BLOCO_SALDOS}
	      			</tbody>
	  			</table> <!-- Fim da Tabela Saldos -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Container Saldos -->

		<br><br>

		<div class="container tabela">
			<h1>Lançamentos Comuns</h1>
			<div class="panel panel-default">
				<table class="table table-bordered">
	    			<thead>
	      				<tr>
	        				<th>Data Receb.</th>
	        				<th>Nome do Paciente</th>
	        				<th>Valor Receb.</th>
	        				<th>Forma Pag.</th>
	        				<th>Tx Cartão</th>
	        				<th>Comissão</th>
	        				<th>Valor Líq.</th>
	        				<th></th>
	        				<th></th>
	      				</tr>
	    			</thead>
	    			<tbody>
	    			{BLOCO_DADOSCOMUNS}
	      				<tr>
	        				<td>{datadaficha}</td>
	        				<td>{nomepac}</td>
	        				<td>{valor}</td>
	        				<td>{forma}</td>
	        				<td>{taxacartao}</td>
	        				<td>{taxacomissao}</td>
	        				<td>{valorliquido}</td>
	        				<td><a href="{URLEDITARCOMUNS}" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a></td>
	        				<td><a href="{URLDELETARCOMUNS}" title="Deletar"><span class="glyphicon glyphicon-trash"></span></a></td>
	      				</tr>
	      			{/BLOCO_DADOSCOMUNS}
	      			{BLOCO_SEMDADOSCOMUNS}
	      				<tr>
	        				<td colspan="9">Nenhum Lançamento no Momento.</td>
	      				</tr>
	    			{/BLOCO_SEMDADOSCOMUNS}
	      			</tbody>
	  			</table> <!-- Fim da Tabela Lançamentos Comuns -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Container Lançamentos Comuns -->

		<br><br>

		<div class="container tabela">		
			<div class="panel panel-default">
				<table class="table table-bordered">
	    			<thead>
	    				<tr>
	    					<th class="celula-fundo-cinza" colspan="5">Créditos Integrais para o Dentista</th>
	    				</tr>
	      				<tr>
	        				<th>Data Crédito</th>
	        				<th>Observações</th>
	        				<th>Crédito</th>
	        				<th></th>
	        				<th></th>
	      				</tr>
	    			</thead>
	    			<tbody>
	    				{BLOCO_CREDITOS}    			
	      				<tr>
	        				<td>{datadafichacredito}</td>
	        				<td>{observacoescredito}</td>
	        				<td>{valorcredito}</td>
	        				<td><a href="{URLEDITARCREDITO}" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a></td>
	        				<td><a href="{URLDELETARCREDITO}" title="Deletar"><span class="glyphicon glyphicon-trash"></span></a></td>
	      				</tr>
	      				{/BLOCO_CREDITOS}
	      				{BLOCO_SEMCREDITOS}
	      				<tr>
	      					<td colspan="5">Sem créditos para o Dentista no momento.</td>
	      				</tr>
	      				{/BLOCO_SEMCREDITOS}
	      			</tbody>
	  			</table> <!-- Fim da Tabela Lançamentos Comuns -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Container Creditos -->

		<br><br>

		<div class="container tabela">
			<div class="panel panel-default">
				<table class="table table-bordered">
	    			<thead>
	    				<tr>
	    					<th class="celula-fundo-cinza" colspan="5">Saídas Antecipadas ao Dentista</th>
	    				</tr>
	      				<tr>
	        				<th>Data Saída</th>
	        				<th>Observações</th>
	        				<th>Débito</th>
	        				<th></th>
	        				<th></th>
	      				</tr>
	    			</thead>
	    			<tbody>
	    				{BLOCO_DEBITOS}
	      				<tr>
	        				<td>{datadafichadebito}</td>
	        				<td>{observacoesdebito}</td>
	        				<td>{valordebito}</td>
	        				<td><a href="{URLEDITARDEBITO}" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a></td>
	        				<td><a href="{URLDELETARDEBITO}" title="Deletar"><span class="glyphicon glyphicon-trash"></span></a></td>
	      				</tr>
	      				{/BLOCO_DEBITOS}
	      				{BLOCO_SEMDEBITOS}
	      				<tr>
	      					<td colspan="5">Sem saídas antecipadas.</td>
	      				</tr>
	      				{/BLOCO_SEMDEBITOS}
	      			</tbody>
	  			</table> <!-- Fim da Tabela Lançamentos Comuns -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Container Debitos Dentista-->

		<br><br>

		<div class="container tabela">
			<div class="panel panel-default">
				<table class="table table-bordered">
	    			<thead>
	    				<tr>
	    					<th class="celula-fundo-cinza" colspan="5">Saídas Antecipadas à Clínica</th>
	    				</tr>
	      				<tr>
	        				<th>Data Saída</th>
	        				<th>Observações</th>
	        				<th>Débito</th>
	        				<th></th>
	        				<th></th>
	      				</tr>
	    			</thead>
	    			<tbody>
	    				{BLOCO_DEBITOSCLINICA}
	      				<tr>
	        				<td>{datadafichadebito}</td>
	        				<td>{observacoesdebito}</td>
	        				<td>{valordebito}</td>
	        				<td><a href="{URLEDITARDEBITO}" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a></td>
	        				<td><a href="{URLDELETARDEBITO}" title="Deletar"><span class="glyphicon glyphicon-trash"></span></a></td>
	      				</tr>
	      				{/BLOCO_DEBITOSCLINICA}
	      				{BLOCO_SEMDEBITOSCLINICA}
	      				<tr>
	      					<td colspan="5">Sem saídas antecipadas.</td>
	      				</tr>
	      				{/BLOCO_SEMDEBITOSCLINICA}
	      			</tbody>
	  			</table> <!-- Fim da Tabela Lançamentos Comuns -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Container Debitos Clinica-->

		<br><br><br>

		<div class="container tabela">
			<h2>Resumo</h2>
	  		<div class="panel panel-default">
				<table class="table table-bordered">
	    			<thead>
	      				<tr>
	        				<th>Total Dinheiro</th>
	        				<th>Total Cartão</th>
	        				<th>Total Cheque</th>
	        				<th>Total real no Caixa</th>
	        				<th>Total p/ o Dentista</th>
	        				<th>Total p/ Clínica</th>
	      				</tr>
	    			</thead>
	    			<tbody>
	      				<tr>
	        				<td>{TOTALDINHEIRO}</td>
	        				<td>{TOTALCARTAO}</td>
	        				<td>{TOTALCHEQUE}</td>
	        				<td>{TOTALREAL}</td>
	        				<td>{TOTALDENTISTA}</td>
	        				<td>{TOTALCLINICA}</td>
	      				</tr>
	    			</tbody>
	  			</table> <!-- Fim da Tabela Resumo -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Resumo -->
		{BLOCO_FECHARCAIXA}
		<div class="container acerto">
			<button id="fazerAcerto" class="btn btn-info center-block">Fazer Acerto com Dentista</button>
			<div class="container lancamento-acerto">
			<h1 class="text-center">Acerto</h1>
			<form action="<?php echo base_url();?>lancamentos/confirmar_acerto" method="POST">
				<div class="form-group row">
					<div class="col-xs-2">
				    	<label for="datadoacerto">Data do Acerto:</label>
				    	<input class="form-control" id="datadoacerto" name="datadoacerto" type="text" value="">
					</div>
					<div class="col-xs-2">
				    	<label for="quemfezacerto">Quem acertou:</label>
				    	<input class="form-control" id="quemfezacerto" name="quemfezacerto" type="text" value="">
					</div>
				</div> <!-- Fim DIV Form-Group Row 1 -->
				<div class="form-group row">
					<div class="col-xs-2">
				    	<label for="valorarepassar">Valor total Comissão:</label>
						<div class="input-group">
				    		<span class="input-group-addon">R$</span>
				    		<input class="form-control" id="valorarepassar" name="valorarepassar" type="text" value="{TOTALDENTISTA}" disabled>
				    	</div>
					</div>
					<div class="col-xs-2">
				    	<label for="valorrepassadodinheiro">Repassado em dinheiro:</label>
						<div class="input-group">
				    		<span class="input-group-addon">R$</span>
				    		<input class="form-control" id="valorrepassadodinheiro" name="valorrepassadodinheiro" type="text" value="">
				    	</div>
					</div>
					<div class="col-xs-2">
				    	<label for="valorrepassadocheque">Repassado em cheque:</label>
						<div class="input-group">
				    		<span class="input-group-addon">R$</span>
				    		<input class="form-control" id="valorrepassadocheque" name="valorrepassadocheque" type="text" value="">
				    	</div>
					</div>						
				</div> <!-- Fim DIV Form-Group Row 2 -->
				<div class="form-group row">
					<div class="col-xs-2">
				    	<label for="valortotalclinica">Valor total Clínica:</label>
						<div class="input-group">
				    		<span class="input-group-addon">R$</span>
				    		<input class="form-control" id="valortotalclinica" name="valortotalclinica" type="text" value="{TOTALCLINICA}" disabled>
				    	</div>
					</div>
					<div class="col-xs-2">
				    	<label for="valorclinicadinheiro">P/ Clínica em dinheiro:</label>
						<div class="input-group">
				    		<span class="input-group-addon">R$</span>
				    		<input class="form-control" id="valorclinicadinheiro" name="valorclinicadinheiro" type="text" value="" >
				    	</div>
					</div>
					<div class="col-xs-2">
				    	<label for="valorclinicacheque">P/ Clínica em cheque:</label>
						<div class="input-group">
				    		<span class="input-group-addon">R$</span>
				    		<input class="form-control" id="valorclinicacheque" name="valorclinicacheque" type="text"value="" >
				    	</div>
					</div>						
				</div> <!-- Fim DIV Form-Group Row 3 -->
				<div class="form-group row">
					<div class="col-xs-3">
				    	<span id="mutreta"></span>
				    	<input type="submit" class="btn btn-success" value="Acertar">
				    	<input type="button" class="btn botaoFecharAcerto" value="Fechar Janela">
					</div>
				</div> <!-- Fim DIV Form-Group Row 4 -->
			</form>
		</div> <!-- Fim DIV Acerto-->
		{/BLOCO_FECHARCAIXA}
		{BLOCO_SEMFECHARCAIXA}
		<div class="container acerto">
			<div id="alerta-liquidez">
				<strong><h3 class="text-center">O caixa não pode ser fechado devido falta de liquidez. </h2></strong>
				<h5 class="text-center">Pelos cálculos do sistema, seria necessário adicionar ao caixa a quantia de R$ {VALORDARLIQUIDEZ} em dinheiro.</h5>
				<h5 class="text-center">Este valor aparecerá na tabela dos Lançamentos Comuns.</h5>
				<br>
				<button id="fazerLiquidez" class="btn btn-warning center-block">Clique para dar Liquidez ao Caixa adicionando Dinheiro</button>

				<div id="campoLiquidez">
					<h4 class="text-center">Qual valor você irá colocar no Caixa do Dentista?</h4>
					<form action="<?php echo base_url();?>lancamentos/dar_liquidez" method="POST">
						<div class="form-group row">
							<div class="col-xs-2 col-xs-offset-5">
								<div class="input-group">
						    		<span class="input-group-addon">R$</span>
						    		<input class="form-control" id="valoraporte" name="valoraporte" type="text">
						    	</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-xs-2 col-xs-offset-5">
						    	<input type="submit" class="btn btn-success" value="Lançar">
						    	<input id="botaoFecharLiquidez" type="button" class="btn" value="Desistir">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		{/BLOCO_SEMFECHARCAIXA}
		</div>
		<br>
		<br>