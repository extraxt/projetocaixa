<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

		{BLOCO_DADOS}
		<div class="container tabela">
			<h1>Você quer mesmo deletar esta saída abaixo?</h1>
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
	      				<tr>
	        				<td>{datadaficha}</td>
	        				<td>{observacoes}</td>
	        				<td>{valor}</td>
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
	    	<h2>Este Débito não existe.</h2>
	    </div>
	    {/BLOCO_SEMDADOS}