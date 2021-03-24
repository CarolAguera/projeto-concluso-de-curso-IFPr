<?php
date_default_timezone_set('America/Sao_Paulo');

require_once("../verificaSessao.php");
include("../mpdf60/mpdf.php");
require_once __DIR__ . '../../../vendor/autoload.php';

function formataData($data)
{
	return substr($data, 8, 2) . "/" .
		substr($data, 5, 2) . "/" .
		substr($data, 0, 4);
}


function getFooter()
{
	$retorno = "<table class=\"tbl_footer\" width=\"1000\">  
			<tr> 
			  <td align=\"left\"><a href='malito:carolaguerabr@gmail.com'>carolaguerabr@gmail.com</a></td>  
			  <td align=\"center\">".date('d/m/Y H:i:s')."</td>   
			  <td align=\"right\">Página: {PAGENO}</td>  
			</tr>  
		  </table>";
	return $retorno;
}


function getTabela($mpdf)
{

	$retorno = "";
	$retorno = "<img class='imagem' src=\"../img/dpbrasillogo.png\"> ";
	$retorno .= "<h4 style=\"text-align:center\">Relatório de Usuário</h4>";
	$retorno .= "<table border='1' width='1000' align='center'>  
		 <tr class='header'>  
			 <th>ID</th>
		 	<th>Nome Completo</th>
		 	<th>Data de Nascimento</th>
			 <th>E-mail</th>
		 </tr>";

	$conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
	$sql = "select * from usuario  ";
	$usuarios = mysqli_query($conexao, $sql);
	mysqli_close($conexao);
	while ($data = mysqli_fetch_array($usuarios)) {
		$retorno .= "<tr class=\"zebra\">";
		$retorno .=	"<td class='destaque'>{$data['id']} </td>";
		$retorno .= "<td>{$data['nome_completo']} </td>";
		$retorno .= " <td>" . formataData($data['data_nascimento']) . "</td>";
		$retorno .= "<td>{$data['email']} </td>";
	}
	$retorno .= "</table>";
	return $retorno;
}

$mpdf = new \Mpdf\mPDF();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("../css/estilo.css");
$mpdf->WriteHTML($css, 1);
$mpdf->SetHTMLFooter(getFooter());
$mpdf->WriteHTML(getTabela($mpdf));
$mpdf->Output();
exit;
