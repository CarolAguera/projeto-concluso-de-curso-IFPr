<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");

$conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

if (!isset($_POST['itemvenda'])) {
    $mensagem = "Volte na Página Vendas e clique no botão Itens.";
    header('location: ./IndexAdmin.php?mensagem=' . $mensagem);
} else {
    $sql = "SELECT * FROM itensvenda WHERE Venda_id = " . $_POST['idAtualizar'];
    $venda = mysqli_query($conexao, $sql);
}

require_once("../menu.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Itens Vendas</title>
    <style>
        .teste {
            background-image: url("../img/textura2.jpg");
        }

        .centr {
            margin-left: 60px;
        }

        .mar {
            padding: 0%;
        }

        .actions {
            width: 300px;
        }
    </style>
</head>

<body class="teste">
    <center>
        <div class="container" style="margin-top: 30px">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Listagem de Itens de Vendas</h2>
                </div>
                <div class="col-sm-3">
                    <a href="./ListagemDeVendas.php" type="button" style="padding-top: 7px; padding-bottom: 6px;" class="btn  btn-warning">
                        <i class="far fa-plus-square"></i> Listagem de Vendas
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="./vendas.php" type="button" style="padding-top: 7px; padding-bottom: 6px;" class="btn  btn-success">
                        <i class="far fa-plus-square"></i> Efetuar Venda
                    </a>
                </div>
            </div>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Produto</th>
                            <th scope="col">Quantidade Vendida</th>
                            <th scope="col">Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        while ($data = mysqli_fetch_array($venda)) { ?>
                        <?php
                            $sqlProduto = "select id,nome from produto where id = '{$data['Produto_id']}' ";
                            $produto = mysqli_query($conexao, $sqlProduto);
                            $buscaproduto = mysqli_fetch_array($produto);
                        ?>
                        <tr>
                            <td><?= $buscaproduto['nome']  ?></td>
                            <td><?= $data['quantidadeVendida']  ?></td>
                            <td><?= number_format($data['valorTotal'], 2, ',', '')  ?></td>
                        </tr>


                        <?php
                        }
                        mysqli_close($conexao);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </center>
</body>

</html>