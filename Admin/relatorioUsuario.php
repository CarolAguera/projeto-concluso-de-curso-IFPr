<?php

session_start();

if (!isset($_SESSION['id'])) {
    $mensagem = "Sessão Expirada. Faça login novamente! ";
    header("location: login.php?mensagem={$mensagem}");
    die();
}


include("../mpdf60/mpdf.php");
require_once __DIR__ . '../../../vendor/autoload.php';

$id = "1";
$result_usuario = "SELECT * FROM usuarios WHERE id = '$id' LIMIT 1";
$resultado_usuario = mysqli_query($conn, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);

$html =
    "<html>
			<body>
				<h1>Informações do Usuário</h1>
				Id: " . $row_usuario['id'] . "<br>
				Nome: " . $row_usuario['nome_completo'] . "<br>
				E-mail: " . $row_usuario['email'] . "<br>
				Senha: " . $row_usuario['senha'] . "<br>
				<h4>http://www.celke.com.br</h4>
			</body>
		</html>
		";


$mpdf = new \Mpdf\mPDF();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("style.css");
$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML($html);
$mpdf->Output();

exit;
