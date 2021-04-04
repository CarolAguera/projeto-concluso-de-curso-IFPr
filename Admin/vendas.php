<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");


if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['finalizar'])) {
    $valorTotal = $_POST['resumoSoma'];
    $valorTotal1 = str_replace(",", ".", str_replace(".", "", $valorTotal));
    $desconto = $_POST['desconto'];
    $desconto1 = str_replace(",", ".", str_replace(".", "", $desconto));
    $Usuario_id = $_SESSION['id'];
    $Cliente_id = $_POST['cliente'];

    if (!($valorTotal1 != null && $desconto1 != null)) {
        if (!($Usuario_id != null && $Cliente_id != null)) {
            header("location: vendas.php?error=Formulário Vazio! Tente novamente!");
            die();
        } else {

            $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

            // Criacao de Venda
            $sql = "INSERT INTO venda (valorTotal,desconto,Usuario_id,Cliente_id) 
             VALUES ('{$valorTotal1}','{$desconto1}' ,'{$Usuario_id}', '{$Cliente_id}') ";

            mysqli_query($conexao, $sql);

            // Obter o ultimo ID
            $sqlID = "SELECT LAST_INSERT_ID()";
            $ID = mysqli_query($conexao, $sqlID);

            // Obter os dados dos Itens das Venda em Array
            $idProduto = $_POST['Produto_id'];
            $quantV = $_POST['quantV'];
            $valor = $_POST['valor'];

            // Obter o Ultimo ID do formato Mysql para a Variavel
            $idDaVendaCriada = mysqli_fetch_array($ID)['LAST_INSERT_ID()'];

            // Criacao de Itens de Venda
            for ($i = 0; $i < count($idProduto); $i++) {
                $valorTotalItensVenda = $valor[$i] * $quantV[$i];
                $sql1 = "INSERT INTO itensvenda (Venda_id,Produto_id,quantidadeVendida,valorTotal) 
            VALUES ('{$idDaVendaCriada}','{$idProduto[$i]}', '{$quantV[$i]}','{$valorTotalItensVenda}') ";
                mysqli_query($conexao, $sql1);

                $sql2 = "SELECT quantidade FROM produto WHERE id = '{$idProduto[$i]}' ";
                $quantidade = mysqli_fetch_array(mysqli_query($conexao, $sql2))["quantidade"];

                $quantNova = $quantidade - $quantV[$i];
                $sql3 = "UPDATE produto SET quantidade = '$quantNova' where id = '$idProduto[$i]' ";
                mysqli_query($conexao, $sql3);
            }

            mysqli_close($conexao);

            $mensagem = "Registro salvo com sucesso.";
        }
    }
}
require_once("../menu.php");

?>

<!doctype html>
<html lang="pt-br">

<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="../Admin/venda.js"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <style>
        .pt-5,
        .py-5 {
            padding-top: 0rem !important;
        }

        .teste {
            background-image: url("../img/textura2.jpg");
        }

        .btn-personalizado {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</head>

<body class="teste">
    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="../img/dpbrasillogo.png" alt="" width="auto" height="auto">
            <h2>Fechar Venda</h2>
        </div>
        <?php if (isset($mensagem)) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $mensagem; ?>
        </div>
        <?php } ?>
        <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_GET['error']; ?>
        </div>
        <?php } ?>
        <form name="form" method="POST" action="vendas.php" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Resumo: </span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">TOTAL: </h6>
                            </div>
                            <input type="hidden" id="resumoSoma" name="resumoSoma">
                            <span id="resumoSomaSpan" class="text-muted">
                                0,00
                            </span>
                        </li>
                        <!-- Isso aqui serve para se for aplicado algum desconto -->
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="input-group text-right">
                                <div class="input-group-prepend">
                                    <div class="input-group-text font-weight-bold text-success">Desconto R$</div>
                                </div>
                                <input type="text" class="form-control text-right" name="desconto" placeholder="0,00" id="desconto">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-personalizado" id="btnAplicarDesconto"><i class="fas fa-check"></i></button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total da Venda: </span>
                            <strong>
                                <div id="resumoValorTotal">0,00</div>
                            </strong>
                        </li>
                    </ul>
                    <div class="input-group">
                        <button class="btn btn-success btn-lg btn-block" style="margin-bottom: 50px;" name="finalizar" id="finalizar" value="finalizar" type="submit"><i class="fas fa-arrow-circle-right"></i><b> Finalizar Venda</b></button>
                    </div>
                </div>
                <div class="col-md-8 order-md-1">

                    <h4 class="mb-3">Seleciona Cliente</h4>
                    <select class="js-example-basic-single js-states form-control" name="cliente" style="width: 100%" required>
                        <?php
                        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                        $sql = "select id,nome_completo from cliente ";
                        $cliente = mysqli_query($conexao, $sql);
                        mysqli_close($conexao); ?>
                        <option disabled="disabled" selected>Escolher...</option>
                        <?php
                        while ($data = mysqli_fetch_array($cliente)) { ?>
                        <option value="<?= $data['id'] ?> "><?= $data['nome_completo']  ?></option>
                        <?php  }    ?>
                    </select>
                    <hr class="mb-4">
                    <h4 class="mb-3">Seleciona Produtos</h4>

                    <select class="js-example-basic-single js-states form-control" name="Produto_id" id="Produto_id" style="width: 100%" required>
                        <?php
                        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                        $sql = "select * from produto ";
                        $produto = mysqli_query($conexao, $sql);
                        mysqli_close($conexao); ?>
                        <option disabled="disabled" selected>Escolher...</option>
                        <?php
                        while ($data = mysqli_fetch_array($produto)) { ?>
                        <option value="<?= $data['id'] ?> "><?= $data['nome']  ?></option>
                        <?php  }    ?>
                    </select>
                    <div class="row">
                        <div class="col-6">
                            <label>Quantidade Estoque</label>
                            <input disabled type="text" class="form-control" id="quantidade" name="quantidade">
                        </div>
                        <div class="col-6">
                            <label>Preço</label>
                            <input disabled type="number" class="form-control" id="preco" name="preco">
                        </div>
                    </div>
                    <label>Quantidade Vendida</label>
                    <input type="text" class="form-control input-sm" id="quantV" name="quantV">
                    <br>
                    <button class="btn btn-warning btn-lg btn-block" type="button" id="adicionarProdutos"><i class="far fa-plus-square"></i> Adicionar Produto</button>
                    <hr class="mb-4">
                    <h4 class="mb-3">Lista de Produtos</h4>
                    <div class="row">
                        <div class="col">
                            <?php
                            mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                            ?>
                            <table id="tabela" class="table table-striped table-bordered table-hover table-sm">
                                <thead style="background-color: white;">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Produto</th>
                                        <th scope="col">Quantidade</th>
                                        <th scope="col">Preço Un.</th>
                                        <th scope="col">Preço Total</th>
                                        <th scope="col">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Conteúdo -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
                var forms = document.getElementsByClassName('needs-validation');
                // Faz um loop neles e evita o envio
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        $('#desconto').mask('#.##0,00', {
            reverse: true
        });
    </script>

</body>

</html>