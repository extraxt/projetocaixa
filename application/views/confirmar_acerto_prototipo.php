<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

		<div class="container cabecalho">
			<div>
				<h2 class="text-center">DATA DO ACERTO: {datadoacerto}</h4>
				<h4 class="text-center"><strong>Quem acertou com o dentista:</strong> {quemafezacerto}</h4>
			</div>
		</div>
		<br>
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
	        				<td colspan="9">Nenhum Lançamento Comum.</td>
	      				</tr>
	    			{/BLOCO_SEMDADOSCOMUNS}
	      			</tbody>
	  			</table> <!-- Fim da Tabela Lançamentos Comuns -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Container Lançamentos Comuns -->
		<div class="container tabela">
			<h1>Créditos</h1>
			<div class="panel panel-default">
				<table class="table table-bordered">
	    			<thead>
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
	        				<td colspan="5">Nenhum Crédito.</td>
	      				</tr>
	    			{/BLOCO_SEMCREDITOS}
	      			</tbody>
	  			</table> <!-- Fim da Tabela Lançamentos Comuns -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Container Creditos -->
		<div class="container tabela">
			<h1>Saídas</h1>
			<div class="panel panel-default">
				<table class="table table-bordered">
	    			<thead>
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
	        				<td colspan="5">Nenhuma Saída.</td>
	      				</tr>
	    			{/BLOCO_SEMDEBITOS}
	      			</tbody>
	  			</table> <!-- Fim da Tabela Lançamentos Comuns -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Container Debitos -->
		
		<div class="col-xs-6">
				<h3 class="text-center">Resumo Caixa</h3>
				<div class="panel panel-default">
					<table class="table table-bordered">
		    			<thead>
		      				<tr>
		      					<th></th>
		      					<th>Resultado</th>
		      				</tr>
		    			</thead>
		    			<tbody>
		    				<tr>
		        				<td>Saldo Dentista Prévio</td>
		        				<td>{saldodentistaprevio}</td>
		      				</tr>
		      				<tr>
		        				<td>Saldo Clinica Prévio</td>
		        				<td>{saldoclinicaprevio}</td>
		      				</tr>
		      				<tr>
		        				<td>Total Dinheiro</td>
		        				<td>{totaldinheiro}</td>
		      				</tr>
		      				<tr>
		        				<td>Total Cartão</td>
		        				<td>{totalcartao}</td>
		      				</tr>
		      				<tr>
		        				<td>Total Cheque</td>
		        				<td>{totalcheque}</td>
		      				</tr>
		      				<tr>
		        				<td>Total Comissão</td>
		        				<td>{totalcomissao}</td>
		      				</tr>
		      				<tr>
		        				<td>Total p/ Clínica</td>
		        				<td>{totalpclinica}</td>
		      				</tr>
		    			</tbody>
		  			</table> <!-- Fim da Tabela Resumo Caixa -->
	  			</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
			</div>
		<div class="col-xs-6">
			<h3 class="text-center">Resumo Distribuição</h3>
			<div class="panel panel-default">
					<table class="table table-bordered">
		    			<thead>
		      				<tr>
		      					<th></th>
		      					<th>Resultado</th>
		      				</tr>
		    			</thead>
		    			<tbody>
		      				<tr>
		        				<td>Dentista - Dinheiro</td>
		        				<td>{dentistadinheiro}</td>
		      				</tr>
		      				<tr>
		        				<td>Dentista - Cheque</td>
		        				<td>{dentistacheque}</td>
		      				</tr>
		      				<tr>
		        				<td>Novo Saldo Dentista</td>
		        				<td>{saldodentista}</td>
		      				</tr>
		      				<tr>
		        				<td>Clinica - Dinheiro</td>
		        				<td>{clinicadinheiro}</td>
		      				</tr>
		      				<tr>
		        				<td>Clinica - Cheque</td>
		        				<td>{clinicacheque}</td>
		      				</tr>
		      				<tr>
		        				<td>Novo Saldo Clínica</td>
		        				<td>{saldoclinica}</td>
		      				</tr>
		    			</tbody>
		  			</table> <!-- Fim da Tabela Resumo Caixa -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div>
		<br>
		<br>
		<div class="container text-center">
			<div id="alerta-liquidez">
				<h1 class="text-center">Você quer mesmo fazer o acerto baseado nestas informações?</h1>
				<h5 class="text-center">Se você perceber algum erro, aperte Voltar no navegador. Nada acontecerá e você terá a oportunidade de fazer correções.</h5>
				<h5 class="text-center">Confira os dados da folha de <strong>impressão do Caixa</strong>. Se houver dúvidas, imprima, volte para a tela anterior e confirme linha por linha dos lançamentos.</h5>
				<h5 class="text-center">Apertando o botão <strong>FINALIZAR</strong>, todos os dados serão arquivados no banco de dados e o caixa começará do zero.</h5>
				<h5 class="text-center">Os únicos dados preservados para o próximo Caixa serão os valores de Saldo da Clínica e do Dentista.</h5>
				<br>
				<input type="submit" class="btn btn-warning" value="Finalizar">
			</div>
		<br><br>
		</div> <!-- Fim DIV Finalizar-->