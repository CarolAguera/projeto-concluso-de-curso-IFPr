<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");

if (isset($_POST['salvar'])) {
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


    $sql = "insert into cliente (nome_completo,email,endereco,cep,numero,local_trabalho,telefone_trabalho,sexo,cidade,estado,data_nascimento,telefone_celular,telefone_residencial,cpf,status) 
        values ('{$nome}',
        '{$email}', 
        '{$endereco}', 
        '{$cep}', 
        '{$numero}', 
        '{$local_trabalho}', 
        '{$telefone_trabalho}', 
        '{$sexo}',
        '{$cidade}',
        '{$estado}',
        '{$data_nascimento}',
        '{$telefone_celular}',
        '{$telefone_residencial}',
        '{$cpf}', 
        '{$statusAtualizar}')";

    //Executar a SQL
    mysqli_query($conexao, $sql);

    //Fechar a conexão com o BD
    mysqli_close($conexao);

    //Mensagem de sucesso
    $mensagem = "Registro salvo com sucesso.";
    //header("Refresh:5");
}
require_once("../menu.php");

?>

<head>
    <title>Novo Cliente</title>
    <style>
        .centr {
            margin-left: 60px;
        }

        .teste {
            background-image: url("../img/textura2.jpg");
        }
    </style>
</head>

<body class="teste">
    <div class="container display-4" style="margin-top: 25px;">
        <h3>Novo Cliente</h3>
    </div>
    <hr width="74%" />
    <div class="container">
        <?php if (isset($mensagem)) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $mensagem; ?>
        </div>
        <?php } ?>
        <form name="form" id="form" method="post" action="NovoCliente.php" class="needs-validation" novalidate>
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="inputNome">Nome Completo</label>
                    <input type="text" class="form-control" name="nome_completo" placeholder="Digite seu Nome Completo" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Digite a Email" name="email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAddress">Endereço</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Digite seu Endereço" name="endereco" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCEP">CEP</label>
                    <input type="text" class="form-control" id="inputCEP" placeholder="Ex.: 00000-000" maxlength="8" name="cep" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputNumero">Número</label>
                    <input type="text" class="form-control" id="inputNumero" name="numero" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputtrabalho">Local de Trabalho</label>
                    <input type="text" class="form-control" id="inputtrabalho" name="local_trabalho" placeholder="Digite seu local de trabalho" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputtrabalhotelefone">Telefone Trabalho</label>
                    <input type="text" class="form-control" id="inputtrabalhotelefone" name="telefone_trabalho" placeholder="Digite o Telefone do seu trabalho " required>
                </div>

                <div class="form-group col-md-3">
                    <label for="inputSexo">Sexo</label>
                    <select name="sexo" id="inputSexo" class="form-control ls-select" required>
                        <option value="" disabled="disabled" selected>Escolher...</option>
                        <option value="1">Feminino</option>
                        <option value="2">Masculino</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Cidade</label>
                    <input type="text" class="form-control" placeholder="Digite a Cidade" name="cidade" id="inputCity" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEstado">Estado</label>
                    <select id="inputEstado" class="form-control" name="estado" required>
                        <option value="" disabled="disabled" selected>Escolher...</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputNasc">Data de Nascimento</label>
                    <input type="date" class="form-control" id="inputNasc" name="data_nascimento" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputCel">Celular</label>
                    <input type="text" class="form-control " name="telefone_celular" id="inputCel" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputTelefone">Telefone</label>
                    <input type="text" class="form-control" id="inputTelefone  " name="telefone_residencial" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCPF">CPF</label>
                    <input type="cpf" class="form-control" id="inputCPF" name="cpf" maxlength="11" required>
                </div>
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

            <center>
                <button type="submit" class="btn btn-success" name="salvar">Cadastrar</button>
                <a type="button" class="btn btn-warning" href="clientes.php"><i class="fas fa-arrow-circle-right"></i><b> Ir para Gestão de Clientess</b></a>
            </center>
        </form>
        <br>
        <br>
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
    <?php
    require_once("rodape.php");
    ?>
</body>

</html>