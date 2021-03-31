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
  $retorno .= "<h4 style=\"text-align:center\">Relatório de Vendas do Mês Atual</h4>";
  $retorno .= "<table border='1' width='1000' align='center'>  
		 <tr class='header'>  
         <th>ID</th>s
         <th>Usuário</th>
         <th>Valor Total</th>
         <th>Desconto</th>
         <th>Valor Total da Venda</th>
         <th>Data Da Venda</th>
		 </tr>";

  $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

  $data_incio = mktime(0, 0, 0, date('m'), 1, date('Y'));
  $data_fim = mktime(0, 0, 0, date('m') + 1, 1, date('Y'));


  $sql = "SELECT venda.*, usuario.nome_completo as nome_usuario FROM venda
           INNER JOIN usuario ON venda.Usuario_id = usuario.id
           WHERE data_hora BETWEEN ". "'". date('Y-m-d', $data_incio). "'" . " AND " . "'" . date('Y-m-d', $data_fim) . "'". "";         
  $vendas = mysqli_query($conexao, $sql);
  mysqli_close($conexao);
  while ($data = mysqli_fetch_array($vendas)) {
    $retorno .= "<tr class=\"zebra\">";
    $retorno .= "<td class='destaque'>{$data['id']} </td>";
    $retorno .= "<td>{$data['nome_usuario']} </td>";
    $retorno .= "<td>" . number_format($data['valorTotal'], 2, ',', '.') . "</td>";
    $retorno .= "<td> " . number_format($data['desconto'], 2, ',', '') . "</td>";
    $retorno .= "<td class='destaqueVenda'>" . number_format($data['valorTotal'] - $data['desconto'], 2, ',', '.') . "</td>";
    $retorno .= "<td>" . (new DateTime($data['data_hora']))->format('d/m/Y') . "</td>";
    // $retorno .= "<td>". date('d/m/Y H:i:s',$data['data_hora']) ."</td>";
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
