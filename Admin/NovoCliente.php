<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");
require_once("../menu.php");

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

    


}


?>

<head>
    <title>Novo Cliente</title>
    <style>
        .centr {
            margin-left: 60px;
        }
    </style>
</head>

<body>
    <br>
    <div class="container display-4">
        <h3>Novo Cliente</h3>
    </div>
    <hr width="74%" />
    <div class="container">
        <?php if (isset($mensagem)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $mensagem; ?>
            </div>
        <?php } ?>
        <form name="form" id="form" method="post" action="NovoCliente.php">
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="inputNome">Nome Completo</label>
                    <input type="text" class="form-control" name="nome_completo" placeholder="Digite seu Nome Completo">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Digite a Email" name="email">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAddress">Endereço</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Digite seu Endereço" name="endereco">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCEP">CEP</label>
                    <input type="text" class="form-control" id="inputCEP" placeholder="Ex.: 00000-000" maxlength="8" name="cep">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputNumero">Número</label>
                    <input type="text" class="form-control" id="inputNumero" name="numero">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputtrabalho">Local de Trabalho</label>
                    <input type="text" class="form-control" id="inputtrabalho" name="local_trabalho" placeholder="Digite seu local de trabalho">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputtrabalhotelefone">Telefone Trabalho</label>
                    <input type="text" class="form-control" id="inputtrabalhotelefone" name="telefone_trabalho" placeholder="Digite o Telefone do seu trabalho ">
                </div>

                <div class="form-group col-md-3">
                    <label for="inputSexo">Sexo</label>
                    <select name="sexo" id="inputSexo" class="form-control ls-select">
                        <option value="" disabled="disabled" selected>Escolher...</option>
                        <option value="1">Feminino</option>
                        <option value="2">Masculino</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Cidade</label>
                    <input type="text" class="form-control" placeholder="Digite a Cidade" name="cidade" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEstado">Estado</label>
                    <select id="inputEstado" class="form-control" name="estado">
                        <option value="" disabled="disabled">Escolher...</option>
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
                    <input type="date" class="form-control" id="inputNasc" name="data_nascimento">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputCel">Celular</label>
                    <input type="text" class="form-control phone-ddd-mask" name="telefone_celular" id="inputCel">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputTelefone">Telefone</label>
                    <input type="text" class="form-control" id="inputTelefone  phone-ddd-mask" name="telefone_residencial">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCPF">CPF</label>
                    <input type="cpf" class="form-control" id="inputCPF" name="cpf" placeholder="Ex.: 000.000.000-00" maxlength="11">
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
                <button type="submit" class="btn btn-success" name="salvar">Enviar</button>
            </center>
        </form>
        <br>
        <br>
    </div>
    <script>
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