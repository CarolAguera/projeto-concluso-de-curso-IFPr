<?php

session_start();

if (!isset($_SESSION['id'])) {
    $mensagem = "Sessão Expirada. Faça login novamente! ";
    header("location: login.php?mensagem={$mensagem}");
    die();
}


include("../mpdf60/mpdf.php");
require_once __DIR__ . '../../../vendor/autoload.php';

$html = "
 <fieldset>
 <h1>Comprovante de Pagamento</h1>
 <p class='center sub-titulo'>
 Nº <strong>0001</strong> - 
 VALOR <strong>R$ 700,00</strong>
 </p>
 <p>Recebi(emos) de <strong>Ebrahim Paula Leite</strong></p>
 <p>a quantia de <strong>Setecentos Reais</strong></p>
 <p>Correspondente a <strong>Serviços prestados ..<strong></p>
 <p>e para clareza firmo(amos) o presente.</p>
 <p class='direita'>Umuarama, 07 de Março de 2021</p>
 <p>Assinatura ......................................................................................................................................</p>
 <p>Nome <strong>Carolina Aguera</strong> CPF/CNPJ: <strong>106.280.659-06</strong></p>
 <p>Endereço <strong>Rua Treze de Maio, 1829 - Jardim Colibri, Umuarama - Paraná</strong></p>
 </fieldset>
 ";


$mpdf = new \Mpdf\mPDF();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("../css/style.css");
$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML($html);
$mpdf->Output();

exit;
