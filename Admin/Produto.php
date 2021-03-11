<?php
require_once("../dependencias.php");
require_once("../verificaSessao.php");
require_once("../menu.php");

if (isset($_POST['salvar'])) {
    //Pega os valores dos inputs do formulário
    $nome = $_POST['nome'];
    $codigo = $_POST['codigo'];
    $valorvenda = $_POST['valorvenda'];
    $categoria = $_POST['categoria'];
    $marca = $_POST['marca'];
    $medida = $_POST['medida'];
    //$status = $_POST['status'];
    $quantidade = $_POST['quantidade'];
    if (isset($_POST['status'])) {
        $status = 1;
    } else {
        $status = 0;
    }

    //Iniciar a conexão com o BD
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');

    //Gerar a SQL
    $sql = "insert into produto (nome,codigo,valor_venda,Categoria_id,Marca_id,medida_id,status,quantidade) 
        values ('{$nome}','{$codigo}', '{$valorvenda}', '{$categoria}', '{$marca}', '{$medida}', '{$status}', '{$quantidade}') ";

    //Executar a SQL
    mysqli_query($conexao, $sql);

    //Fechar a conexão com o BD
    mysqli_close($conexao);
    //Mensagem de sucesso
    $mensagem = "Registro salvo com sucesso.";
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Cadastrar Produto</title>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <style>
        .teste {
            background-image: url("../img/textura2.jpg");
        }
    </style>
</head>

<body class="teste">
    <center style="margin-top: 100px;">
        <strong style="margin-top: 30px; font-size: 40px;">Cadastro de Produto</strong>
    </center>
    <div class="container" style="margin-top: 30px;">
        <?php if (isset($mensagem)) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $mensagem; ?>
        </div>
        <?php } ?>
        <form name="form" method="POST" action="Produto.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Nome do Produto</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="Digite o Nome" name="nome">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Código do Produto</label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="Digite o Código" name="codigo">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputValorVenda">Valor Venda</label>
                    <input type="double" id="dinheiro" name="valorvenda" class="dinheiro form-control" style="display:inline-block" />
                </div>
                <div class="form-group col-md-2">
                    <label for="inputCategoria">Categoria do Produto</label>
                    <select id="inputCategoria" class="form-control" name="categoria">
                        <?php
                        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                        $sql = "select * from categoria ";
                        $categorias = mysqli_query($conexao, $sql);
                        mysqli_close($conexao);
                        while ($data = mysqli_fetch_array($categorias)) { ?>

                        <option value="<?= $data['id']  ?> "><?= $data['nome']  ?></option>
                        <?php  }    ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputMarca">Marca</label>
                    <select id="inputMarca" class="form-control" name="marca">
                        <?php
                        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                        $sql = "select * from marca ";
                        $marcas = mysqli_query($conexao, $sql);
                        mysqli_close($conexao);
                        while ($data = mysqli_fetch_array($marcas)) { ?>

                        <option value="<?= $data['id']  ?> "><?= $data['nome']  ?></option>
                        <?php  }    ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputQuantidade">Quantidade</label>
                    <input type="text" class="form-control" id="inputQuantidade" name="quantidade">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputUnidadedeMedida">Unidade de Medida</label>
                    <select id="inputUnidadeMedida" class="form-control" name="medida">
                        <?php
                        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'tcc');
                        $sql = "select * from medida ";
                        $categorias = mysqli_query($conexao, $sql);
                        mysqli_close($conexao);
                        while ($data = mysqli_fetch_array($categorias)) { ?>

                        <option value="<?= $data['id']  ?> "><?= $data['nome']  ?></option>
                        <?php  }    ?>
                    </select>
                </div>
                <!--
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" onclick="teste(this);" id="customCheck1" name="status">
                    <label class="custom-control-label" for="customCheck1" id="labelstatus">Status</label>
                </div>
                        -->
                <div class="form-group col-sm-12 col-md-6 col-lg-2 col-xl-2"><label class="control-label" for="status">Status</label><input type="hidden" name="status" value="0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" name="status" value="1" id="status" onclick="teste(this);" checked>
                            </div>
                        </div>
                        <div class="form-control"><strong class="text-success" id="labelstatus">Ativo</strong></div>
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <center>
                <button type="submit" class="btn btn-success" name="salvar">Cadastrar</button>
                <a type="button" class="btn btn-warning" href="Estoque.php"><i class="fas fa-arrow-circle-right"></i><b> Ir para Estoque</b></a>
            </center>
        </form>

    </div>
    <script>
        $('.dinheiro').mask('#.##0,00', {
            reverse: true
        });

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