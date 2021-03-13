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
                    <span class="text-muted">Resumo: </span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">TOTAL: </h6>
                        </div>
                        <span class="text-muted">R$60</span>
                    </li>
                    <!-- Isso aqui serve para se for aplicado algum desconto -->
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Desconto: </h6>
                        </div>
                        <span class="text-success">-R$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total da Venda: </span>
                        <strong>R$55</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <form name="form" method="POST" action="vendas.php" class="needs-validation" novalidate>
                    <h4 class="mb-3">Seleciona Cliente</h4>
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
                    <hr class="mb-4">
                    <h4 class="mb-3">Seleciona Produtos</h4>

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
                    <div class="row">
                        <div class="col-6">
                            <label>Quantidade Estoque</label>
                            <input readonly="" type="text" class="form-control" id="quantidade" name="quantidade">
                        </div>
                        <div class="col-6">
                            <label>Preço</label>
                            <input readonly="" type="text" class="form-control" id="preco" name="preco">
                        </div>
                    </div>
                    <label>Quantidade Vendida</label>
                    <input type="text" class="form-control input-sm" id="quantV" name="quantV" required>
                    <br>
                    <button class="btn btn-warning btn-lg btn-block" type="submit" id="adicionarProdutos">Adicionar Produto</button>
                </form>

                <hr class="mb-4">
                <h4 class="mb-3">Pagamento</h4>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="avista" name="dinheiro" type="radio" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="avista">Dinheiro (À Vista)</label>
                    </div>
                </div>
                <hr class="mb-4">
                <h4 class="mb-3">Lista de Produtos</h4>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-striped">
                            <thead style="background-color: white;">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Preço Un.</th>
                                    <th scope="col">Preço Total</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><b>1</b></th>
                                    <td>Cimento</td>
                                    <td>2</td>
                                    <td>30,00</td>
                                    <td>60,00</td>
                                    <td class="actions d-flex">
                                        <button class="btn btn-danger btn-xs" style="height: 46px; width: auto; " type="button" data-toggle="modal" data-target="#ExemploModalCentralizado<?= $data['id'] ?>"><i class="far fa-trash-alt" style="color: black;"></i></button>
                                        <div class="modal fade" id="ExemploModalCentralizado<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="TituloModalCentralizado">Confirma a Exclusão ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="vendas.php" method="post">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                                            <button type="submit" class="btn btn-danger" name="excluir">Excluir</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <form action="vendas.php" method="post">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Desconto R$ </div>
                                </div>
                                <input type="text" class="form-control" name="desconto" id="desconto" placeholder="Desconto">
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><b>TOTAL R$ </b></div>
                            </div>
                            <input type="text" class="form-control" name="desconto" id="total" disabled>
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-success btn-lg btn-block" style="margin-bottom: 50px;" type="submit"><i class="fas fa-arrow-circle-right"></i><b> Finalizar Venda</b></button>

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