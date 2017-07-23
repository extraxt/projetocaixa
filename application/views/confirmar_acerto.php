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
	      				</tr>
	    			</thead>
	    			<tbody>
	    			{BLOCO_CREDITOS}
	      				<tr>
	        				<td>{datadafichacredito}</td>
	        				<td>{observacoescredito}</td>
	        				<td>{valorcredito}</td>
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
			<h1>Saídas Antecipadas Dentista</h1>
			<div class="panel panel-default">
				<table class="table table-bordered">
	    			<thead>
	      				<tr>
	        				<th>Data Saída</th>
	        				<th>Observações</th>
	        				<th>Débito</th>
	        			</tr>
	    			</thead>
	    			<tbody>
	    			{BLOCO_DEBITOS}
	      				<tr>
	        				<td>{datadafichadebito}</td>
	        				<td>{observacoesdebito}</td>
	        				<td>{valordebito}</td>
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
		</div> <!-- Fim DIV Container Debitos Dentista -->
		<div class="container tabela">
			<h1>Saídas Antecipadas Clínica</h1>
			<div class="panel panel-default">
				<table class="table table-bordered">
	    			<thead>
	      				<tr>
	        				<th>Data Saída</th>
	        				<th>Observações</th>
	        				<th>Débito</th>
	      				</tr>
	    			</thead>
	    			<tbody>
	    			{BLOCO_DEBITOSCLINICA}
	      				<tr>
	        				<td>{datadafichadebitoclinica}</td>
	        				<td>{observacoesdebitoclinica}</td>
	        				<td>{valordebitoclinica}</td>
	      				</tr>
	      			{/BLOCO_DEBITOSCLINICA}
	      			{BLOCO_SEMDEBITOSCLINICA}
	      				<tr>
	        				<td colspan="5">Nenhuma Saída.</td>
	      				</tr>
	    			{/BLOCO_SEMDEBITOSCLINICA}
	      			</tbody>
	  			</table> <!-- Fim da Tabela Lançamentos Comuns -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Container Debitos Clinica-->
		<div class="container">
		<div class="col-xs-4 col-xs-offset-1">
				<div class="panel panel-default">
					<table class="table table-bordered">
		    			<thead>
		      				<tr>
		      					<th colspan="2"><h3 class="text-center">Saldo Anterior</h3></th>
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
		    			</tbody>
		  			</table> <!-- Fim da Tabela Saldo Anterior -->
	  			</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
				<div class="panel panel-default">
					<table class="table table-bordered">
		    			<thead>
		      				<tr>
		      					<th colspan="2"><h3 class="text-center">Resumo Caixa</h3></th>
		      				</tr>
		    			</thead>
		    			<tbody>
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
		      				<tr>
		      					<td><strong>Total Faturamento:</strong></td>
		      					<td>{totalfaturamento}</td>
		      				</tr>
		    			</tbody>
		  			</table> <!-- Fim da Tabela Resumo Caixa -->
	  			</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Resumo Caixa -->
		<div class="col-xs-4 col-xs-offset-1">
			
			<div class="panel panel-default">
					<table class="table table-bordered">
		    			<thead>
		      				<tr>
		      					<th colspan="2"><h3 class="text-center">Resumo Distribuição</h3></th>
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
		        				<td>Clinica - Dinheiro</td>
		        				<td>{clinicadinheiro}</td>
		      				</tr>
		      				<tr>
		        				<td>Clinica - Cheque</td>
		        				<td>{clinicacheque}</td>
		      				</tr>
		    			</tbody>
		  			</table> <!-- Fim da Tabela Resumo Caixa -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
	  		<div class="panel panel-default">
					<table class="table table-bordered">
		    			<thead>
		      				<tr>
		      					<th colspan="2"><h3 class="text-center">Novo Saldo</h3></th>
		      				</tr>
		    			</thead>
		    			<tbody>
		      				<tr>
		        				<td>Saldo Dentista Final</td>
		        				<td>{saldodentista}</td>
		      				</tr>
		      				<tr>
		        				<td>Saldo Clinica Final</td>
		        				<td>{saldoclinica}</td>
		      				</tr>
		    			</tbody>
		  			</table> <!-- Fim da Tabela Saldo Anterior -->
	  			</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Resumo Distribuição -->
		</div>
		<br>
		<br>
		<div class="container impressao no-print">
			<div class="text-center">
				<a href="javascript:if(window.print)window.print()" class="btn btn-success">Imprimir Relatório</a>
			</div>
		</div>
		<div class="container col-xs-10 col-xs-offset-1 no-print">
			<div id="alerta-liquidez">
				<h1 class="text-center">Você quer mesmo fazer o acerto baseado nestas informações?</h1>
				<h5 class="text-center">Se você perceber algum erro, aperte Voltar no navegador. Nada acontecerá e você terá a oportunidade de fazer correções.</h5>
				<h5 class="text-center">Confira os dados da folha de <strong>impressão do Caixa</strong>. Se houver dúvidas, imprima, volte para a tela anterior e confirme linha por linha dos lançamentos.</h5>
				<h5 class="text-center">Apertando o botão <strong>FINALIZAR</strong>, todos os dados serão arquivados no banco de dados e o caixa começará do zero.</h5>
				<h5 class="text-center">Os únicos dados preservados para o próximo Caixa serão os valores de Saldo da Clínica e do Dentista.</h5>
				<br>
				<div class="text-center">
					<a href="{URLFINALIZAR}" class="btn btn-warning" role="button">Finalizar</a>
				</div>
			</div>
			<br>
		</div>
			