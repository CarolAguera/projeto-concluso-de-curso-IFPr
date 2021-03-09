<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");

if (isset($_POST['atualizar'])) {
    $idAtualizar = $_POST['idAtualizar'];
    $nome_completo = $_POST['nome_completo'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $data_admissao = $_POST['data_admissao'];
    $data_demissao = $_POST['data_demissao'];

    if (isset($_POST['status'])) {
        $statusAtualizar = 1;
    } else {
        $statusAtualizar = 0;
    }

    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

    $sql = "update usuario
    set nome_completo     = '{$nome_completo}',
        status    = '{$statusAtualizar}',
        email = '{$email}',
        senha = '{$senha}',
        data_nascimento = '{$data_nascimento}',
        sexo = '{$sexo}',
        data_admissao = '{$data_admissao}',
        data_demissao = '{$data_demissao}'
    where id       = {$idAtualizar}";

    mysqli_query($conexao, $sql);

    mysqli_close($conexao);


    session_unset();
    session_destroy();
    header('location: ../login.php');
    exit();
}



require_once("../menu.php");

if (isset($_POST['excluir'])) {
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
    $sql = "delete from usuario where id = " . $_POST['id'];
    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
}

?>



<head>
    <title>Gestão de Usuário</title>
    <style>
        @media only screen and (max-width: 991.98px) {
            .d-flex {
                display: block !important;

            }

            .butao {
                margin-top: 2px;
            }
        }

        .teste {
            background-image: url("../img/textura2.jpg");
        }
    </style>
</head>

<body class="teste">
    <div class="container" style="margin-top: 30px;">
        <center>
            <div class="row">
                <div class="col-sm-6">
                    <h3>Gestão de Usuários</h3>
                </div>
                <div class="col-sm-6">
                    <a href="NovoUsuario.php" type="button" class="btn btn-outline-warning">
                        <i class="far fa-plus-square"></i> Cadastrar Usuário
                    </a>
                </div>
            </div>
        </center>
        <div class="row container">
            <table class="table table-striped" style="margin-top: 20px; ">

                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Status</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody style="color: black;">
                    <?php
                    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                    $sql = "select * from usuario  ";
                    $usuarios = mysqli_query($conexao, $sql);
                    mysqli_close($conexao);
                    while ($data = mysqli_fetch_array($usuarios)) {
                        if ($data['status'] == 1) {
                            $statusUsuario = 'Ativo';
                        } else {
                            $statusUsuario = 'Inativo';
                        } ?>

                    <tr>
                        <td><?= $data['id']  ?></td>
                        <td><?= $statusUsuario  ?></td>
                        <td><?= $data['nome_completo']  ?></td>

                        <td class="actions d-flex" style="width: 100%;">
                            <center>
                                <form action="usuarios.php" name="form" method="post" class="needs-validation" novalidate>

                                    <button class="btn btn-warning btn-xs" type="button" style="margin-right: 4px; height: 46px; width: auto; " data-toggle="modal" data-target="#modalExemplo<?= $data['id'] ?>"><i class="far fa-edit"></i></button>
                                    <div class="modal fade" id="modalExemplo<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Alterar Usuário</h5>
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
                                                                    <input type="checkbox" name="status" value="1" onclick="teste(this, <?= $data['id'] ?>);" checked>
                                                                </div>
                                                            </div>
                                                            <div class="form-control"><strong class="text-success" id="labelstatus<?= $data['id'] ?>">Ativo</strong></div>
                                                        </div>
                                                    </div>
                                                    <?php   } else {

                                                            echo $data['id']; ?>
                                                    <div class="form-group"><label class="control-label" style="width: 200px !important;">Status</label>
                                                        <div class="input-group" style="width: 200px !important;">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" name="status" value="0" onclick="teste(this, <?= $data['id'] ?>);">
                                                                </div>
                                                            </div>
                                                            <div class="form-control"><strong class="text-danger" id="labelstatus<?= $data['id'] ?>">Inativo</strong></div>
                                                        </div>
                                                    </div>

                                                    <?php  } ?>

                                                    <label>Nome: </label>
                                                    <input name="nome_completo" class="form-control" style="width: auto !important;" value="<?= $data['nome_completo']  ?> " required>

                                                    <label>Email</label>
                                                    <input type="text" class="form-control" style="width: auto !important;" value="<?= $data['email']  ?>" name="email" placeholder="Digite a Email" required>


                                                    <label>Senha</label>
                                                    <input type="password" class="form-control" name="senha" style="width: auto !important;" value="<?= $data['senha'] ?>" placeholder="Digite a Senha" required>


                                                    <label>Data de Nascimento</label>
                                                    <input type="date" class="form-control" name="data_nascimento" style="width: auto !important;" value="<?= $data['data_nascimento']  ?>" required>

                                                    <label>Data de Admissão</label>
                                                    <input type="date" class="form-control" name="data_admissao" style="width: auto !important;" value="<?= $data['data_admissao']  ?>" disabled>
                                                    <label>Data de Demissão</label>
                                                    <input type="date" class="form-control" name="data_demissao" style="width: auto !important;" value="<?= $data['data_demissao']  ?>">
                                                    <label>Sexo</label>
                                                    <select name="sexo" class="form-control" style="width: auto !important;" required>
                                                        <option value="" disabled="disabled">Escolher...</option>

                                                        <?php if ($data['sexo'] == 1) { ?>
                                                        <option selected value="1">Masculino</option>
                                                        <option value="2">Feminino</option>
                                                        <?php } else { ?>
                                                        <option value="1">Masculino</option>
                                                        <option selected value="2">Feminino</option>
                                                        <?php } ?>

                                                    </select>

                                                </div>
                                                <div class="modal-footer" style="display: block !important;">
                                                    <button type="submit" class="btn btn-success" name="atualizar">Atualizar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </center>
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
                                            <form action="usuarios.php" method="post">
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
        </div>
    </div>

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
    <?php
    require_once("rodape.php");
    ?>
</body>

</html>