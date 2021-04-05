<?php
date_default_timezone_set('America/Sao_Paulo');
require_once("../verificaSessao.php");
include("../mpdf60/mpdf.php");
require_once __DIR__ . '../../../vendor/autoload.php';

function getFooter()
{
    $retorno = "<table class=\"tbl_footer\" width=\"1000\">  
			<tr> 
			  <td align=\"left\"><a href='malito:carolaguerabr@gmail.com'>carolaguerabr@gmail.com</a></td>  
        <td align=\"center\">" . date('d/m/Y H:i:s') . "</td>  
			  <td align=\"right\">Página: {PAGENO}</td>  
			</tr>  
		  </table>";
    return $retorno;
}


function getTabela()
{
    $retorno = "";
    $retorno = "<img class='imagem' src=\"../img/dpbrasillogo.png\"> ";
    //$retorno .= "<h2 style=\"text-align:center\">Depósito Brasil</h2>";
    $retorno .= "<h4 style=\"text-align:center\">Relatório de Vendas</h4>";
    $retorno .= "<table border='1' width='1000' align='center'>  
		 <tr class='header'>  
         <th>ID</th>s
         <th>Usuário</th>
         <th>Cliente</th>
         <th>Valor Total</th>
         <th >Desconto</th>
		 </tr>";

    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
    $sql = "SELECT venda.*, usuario.nome_completo as nome_usuario,
           cliente.nome_completo as nome_cliente FROM venda
           INNER JOIN usuario ON venda.Usuario_id = usuario.id
           INNER JOIN cliente ON venda.Cliente_id = cliente.id";


    $vendas = mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    while ($data = mysqli_fetch_array($vendas)) {
        $retorno .= "<tr class=\"zebra\">";
        $retorno .= "<td class='destaque'>{$data['id']} </td>";
        $retorno .= "<td>{$data['nome_usuario']} </td>";
        $retorno .= "<td>{$data['nome_cliente']} </td>";
        $retorno .= "<td>" . number_format($data['valorTotal'], 2, ',', '') . "</td>";
        $retorno .= "<td> " . number_format($data['desconto'], 2, ',', '') . "</td>";
    }
    $retorno .= "</table>";
    return $retorno;
}

$mpdf = new \Mpdf\mPDF();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("../css/estilo.css");
$mpdf->WriteHTML($css, 1);
$mpdf->SetHTMLFooter(getFooter());
$mpdf->WriteHTML(getTabela());
$mpdf->Output();
exit;
