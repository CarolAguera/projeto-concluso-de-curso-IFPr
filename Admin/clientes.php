<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");
require_once("../menu.php");

function formataData($data)
{
    return substr($data, 8, 2) . "/" .
        substr($data, 5, 2) . "/" .
        substr($data, 0, 4);
}

if (isset($_POST['excluir'])) {
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
    $sql = "delete from cliente where id = " . $_POST['id'];
    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
}
if (isset($_POST['atualizar'])) {
    $idAtualizar = $_POST['idAtualizar'];
    $nome = $_POST['nome_completo'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $numero = $_POST['numero'];
    $local_trabalho = $_POST['local_trabalho'];
    $telefone_trabalho = $_POST['telefone_trabalho'];
    $sexo = $_POST['sexo'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone_celular = $_POST['telefone_celular'];
    $telefone_residencial = $_POST['telefone_residencial'];
    $cpf = $_POST['cpf'];
    if (isset($_POST['statusAtualizar'])) {
        $statusAtualizar = 1;
    } else {
        $statusAtualizar = 0;
    }
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

    $sql = "update cliente
    set nome_completo     = '{$nome_completo}',
        status    = '{$statusAtualizar}',
        email = '{$email}',
        data_nascimento = '{$data_nascimento}',
        sexo = '{$sexo}',
        endereco = '{$endereco}', 
        cep =  '{$cep}', 
        numero = '{$numero}',
        local_trabalho = '{$local_trabalho}', 
        telefone_trabalho = '{$telefone_trabalho}', 
        cidade = '{$cidade}',
        estado = '{$estado}',
        telefone_celular = '{$telefone_celular}',
        telefone_residencial = '{$telefone_residencial}',
        cpf = '{$cpf}'
    where id       = {$idAtualizar}";

    mysqli_query($conexao, $sql);

    mysqli_close($conexao);
}
?>



<head>
    <title>Gestão de Cliente</title>
    <style>
        @media only screen and (max-width: 991.98px) {
            .d-flex {
                display: block !important;

            }

            .butao {
                margin-top: 2px;
            }
        }
    </style>
</head>

<body>
    <h1 style="text-align: center; margin-top: 30px;">Consulta de Clientes</h1>


    <table class="table table-hover container" style="margin-top: 40px; width: 100%;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Status</th>
                <th scope="col">Cliente</th>
                <th scope="col">E-mail</th>
                <th scope="col">Data de Nascimento</th>
                <th scope="col">CPF</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody style="color: black;">
            <?php
            $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
            $sql = "select * from cliente  ";
            $clientes = mysqli_query($conexao, $sql);
            mysqli_close($conexao);
            while ($data = mysqli_fetch_array($clientes)) {
                if ($data['status'] == 1) {
                    $statuscliente = 'Ativo';
                } else {
                    $statuscliente = 'Inativo';
                } ?>

                <tr>
                    <td><?= $data['id']  ?></td>
                    <td><?= $statuscliente  ?></td>
                    <td><?= $data['nome_completo']  ?></td>
                    <td><?= $data['email']  ?></td>
                    <td><?= formataData($data['data_nascimento']) ?></td>
                    <td><?= $data['cpf']  ?></td>


                    <td class="actions d-flex" style="width: 100%;">
                        <center>
                            <form action="clientes.php" name="form" method="post" class="needs-validation" novalidate>

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
                                                <input name="nome_completo" class="form-control" value="<?= $data['nome_completo']  ?> " required>

                                                <label>Email</label>
                                                <input type="text" class="form-control" value="<?= $data['email']  ?>" name="email" placeholder="Digite a Email" required>

                                                <label>Data de Nascimento</label>
                                                <input type="date" class="form-control" name="data_nascimento" value="<?= $data['data_nascimento']  ?>" required>

                                                <label>Sexo</label>
                                                <select name="sexo" class="form-control">
                                                    <option value="" disabled="disabled">Escolher...</option>

                                                    <?php if ($data['sexo'] == 1) { ?>
                                                        <option selected value="1">Masculino</option>
                                                        <option value="2">Feminino</option>
                                                    <?php } else { ?>
                                                        <option value="1">Masculino</option>
                                                        <option selected value="2">Feminino</option>
                                                    <?php } ?>

                                                </select>

                                                <label for="inputCel">Celular</label>
                                                <input type="text" class="form-control phone-ddd-mask" name="telefone_celular" id="inputCel" value="<?= $data['telefone_celular']  ?>" required>


                                                <label for="inputTelefone">Telefone</label>
                                                <input type="text" class="form-control" id="inputTelefone  phone-ddd-mask" value="<?= $data['telefone_residencial']  ?>" name="telefone_residencial" required>


                                                <label for="inputCPF">CPF</label>
                                                <input type="cpf" class="form-control" id="inputCPF" name="cpf" value="<?= $data['cpf']  ?>" maxlength="11" required>

                                                <label for="inputCity">Cidade</label>
                                                <input type="text" class="form-control" placeholder="Digite a Cidade" value="<?= $data['cidade']  ?>" name="cidade" id="inputCity" required>

                                                <label for="inputEstado">Estado</label>
                                                <select id="inputEstado" class="form-control" name="estado">
                                                    <option value="" disabled="disabled">Escolher...</option>
                                                    <?php
                                                    $favcolor = "red";

                                                    switch ($favcolor) {
                                                        case "red":
                                                            echo "Your favorite color is red!";
                                                            break;
                                                        case "blue":
                                                            echo "Your favorite color is blue!";
                                                            break;
                                                        case "green":
                                                            echo "Your favorite color is green!";
                                                            break;
                                                        default:
                                                            echo "Your favorite color is neither red, blue, nor green!";
                                                    }
                                                    ?>
                                                    </option>
                                                </select>

                                                <label for="inputtrabalhotelefone">Telefone Trabalho</label>
                                                <input type="text" class="form-control" id="inputtrabalhotelefone" value="<?= $data['telefone_trabalho']  ?>" name="telefone_trabalho" placeholder="Digite o Telefone do seu trabalho " required>

                                                <label for="inputtrabalho">Local de Trabalho</label>
                                                <input type="text" class="form-control" id="inputtrabalho" name="local_trabalho" value="<?= $data['local_trabalho']  ?>" placeholder="Digite seu local de trabalho" required>

                                                <label for="inputAddress">Endereço</label>
                                                <input type="text" class="form-control" id="inputAddress" value="<?= $data['endereco']  ?>" placeholder="Digite seu Endereço" name="endereco" required>


                                                <label for="inputCEP">CEP</label>
                                                <input type="text" class="form-control" id="inputCEP" value="<?= $data['cep']  ?>" maxlength="8" name="cep" required>

                                                <label for="inputNumero">Número</label>
                                                <input type="text" class="form-control" id="inputNumero" value="<?= $data['numero']  ?>" name="numero" required>


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
                                        <form action="clientes.php" method="post">
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
</body>

</html>