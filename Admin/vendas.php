<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");
require_once("../menu.php");
?>

<!doctype html>
<html lang="pt-br">

<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <style>
        .pt-5,
        .py-5 {
            padding-top: 0rem !important;
        }

        .teste {
            background-image: url("../img/textura2.jpg");
        }
    </style>
</head>

<body class="teste">
    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="../img/dpbrasillogo.png" alt="" width="auto" height="auto">
            <h2>Fechar Venda</h2>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Seu carrinho</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Nome do produto</h6>
                            <small class="text-muted">Breve descrição</small>
                        </div>
                        <!--                         
                        <?php
                        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                        $sql = "select id,valor_venda from produto ";
                        $produto = mysqli_query($conexao, $sql);
                        ?>
                        <span class="text-muted" value="<?= $data['id'] ?> "><?= $data['valor_venda']  ?>R$</span>
                        <?php
                        mysqli_close($conexao);
                        ?> -->
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Segundo produto</h6>
                            <small class="text-muted">Breve descrição</small>
                        </div>
                        <span class="text-muted">R$8</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Terceiro item</h6>
                            <small class="text-muted">Breve descrição</small>
                        </div>
                        <span class="text-muted">R$5</span>
                    </li>
                    <!-- Isso aqui serve para se for aplicado algum desconto -->
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Código de promoção</h6>
                            <small>CODIGOEXEMEPLO</small>
                        </div>
                        <span class="text-success">-R$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total da Venda</span>
                        <strong>R$20</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Seleciona Cliente</h4>
                <form name="form" method="POST" action="vendas.php">
                    <select class="js-example-basic-single js-states form-control" name="cliente" style="width: 100%">
                        <?php
                        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                        $sql = "select id,nome_completo from cliente ";
                        $cliente = mysqli_query($conexao, $sql);
                        mysqli_close($conexao); ?>
                        <option value="" disabled="disabled" selected>Escolher...</option>
                        <?php
                        while ($data = mysqli_fetch_array($cliente)) { ?>
                        <option value="<?= $data['id'] ?> "><?= $data['nome_completo']  ?></option>
                        <?php  }    ?>
                    </select>
                    <br>
                    <br>
                    <button class="btn btn-primary btn-lg btn-block" type="submit" id="adicionarCliente">Adicionar Cliente</button>
                </form>
                <hr class="mb-4">
                <h4 class="mb-3">Seleciona Produtos</h4>
                <form name="form" method="POST" action="vendas.php" class="needs-validation" novalidate>
                    <select class="js-example-basic-single js-states form-control" name="produto" style="width: 100%" required>
                        <?php
                        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                        $sql = "select id,nome,quantidade from produto ";
                        $produto = mysqli_query($conexao, $sql);
                        mysqli_close($conexao); ?>
                        <option value="" disabled="disabled" selected>Escolher...</option>
                        <?php
                        while ($data = mysqli_fetch_array($produto)) { ?>
                        <option value="<?= $data['id'] ?> "><?= $data['nome']  ?></option>
                        <?php  }    ?>
                    </select>
                    <label>Quantidade Estoque</label>
                    <input readonly="" type="text" class="form-control input-sm" id="quantidade" name="quantidade">
                    <label>Preço</label>
                    <input readonly="" type="text" class="form-control input-sm" id="preco" name="preco">
                    <label>Quantidade Vendida</label>
                    <input type="text" class="form-control input-sm" id="quantV" name="quantV" required>
                    <br>
                    <button class="btn btn-warning btn-lg btn-block" type="submit" id="adicionarProdutos">Adicionar Produto</button>
                </form>

                <hr class="mb-4">

                <form class="needs-validation" novalidate>
                    <h4 class="mb-3">Pagamento</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="avista" name="dinheiro" type="radio" class="custom-control-input" checked required>
                            <label class="custom-control-label" for="avista">Dinheiro (À Vista)</label>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="row">

                        <!-- Mostra o total da compra -->
                        <label for="cc-nome">Total da Venda</label>
                        <input type="text" class="form-control" id="cc-nome" placeholder="Total da Venda" disabled>

                    </div>
                    <div class="row">

                        <!-- Colocar valor de desconto-->
                        <label for="cc-nome">Desconto</label>
                        <input type="text" class="form-control" id="cc-nome" placeholder="Desconto" >

                    </div>
                    <div class="row">

                        <!-- Digita o valor que o cliente pagou -->
                        <label for="cc-nome">Valor Recebido</label>
                        <input type="text" class="form-control" id="cc-nome" placeholder="Valor Recebido do Cliente" required>

                    </div>
                    <div class="row">

                        <!--Mostra o valor que falta para receber do cliente -->
                        <label for="cc-nome">Saldo a Receber</label>
                        <input type="text" class="form-control" id="cc-nome" placeholder="Saldo a Receber" required>

                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-success btn-lg btn-block" type="submit"><i class="fas fa-arrow-circle-right"></i><b> Finalizar Venda</b></button>
                </form>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        (function() {
            'use strict';

            window.addEventListener('load', function() {
                // Selecione todos os campos que nós queremos aplicar estilos Bootstrap de validação customizados.
                var forms = document.getElementsByClassName('needs-validation');

                // Faz um loop neles e previne envio
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
    </script>

</body>

</html>