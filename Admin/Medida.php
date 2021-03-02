<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../verificaSessao.php");
require_once("../menu.php");

if (isset($_POST['salvar'])) {

    //Pega os valores dos inputs do formulário
    $nome = $_POST['nome'];
    if (isset($_POST['status'])) {
        $status = 1;
    } else {
        $status = 0;
    }

    //Iniciar a conexão com o BD
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

    //Gerar a SQL
    $sql = "insert into medida (nome, status) 
    values ('{$nome}', '{$status}') ";


    //Executar a SQL
    mysqli_query($conexao, $sql);

    //Fechar a conexão com o BD
    mysqli_close($conexao);
}
if (isset($_POST['excluir'])) {
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
    $sql = "delete from medida where id = " . $_POST['id'];
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

    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

    $sql = "update medida
    set nome     = '{$nomeAtualizar}',
        status    = '{$statusAtualizar}'
    where id       = {$idAtualizar}";

    mysqli_query($conexao, $sql);

    mysqli_close($conexao);
}
?>



<head>
    <title>Medida</title>
</head>

<body>
    <h1 style="text-align: center; margin-top: 30px;">Unidade de Medidas</h1>
    <center class="container">
        <form name="form" method="POST" action="Medida.php">
            <input type="text" class="form-control" name="nome" style="width: auto; margin-top: 30px;" placeholder="Digite a nova medida">
            <br>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" onchange="teste(this);" checked id="customCheck1" value="1" name="status">
                <label class="custom-control-label" for="customCheck1" id="labelstatus">Status</label>
            </div>
            <button type="submit" class="btn btn-success" style="margin-top: 30px;" name="salvar">Cadastrar</button>
        </form>
        <table class="table table-hover" style="margin-top: 40px; width: auto;">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Status</th>
                    <th scope="col">Medida</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody style="color: black;">
                <?php
                $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                $sql = "select * from medida ";
                $medidas = mysqli_query($conexao, $sql);
                mysqli_close($conexao);
                while ($data = mysqli_fetch_array($medidas)) {
                    if ($data['status'] == 1) {
                        $statusProduto = 'Ativo';
                    } else {
                        $statusProduto = 'Inativo';
                    } ?>

                    <tr>
                        <td><?= $data['id']  ?></td>
                        <td><?= $statusProduto  ?></td>
                        <td><?= $data['nome']  ?></td>

                        <td class="actions d-flex" style="width: 120px;">
                            <center>
                                <form action="Medida.php" name="form" method="post">

                                    <button class="btn btn-warning btn-xs" type="button" style="margin-right: 4px;" data-toggle="modal" data-target="#modalExemplo<?= $data['id'] ?>"><img src="../img/editar.png" alt="" srcset="" width="27px" height="27px"></button>
                                    <div class="modal fade" id="modalExemplo<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Alterar medida</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="idAtualizar" value="<?= $data['id'] ?>">
                                                    <label for="fname">Nome: </label>
                                                    <input name="nomeAtualizar" class="form-control" style="width: 300px !important;" value="<?= $data['nome']  ?> ">
                                                    <br>
                                                    <?php

                                                    if ($data['status'] == 1) {
                                                        $checagem = 'checked';
                                                    } else {
                                                        $checagem = '';
                                                    }

                                                    ?>
                                                    <label for="fstatus">Status: </label>
                                                    <input type="checkbox" name="statusAtualizar" id="status" <?= $checagem ?>>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" name="atualizar">Atualizar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </center>
                            <form action="Medida.php" method="post" onsubmit="return confirm('Confirma exclusão?')">
                                <input type="hidden" name="id" value="<?= $data['id']  ?> ">
                                <button class="btn btn-danger btn-xs" type="submit" id="excluir" name="excluir"><img src="../img/excluir.png" alt="" srcset="" width="27px" height="27px"></button>
                            </form>
                        </td>
                    </tr>

                <?php  }    ?>
            </tbody>
        </table>
    </center>
    <script>
        function teste(tag) {
            let label = document.getElementById('labelstatus');
            if (tag.value == '1') {
                tag.value = 0;
                label.innerHTML = 'Não'
            } else {
                tag.value = 1;
                label.innerHTML = 'Sim'
            }
            console.log(tag.value);
        }
    </script>
</body>

</html>