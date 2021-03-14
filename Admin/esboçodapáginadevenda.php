<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");
require_once("../menu.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <style>
        .pt-5,
        .py-5 {
            padding-top: 0rem !important;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="../img/dpbrasillogo.png" alt="" width="auto" height="auto">
            <h2>Venda</h2>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <form name="form" method="POST" action="vendas.php">
                    <label>Seleciona Cliente</label>
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
                    <label>Selecionar Produto</label>
                    <select class="js-example-basic-single js-states form-control" name="produto" style="width: 100%">
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
                    <input type="text" class="form-control input-sm" id="quantV" name="quantV">
                    <p></p>
                    <span class="btn btn-primary" id="adicionar">Adicionar</span>
                    <input class="btn btn-danger" type="reset" id="reset"></input>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            $('#produto').change(function() {

                $.ajax({
                    type: "POST",
                    data: "idproduto=" + $('#produto').val(),
                    //Obter dados dos produtos está em anotações -->
                    url: "../procedimentos/vendas/obterDadosProdutos.php",
                    success: function(r) {
                        dado = jQuery.parseJSON(r);


                        $('#quantidade').val(dado['quantidade']);
                        $('#preco').val(dado['preco']);

                    }
                });
            });
        });
    </script>

</body>

</html>