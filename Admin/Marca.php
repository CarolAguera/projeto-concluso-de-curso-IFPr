<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../dependencias.php");
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
    $sql = "insert into marca (nome, status) 
    values ('{$nome}', '{$status}') ";


    //Executar a SQL
    mysqli_query($conexao, $sql);

    //Fechar a conexão com o BD
    mysqli_close($conexao);
}
if (isset($_POST['excluir'])) {
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
    $sql = "delete from marca where id = " . $_POST['id'];
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

    $sql = "update marca
    set nome     = '{$nomeAtualizar}',
        status    = '{$statusAtualizar}'
    where id       = {$idAtualizar}";

    mysqli_query($conexao, $sql);

    mysqli_close($conexao);
}
?>



<head>
    <title>Marca</title>
</head>

<body>
    <h1 style="text-align: center; margin-top: 30px;">Marcas</h1>
    <center class="container">
        <form name="form" method="POST" action="Marca.php" class="needs-validation" novalidate>
            <input type="text" class="form-control" name="nome" style="width: auto; margin-top: 30px;" placeholder="Digite a nova Marca" required>
            <div class="invalid-feedback">
                Você deve colocar o NOME da nova Marca!
            </div>
            <br>
            <div class="form-group "><label class="control-label" style="width: 200px !important;" for="status">Status</label><input type="hidden" name="status" value="0">
                <div class="input-group" style="width: 200px !important;">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="checkbox" name="status" value="1" id="status" onclick="teste1(this);" checked>
                        </div>
                    </div>
                    <div class="form-control"><strong class="text-success" id="statuscadastrar">Ativo</strong></div>
                </div>
                <span class="help-block"></span>
            </div>
            <button type="submit" class="btn btn-success" style="margin-top: 30px;" name="salvar">Cadastrar</button>
        </form>
        <table class="table table-hover" style="margin-top: 40px; width: auto;">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Status</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody style="color: black;">
                <?php
                $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                $sql = "select * from marca ";
                $marcas = mysqli_query($conexao, $sql);
                mysqli_close($conexao);
                while ($data = mysqli_fetch_array($marcas)) {
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

                            <form action="Marca.php" name="form" method="post" class="needs-validation" novalidate>

                            <button class="btn btn-warning btn-xs"  type="button" style="margin-right: 4px; height: 46px; width: auto; " data-toggle="modal" data-target="#modalExemplo<?= $data['id'] ?>"><i class="far fa-edit"></i></button>


                                <center>
                                    <div class="modal fade" id="modalExemplo<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" >
                                                    <h5 class="modal-title" id="exampleModalLabel">Alterar Marca</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
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

                                                    <?php  } ?>
                                                    <label for="fname">Nome: </label>
                                                    <input name="nomeAtualizar" class="form-control" style="width: 300px !important;" value="<?= $data['nome']  ?> " required>
                                                    <div class="invalid-feedback">
                                                        Você deve colocar o NOME da nova Marca!
                                                    </div>
                                                    <br>

                                                    <div class="modal-footer" style="display: block !important;">
                                                        <button type="submit" class="btn btn-success" name="atualizar">Atualizar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </center>
                            </form>

                            <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#ExemploModalCentralizado1<?= $data['id'] ?>"><i class="far fa-trash-alt" style="color: black;"></i></button>
                            <div class="modal fade" id="ExemploModalCentralizado1<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="TituloModalCentralizado">Confirma a Exclusão ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="Marca.php" method="post">
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

                <?php  }    ?>
            </tbody>
        </table>
    </center>
    <script>
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

        function teste1(tag) {
            let labelStatus = document.getElementById('statuscadastrar');
            if (tag.value == '1') {
                tag.value = 0;
                labelStatus.className = "text-danger";
                labelStatus.innerHTML = "Inativo";

            } else {
                tag.value = 1;
                labelStatus.className = "text-success";
                labelStatus.innerHTML = "Ativo";
            }
            console.log(tag.value);
        }

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