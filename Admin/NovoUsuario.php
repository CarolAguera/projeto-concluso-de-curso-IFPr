<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");
require_once("../menu.php");

if (isset($_POST['salvar'])) {
    $nome_completo = $_POST['nome_completo'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $data_demissao = $_POST['data_demissao'];

    if (isset($_POST['statusAtualizar'])) {
        $statusAtualizar = 1;
    } else {
        $statusAtualizar = 0;
    }

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);


    //Iniciar a conexão com o BD
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

    //Gerar a SQL
    $sql = "insert into usuario (nome_completo,status,email,senha,data_nascimento,sexo,data_demissao) 
        values ('{$nome_completo}','{$statusAtualizar}', '{$email}', '{$senhaCriptografada}', '{$data_nascimento}', '{$sexo}', '{$data_demissao}') ";

    //Executar a SQL
    mysqli_query($conexao, $sql);

    //Fechar a conexão com o BD
    mysqli_close($conexao);
    //Mensagem de sucesso
    $mensagem = "Registro salvo com sucesso.";
}

?>

<head>
    <title>Novo Usuário</title>
    <style>
        .centr {
            margin-left: 60px;
        }

        .custom-control {
            position: relative;
            display: block;
            padding-left: 80px;
            margin-top: 37px;
        }

        .teste {
            background-image: url("../img/textura2.jpg");
        }
    </style>
</head>

<body class="teste">
    <div class="container display-4" style="margin-top: 20px;">
        <h3>Novo Usuário</h3>
    </div>
    <hr width="74%" />
    <div class="container">
        <?php if (isset($mensagem)) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $mensagem; ?>
        </div>
        <?php } ?>
        <form name="form" id="form" method="post" class="needs-validation" novalidate>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputNome">Nome Completo</label>
                    <input type="text" class="form-control" name="nome_completo" placeholder="Digite seu Nome Completo" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Digite a Email" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputPassword4">Senha</label>
                    <input type="password" class="form-control" id="inputPassword4" name="senha" placeholder="Digite a Senha" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputNasc">Data de Nascimento</label>
                    <input type="date" class="form-control" id="inputNasc" name="data_nascimento" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputSexo">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control" required>
                        <option value="" disabled="disabled" selected>Escolher...</option>
                        <option value="1">Masculino</option>
                        <option value="2">Feminino</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputDemissao">Data de Demissão</label>
                    <input type="date" class="form-control" id="inputDemissao" name="data_demissao">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-group col-md-1"><label class="control-label" style="width: 200px !important;" for="status">Status</label><input type="hidden" name="status" value="0">
                        <div class="input-group" style="width: 200px !important;">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" name="statusAtualizar" value="1" id="status" onclick="teste(this);" checked>
                                </div>
                            </div>
                            <div class="form-control"><strong class="text-success" id="labelstatus">Ativo</strong></div>
                        </div>
                        <span class="help-block"></span>
                    </div>

                </div>
            </div>

            <center>
                <button type="submit" class="btn btn-success" name="salvar">Cadastrar</button>
                <a type="button" class="btn btn-warning" href="usuarios.php"><i class="fas fa-arrow-circle-right"></i><b> Ir para Gestão de Usuários</b></a>
            </center>
        </form>
        <br>
        <br>
    </div>

    <script>
        let dataAtual = new Date();
        let dia = dataAtual.getDate();
        if (dia < 10) {
            dia = '0' + dia;
        }
        let mes = dataAtual.getMonth() + 1;
        if (mes < 10) {
            mes = '0' + mes;
        }
        let ano = dataAtual.getFullYear();
        document.getElementById('inputNasc').max = `${ano}-${mes}-${dia}`;
        document.getElementById('inputDemissao').max = `${ano}-${mes}-${dia}`;

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

        function teste(tag) {
            let labelAtivo = document.getElementById('labelstatus');
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