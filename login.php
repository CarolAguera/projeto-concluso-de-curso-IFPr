<?php
require_once("dependencias.php");


if (isset($_POST['entrar'])) {
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$entrar = $_POST['entrar'];

	if ($email == "" && $senha == "") {
	}
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<link rel="icon" href="img/iconPNG.png" type="image/png" sizes="16x16">
	<style>
		.card-title {
			background-color: rgb(20, 141, 197);
			text-align: center;
		}

		@media only screen and (max-width: 986px) {
			.container {
				margin-top: 100px !important;
				margin-bottom: 0px !important;
			}
		}
	</style>
	<title>Login</title>
</head>


<body style="background-color: #182f63">
	<div class="container" style="margin-top: 100px; margin-bottom: 100px;">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<?php
				if (isset($_GET['mensagem'])) { ?>
					<div class="alert alert-warning" role="alert">
						<?= $_GET['mensagem'] ?>
					</div>
				<?php
				}
				?>
				<div class="card card-body">
					<div class="card card-title"><strong>Sistema</strong></div>
					<div class=" ">
						<p>
							<img src="img/dpbrasil.jpg" class="rounded" width="100%">
						</p>
						<form name="form" id="frmLogin" method="POST" action="autenticacao.php">
							<label>Email</label>
							<input type="email" class="form-control input-sm" name="email" id="email">
							<label>Senha</label>
							<input type="password" name="senha" id="senha" class="form-control input-sm">
							<center style="margin-top: 10px;">
								<button class="btn btn-primary btn-sm" type="submit" id="entrar" name="entrar">Entrar</button>
							</center>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>

</html>