<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");
?>

<head>
    <script>
        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('uf').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('rua').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('uf').value = (conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('rua').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('uf').value = "...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
    </script>
</head>
<?php
if (isset($_POST['salvar'])) {
    include("validarCPF.php");
    $nome = $_POST['nome_completo'];
    $email = $_POST['email'];
    $rua = $_POST['rua'];
    $cep = $_POST['cep'];
    $numero = $_POST['numero'];
    $local_trabalho = $_POST['local_trabalho'];
    $telefone_trabalho = $_POST['telefone_trabalho'];
    $sexo = $_POST['sexo'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone_celular = $_POST['telefone_celular'];
    $telefone_residencial = $_POST['telefone_residencial'];
    $bairro = $_POST['bairro'];
    $cpf = $_POST['cpf'];
    if (isset($_POST['statusAtualizar'])) {
        $statusAtualizar = 1;
    } else {
        $statusAtualizar = 0;
    }

    if (!validaCPF($cpf)) {
        header("location: NovoCliente.php?error=CPF Inválido");
        die();
    }

    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

    $sql1 = "SELECT * FROM cliente WHERE cpf = '{$cpf}'";
    $variavel =  mysqli_query($conexao, $sql1);
    $totalcpf =  mysqli_num_rows($variavel);

    if ($totalcpf > 0) {
        header("location: NovoCliente.php?aviso=CPF Já Cadastrado no Sistema");
        die();
    }
    $sql2 = "insert into cliente (nome_completo,email,rua,cep,bairro,numero,local_trabalho,telefone_trabalho,sexo,cidade,uf,data_nascimento,telefone_celular,telefone_residencial,cpf,status) 
        values ('{$nome}',
        '{$email}', 
        '{$rua}', 
        '{$cep}', 
        '{$bairro}',
        '{$numero}', 
        '{$local_trabalho}', 
        '{$telefone_trabalho}', 
        '{$sexo}',
        '{$cidade}',
        '{$uf}',
        '{$data_nascimento}',
        '{$telefone_celular}',
        '{$telefone_residencial}',
        '{$cpf}', 
        '{$statusAtualizar}')";

    //Executar a SQL
    mysqli_query($conexao, $sql2);

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
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
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
        <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_GET['error']; ?>
        </div>
        <?php } ?>
        <?php if (isset($_GET['aviso'])) { ?>
        <div class="alert alert-warning" role="alert">
            <?php echo $_GET['aviso']; ?>
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
                <div class="form-group col-md-3">
                    <label>CEP</label>
                    <input name="cep" type="text" id="cep" class="form-control" value="" size="10" maxlength="9" onchange="pesquisacep(this.value);" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Rua</label>
                    <input type="text" class="form-control" id="rua" size="60" placeholder="Digite seu Rua" name="rua" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Bairro</label>
                    <input name="bairro" type="text" class="form-control" id="bairro" required>
                </div>
                <div class="form-group col-md-1">
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
                    <input name="cidade" type="text" id="cidade" class="form-control" size="40" required>
                </div>
                <div class="form-group col-md-4">
                    <label>Estado</label>
                    <input name="uf" class="form-control" type="text" id="uf" required />
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
                    <input type="text" class="cpf form-control" id="cpf" name="cpf" maxlength="11" required>
                </div>
                <div class="form-group col-md-1"><label class="control-label" style="width: 200px !important;" for="status">Status</label>
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
                <a type="button" class="btn btn-warning" href="clientes.php"><i class="fas fa-arrow-circle-right"></i><b> Ir para Gestão de Clientes</b></a>
            </center>
        </form>
        <br>
        <br>
    </div>
    <script>
        $('.cpf').mask('000.000.000-00', {
            reverse: true
        });
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
        document.getElementById('inputNasc').max = `${ano}-${mes}-${dia}`


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
    </script>

</body>

</html>