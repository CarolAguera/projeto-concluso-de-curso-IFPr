<?php
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
$idproduto = $_POST['Produto_id'];
$sql = "select * from produto where id='{$idproduto}'";
$executar = mysqli_query($conexao, $sql);
$dado = mysqli_fetch_array($executar);

echo json_encode($dado);

