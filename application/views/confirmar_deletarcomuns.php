<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

		{BLOCO_DADOS}
		<div class="container tabela">
			<h1>Você quer mesmo deletar este lançamento abaixo?</h1>
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
	      				<tr>
	        				<td>{datadaficha}</td>
	        				<td>{nomepac}</td>
	        				<td>{valor}</td>
	        				<td>{forma}</td>
	        				<td>{taxacartao}</td>
	        				<td>{taxacomissao}</td>
	        				<td>{valorliquido}</td>
	      				</tr>
	      			</tbody>
	      		</table> <!-- Fim da Tabela -->
	  		</div> <!-- Fim da DIV que engloba a tabela para arredondar as bordas -->
		</div> <!-- Fim DIV Container Tabela -->

		<div class="container text-center">
			<a href="{URLDELETAR}" class="btn btn-info" role="button">Deletar</a>
		</div> <!-- Fim DIV Botão-->

	    {/BLOCO_DADOS}

	    {BLOCO_SEMDADOS}
	    <div class="text-center">
	    	<h2>Este Lançamento não existe.</h2>
	    </div>
	    {/BLOCO_SEMDADOS}