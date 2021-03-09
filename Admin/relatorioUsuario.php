<?php
require_once("../verificaSessao.php");
include("../mpdf60/mpdf.php");
require_once __DIR__ . '../../../vendor/autoload.php';

$conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
if (!$conexao) {
	die("Falha na conexao: " . mysqli_connect_error());
} else {
	//echo "Conexao realizada com sucesso";
}

$conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
$sql = "select * from usuario  ";
$usuarios = mysqli_query($conexao, $sql);

$html = "
<html>

<body>
<h1>Relatório do Usuário</h1>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Status</th>
				<th>Usuário</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			";

while ($data = mysqli_fetch_array($usuarios)) {
	$opa = (string) $data['id'];
	"
			<tr>
				<td> " .  $opa  . " </td>
				<td> " .  $data['nome_completo'] . " </td>
				<td> " . $data['email']  . "</td>
			</tr>
				";
}
" 

		</tbody>
	</table>
</body>

</html>
";
$mpdf = new \Mpdf\mPDF();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("../css/estilo.css");
$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
