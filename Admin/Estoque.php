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
    $quantidadeAtualizar = $_POST['quantidadeAtualizar'];


    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

    $sql = "update produto
    set nome     = '{$nomeAtualizar}',
        status    = '{$statusAtualizar}',
        codigo = '{$codigo}',
        valor_venda = '{$valorvenda}',
        Categoria_id = '{$categoria}',
        Marca_id = '{$marca}',
        medida_id = '{$medida}',
        quantidade = '{$quantidadeAtualizar}'
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
                    
                    <form action="Estoque.php" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Pesquisar por Nome">
                            <button class="btn btn-primary" type="submit" name="pesquisar"><i class="fas fa-search"></i><b> Pesquisar</b></button>
                        </div>
                    </form>
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
                                        <button class="btn btn-warning btn-xs mr-1" style="height: 46px; width: auto;" type="button" data-toggle="modal" data-target="#modalExemplo<?= $data['id'] ?>"><i class="far fa-edit"></i></button>
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
                                                        <form action="Estoque.php" method="post">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                                            <button type="submit" class="btn btn-danger" name="excluir">Excluir</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                                <?php if ($data['status'] == 1) { ?>

                                                                    <div class="form-group"><label class="control-label" style="width: 200px !important;">Status</label>
                                                                        <div class="input-group" style="width: 200px !important;">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">
                                                                                    <input type="checkbox" name="statusAtualizar" value="1" onclick="teste(this, <?= $data['id'] ?>);" checked>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-control"><strong class="text-success" id="labelstatus<?= $data['id'] ?>">Ativo</strong></div>
                                                                        </div>
                                                                    </div>
                                                                <?php   } else {

                                                                ?>
                                                                    <div class="form-group"><label class="control-label" style="width: 200px !important;">Status</label>
                                                                        <div class="input-group" style="width: 200px !important;">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">
                                                                                    <input type="checkbox" name="statusAtualizar" value="0" onclick="teste(this, <?= $data['id'] ?>);">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-control"><strong class="text-danger" id="labelstatus<?= $data['id'] ?>">Inativo</strong></div>
                                                                        </div>
                                                                    </div>

                                                                <?php  } ?> <br>
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
                                                                <input class="form-control" id="inputQuantidade" name="quantidadeAtualizar" style="width: auto;" value="<?= $data['quantidade']  ?>">

                                                                <label for="inputUnidadedeMedida">Unidade de Medida</label>
                                                                <select id="inputUnidadeMedida" class="form-control" name="medida" style="width: auto;">
                                                                    <?php

                                                                    $sql = "select * from medida ";
                                                                    $categorias = mysqli_query($conexao, $sql);

                                                                    while ($data = mysqli_fetch_array($categorias)) { ?>

                                                                        <option value="<?= $data['id']  ?> "><?= $data['nome']  ?></option>
                                                                    <?php  }    ?>
                                                                </select>
                                                                <br>
                                                                <div class="modal-footer" style="display: block !important;">
                                                                    <button type="submit" class="btn btn-success" name="atualizar">Atualizar</button>
                                                                </div>
                                                            </div>
                                                        </center>
                                                    </form>
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
        </div>

    </center>
    <br>
    <center>
        <div class="btn-group" role="group" aria-label="Exemplo básico">
            <button type="button" class="btn btn-secondary">Anterior</button>
            <button type="button" class="btn btn-secondary">Próximo</button>
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