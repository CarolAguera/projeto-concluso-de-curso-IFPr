<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");
require_once("../menu.php");

if (isset($_POST['excluir'])) {
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
    $sql1 = "SELECT Venda_id,Produto_id FROM itensvenda";
    //$sql = "delete from venda where id = " . $_POST['id'];
    //$sql2 = "DELETE FROM `itensvenda` WHERE `itensvenda`.`Venda_id` = " . $_POST['id'] . " AND `itensvenda`.`Produto_id` =" . $_POST['id'];
    $procurando = mysqli_query($conexao, $sql1);
    var_dump(mysqli_fetch_array($procurando));
    //mysqli_query($conexao, $sql2);
    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Vendas</title>
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
                    <h2>Listagem de Vendas</h2>
                </div>
                <div class="col-sm-2">
                    <?php if (isset($mensagem)) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $mensagem; ?>
                    </div>
                    <?php } ?>
                    <!-- <div class="container">
                        <form action="ListagemDeVendas.php" method="post">
                            <div class="input-group ">
                                <input type="text" class="form-control" placeholder="Pesquisar por Nome" name="nomePesquisar">
                                <button class="btn btn-primary" type="submit" name="pesquisar"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div> -->
                </div>
                <div class="col-sm-4">
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
                            <th scope="col">ID</th>
                            <th scope="col">Status</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Valor Total</th>
                            <th scope="col">Desconto</th>
                            <th scope="col">Data e Hora</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                        $sql = "select * from venda";
                        $venda = mysqli_query($conexao, $sql);

                        while ($data = mysqli_fetch_array($venda)) {

                            $sqlUsuario = "select id,nome_completo from usuario where id = '{$data['Usuario_id']}' ";
                            $usuario = mysqli_query($conexao, $sqlUsuario);
                            $buscaUsuario = mysqli_fetch_array($usuario);

                            $sqlCliente = "select id,nome_completo  from cliente where id = '{$data['Cliente_id']}' ";
                            $cliente = mysqli_query($conexao, $sqlCliente);
                            $buscaCliente = mysqli_fetch_array($cliente);

                            if ($data['status'] == 1) {
                                $statusProduto = 'Ativo';
                            } else {
                                $statusProduto = 'Inativo';
                            }
                            ?>

                        <tr>
                            <td><?= $data['id']  ?></td>
                            <td><?= $statusProduto  ?></td>
                            <td><?= $buscaUsuario['nome_completo']  ?></td>
                            <td><?= $buscaCliente['nome_completo']  ?></td>
                            <td><?= number_format($data['valorTotal'], 2, ',', '')  ?></td>
                            <td><?= number_format($data['desconto'], 2, ',', '') ?></td>
                            <?php $data_hora = strtotime($data[' data_hora']); ?>
                            <td><?= date('d/m/Y H:i:s', $data_hora) ?></td>


                            <td class="actions d-flex" style="width: 120px;">
                                <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#ExemploModalCentralizado<?= $data['id'] ?>"><i class="far fa-trash-alt" style="color: black;"></i></button>
                                <div class="modal fade" id="ExemploModalCentralizado<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" style="color: black;" id="TituloModalCentralizado">Confirma a Exclusão ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="ListagemDeVendas.php" method="post">
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

                        <?php  }

                        mysqli_close($conexao);

                        ?>


                    </tbody>
                </table>
            </div>
        </div>

    </center>
    <script>
        function teste(tag, id) {
            let labelAtivo = document.getElementById('labelstatus' + id);
            if (tag.value == '1') {
                tag.value = 0;
                labelAtivo.className = "text-danger";
                labelAtivo.innerHTML = "Inativo";

            } else {
                tag.value = 1;
                labelAtivo.className = "text-success";
                labelAtivo.innerHTML = "Ativo";
            }
            console.log(tag.value);
        }
    </script>
</body>

</html>