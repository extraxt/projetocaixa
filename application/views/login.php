<div class="container">
	<div class="caixa-login">
		<h1 class="text-center">Login no sistema</h1>
	</div>
	<div class="col-xs-4 col-xs-offset-4">
		<form action="<?php echo base_url("login/logar");?>" method="POST">
			<div class="form-group">
				<label for="usuario">Usuário:</label>
				<input class="form-control" id="usuario" name="usuario" type="text" required>
			</div>
			<div class="form-group">
				<label for="senha">Senha:</label>
				<input class="form-control" id="senha" name="senha" type="password" required>
			</div>
			<div class="text-center">
				<input type="submit" class="btn btn-success" value="Entrar">
			</div>
		</form>
	</div>
</div>