<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");
require_once("../menu.php");
if (isset($_POST['salvar'])) {

    //Pega os valores dos inputs do formulário
    $nome = $_POST['nome'];
    if (isset($_POST['status'])) {
        $statusAtualizar = 1;
    } else {
        $statusAtualizar = 0;
    }



    //Iniciar a conexão com o BD
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

    //Gerar a SQL
    $sql = "insert into categoria (nome, status) 
        values ('{$nome}', '{$statusAtualizar}') ";

    //Executar a SQL
    mysqli_query($conexao, $sql);

    //Fechar a conexão com o BD
    mysqli_close($conexao);

    //Mensagem de sucesso
    $mensagem = "Registro salvo com sucesso.";
}
if (isset($_POST['excluir'])) {
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
    $sql = "delete from categoria where id = " . $_POST['id'];
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

    $sql = "update categoria
    set nome     = '{$nomeAtualizar}',
        status    = '{$statusAtualizar}'
    where id       = {$idAtualizar}";

    mysqli_query($conexao, $sql);

    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Categoria</title>
</head>

<body>
    <h1 style="text-align: center; margin-top: 30px;">Categorias</h1>
    <center class="container">
        <?php if (isset($mensagem)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $mensagem; ?>
            </div>
        <?php } ?>

        <form name="form" method="POST" action="Categoria.php" class="needs-validation" novalidate>
            <center>
                <input type="text" id="nome" name="nome" class="form-control" style="width: auto; margin-top: 30px;" placeholder="Digite a nova categoria" required>
                <div class="invalid-feedback">
                    Você deve colocar o NOME da nova Categoria!
                </div>
                <br>
                <div class="form-group "><label class="control-label" style="width: 200px !important;" for="status">Status</label><input type="hidden" name="status" value="0">
                    <div class="input-group" style="width: 200px !important;">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" name="status" value="1" id="status" onclick="teste(this);" checked>
                            </div>
                        </div>
                        <div class="form-control"><strong class="text-success" id="statuscadastrar">Ativo</strong></div>
                    </div>
                    <span class="help-block"></span>
                </div>
            </center>
            <button type="submit" id="salvar" name="salvar" class="btn btn-success" style="margin-top: 30px;">Cadastrar </button>
        </form>
    </center>
    <center>
        <div class="row container bg-white" style="width: 450px; margin-top: 30px;">

          
                <table class=" table-striped table table-hover container">
                    <thead style="color: black;">
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody style="color: black;">
                        <?php
                        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                        $sql = "select * from categoria ";
                        $categorias = mysqli_query($conexao, $sql);
                        mysqli_close($conexao);
                        while ($data = mysqli_fetch_array($categorias)) {
                            if ($data['status'] == 1) {
                                $statusProduto = 'Ativo';
                            } else {
                                $statusProduto = 'Inativo';
                            } ?>

                            <tr>
                                <td><?= $data['id']  ?></td>
                                <td><?= $statusProduto  ?></td>
                                <td><?= $data['nome']  ?></td>
                                <td class="actions d-flex" style="margin:0px;" style="width: auto;">
                                    <!-- <center> -->
                                        <form action="Categoria.php" method="post" class="needs-validation" novalidate>
                                            <!-- <button class="btn btn-warning btn-xs" type="button" style="margin-right: 4px;" data-toggle="modal" data-target="#ExemploModalCentralizado<?= $data['id'] ?>"><img src="../img/editar.png" alt="" srcset="" width="27px" height="27px"><?php ?></button> -->
                                            <button class="btn btn-warning btn-xs"  type="button" style="margin-right: 4px; height: 46px; width: auto; " data-toggle="modal" data-target="#ExemploModalCentralizado1<?= $data['id'] ?>"><i class="far fa-edit"></i></button>

                                            <div class="modal fade" id="ExemploModalCentralizado1<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="TituloModalCentralizado">Alterar Categoria</h5>
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
                                                                Você deve colocar o NOME da nova Categoria!
                                                            </div>
                                                            <br>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                            <button type="submit" class="btn btn-success" name="atualizar">Atualizar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                               

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

                        <?php }    ?>


                    </tbody>
                </table>
        
        </div>
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