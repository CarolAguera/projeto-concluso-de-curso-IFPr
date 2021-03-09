<?php
require_once("../verificaSessao.php");
include("../mpdf60/mpdf.php");
require_once __DIR__ . '../../../vendor/autoload.php';

function getFooter()
{
    $retorno = "<table class=\"tbl_footer\" width=\"1000\">  
			<tr> 
			  <td align=\"left\"><a href='malito:carolaguerabr@gmail.com'>carolaguerabr@gmail.com</a></td>  
			  <td align=\"right\">Página: {PAGENO}</td>  
			</tr>  
		  </table>";
    return $retorno;
}


function getTabela()
{
    $retorno = "";
    $retorno .= "<h2 style=\"text-align:center\">Depósito Brasil</h2>";
    $retorno .= "<h4 style=\"text-align:center\">Relatório de Produtos</h4>";
    $retorno .= "<table border='1' width='1000' align='center'>  
		 <tr class='header'>  
			 <th>ID</th>
		 	 <th>Nome</th>
		 	 <th>Código</th>
			 <th>Quantidade</th>
             <th>Categoria</th>
             <th>Marca</th>
             <th>Medida</th>
             <th>Valor Venda</th>
		 </tr>";

    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
    $sql = "select * from produto  ";
    $usuarios = mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    while ($data = mysqli_fetch_array($usuarios)) {
        $retorno .= "<tr class=\"zebra\">";
        $retorno .=    "<td class='destaque'>{$data['id']} </td>";
        $retorno .= "<td>{$data['nome']} </td>";
        $retorno .= "<td>{$data['codigo']} </td>";
        $retorno .= "<td>{$data['quantidade']} </td>";
        $retorno .= "<td>{$data['Categoria_id']} </td>";
        $retorno .= "<td>{$data['Marca_id']} </td>";
        $retorno .= "<td>{$data['Medida_id']} </td>";
        $retorno .= "<td>{$data['valor_venda']} </td>";
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
