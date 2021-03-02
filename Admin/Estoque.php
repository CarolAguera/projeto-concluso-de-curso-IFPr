<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");
require_once("../menu.php");

if (isset($_POST['excluir'])) {
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
    $sql = "delete from produto where id = " . $_POST['id'];
    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
}
if (isset($_POST['atualizar'])) {
    $idAtualizar = $_POST['idAtualizar'];
    $nomeAtualizar = $_POST['nomeAtualizar'];
    if (isset($_POST['statusAtualizar'])) {
        $statusAtualizar = 1;
    } else {
        $statusAtualizar = 0;
    }

    $codigo = $_POST['codigo'];
    $valorvenda = $_POST['valorvenda'];
    $categoria = $_POST['categoria'];
    $marca = $_POST['marca'];
    $medida = $_POST['medida'];
    $quantidade = $_POST['quantidade'];


    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

    $sql = "update produto
    set nome     = '{$nomeAtualizar}',
        status    = '{$statusAtualizar}',
        codigo = '{$codigo}',
        valor_venda = '{$valorvenda}',
        Categoria_id = '{$categoria}',
        Marca_id = '{$marca}',
        medida_id = '{$medida}',
        quantidade = '{$quantidade}'
    where id       = {$idAtualizar}";

    mysqli_query($conexao, $sql);

    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Estoque</title>
    <style>
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

<body>

    <br>
    <center>
        <div class="container" style="margin-top: 30px">
            <div id="top" class="row">
                <div class="col-sm-3">
                    <h2>Estoque</h2>
                </div>
                <div class="col-sm-6">
                    <?php if (isset($mensagem)) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $mensagem; ?>
                        </div>
                    <?php } ?>

                    <div class="input-group">
                        <input class="form-control" placeholder="Pesquisar Itens">
                        <span class="input-group-btn">
                            <button class="btn btn-success" style="padding: 10px !important; margin-left: 10px;" type="submit" style="margin-left:30px;">
                                <i class="fas fa-search"></i>
                            </button>
                        </span>
                    </div>

                </div>
                <div class="col-sm-3">
                    <a href="Produto.php" class="btn btn-primary " style="padding: 11px !important;">
                        <i class="far fa-plus-square"></i>
                    </a>
                </div>
            </div>
            <br>
            <br>
            <div class="row container bg-dark">

                <div class="table-responsive col-md-12">
                    <table class="table table-striped">
                        <thead style="color: white;">
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Nome</th>
                                <th>Código</th>
                                <th>Valor Venda</th>
                                <th>Categoria</th>
                                <th>Marca</th>
                                <th>Unidade de Medida</th>
                                <th>Quantidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody style="color: white;">
                            <?php
                            $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                            $sqlEstoque = "select * from produto ";
                            $estoque = mysqli_query($conexao, $sqlEstoque);
                            while ($data = mysqli_fetch_array($estoque)) { ?>

                                <?php $sqlCategoria = "select * from categoria where id = '{$data['Categoria_id']}' ";
                                $categoria = mysqli_query($conexao, $sqlCategoria);
                                $buscaCategoria = mysqli_fetch_array($categoria);

                                $sqlMarca = "select * from marca where id = '{$data['Marca_id']}' ";
                                $marca = mysqli_query($conexao, $sqlMarca);
                                $buscaMarca = mysqli_fetch_array($marca);

                                $sqlMedida = "select * from medida where id = '{$data['Medida_id']}' ";
                                $medida = mysqli_query($conexao, $sqlMedida);
                                $buscaMedida = mysqli_fetch_array($medida);

                                if ($data['status'] == 1) {
                                    $statusProduto = 'Ativo';
                                } else {
                                    $statusProduto = 'Inativo';
                                }
                                ?>

                                <tr>
                                    <td><?= $data['id']  ?></td>
                                    <td><?= $statusProduto  ?></td>
                                    <td><?= $data['nome']  ?></td>
                                    <td><?= $data['codigo']  ?></td>
                                    <td><?= $data['valor_venda']  ?></td>
                                    <td> <?= $buscaCategoria['nome']  ?></td>
                                    <td><?= $buscaMarca['nome']  ?></td>
                                    <td><?= $buscaMedida['nome']  ?></td>
                                    <td><?= $data['quantidade']  ?></td>

                                    <td class="actions d-flex" style="width: 120px;">
                                        <button class="btn btn-warning btn-xs mr-1" style="width:53px; height:41px" type="button" data-toggle="modal" data-target="#modalExemplo<?= $data['id'] ?>"><img src="../img/editar.png" alt="" srcset="" width="27px" height="27px"></button>

                                        <form action="Estoque.php" method="post" onsubmit="return confirm('Confirma exclusão?')">
                                            <input type="hidden" name="id" value="<?= $data['id']  ?> ">
                                            <button class="btn btn-danger btn-xs" type="submit" name="excluir"><img src="../img/excluir.png" alt="" srcset="" width="27px" height="27px"></button>
                                        </form>

                                        <div class="modal fade " id="modalExemplo<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content bg-dark">
                                                    <form action="Estoque.php" name="form" method="post">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Alterar Produto</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <center>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="idAtualizar" value="<?= $data['id'] ?>">
                                                                <?php

                                                                if ($data['status'] == 1) {
                                                                    $checagem = 'checked';
                                                                } else {
                                                                    $checagem = '';
                                                                }

                                                                ?>
                                                                <label for="fstatus">Status: </label>
                                                                <input type="checkbox" name="statusAtualizar" id="status" <?= $checagem ?>>
                                                                <br>
                                                                <label for="fname">Nome: </label>
                                                                <input name="nomeAtualizar" class="form-control" style="width: auto;" value="<?= $data['nome']  ?> ">
                                                                
                                                                <label for="fcodigo">Código: </label>
                                                                <input name="codigo" class="form-control" style="width: auto;" value="<?= $data['codigo']  ?> ">
                                                                <label for="fvalorvenda">Valor Venda: </label>
                                                                <input name="valorvenda" class="form-control" style="width: auto;" value="<?= $data['valor_venda']  ?> ">
                                                                <label for="inputCategoria">Categoria: </label>
                                                                <select id="inputCategoria" class="form-control" name="categoria" style="width: auto;">
                                                                    <?php

                                                                    $sql = "select * from categoria ";
                                                                    $categorias = mysqli_query($conexao, $sql);

                                                                    while ($data = mysqli_fetch_array($categorias)) { ?>

                                                                        <option value="<?= $data['id']  ?> "><?= $data['nome']  ?></option>
                                                                    <?php  }    ?>
                                                                </select>
                                                                <label for="inputMarca">Marca: </label>
                                                                <select id="inputMarca" class="form-control" name="marca" style="width: auto;">
                                                                    <?php

                                                                    $sql = "select * from marca ";
                                                                    $marcas = mysqli_query($conexao, $sql);

                                                                    while ($data = mysqli_fetch_array($marcas)) { ?>

                                                                        <option value="<?= $data['id']  ?> "><?= $data['nome']  ?></option>
                                                                    <?php  }    ?>
                                                                </select>
                                                                <label for="inputQuantidade">Quantidade</label>
                                                                <input type="text" class="form-control" id="inputQuantidade" name="quantidade" style="width: auto;">

                                                                <label for="inputUnidadedeMedida">Unidade de Medida</label>
                                                                <select id="inputUnidadeMedida" class="form-control" name="medida" style="width: auto;">
                                                                    <?php

                                                                    $sql = "select * from medida ";
                                                                    $categorias = mysqli_query($conexao, $sql);

                                                                    while ($data = mysqli_fetch_array($categorias)) { ?>

                                                                        <option value="<?= $data['id']  ?> "><?= $data['nome']  ?></option>
                                                                    <?php  }    ?>
                                                                </select>
                                                                <label for="inputQuantidade">Quantidade</label>
                                                                <input type="text" class="form-control" id="inputQuantidade" name="quantidade" style="width:auto;">
                                                                <br>

                                                                <div class="modal-footer" style="display: block !important;">
                                                                    <button type="submit" class="btn btn-success" name="atualizar">Atualizar</button>
                                                                </div>
                                                            </div>
                                                        </center>
                                                    </form>
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
        </div>

    </center>
    <br>
    <center>
        <div class="btn-group" role="group" aria-label="Exemplo básico">
            <button type="button" class="btn btn-secondary">Anterior</button>
            <button type="button" class="btn btn-secondary">Próximo</button>
        </div>
    </center>

</body>

</html>